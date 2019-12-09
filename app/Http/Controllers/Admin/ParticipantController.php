<?php

namespace App\Http\Controllers\Admin;
;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Scheduleparticipant;
use App\Group;
use App\Type;
use App\Category;
use App\Participant;
use App\Surveyform;
use App\SurveyQuestion;
use App\SurveyOption;
use App\SurveyFormInfo;
use App\Package\SendEmailLib;
use App\Package\SendSMSLib;
use App\EmailTemplate;
use App\SMSTemplate;
use App\Trigger;
use App\Helpers\CommonHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\ParticipantRequest;
use DB;
use Input;
use Auth;
use App\Setting;

class ParticipantController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/';
    }

    protected function _encrypt($moment_id) {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) {

       if ($request->has('extraData')) {
            $extraData = $request->input('extraData');
           
            if(!empty($extraData['schedule_id'])){
                $scheduleParticipants = Scheduleparticipant::where('schedule_id', $extraData['schedule_id'])->pluck('participant_id')->toArray();
            }
        }
        $this->data['group'] = DB::table('tbl_groups')->where('is_deleted', 0)->select('*')->get();
        $this->data['type'] = DB::table('tbl_types')->select('*')->where('is_deleted', 0)->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $this->data['allCategories'] = Category::Select('id', 'category_name')
                ->where('is_deleted', 0)
                ->get();
        $this->data['country'] = Country::Select('dial_code', 'name')->get();
        $scheduleParticipants = !empty($scheduleParticipants)?$scheduleParticipants:array(0);
        $login_user = Auth::user();

        $this->data['page_title'] = "Participant Management";
        
        if (!$request->ajax()) {
            return view('admin.participant.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_option_data = DB::table('tbl_participants')
                ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->where('is_deleted', 0)
                ->orderBy('id', 'desc');

        $segment = $extraData['segment'];
        //echo $segment;die;

        if (!empty($scheduleParticipants) && $segment=='list_schedule_participants') {
            $survey_option_data->whereIn('id', $scheduleParticipants);
        }
        
        $survey_option_data = $survey_option_data->get();
        $query = $this->getDataManual($extraData);
            $survey_option_data = $query;
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_option_data)
            ->addColumn('action', function($row) {
                $edit_url = route('participant.edit', $row->id);
                $delete_url = route('participant.destroy', $row->id);
                $submitted_form_url = route('participant_form', $row->id);
                // $links = '<a title="Survey Form Details" rel="'.$form_details.'" href="'.$form_details.'" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View Survey Form</a>&nbsp';
                $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                $links .= '<a title="'. __('message.more').' '.__('message.details').'" href="javascript:void(0)" class="text-info mr-2 text-25 more-details"><i class="i-Magnifi-Glass1 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="Get survey forms submitted by ' . $row->first_name . '" href="' . $submitted_form_url . '" class="btn btn-primary"><i class="i-Magnifi-Glass1 nav-icon font-weight-bold" aria-hidden="true"></i>&nbsp; '.__('message.survey_report').'</a>';
                return $links;
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['first_name', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->check_user_role();

        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['on_behalf'] = Setting::where('setting_key','on_behalf_of')->first();

        $this->data['menu_type'] = 1;
        return view('admin.participant.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantRequest $request) {
        $login_user = Auth::user();


        $participant = new Participant;
        $participant->first_name = $request->input('first_name');
        $participant->last_name = $request->input('last_name');
        $participant->email = $request->input('email');
        $participant->dial_code = $request->input('dialing_code');

        $participant->mobile = $request->input('mobile');

        $participant->on_behalf_first_name = $request->input('on_behalf_first_name');
        $participant->on_behalf_last_name = $request->input('on_behalf_last_name');
        $participant->on_behalf_email = $request->input('on_behalf_email');
        $participant->on_behalf_mobile = $request->input('on_behalf_mobile');

        $participant->gender = $request->input('gender');
        $participant->dob = $request->input('dob');
        $participant->location_id = $request->input('location_id');
        $participant->category_id = $request->input('category_id');
        $participant->sub_category_id = $request->input('sub_category_id');
        $participant->group_id = $request->input('group_id');
        $participant->type_id = $request->input('type_id');
        $participant->comment = $request->input('comment');
        $participant->is_updated = 1;

        $participant->user_id = $login_user->id;
        // $participant->created_at = date('Y-m-d');


        if ($participant->save()) {
            $participant_id = $participant->id;
            $data = DB::table('tbl_participants')->where('id',$participant->id)->first();
            $auto_trigger_data = DB::table('tbl_auto_trigger_setting')
                                ->select('*')
                                // ->where('type',$data->type_id)
                                // ->where('category', $data->category_id)
                                // ->where('group',$data->group_id)
                                ->where('trigger_event', 1)->get();
                
            foreach ($auto_trigger_data as $key => $value) {
                $group = explode(',', $value->group);
                $type = explode(',', $value->type);
                $category = explode(',', $value->category);
                
                $grouparray = array_search($data->group_id,$group);
                $typearray = array_search($data->type_id,$type);
                $categoryarray = array_search($data->category_id,$category);

                $group = $group[$grouparray];
                $type = $type[$typearray];
                $category = $category[$categoryarray];
                if(($group && $type && $category) != null ){
                $auto_trigger_data = DB::table('tbl_auto_trigger_setting')
                                ->select('*')
                                ->where('type',$type)
                                ->where('category', $category)
                                ->where('group',$group)
                                ->where('trigger_event', 1)->get();
                }
                                
            if (!empty($auto_trigger_data)) {
                foreach ($auto_trigger_data as $trigger_data) {
                    if ($trigger_data->trigger_event == 1) { //for created participant
                        $trigger_array = array("trigger_id" => $trigger_data->id,
                            "email_templ_id" => $trigger_data->email_templ_id,
                            "sending_method" => $trigger_data->sending_method,
                            "form_id" => $trigger_data->form_id,
                            "waiting_hours" => $trigger_data->waiting_hours,
                            "waiting_time_formate" => $trigger_data->waiting_time_formate,
                            "trigger_name" => $trigger_data->trigger_name,
                            "trigger_event" => $trigger_data->trigger_event,
                            "participant_id" => $participant_id,
                            'auth_id'   => $login_user->id,
                        );
                        // if immediately is checked
                        if ($trigger_data->immediately == 1) {
                            if ($trigger_data->sending_method == 1) { // for send sms
                            $this->sendAutoTriggerSMS($trigger_array);
                            } else {
                                $this->sendAutoTriggerEmail($trigger_array);
                            }    
                        }
                        
                    }
                }
            } 
        } 
        // else {
        //         $request->session()->flash('message.level', 'success');
        //     $request->session()->flash('message.content', 'Participant created successfully!21');
        //         return redirect()->route('participant.index');
        //     }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content',  __('message.participant').' '.__('message.created').' '.__('message.successfully'));
            return redirect()->route('participant.index');
        }
    }

    /* ==========================================
     * This function is use for send email for auto trigger setting
     */

    public function sendAutoTriggerEmail($trigger_data) {
        $count = 0;
        $participant_data = Participant::where('id', $trigger_data['participant_id'])->first();

        $template = EmailTemplate::Select('id', 'title', 'content')
                ->where('id', $trigger_data['email_templ_id'])
                ->first();
        $ids = [];
        $contentData = $template->content;
        $token = md5(time());
        if ($participant_data) {
            $trigger_id = $trigger_data['trigger_id'];
            $mail = new SendEmailLib;
            $to = $participant_data->email;
            $template->content = str_replace('(participant_name)', $participant_data->first_name, $contentData);
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

                        $expl = explode('_', $searchResult);
                        array_push($ids, $expl[1]);
                        $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                        // survey link url
                        // $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                        // modeified link
                        $longUrl = $link."/".$this->_encrypt($participant_data->id).'/'.$this->_encrypt(2).'/'.$token.'/';

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

            if(!empty($to)){
                    $subject = $template->title;
                    $message = $template->content;
                    $message.= "<br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to,$subject,$message);
                    $count++;
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $participant_data->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', $trigger_data['auth_id'])
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $participant_data->id)
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $participant_data->id, 'token'=>$token, 'sms_email' => 2, 'user_id' => $trigger_data['auth_id']);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }
                    return true;

                } else {
                return false;
            }
        } else {
            return false;
        }
    }

//END sendAutoTriggerEmail();


    /* ==========================================
     * This function is use for send sms for auto trigger setting
     */

    public function sendAutoTriggerSMS($trigger_data) {
        $participant = Participant::where('id', $trigger_data['participant_id'])->first();
        $token = md5(time());
        if ($participant) {

            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title', 'content')
                    ->where('id', $trigger_data['email_templ_id'])
                    ->first();
            $ids = [];
            $contentData = $template->content;
            $domainName = $_SERVER['SERVER_NAME'];
            $trigger_id = $trigger_data['trigger_id'];
            $sender_id = CommonHelper::getSettingByKey('sender_id');
            $user_account = CommonHelper::getSettingByKey('user_account');
            $user_password = CommonHelper::getSettingByKey('user_password');

            // $survey_form_link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($trigger_data['form_id']);

            $token = md5(time());
            $to_number = $participant->dial_code . $participant->mobile;

            // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $participant->first_name, $contentData);

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

                        $expl = explode('_', $searchResult);
                        array_push($ids, $expl[1]);
                        $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                        // survey link url
                        $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                        // modeified link
                        $longUrl = $link."/".$this->_encrypt($participant->id).'/'.$this->_encrypt(2).'/'.$token.'/';

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
                $message_content = $template->content;
                $msg = $message_content;//." ".$data->url;
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

                if(!empty($send_sms_status)){
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $participant->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 1)
                            ->where('user_id', $trigger_data['auth_id'])
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $participant->id)
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $participant->id, 'token'=>$token, 'sms_email' => 1, 'user_id' => $trigger_data['auth_id']);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }

                }
        } else {
            return false;
        }
    }

