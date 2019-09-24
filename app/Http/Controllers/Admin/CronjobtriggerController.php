<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Participant;
use App\EmailTemplate;
use App\SMSTemplate;
use App\Trigger;
use App\Schedule;
use App\SurveyFormInfo;
use App\Scheduleparticipant;
use App\Schedulereminder;
use App\Scheduleremindercount;
use App\ScheduleCount;
use App\FeedBackComplains;
use App\Type;
use App\Package\SendEmailLib;
use App\Package\SendSMSLib;
use App\Helpers\CommonHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TypeRequest;
use DB;
use Input;
use Auth;
use Carbon\Carbon;

class CronjobtriggerController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        // $this->data['base_path'] = url('/') . '/';
        $this->data['base_path'] = 'http://ss.erjaan.com/admin/';
    }

    protected function _encrypt($moment_id) {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    public function triggerForNewParticipant() {
        $triggers = Trigger::select('*')->where(['trigger_event' => 1])->get();
        if (!$triggers->isEmpty()) {
            foreach ($triggers as $obj) {
                $time_diff = 'TIMESTAMPDIFF(' . strtoupper($obj->waiting_time_formate) . ', created_at, NOW()) as time_diff';
                $user_data[$obj->waiting_hours . "_" . $obj->waiting_time_formate . "_" . $obj->form_id . "_" . $obj->email_templ_id . "_" . $obj->sending_method] = Participant::select(DB::raw($time_diff), 'id', 'first_name', 'last_name', 'email', 'dial_code', 'mobile', 'on_behalf_first_name', 'on_behalf_last_name', 'on_behalf_email', 'on_behalf_mobile', 'created_at')
                    ->where(['is_updated' => 1, 'is_deleted' => 0])->having('time_diff', '=', $obj->waiting_hours)->get()->toArray();
            }
        }
        if (!empty($user_data)) {
            $param = array();
            foreach ($user_data as $key => $data) {
                $keys = explode("_", $key);
                $param['survey_id'] = $keys[2];
                $param['template'] = $keys[3];
                $param['email_type'] = $keys[4];
                $param['on_behalf'] = 2;


                $param['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($keys[2]);
                $this->sendNotifyToParticipant($param, $data);
            }
        }
    }

    public function triggerForUpdateParticipant() {
        $triggers = Trigger::select('*')->where(['trigger_event' => 2])->get();
        if (!$triggers->isEmpty()) {
            foreach ($triggers as $obj) {
                $time_diff = 'TIMESTAMPDIFF(' . $obj->waiting_time_formate . ', created_at, now()) as time_diff';
                $user_data[$obj->waiting_hours . "_" . $obj->waiting_time_formate . "_" . $obj->form_id . "_" . $obj->email_templ_id . "_" . $obj->sending_method] = Participant::select(DB::raw($time_diff), 'id', 'first_name', 'last_name', 'email', 'dial_code', 'mobile', 'on_behalf_first_name', 'on_behalf_last_name', 'on_behalf_email', 'on_behalf_mobile', 'created_at')
                    ->where(['is_updated' => 2, 'is_deleted' => 0])->having('time_diff', '=', $obj->waiting_hours)->get()->toArray();
            }
        }
        if (!empty($user_data)) {
            $param = array();
            foreach ($user_data as $key => $data) {
                $keys = explode("_", $key);
                $param['survey_id'] = $keys[2];
                $param['template'] = $keys[3];
                $param['email_type'] = $keys[4];
                $param['on_behalf'] = 2;


                $param['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($keys[2]);
                $this->sendNotifyToParticipant($param, $data);
            }
        }
    }

    function sendNotifyToParticipant($params, $participant) {
        $count = 0;
        $temp_id = $params['template'];
        $email_type = $params['email_type'];

        if ($email_type == 1) { // for send sms
            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title', 'content')
                    ->where('id', $temp_id)
                    ->first();

            $domainName = $_SERVER['SERVER_NAME'];

            $sender_id = CommonHelper::getSettingByKey('sender_id');
            $user_account = CommonHelper::getSettingByKey('user_account');
            $user_password = CommonHelper::getSettingByKey('user_password');

            $ids= [];
            $contentData = $template->content;            
            foreach ($participant as $row) {
                $token = md5(time());
                $to_number = $params['on_behalf'] == 2 ? $row['dial_code'] . $row['mobile'] : $row['dial_code'] . $row['mobile'];
                // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $row['first_name'], $contentData);

                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');

                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{

                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row['id']).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/';

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }
                $message_content = $template->content;
                $msg = $message_content;//." ".$data->url;

                //$msg .= "Click above link to open the survey form.";
                
                $MsgID = rand(1, 99999);

                $message_body = array("userAccount" => $user_account->setting_value,
                    "passAccount" => $user_password->setting_value,
                    "numbers" => $to_number,
                    "sender" => $sender_id->setting_value,
                    "msg" => $msg,
                    "timeSend" => 0,
                    "dateSend" => 0,
                    "applicationType" => '68',
                    "domainName" => $domainName,
                    "MsgID" => $MsgID,
                    "deleteKey" => 0
                );

                $send_sms_status = $send_sms->sendSMS($message_body);

                if (!empty($send_sms_status)) {
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $row['id'])
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 1)
                            ->where('user_id', \Auth::user()->id)
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $row['id'])
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $row['id'], 'token'=>$token, 'sms_email' => 1, 'user_id' => \Auth::user()->id);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }
                } else {
                    //notify to admin
                }
            }
            //here is remaining code for send sms api use
        } else { //for Email template            

            $template = EmailTemplate::Select('id', 'title', 'content')
                    ->where('id', $temp_id)
                    ->first();

            $ids = [];
            $contentData = $template->content;            
            foreach ($participant as $row) {
                $token = md5(time());
                $mail = new SendEmailLib;
                $to = $params['on_behalf'] == 2 ? $row['email'] : $row['email'];
                $template->content = str_replace('(participant_name)', $row['first_name'], $contentData);

                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');
                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);

                        //this section for send complain pop-up window to participant
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{

                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row['id']).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/'.$this->_encrypt(0);;

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }


                if (!empty($to)) {
                   $subject = $template->title;
                    $message = $template->content;
                    $message.= "<br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to,$subject,$message);
                    $count++;

                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $row['id'])
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', \Auth::user()->id)
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $row['id'])
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $row['id'], 'token'=>$token, 'sms_email' => 2, 'user_id' => \Auth::user()->id);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }
                }
            }
        }
    }

    //schedule trigger
    public function scheduleTrigger() {
        // dd(date('h:i A'));
         $date = date('h:i A');
        $a = explode(':', $date);
        if ($a[0]<10) {
            $ab = $a[0];
            $abc = $ab.':'.$a[1];
        }
        if (isset($abc)) {
            $date = $abc;
        }
        // old
        $allSchedules = Schedule::select('id', 'user_id')->where('schedule_date', '=', date("Y-m-d"))->where('schedule_time', '=', $date)->where('status', 1)->get();
        
        // ->where('schedule_time', '=', $date)
        // edited by kandarp pandya 30-01-2019
        // $allSchedules = Schedule::where('status', 1)->get();

        // dd($allSchedules, date('h:i A'), $date, date("Y-m-d"));
        $participant_data = array();
        if (!$allSchedules->isEmpty()) {
            $noOfTime = 0;
            foreach ($allSchedules as $obj) {
                // if number of trial is not null
                $participant_data[$obj->id] = DB::table('tbl_scheduled_participant')
                        ->select('tbl_participants.*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                        ->join('tbl_participants', 'tbl_participants.id', '=', 'tbl_scheduled_participant.participant_id')
                        ->where('schedule_id', $obj->id)
                        ->orderBy('tbl_scheduled_participant.id', 'desc')
                        ->get();
            }
        }
        // dd($noOfTime);
        if (!empty($participant_data)) {
            $param = array();
            $daysArray = array(
                'hourly' => 1,
                'monthly' => 1,
                'quarterly' => 3,
                'halfyearly' => 6,
                'annually' => 12,
            );
            
            foreach ($participant_data as $key => $data) {
                $scheduleData = Schedule::select('*')->where('id', $key)->first();
                //to increment the sent schedule date.
                if ($scheduleData['schedule_type'] != 'one_time') {
                    if ($scheduleData['schedule_type'] != 'hourly') {
                        if ($date == $scheduleData['schedule_time']) {
                            $nMonths = $daysArray[$scheduleData['schedule_type']];
                            $startDate = $scheduleData['schedule_date'];
                            $final_date = Carbon::parse($startDate)->addMonths($nMonths)->format('Y-m-d');
                            DB::table('tbl_schedule')
                            ->where('id', $key)
                            ->update(['schedule_date' => $final_date]);
                        }
                    } else {
                        // if schedule type is hours then update hours
                        if (strtotime($scheduleData['end_date']) >= strtotime(date('Y-m-d'))) {
                            DB::table('tbl_schedule')
                            ->where('id', $key)
                            ->update(['schedule_time' => date('h:i A', strtotime('+1 hour'))]);
                        }
                    }
                }
                $param['auth_id'] = $scheduleData['user_id'];
                $param['survey_id'] = $scheduleData['survey_form_id'];
                $param['template'] = $scheduleData['survey_template_type'];
                $param['email_type'] = $scheduleData['survey_email_sms_sending_method'];
                $param['on_behalf'] = $scheduleData['survey_sendto_method'];
                $param['on_behalf'] = $scheduleData['survey_sendto_method'];
                $param['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($scheduleData['survey_form_id']);
                // edited by kandarp pandya 30-01-2019
                $countPS = ScheduleCount::where('schedule_id', $key)->count();
                
                if ($scheduleData['number_of_times'] != null && $scheduleData['number_of_times'] > $countPS) {
                    //insert values in schedule reminder count table
                    $values = array('schedule_id' => $key, 'participant_id' => $data[0]->id);
                    DB::table('tbl_schedule_count')->insert($values);
                    $this->sendNotifyToParticipantSchedule($param, $data);
                } else {
                    // if number of times is null and end date is current date or equal to less than
                    if ($scheduleData['number_of_times'] == null && date('Y-m-d') <= $scheduleData['end_date']) {
                        $this->sendNotifyToParticipantSchedule($param, $data);
                    }
                }
                
            }
        }
    }

    function sendNotifyToParticipantSchedule($params, $participant) {
        $count = 0;
        $temp_id = $params['template'];
        $email_type = $params['email_type'];

        if ($email_type == 1) { // for send sms
            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title', 'content')
                    ->where('id', $temp_id)
                    ->first();

            $domainName = $_SERVER['SERVER_NAME'];

            $sender_id = CommonHelper::getSettingByKey('sender_id');
            $user_account = CommonHelper::getSettingByKey('user_account');
            $user_password = CommonHelper::getSettingByKey('user_password');

            $ids = [];
            $contentData = $template->content;
            foreach ($participant as $row) {
                $token = md5(time());
                $to_number = $params['on_behalf'] == 2 ? $row->dial_code . $row->mobile : $row->dial_code . $row->on_behalf_mobile;

                // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $row->first_name, $contentData);

                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');

                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{

                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row->id).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/';

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }
                $message_content = $template->content;
                $msg = $message_content;//." ".$data->url;
                //$msg .= "Click above link to open the survey form.";
                
                $MsgID = rand(1, 99999);

                $message_body = array("userAccount" => $user_account->setting_value,
                    "passAccount" => $user_password->setting_value,
                    "numbers" => $to_number,
                    "sender" => $sender_id->setting_value,
                    "msg" => $msg,
                    "timeSend" => 0,
                    "dateSend" => 0,
                    "applicationType" => '68',
                    "domainName" => $domainName,
                    "MsgID" => $MsgID,
                    "deleteKey" => 0
                );

                $send_sms_status = $send_sms->sendSMS($message_body);

                if (!empty($send_sms_status)) {
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 1)
                            ->where('user_id', $params['auth_id'])
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $row->id, 'token'=>$token, 'sms_email' => 1, 'user_id' => \Auth::user()->id);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }
                } else {
                    //notify to admin
                }
            }
            //here is remaining code for send sms api use
        } else {
            $template = EmailTemplate::Select('id', 'title', 'content')
                    ->where('id', $temp_id)
                    ->first();

            $ids = [];
            $contentData = $template->content;
            foreach ($participant as $row) {
                $token = md5(time());
                $mail = new SendEmailLib;
                $to = $params['on_behalf'] == 2 ? $row->email : $row->on_behalf_email;

                // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $row->first_name, $contentData);
                // foreach ($parameterList as $key => $value) {
                //     $template->content = str_replace('(' . strtolower(str_replace(' ', '_', $value->survey_form_title)) . ')', $value->survey_form_title, $template->content);    
                // }
                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');
                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);

                        //this section for send complain pop-up window to participant
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{

                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row->id).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/'.$this->_encrypt(0);;

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }
                if (!empty($to)) {
                    $subject = $template->title;
                    $message = $template->content;
                    $message.= "<br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                    $count++;

                    $survey_count = DB::table('tbl_survey_count')
                            ->select('token')
                            ->where('form_id', $params['survey_id'])
                            ->where('participant_id', $row->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', $params['auth_id'])
                            ->first();

                    if ($survey_count) {
                        DB::table('tbl_survey_count')
                                ->where('form_id', $params['survey_id'])
                                ->where('participant_id', $row->id)
                                ->update(['token' => $token]);
                    } else {
                        $values = array('form_id' => $params['survey_id'], 'participant_id' => $row->id, 'token' => $token, 'sms_email' => 2, 'user_id' => $params['auth_id']);
                        DB::table('tbl_survey_count')->insert($values);
                    }
                }
            }
        }
    }

    //schedule reminder trigger
    public function scheduleReminderTrigger() {
        $allSchedules = DB::table('tbl_schedule')
                ->select('tbl_schedule.survey_form_id', 'tbl_schedule.survey_template_type', 'tbl_schedule_reminder.*')
                ->join('tbl_schedule_reminder', 'tbl_schedule_reminder.schedule_id', '=', 'tbl_schedule.id')
                ->whereDate('tbl_schedule_reminder.created_at', '=', date("Y-m-d"))
                ->where('tbl_schedule.status', 1)
                ->orderBy('tbl_schedule.id', 'desc')
                ->get();
                
        $participant_data = array();
        if (!$allSchedules->isEmpty()) {
            foreach ($allSchedules as $obj) {
                $participant_data[$obj->schedule_id . '_' . $obj->rotation_number . '_' . $obj->survey_form_id . '_' . $obj->reminder_type_id . '_' . $obj->reminder_template_id . '_' . $obj->rotation_type . '_' . $obj->created_at . '_' . $obj->end_date]
                 = DB::table('tbl_scheduled_participant')
                        ->select('tbl_participants.*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                        ->join('tbl_participants', 'tbl_participants.id', '=', 'tbl_scheduled_participant.participant_id')
                        ->where('schedule_id', $obj->schedule_id)
                        ->orderBy('tbl_scheduled_participant.id', 'desc')
                        ->get()->toArray();
            }
        }
        // dd($participant_data);
        if (!empty($participant_data)) {
            $param = array();
            foreach ($participant_data as $key => $data) {
                $keys = explode("_", $key);
                // dd($keys);
                foreach ($data as $row) {
                    $records = SurveyFormInfo::select('participant_id')->where(['participant_id' => $row->id,'form_id' => $keys[2]])
                            ->groupby('participant_id')->first();
                    
                    $myPartiArrayID = array($records['participant_id']);
                    
                    //remove participant id from the array who has submitted the survey form already
                    $reminderData = Scheduleremindercount::select('id')->where(['schedule_id' => $key, 'participant_id' => $row->id])->count();
                    // edited by kandarp pandya 29-01-2019
                    if (isset($keys[7]) && $keys[7]) {
                        // checked if end date is not null
                        if (strtotime(date('Y-m-d')) <= strtotime($keys[7])) {
                            // if current date is equal to end date or lower to end date
                            $reminderData = $keys[1] - 1;
                        }
                    }
                    if($keys[1] > $reminderData && !in_array($row->id,$myPartiArrayID)){
                        $param['participant_id'] = $row->id;
                        $param['survey_id'] = $keys[4];
                        $param['dial_code'] = $row->dial_code;
                        $param['mobile'] = $row->mobile;
                        $param['email'] = $row->email;
                        $param['first_name'] = $row->first_name;
                        $param['last_name'] = $row->last_name;
                        $param['email_type'] = $keys[3];
                        $param['template'] = $keys[4];
                        $param['on_behalf'] = 2;
                        $param['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($keys[2]);
                        // dd($param, $keys[4]);
                        // edited by kandarp pandya 29-01-2019
                        // $key[5] == 8 means 8 for hourly
                        
                        if ($keys[5] == 8) {
                            // if reminder type is hourly
                            if (date('i') == '00') {
                                $this->sendNotifyToParticipantScheduleReminder($param);
                            }
                        } else {
                            $this->sendNotifyToParticipantScheduleReminder($param);
                        }
                        
                       
                        
                        //insert values in shchue reminder count table
                        $values = array('schedule_id' => $key, 'participant_id' => $row->id);
                        DB::table('tbl_schedule_reminder_count')->insert($values);

                        $final_date = Carbon::parse($keys[6])->addDays($keys[5])->format('Y-m-d H:i:s');

                        DB::table('tbl_schedule_reminder')
                                ->where('id', $key[0])
                                ->update(['created_at' => $final_date]);
                    }
                }
            }
        }
    }

    function sendNotifyToParticipantScheduleReminder($params) {
        
        $count = 0;
        $temp_id = $params['template'];
        $email_type = $params['email_type'];

        if ($email_type == 1) { // for send sms
            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title')
                    ->where('id', $temp_id)
                    ->first();

            $domainName = $_SERVER['SERVER_NAME'];

            $sender_id = CommonHelper::getSettingByKey('sender_id');
            $user_account = CommonHelper::getSettingByKey('user_account');
            $user_password = CommonHelper::getSettingByKey('user_password');


            //foreach ($participant as $row) {
                $token = md5(time());
                $to_number = $params['on_behalf'] == 2 ? $params['dial_code'] . $params['mobile'] : $params['dial_code'] . $params['mobile'];

                //$msg = $template->title . " " . $params['survey_form_link'] . "/" . $this->_encrypt($params['participant_id']) . '/' . $this->_encrypt($params['on_behalf']) . '/' . $token;
                
                $message_content = $params['first_name']." ".$params['last_name'].",  ".$template->content;

                $msg = $message_content." ". $params['survey_form_link']."/".$this->_encrypt($params['participant_id']).'/'.$this->_encrypt($params['on_behalf']).'/'.$token."  ";
                //$msg .= "Click above link to open the survey form.";
                $MsgID = rand(1, 99999);

                $message_body = array("userAccount" => $user_account->setting_value,
                    "passAccount" => $user_password->setting_value,
                    "numbers" => $to_number,
                    "sender" => $sender_id->setting_value,
                    "msg" => $msg,
                    "timeSend" => 0,
                    "dateSend" => 0,
                    "applicationType" => '68',
                    "domainName" => $domainName,
                    "MsgID" => $MsgID,
                    "deleteKey" => 0
                );

                $send_sms_status = $send_sms->sendSMS($message_body);

                if (!empty($send_sms_status)) {
                    $survey_count = DB::table('tbl_survey_count')
                            ->select('token')
                            ->where('form_id', $params['survey_id'])
                            ->where('participant_id', $params['participant_id'])
                            ->where('is_submitted_send', 1)
                            ->first();

                    if ($survey_count) {
                        DB::table('tbl_survey_count')
                                ->where('form_id', $params['survey_id'])
                                ->where('participant_id', $params['participant_id'])
                                ->update(['token' => $token]);
                    } else {
                        $values = array('form_id' => $params['survey_id'], 'participant_id' => $params['participant_id'], 'token' => $token);
                        DB::table('tbl_survey_count')->insert($values);
                    }
                } else {
                    //notify to admin
                }
            //}
            //here is remaining code for send sms api use
        } else {
            $template = EmailTemplate::Select('id', 'title')
                    ->where('id', $temp_id)
                    ->first();

            //foreach ($participant as $row) {
                $token = md5(time());
                $mail = new SendEmailLib;
                $to = $params['on_behalf'] == 2 ? $params['email'] : $params['email'];
                if (!empty($to)) {
                    $subject = $template['title'];
                    $message = "Hello " . $params['first_name'] . " " . $params['last_name'] . " ,<br>";
                    $message .= "Please submit survey on below link <br>";
                    $message .= '<a href="' . $params['survey_form_link'] . "/" . $this->_encrypt($params['participant_id']) . '/' . $this->_encrypt($params['on_behalf']) . '/' . $token . '"> Click Here </a> For submit survey information, Or Copy bellow link and use <br>' . $params['survey_form_link'] . "/" . $this->_encrypt($params['participant_id']) . '/' . $this->_encrypt($params['on_behalf']) . '/' . $token;
                    $message .= "<br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                    $count++;

                    $survey_count = DB::table('tbl_survey_count')
                            ->select('token')
                            ->where('form_id', $params['survey_id'])
                            ->where('participant_id', $params['participant_id'])
                            ->where('is_submitted_send', 1)
                            ->first();

                    if ($survey_count) {
                        DB::table('tbl_survey_count')
                                ->where('form_id', $params['survey_id'])
                                ->where('participant_id', $params['participant_id'])
                                ->update(['token' => $token]);
                    } else {
                        $values = array('form_id' => $params['survey_id'], 'participant_id' => $params['participant_id'], 'token' => $token);
                        DB::table('tbl_survey_count')->insert($values);
                    }
                }
            //}
        }
    }

    public function changeComplainStatus(Request $request)
    {
        $complaint = FeedBackComplains::where('status', 'new')->get();
        $status_day = DB::table('selected_feedback_question')->first();
        
        $day = $status_day ? $status_day->complain_status_day : 3;
        if (count($complaint) > 0) {
            foreach ($complaint as $key => $value) {
                $date = $value->created_at;
                $newDate = date('Y-m-d', strtotime($date. ' + '.$day.' days')); // Added 3 days to created date
                // if current date is greater then or same to the new date of created date
                if (date('Y-m-d') >= $newDate) {
                    // update status
                    FeedBackComplains::where('id', $value->id)->update([
                        'status' => 'late',
                        'modified_by'   => null,
                    ]);
                    //this section for send email to user,customer,admin
                    $status_notification = StatusNotification::where('id',4)->first();
                    $users = $status_notification ? explode(',',$status_notification->users) : null;
                    $feedbackDetails = FeedBackComplains::where('id', $value->id)->first();

                    $customerID = $request->get('id');
                    //send email to customer
                    if(isset($status_notification) && $status_notification->send_to_customer == 'yes' && $status_notification->status_template == 'email'){
                            $token = md5(time());
                            $mail = new SendEmailLib;
                            $to = $feedbackDetails->email;

                            $ids = [];
                            $countSurveyIn = substr_count($status_notification->customer_email_template, '(survey_');
                            if ($countSurveyIn > 0) {

                                for ($i=0; $i <= $countSurveyIn; $i++) {
                                    $fullstring = $status_notification->customer_email_template;
                                    //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                                    $string = ' ' . $fullstring;
                                    $start = '(';
                                    $end = ')';
                                    $ini = strpos($string, $start);
                                    if ($ini == 0) break;
                                    $ini += strlen($start);
                                    $len = strpos($string, $end, $ini) - $ini;
                                    $searchResult = substr($string, $ini, $len);
                                    $expl = explode('_', $searchResult);
                                    array_push($ids, $expl[1]);
                                    $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                                    
                                    $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                                    // modeified link
                                    $longUrl = $link."/".$this->_encrypt($customerID).'/'.$this->_encrypt(1).'/'.$token.'/'.$this->_encrypt(1);

                                    $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';
                                    
                                    $ch = curl_init();
                                    $timeout = 5;
                                    curl_setopt($ch,CURLOPT_URL,$url);
                                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                                    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                                    $data = curl_exec($ch);
                                    
                                    curl_close($ch);
                                    $data = json_decode($data);
                                    $status_notification->customer_email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->customer_email_template);

                                }    
                            }
                            //this section for create entry into the survey count
                            foreach ($ids as $key => $value) {
                                $survey_count = DB::table('tbl_survey_count')
                                            ->select('token') 
                                            ->where('form_id', $value)
                                            ->where('participant_id', $customerID)
                                            ->where('is_submitted_send', 1)
                                            ->where('sms_email', 2)
                                            ->where('user_id', Auth::id())
                                            ->first();
                                if($survey_count){
                                        DB::table('tbl_survey_count')
                                        ->where('form_id', $value)
                                        ->where('participant_id', $customerID)
                                        ->update(['token' => $token]);
                                    }else{
                                        $values = array('form_id' => $value,'participant_id' => $customerID, 'token'=>$token, 'sms_email' => 2, 'user_id' => Auth::id());
                                        DB::table('tbl_survey_count')->insert($values);
                                    }
                            }
                            $messageContent= str_replace('{var_customer_name}' ,$feedbackDetails->name,$status_notification->customer_email_template);
                            $messageContentFinal= str_replace('{var_customer_email}' ,$feedbackDetails->email,$messageContent);

                            $message_content = "Your complaint status is ". str_replace('_', ' ', $request->get('status')).", <br> Complain Date : ".$feedbackDetails->created_at.", <br> message : " .$messageContentFinal;
                            
                            $subject = "User Complaints";
                            $message = $message_content;
                            $message.= "<br><br><br>Thanks, <br> Digital Survey Team";
                            $test = $mail->sendEmail($to,$subject,$message);
                    }
                    //send email to all admin
                    if(isset($status_notification) && $status_notification->status_template == 'email'){
                        $admin = User::where('user_role', 0)->get();
                        foreach ($admin as $key => $value) {
                            if ($value->email) {
                                $token = md5(time());
                                $mail = new SendEmailLib;
                                $to = $value->email;
                                $messageContent= str_replace('{var_customer_name}' ,$feedbackDetails->name,$status_notification->customer_email_template);
                                $messageContentFinal= str_replace('{var_customer_email}' ,$feedbackDetails->email,$messageContent);
                                $message_content = $message_content = "Customer complaint status is ". str_replace('_', ' ', $request->get('status')).",<br> Complain Date : ".$feedbackDetails->created_at.", <br> message : " .$messageContentFinal;

                                $subject = "User Complaints";
                                $message = $message_content;
                                $message.= "<br><br><br>Thanks, <br> Digital Survey Team";
                                $test = $mail->sendEmail($to,$subject,$message);
                            }
                        }
                    }
                    //send email to selected users 
                    if(isset($status_notification) && $status_notification->status_template == 'email'){
                        foreach ($users as $key => $value) {
                            $user = User::where('id', $value)->first();
                            if ($user && $user->email) {
                                $token = md5(time());
                                $mail = new SendEmailLib;
                                $to = $user->email;

                                // $ids = [];
                                // $countSurveyIn = substr_count($status_notification->email_template, '(survey_');
                                // if ($countSurveyIn > 0) {

                                //     for ($i=0; $i <= $countSurveyIn; $i++) {
                                //         $fullstring = $status_notification->email_template;
                                //         //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                                //         $string = ' ' . $fullstring;
                                //         $start = '(';
                                //         $end = ')';
                                //         $ini = strpos($string, $start);
                                //         if ($ini == 0) break;
                                //         $ini += strlen($start);
                                //         $len = strpos($string, $end, $ini) - $ini;
                                //         $searchResult = substr($string, $ini, $len);
                                //         $expl = explode('_', $searchResult);
                                //         array_push($ids, $expl[1]);
                                //         $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                                        
                                //         $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                                //         // modeified link
                                //         $longUrl = $link."/".$this->_encrypt($customerID).'/'.$this->_encrypt(1).'/'.$token.'/'.$this->_encrypt(1);

                                //         $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';
                                        
                                //         $ch = curl_init();
                                //         $timeout = 5;
                                //         curl_setopt($ch,CURLOPT_URL,$url);
                                //         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                                //         curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                                //         $data = curl_exec($ch);
                                        
                                //         curl_close($ch);
                                //         $data = json_decode($data);
                                //         $status_notification->email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->email_template);

                                //     }    
                                // }
                                // //this section for create entry into the survey count
                                // foreach ($ids as $key => $value) {
                                //     $survey_count = DB::table('tbl_survey_count')
                                //                 ->select('token') 
                                //                 ->where('form_id', $value)
                                //                 ->where('participant_id', $customerID)
                                //                 ->where('is_submitted_send', 1)
                                //                 ->where('sms_email', 2)
                                //                 ->where('user_id', Auth::id())
                                //                 ->first();
                                //     if($survey_count){
                                //             DB::table('tbl_survey_count')
                                //             ->where('form_id', $value)
                                //             ->where('participant_id', $customerID)
                                //             ->update(['token' => $token]);
                                //         }else{
                                //             $values = array('form_id' => $value,'participant_id' => $customerID, 'token'=>$token, 'sms_email' => 2, 'user_id' => Auth::id());
                                //             DB::table('tbl_survey_count')->insert($values);
                                //         }
                                // }

                                $messageContent= str_replace('{var_user_name}' ,$user->name,$status_notification->email_template);
                                $messageContentFinal= str_replace('{var_user_email}' ,$user->email,$messageContent);
                                $message_content = $message_content = "Your complaint status is ". str_replace('_', ' ', $request->get('status')).", <br> Complain Date : ".$feedbackDetails->created_at.", <br> message : " .$messageContentFinal;

                                $subject = "User Complaints";
                                $message = $message_content;
                                $message.= "<br><br><br>Thanks, <br> Digital Survey Team";
                                $test = $mail->sendEmail($to,$subject,$message);
                            }
                        }
                    }
        //end send email section
                }
            
            }
            
        }
    }

}