//END sendAutoTriggerSMS()



    /* ==========================================
     * This function is use for send sms for auto trigger setting
     */

    public function checkSMSBalence(Request $request) {
        $check_sms = new SendSMSLib;

        $user_account = CommonHelper::getSettingByKey('user_account');
        $user_password = CommonHelper::getSettingByKey('user_password');

        $message_body = array("userAccount" => $user_account->setting_value,
            "passAccount" => $user_password->setting_value
        );
        $balence = $check_sms->checkSmsBalence($message_body);
        echo json_encode($balence);
        exit();
    }

//END sendAutoTriggerSMS()

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {

        $login_user = Auth::user();

        $this->data['page_title'] = "Participant Management";

        if (!$request->ajax()) {
            return view('admin.participant.survey_form_list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_form_info = DB::table('tbl_participants')
                ->select('tbl_participants.first_name', 'tbl_participants.last_name', 'tbl_participants.on_behalf_first_name', 'tbl_participants.on_behalf_last_name', 'tbl_survey_count.is_submitted_send', 'tbl_survey_form.survey_form_title', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->join('tbl_survey_count', 'tbl_participants.id', '=', 'tbl_survey_count.participant_id')
                ->join('tbl_survey_form', 'tbl_survey_form.id', '=', 'tbl_survey_count.form_id')
                ->orderBy('tbl_survey_count.id', 'desc')
                ->get();



        return Datatables::of($survey_form_info)
                        ->addColumn('action', function($row) {
                            $form_details = route('participant_form_details', $row->form_id . '/' . $row->token);
                            $links = '<a title="Survey Form Details" rel="' . $form_details . '" href="javascript:void(0)" class="btn btn-success survey_form_details"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>&nbsp';
                            //$links .= '<a title="Active" data-href="' . $active_url . '" class="btn btn-warning active_inactive_data"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>';
                            return $links;
                        })
                        ->editColumn('created_at', function($row) {
                            return date('d M, Y', strtotime($row->created_at));
                        })
                        ->filterColumn('created_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->filterColumn('updated_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->rawColumns(['first_name', 'action'])
                        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displaySurveyParticipant(Request $request) {

        $login_user = Auth::user();

        $this->data['page_title'] = "Participant Management";

        if (!$request->ajax()) {
            return view('admin.participant.survey_form_list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_form_info = DB::table('tbl_participants')
                ->select('tbl_participants.id as parti_id', 'tbl_participants.first_name', 'tbl_participants.last_name', 'tbl_participants.on_behalf_first_name', 'tbl_participants.on_behalf_last_name', 's_count.*', 'tbl_survey_form.survey_form_title', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->join('tbl_survey_count as s_count', 'tbl_participants.id', '=', 's_count.participant_id')
                ->join('tbl_survey_form', 's_count.form_id', '=', 'tbl_survey_form.id')
                ->orderBy('s_count.id', 'desc');

        $base_path = $this->data['base_path'];

        return Datatables::of($survey_form_info)
                        ->addColumn('action', function($row) {
                            $form_details = route('participant_form_details', $row->form_id . '/' . $row->token);

                            if ($row->is_submitted_send == 2) {
                                $links = '<a title="Survey Form Details" rel="' . $form_details . '" href="javascript:void(0)" class="btn btn-success survey_form_details"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>&nbsp';
                            } else {
                                $links = '<a title="Resend survey link to participant" form-data="' . $row->form_id . '" rel="' . $row->parti_id . '" href="javascript:void(0)" class="btn btn-primary send_survey_form_link"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Survey Link</a>&nbsp';
                            }

                            //$links .= '<a title="Active" data-href="' . $active_url . '" class="btn btn-warning active_inactive_data"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>';
                            return $links;
                        })
                        ->editColumn('created_at', function($row) {
                            return date('d M, Y', strtotime($row->created_at));
                        })
                        ->filterColumn('created_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->filterColumn('updated_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->rawColumns(['first_name', 'action'])
                        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function form_detail(Request $request, $id, $token) {
        $login_user = Auth::user();
        //echo $token;die;

        $this->data['page_title'] = "Participant Management";

        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $id])
                ->get();

        $submit_survey_form = SurveyFormInfo::where(['form_id' => $id, 'token' => $token])->get();

        $html = '';
        $question = 1;
        $html .= '<div class="modal-header">';
        $html .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $html .= '<img style="width:60px;height:60px;float:left;" src="' . $this->data['base_path'] . $survey_form_data[0]->survey_form_logo . '">  <h4 class="modal-title">' . $survey_form_data[0]->survey_form_title . '</h4>';
        $html .= '</div>';

        $html .= '<div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="portlet-body form">
                                        <div class="form-body">';
        $html .= '<p style="text-align:center;font-size:25px;">' . $survey_form_data[0]->survey_form_header . '</p>';

        $i = 1;
        if ($submit_survey_form) {
            foreach ($submit_survey_form as $value) {
                $html .= '<strong>' . $i . ': </strong>' . $value->survey_question . '<br>';
                $unserialize_array = unserialize($value->answer);
                foreach ($unserialize_array['answer'] as $k => $t) {
                    if (!empty($unserialize_array['question_type'][$k]) && $unserialize_array['question_type'][$k] == 5) { // for star rating
                        for ($i = 1; $i <= $unserialize_array['answer'][$k]; $i++) {
                            $html .= '<span class="star_rating"><i class="fa fa-star"></i></span>';
                        }
                    } else {
                        $html .= '<span class="option_val">' . $unserialize_array['answer'][$k] . ' </span>';
                    }

                    $html .= (!empty($unserialize_array['option_point'][$k]['option_point'])) ? "(" . $unserialize_array['option_point'][$k]['option_point'] . ")<br>" : "<br>";
                }
                $i++;
            }
        }

        $html .= '</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p style="text-align:center;font-size:25px;">' . $survey_form_data[0]->survey_form_footer . '</p>
            </div>';

        echo json_encode($html);
        die();
    }

//END form_detail()

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_dialing_code(Request $request) {
        $country_data = Country::where('id', $request->get('location_id'))->first(); 
        echo json_encode($country_data->dial_code);
        die();
    }

//END form_detail()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $participant_data = Participant::where('id', $id);
        $login_user = Auth::user();

        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['on_behalf'] = Setting::where('setting_key','on_behalf_of')->first();

        $this->data['repairman_data'] = $participant_data->first();
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('participant.index');
        }
        return view('admin.participant.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipantRequest $request, $id) {
        $login_user = Auth::user();
        $survey_participant = Participant::find($id);
        if (empty($survey_participant)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('participant.index');
        }

        $survey_participant->first_name = $request->input('first_name');
        $survey_participant->last_name = $request->input('last_name');
        $survey_participant->email = $request->input('email');
        $survey_participant->dial_code = $request->input('dialing_code');
        $survey_participant->mobile = $request->input('mobile');
        $survey_participant->on_behalf_first_name = $request->input('on_behalf_first_name');
        $survey_participant->on_behalf_last_name = $request->input('on_behalf_last_name');
        $survey_participant->on_behalf_email = $request->input('on_behalf_email');
        $survey_participant->on_behalf_mobile = $request->input('on_behalf_mobile');
        $survey_participant->gender = $request->input('gender');
        $survey_participant->dob = $request->input('dob');
        $survey_participant->location_id = $request->input('location_id');
        $survey_participant->category_id = $request->input('category_id');
        $survey_participant->sub_category_id = $request->input('sub_category_id');
        $survey_participant->group_id = $request->input('group_id');
        $survey_participant->type_id = $request->input('type_id');
        $survey_participant->comment = $request->input('comment');
        $survey_participant->is_updated = 2;


        if ($survey_participant->save()) {

            $participant_id = $survey_participant->id;
            
            $data = DB::table('tbl_participants')->where('id',$survey_participant->id)->first();
            $auto_trigger_data = DB::table('tbl_auto_trigger_setting')
                                ->select('*')
                                // ->where('type',$data->type_id)
                                // ->where('category', $data->category_id)
                                // ->where('group',$data->group_id)
                                ->where('trigger_event', 2)->get();
             foreach ($auto_trigger_data as $key => $value) {
                $group = explode(',', $value->group);
                $type = explode(',', $value->type);
                $category = explode(',', $value->category);
                
                $grouparray = array_search($data->group_id,$group);
                $typearray = array_search($data->type_id,$type);
                $categoryarray = array_search($data->category_id,$category);

                $group = $group[$grouparray];
                $type = $type[$typearray];
                $category = $category[$categoryarray];
                // find_in_set is used to find value in table column which paerated by comma(,)
                $auto_trigger_data = DB::table('tbl_auto_trigger_setting')
                                ->select('*')
                                ->whereRaw("find_in_set('".$type."', tbl_auto_trigger_setting.type)")
                                // ->where('type',$type)
                                ->whereRaw("find_in_set('".$category."', tbl_auto_trigger_setting.category)")
                                // ->where('category', $category)
                                ->whereRaw("find_in_set('".$group."', tbl_auto_trigger_setting.group)")
                                // ->where('group',$group)
                                ->where('trigger_event', 2)->get();
                                
            if (!empty($auto_trigger_data)) {
                foreach ($auto_trigger_data as $trigger_data) {
                    if ($trigger_data->trigger_event == 2) {
                        $trigger_array = array("trigger_id" => $trigger_data->id,
                            "email_templ_id" => $trigger_data->email_templ_id,
                            "sending_method" => $trigger_data->sending_method,
                            "form_id" => $trigger_data->form_id,
                            "waiting_hours" => $trigger_data->waiting_hours,
                            "waiting_time_formate" => $trigger_data->waiting_time_formate,
                            "trigger_name" => $trigger_data->trigger_name,
                            "trigger_event" => $trigger_data->trigger_event,
                            "participant_id" => $participant_id,
                            'auth_id'   => $login_user->id,
                        );
                        // if immediately is checked
                        
                        if ($trigger_data->immediately == 1) {
                            if ($trigger_data->sending_method == 1) { // for send sms
                            $this->sendAutoTriggerSMS($trigger_array);
                            } else {
                                $this->sendAutoTriggerEmail($trigger_array);
                            }    
                        }
                    }
                }
            }
            //  else {
            //     $request->session()->flash('message.level', 'danger');
            //     $request->session()->flash('message.content', 'Something went wrong!');
            //     return redirect()->route('participant.index');
            // }
        }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.updated').' '.__('message.successfully'));
            return redirect()->route('participant.index');
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('participant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {

        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $participant = Participant::find($id);
        $response = array('status' => true, 'message' => __('message.participant').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($participant)) {
            $response = array('status' => false, 'message' => __('message.participant').' '.__('message.not').' '.__('message.found'));
        } else {
            $participant->is_deleted = 1;
            $participant->save();
        }
        echo json_encode($response);
        die();
    }

    function check_user_role() {
        if (Auth::user()->user_role == 2) {
            echo "Access Denied";
            die;
        }
    }

    /*
     * Get More details of participant
     */

    function moreDetailsParticipant(Request $request) {

        if (!$request->ajax()) {
            return;
        }

        $data = Participant::with(array('category' => function($query) {
                        $query->select('id', 'category_name');
                    }))
                ->with(array('sub_category' => function($query) {
                        $query->select('id', 'category_name');
                    }))
                ->with(array('location' => function($query) {
                        $query->select('id', 'name');
                    }))
                ->with(array('group' => function($query) {
                        $query->select('id', 'group_name');
                    }))
                ->with(array('type' => function($query) {
                        $query->select('id', 'type_name');
                    }))
                ->where('id', $request->input('participant_id'))
                ->first();

        $response = array('status' => true, 'data' => $data);
        echo json_encode($response);
    }

    //list of scheduled participants 
    public function listScheduleParticipants(Request $request, $id) {
        $this->data['schedule_id'] = $id;
        $this->data['group'] = DB::table('tbl_groups')->where('is_deleted', 0)->select('*')->get();
        $this->data['type'] = DB::table('tbl_types')->select('*')->where('is_deleted', 0)->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $this->data['allCategories'] = Category::Select('id', 'category_name')
                ->where('is_deleted', 0)
                ->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        return view('admin.participant.list', $this->data);
    }

    // 31-08-2018
    public function Quick_Add_Participant(Request $request)
    {

        $login_user = Auth::user();
        $participant = new Participant;

        $participant->first_name = $request->input('first_name');
        $participant->last_name = $request->input('last_name');
        $participant->email = $request->input('email');
        $participant->mobile = $request->input('mobile');
        $participant->dial_code = $request->input('dialing_code');
        $participant->user_id = $login_user->id;
        $participant->gender = $request->input('gender');
        $participant->dob = $request->input('dob');
        $participant->location_id = $request->input('location_id');
        $participant->category_id = $request->input('category_id');
        $participant->sub_category_id = $request->input('sub_category_id');
        $participant->group_id = $request->input('group_id');
        $participant->type_id = $request->input('type_id');
        $participant->comment = $request->input('comment');

        $participant->save();
        $participant_id = $participant->id;
            $auto_trigger_data = DB::table('tbl_auto_trigger_setting')->select('*')->where('trigger_event', 1)->get();
            if (!empty($auto_trigger_data)) {
                foreach ($auto_trigger_data as $trigger_data) {
                    if ($trigger_data->trigger_event == 1) { //for created participant
                        $trigger_array = array("trigger_id" => $trigger_data->id,
                            "email_templ_id" => $trigger_data->email_templ_id,
                            "sending_method" => $trigger_data->sending_method,
                            "form_id" => $trigger_data->form_id,
                            "waiting_hours" => $trigger_data->waiting_hours,
                            "waiting_time_formate" => $trigger_data->waiting_time_formate,
                            "trigger_name" => $trigger_data->trigger_name,
                            "trigger_event" => $trigger_data->trigger_event,
                            "participant_id" => $participant_id,
                            'auth_id'        => $login_user->id,
                        );
                        // if immediately is checked
                        if ($trigger_data->immediately == 1) {
                            if ($trigger_data->sending_method == 1) { // for send sms
                            $this->sendAutoTriggerSMS($trigger_array);
                            } else {
                                $this->sendAutoTriggerEmail($trigger_array);
                            }    
                        }else{
                            if ($trigger_data->sending_method == 1) { // for send sms
                            $this->sendAutoTriggerSMS($trigger_array);
                            } else {
                                $this->sendAutoTriggerEmail($trigger_array);
                            } 
                        }
                        
                    }
                }
            }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.participant').' '.__('message.created').' '.__('message.successfully'));
        return redirect()->back();
    }
    public function quick_participant_setting(Request $request){
        $get_quick_data = DB::table('tbl_quick_add_setting')->where('id', 1)->get();
        if($get_quick_data){
            $quick_add = DB::table('tbl_quick_add_setting')->where('id', 1)->update([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'location' => $request->get('location'),
                'mobile' => $request->get('mobile'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'category' => $request->get('category'),
                'sub_category' => $request->get('sub_category'),
                'group' => $request->get('group'),
                'type' => $request->get('type'),
                'comment' => $request->get('comment'),
                'quick_add_button' => $request->get('quick_add_button')
            ]);
            
        }else{
            $insert_quick_data = DB::table('tbl_quick_add_setting')->insert([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'location' => $request->get('location'),
                'mobile' => $request->get('mobile'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'category' => $request->get('category'),
                'sub_category' => $request->get('sub_category'),
                'group' => $request->get('group'),
                'type' => $request->get('type'),
                'comment' => $request->get('comment'),
                'quick_add_button' => $request->get('quick_add_button')
            ]);
        }    
        $quick_setting = DB::table('tbl_quick_add_setting')->where('id',1)->first();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.participant').' '.__('message.setting').' '.__('message.created').' '.__('message.successfully'));
        $this->data['quick_setting'] = $quick_setting;
        return view('admin.setting.quick_participant_setting', $this->data);
    }

    function getDataManual($extraData) {
        DB::statement(DB::raw('set @rownum=0'));
        $query = DB::table('tbl_participants')
                ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->where('is_deleted', 0)
                ->orderBy('id', 'asc');

        if (!empty($extraData['category_id'])) {
            $query->where('category_id', $extraData['category_id']);
        }

        if (!empty($extraData['sub_category_id'])) {
            $query->where('sub_category_id', $extraData['sub_category_id']);
        }

        if (!empty($extraData['location_id'])) {
            $query->where('location_id', $extraData['location_id']);
        }

        if (!empty($extraData['group_id'])) {
            $query->where('group_id', $extraData['group_id']);
        }

        if (!empty($extraData['type_id'])) {
            $query->where('type_id', $extraData['type_id']);
        }

        if (!empty($extraData['gender'])) {
            $query->where('gender', $extraData['gender']);
        }

        if (!empty($extraData['search_filter_value'])) {
            $query->where(function($q) use ($extraData) {
                $q->where(DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'), 'like', "%" . $extraData['search_filter_value'] . "%");
                $q->orWhere('email', $extraData['search_filter_value']);
                $q->orWhere('mobile', $extraData['search_filter_value']);
            });
        }    
        if (isset($extraData) and isset($extraData['filter']) and strtolower($extraData['filter']) != 'all') {
            if (isset($extraData['filter2']) and strtolower($extraData['filter2']) != 'all') {
                if ($extraData['filter'] == 'category') {
                    $query->where('category_id', $extraData['filter2']);
                }
                if ($extraData['filter'] == 'group') {
                    $query->where('group_id', $extraData['filter2']);
                }
                if ($extraData['filter'] == 'country') {
                    $query->where('location_id', $extraData['filter2']);
                }
                if ($extraData['filter'] == 'type') {
                    $query->where('type_id', $extraData['filter2']);
                }
            }
        }
            return $query;
    }
    function participantSearch(Request $request){
        //dd($request);
        $category_id = $request->get('category_id') ? $request->get('category_id') : '';
        $sub_category_id = $request->get('sub_category_id') ? $request->get('sub_category_id') : '';
        $type_id = $request->get('type_id') ? $request->get('type_id') : '';
        $location_id = $request->get('location_id') ? $request->get('location_id') : '';
        $gender = $request->get('gender') ? $request->get('gender') : '';
        $group_id = $request->get('group_id') ? $request->get('group_id') : '';


        $survey_option_data = DB::table('tbl_participants')
                ->select('*')
                ->where('is_deleted', 0);
                

        if($category_id){
            $survey_option_data = $survey_option_data->where('category_id',$category_id);
        }
        if($sub_category_id){
            $survey_option_data = $survey_option_data->where('sub_category_id',$sub_category_id);
        }
        if($type_id){
            $survey_option_data = $survey_option_data->where('type_id',$type_id);
        }
        if($location_id){
            $survey_option_data = $survey_option_data->where('location_id',$location_id);
        }
        if($gender){
            $survey_option_data = $survey_option_data->where('gender',$gender);
        }
        if($group_id){
            $survey_option_data = $survey_option_data->where('group_id',$group_id);
        }        
        $survey_option_data = $survey_option_data->orderBy('id', 'desc')->get();
        //dd($survey_option_data);        
        return $survey_option_data;
    }

}
