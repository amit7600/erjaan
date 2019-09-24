<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use App\Participant;
use App\Surveyform;
use Input;
use App\Country;
use Yajra\Datatables\Datatables;
use App\Package\SendSMSLib;
use App\Helpers\CommonHelper;
use App\FeedBackComplains;
use App\Category;
use Carbon\Carbon;


class DashboardController extends Controller {

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/';
    }
    
    public function index(Request $request) {
        $user = Auth::user();
        $role = $user->user_role;
        $user_id = $user->id;
        if (!session()->has('select_chart_by')) {
            session(['select_chart_by' => 2]);    
        }
        if (!session()->has('select_chart_type')) {
            session(['select_chart_type' => 2]);
        }
        
        $this->data['menu_type'] = 1;
        $this->data['country'] = Country::Select('id', 'name')->get();
        session(['country' => $this->data['country']]);
        $this->data['user_count'] = User::Select('id', 'name')->where('user_role', 1)->where('status', 1)->count();
        $this->data['participant_count'] = Participant::Select('id', 'name')->where('is_deleted', 0)->where('status', 1)->count();
        $this->data['survey_form_count'] = Surveyform::Select('id', 'user_id')->where('is_deleted', 0)->where('status', 1)->count();
        $this->data['in_progress'] = FeedBackComplains::Select('*')->where('status', 'in_progress')->count();
        $this->data['new'] = FeedBackComplains::Select('*')->where('status', 'new')->count();
        $this->data['resolved'] = FeedBackComplains::Select('*')->where('status', 'resolved')->count();
        $this->data['late'] = FeedBackComplains::Select('*')->where('status', 'late')->count();
        $this->data['participant_new'] = Participant::Select('*')->where('is_updated', 1)->count();
        $this->data['participant_new_today'] = Participant::Select('*')->where('is_updated', 1)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['participant_new_weekly'] = Participant::Select('*')->where('is_updated', 1)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['participant_new_month'] = Participant::Select('*')->where('is_updated', 1)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['participant_new_year'] = Participant::Select('*')->where('is_updated', 1)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();
        $this->data['participant_update'] = Participant::Select('*')->where('is_updated', 2)->count();
        $this->data['participant_update_today'] = Participant::Select('*')->where('is_updated', 2)->whereDate('updated_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['participant_update_weekly'] = Participant::Select('*')->where('is_updated', 2)->whereDate('updated_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['participant_update_month'] = Participant::Select('*')->where('is_updated', 2)->whereDate('updated_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['participant_update_year'] = Participant::Select('*')->where('is_updated', 2)->whereDate('updated_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();
        $this->data['in_progress_response'] = FeedBackComplains::Select('*')->where('status', 'in_progress')->count();
        $this->data['new_response'] = FeedBackComplains::Select('*')->where('status', 'new')->count();
        $this->data['resolved_response'] = FeedBackComplains::Select('*')->where('status', 'resolved')->count();
        $this->data['late_response'] = FeedBackComplains::Select('*')->where('status', 'late')->count();


        //Here Feedback Responses
        $this->data['feedback_today'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',1)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['feedback_weekly'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',1)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['feedback_month'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',1)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['feedback_year'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',1)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();

        //Here Feedback Responses for teminal 2
        $this->data['feedback_today2'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',2)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['feedback_weekly2'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',2)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['feedback_month2'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',2)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['feedback_year2'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',2)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();

        //Here Feedback Responses for teminal 3
        $this->data['feedback_today3'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',3)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['feedback_weekly3'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',3)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['feedback_month3'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',3)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['feedback_year3'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',3)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();

        //Here Feedback Responses for teminal 4
        $this->data['feedback_today4'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',4)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['feedback_weekly4'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',4)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['feedback_month4'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',4)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['feedback_year4'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',4)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();

        //Here Feedback Responses for teminal 5
        $this->data['feedback_today5'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',5)->whereDate('created_at', Carbon::now()->format('Y/m/d'))->count();
        $this->data['feedback_weekly5'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',5)->whereDate('created_at','>=', Carbon::now()->subDays(7)->toDateTimeString())->count();
        $this->data['feedback_month5'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',5)->whereDate('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->count();
        $this->data['feedback_year5'] = DB::table('feedback_survey')->Select('*')->where('feedback_id',5)->whereDate('created_at','>=', Carbon::now()->subDays(365)->toDateTimeString())->count();

        
        
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

        //sms count 11/9
        // $sms_count = DB::table('tbl_survey_count')
        //             ->select('*')
        //             ->count();
        // $this->data['sms_count'] = $sms_count;

        //Participant List Start
        $this->data['participant_record'] = Participant::Select('*')->where('is_deleted', 0)->where('status', 1)->paginate(10);
        
        //Participant List end

        $update = DB::table('reset_sms_email')
                    ->select('updated_at')
                    ->where('id',1)->first();
        $update_email = DB::table('reset_sms_email')
                    ->select('updated_at')
                    ->where('id',2)->first();        
                       

        $sms_count = DB::table('tbl_survey_count')
                    ->join('reset_sms_email','tbl_survey_count.sms_email','=','reset_sms_email.id')
                    ->select('tbl_survey_count.*')
                    ->where('tbl_survey_count.updated_at','>',$update->updated_at)
                    ->where('tbl_survey_count.sms_email',1)
                    ->count();
       
        $this->data['sms_count'] = $sms_count;            

        $sms_response_count = DB::table('tbl_survey_count')
                    ->join('reset_sms_email','tbl_survey_count.sms_email','=','reset_sms_email.id')
                    ->select('tbl_survey_count.*')
                    ->where('tbl_survey_count.updated_at','>',$update->updated_at)
                    ->where('tbl_survey_count.is_submitted_send',2)
                    ->where('tbl_survey_count.sms_email',1)
                    ->count();
        $this->data['sms_response_count'] = $sms_response_count;

        $email_count =  DB::table('tbl_survey_count')
                    ->join('reset_sms_email','tbl_survey_count.sms_email','=','reset_sms_email.id')
                    ->select('tbl_survey_count.*')
                    ->where('tbl_survey_count.updated_at','>',$update_email->updated_at)
                    ->where('tbl_survey_count.sms_email',2)
                    ->count();
        $this->data['email_count'] = $email_count;

        // $email_response_count = DB::table('tbl_survey_count')
        //             ->select('*')
        //             ->where('is_submitted_send',2)
        //             ->where('sms_email',2)
        //             ->count();
            $email_response_count =  DB::table('tbl_survey_count')
                    ->join('reset_sms_email','tbl_survey_count.sms_email','=','reset_sms_email.id')
                    ->select('tbl_survey_count.*')
                    ->where('tbl_survey_count.updated_at','>',$update_email->updated_at)
                    ->where('tbl_survey_count.is_submitted_send',2)
                    ->where('tbl_survey_count.sms_email',2)
                    ->count();  

        $this->data['email_response_count'] = $email_response_count;

        //sms balance

        $check_sms = new SendSMSLib;

        $user_account = CommonHelper::getSettingByKey('user_account');
        $user_password = CommonHelper::getSettingByKey('user_password');

        $message_body = array("userAccount" => $user_account->setting_value,
            "passAccount" => $user_password->setting_value
        );
        $balence = $check_sms->checkSmsBalence($message_body);
        
        $this->data['sms_balance'] = $balence;
        

        //end sms

        $setting_data = DB::table('tbl_settings')
                        ->select('*')->get();

        $form_id = $setting_data[4]->setting_value;
        
        //to show the kpi report
        $survey_record = DB::table('tbl_survey_form')
                ->select('id', 'survey_form_title')
                ->where('is_deleted', 0)
                ->where('id', $form_id)
                ->where('status', 1)
                ->limit(1)
                ->first();
        

        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => isset($survey_record) ? $survey_record->id : null])
                ->get();

        $this->data['survey_form_data'] = $survey_form_data;
        $permission_data = DB::table('tbl_user_role')
                        ->select('view_dashboard')
                        ->where('view_dashboard', 1)
                        ->first();
        $this->data['permission_data'] = $permission_data;

        $this->data['survey_form_id'] = isset($survey_record) ? $survey_record->id : null;
        $this->data['survey_form_title'] = isset($survey_record) ?  $survey_record->survey_form_title : '';
        $this->data['setting'] = DB::table('tbl_settings')
                    ->get();
        //feedback chart
        $question = DB::table('feedback_question')
                            ->join('feedback_survey','feedback_survey.question_id', '=', 'feedback_question.id')
                            ->select('feedback_survey.*','feedback_question.*');
        $question = $question->where('feedback_question.feedback_id',1)->get();
        $total_question = DB::table('feedback_question')->select('*')->where('feedback_id',1)->get();
        $feedback_question[] = $question;

        //feedback chart 2    
        $question2 = DB::table('feedback_question')
                            ->join('feedback_survey','feedback_survey.question_id', '=', 'feedback_question.id')
                            ->select('feedback_survey.*','feedback_question.*');
        $question2 = $question2->where('feedback_question.feedback_id',2)->get();
        $total_question2 = DB::table('feedback_question')->select('*')->where('feedback_id',2)->get();
        $feedback_question2[] = $question2;

        //feedback chart 3
        $question3 = DB::table('feedback_question')
                            ->join('feedback_survey','feedback_survey.question_id', '=', 'feedback_question.id')
                            ->select('feedback_survey.*','feedback_question.*');
        $question3 = $question3->where('feedback_question.feedback_id',3)->get();
        $total_question3 = DB::table('feedback_question')->select('*')->where('feedback_id',3)->get();
        $feedback_question3[] = $question3;

        //feedback chart 4
        $question4 = DB::table('feedback_question')
                            ->join('feedback_survey','feedback_survey.question_id', '=', 'feedback_question.id')
                            ->select('feedback_survey.*','feedback_question.*');
        $question4 = $question4->where('feedback_question.feedback_id',4)->get();
        $total_question4 = DB::table('feedback_question')->select('*')->where('feedback_id',4)->get();
        $feedback_question4[] = $question4;

        //feedback chart 5
        $question5 = DB::table('feedback_question')
                            ->join('feedback_survey','feedback_survey.question_id', '=', 'feedback_question.id')
                            ->select('feedback_survey.*','feedback_question.*');
        $question5 = $question5->where('feedback_question.feedback_id',5)->get();
        $total_question5 = DB::table('feedback_question')->select('*')->where('feedback_id',5)->get();
        $feedback_question5[] = $question5;

        $user_id = null;$city = null;$created_from = null;$created_to = null;
        //compain chart
        $new = DB::table('feedback_complains')->select('*')->where('status','new')->get();
        $in_progress = DB::table('feedback_complains')->select('*')->where('status','in_progress')->get();
        $resolved = DB::table('feedback_complains')->select('*')->where('status','resolved')->get();
        $late = DB::table('feedback_complains')->select('*')->where('status','late')->get();
        // $feedback_complain = $feedback_complain->get();
        $feedback_complain = array($new,$in_progress,$resolved,$late);
         $data[] = '';
        //complain end
        //reason chart start here

        $reason = DB::table('feedback_reason')->where('feedback_id',1)->select('*');

        
        $reason = $reason->get();
        $feedback_reason = $reason;
        $results_total = DB::table('feedback_reason')->where('feedback_id',1)->select('*')->get();
        $total = 0;
        foreach ($reason as $key => $value) {
            $results = DB::table('feedback_rating')->where('feedback_id',1)->select('*')
            ->where('comment', $value->feedback_reason)->count();            
            $total = $total + $results;
                        }  

        $reason2 = DB::table('feedback_reason')->where('feedback_id',2)->select('*');
        $reason2 = $reason2->get();
        $feedback_reason2 = $reason2;
        $results_total2 = DB::table('feedback_reason')->where('feedback_id',2)->select('*')->get();
        $total2 = 0;
        foreach ($reason2 as $key => $value) {
            $results = DB::table('feedback_rating')->where('feedback_id',2)->select('*')
            ->where('comment', $value->feedback_reason)->count();            
            $total2 = $total2 + $results;
                        } 

        $reason3 = DB::table('feedback_reason')->where('feedback_id',3)->select('*');
        $reason3 = $reason3->get();
        $feedback_reason3 = $reason3;
        $results_total3 = DB::table('feedback_reason')->where('feedback_id',3)->select('*')->get();
        $total3 = 0;
        foreach ($reason3 as $key => $value) {
            $results = DB::table('feedback_rating')->where('feedback_id',3)->select('*')
            ->where('comment', $value->feedback_reason)->count();            
            $total3 = $total3 + $results;
                        }

        $reason4 = DB::table('feedback_reason')->where('feedback_id',4)->select('*');
        $reason4 = $reason4->get();
        $feedback_reason4 = $reason4;
        $results_total4 = DB::table('feedback_reason')->where('feedback_id',4)->select('*')->get();
        $total4 = 0;
        foreach ($reason4 as $key => $value) {
            $results = DB::table('feedback_rating')->where('feedback_id',4)->select('*')
            ->where('comment', $value->feedback_reason)->count();            
            $total4 = $total4 + $results;
                        } 
        //dd($response_array4);                     

        $reason5 = DB::table('feedback_reason')->where('feedback_id',5)->select('*');
        $reason5 = $reason5->get();
        $feedback_reason5 = $reason5;
        $results_total5 = DB::table('feedback_reason')->where('feedback_id',5)->select('*')->get();
        $total5 = 0;
        foreach ($reason5 as $key => $value) {
            $results = DB::table('feedback_rating')->where('feedback_id',5)->select('*')
            ->where('comment', $value->feedback_reason)->count();            
            $total5 = $total5 + $results;
                        }                                                  
        //dd($response_array4);
        //dd($feedback_reason_data4);
        $this->data['total_reason'] = $total;
        $this->data['feedback_reason_data'] = $feedback_reason;
        $this->data['total_reason2'] = $total2;
        $this->data['feedback_reason_data2'] = $feedback_reason2;
        $this->data['total_reason3'] = $total3;
        $this->data['feedback_reason_data3'] = $feedback_reason3;
        $this->data['total_reason4'] = $total4;
        $this->data['feedback_reason_data4'] = $feedback_reason4;
        $this->data['total_reason4'] = $total5;
        $this->data['feedback_reason_data5'] = $feedback_reason5;
        $this->data['data'] = $data;
        $this->data['feedback_complain'] = $feedback_complain;
        $this->data['user_id'] = $user_id;
        $this->data['city'] = $city;
        $this->data['user'] = $user;
        $this->data['total_question'] = $total_question;
        $this->data['total_question2'] = $total_question2;
        $this->data['total_question3'] = $total_question3;
        $this->data['total_question4'] = $total_question4;
        $this->data['total_question5'] = $total_question5;
        $this->data['feedback_question'] = $feedback_question;
        $this->data['feedback_question2'] = $feedback_question2;
        $this->data['feedback_question3'] = $feedback_question3;
        $this->data['feedback_question4'] = $feedback_question4;
        $this->data['feedback_question5'] = $feedback_question5;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;


        //this code for reason bar chart

        // developed by kandarp pandya --- 16-06-2019
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear = date('Y'); // get cureent year
        $year = [$currentYear-0, $currentYear-1, $currentYear-2, $currentYear-3, $currentYear-4, $currentYear-5]; // Current year with last 5 year
        $feedBackReason = DB::table('feedback_reason')->where('feedback_id',1)->select('*')->get();
    
        $newMonthArray = [];
        $newYearArray = [];
        $response_array = [];
        foreach ($feedBackReason as $key => $value) {
            $monthValue = [];
            $yearValue = [];
            $response_value = [];
            foreach ($months as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id',1)->select('*')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $monthValue[] = $results;
                    }
            foreach ($year as $keyY => $valueY) {
                $results = DB::table('feedback_rating')->where('feedback_id',1)->select('*')
                        ->whereYear('created_at', $valueY)
                        // ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        $response_value[] = $results;
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $yearValue[] = $results;
            }
            $newMonthArray[$key]['values'] = $monthValue;
            $newMonthArray[$key]['text'] = $value->feedback_reason;
            $response_array[$key][$value->feedback_reason] = array_sum($response_value);

            $newYearArray[$key]['values'] = $yearValue;
            $newYearArray[$key]['text'] = $value->feedback_reason;
        }
        $monthValues = json_encode($months);
        $yearValues = json_encode($year);
        $this->data['response_array'] = $response_array;
        $this->data['monthValues'] = $monthValues;
        $this->data['yearValues'] = $yearValues;
        // dd(json_encode($newYearArray));
        $this->data['yearValueData'] = json_encode($newYearArray);
        $this->data['monthValueData'] = json_encode($newMonthArray);


        // developed by Rushi Purohit --- 09-09-2019
        $months2 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear2 = date('Y'); // get cureent year
        $year2 = [$currentYear2-0, $currentYear2-1, $currentYear2-2, $currentYear2-3, $currentYear2-4, $currentYear2-5]; // Current year with last 5 year
        $feedBackReason2 = DB::table('feedback_reason')->where('feedback_id',2)->select('*')->get();
    
        $newMonthArray2 = [];
        $newYearArray2 = [];
        $response_array2 = [];
        foreach ($feedBackReason2 as $key => $value) {
            $monthValue2 = [];
            $yearValue2 = [];
            $response_value2 = [];
            foreach ($months2 as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id',2)->select('*')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $monthValue2[] = $results;
                    }
            foreach ($year2 as $keyY => $valueY) {
                $results = DB::table('feedback_rating')->where('feedback_id',2)->select('*')
                        ->whereYear('created_at', $valueY)
                        // ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        $response_value2[] = $results;
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $yearValue2[] = $results;
            }
            $newMonthArray2[$key]['values'] = $monthValue2;
            $newMonthArray2[$key]['text'] = $value->feedback_reason;
            $response_array2[$key][$value->feedback_reason] = array_sum($response_value2);

            $newYearArray2[$key]['values'] = $yearValue2;
            $newYearArray2[$key]['text'] = $value->feedback_reason;
        }
        $monthValues2 = json_encode($months2);
        $yearValues2 = json_encode($year2);
        $this->data['response_array2'] = $response_array2;
        $this->data['monthValues2'] = $monthValues2;
        $this->data['yearValues2'] = $yearValues2;
        // dd(json_encode($newYearArray));
        $this->data['yearValueData2'] = json_encode($newYearArray2);
        $this->data['monthValueData2'] = json_encode($newMonthArray2);

        // developed by Rushi Purohit --- 09-09-2019
        $months3 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear3 = date('Y'); // get cureent year
        $year3 = [$currentYear3-0, $currentYear3-1, $currentYear3-2, $currentYear3-3, $currentYear3-4, $currentYear3-5]; // Current year with last 5 year
        $feedBackReason3 = DB::table('feedback_reason')->where('feedback_id',3)->select('*')->get();
    
        $newMonthArray3 = [];
        $newYearArray3 = [];
        $response_array3 = [];
        foreach ($feedBackReason3 as $key => $value) {
            $monthValue3 = [];
            $yearValue3 = [];
            $response_value2 = [];
            foreach ($months3 as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id',3)->select('*')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $monthValue3[] = $results;
                    }
            foreach ($year3 as $keyY => $valueY) {
                $results = DB::table('feedback_rating')->where('feedback_id',3)->select('*')
                        ->whereYear('created_at', $valueY)
                        // ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        $response_value3[] = $results;
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $yearValue3[] = $results;
            }
            $newMonthArray3[$key]['values'] = $monthValue3;
            $newMonthArray3[$key]['text'] = $value->feedback_reason;
            $response_array3[$key][$value->feedback_reason] = array_sum($response_value3);

            $newYearArray3[$key]['values'] = $yearValue3;
            $newYearArray3[$key]['text'] = $value->feedback_reason;
        }
        $monthValues3 = json_encode($months3);
        $yearValues3 = json_encode($year3);
        $this->data['response_array3'] = $response_array3;
        $this->data['monthValues3'] = $monthValues3;
        $this->data['yearValues3'] = $yearValues3;
        // dd(json_encode($newYearArray));
        $this->data['yearValueData3'] = json_encode($newYearArray3);
        $this->data['monthValueData3'] = json_encode($newMonthArray3);


        // developed by Rushi Purohit --- 09-09-2019
        $months4 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear4 = date('Y'); // get cureent year
        $year4 = [$currentYear4-0, $currentYear4-1, $currentYear4-2, $currentYear4-3, $currentYear4-4, $currentYear4-5]; // Current year with last 5 year
        $feedBackReason4 = DB::table('feedback_reason')->where('feedback_id',4)->select('*')->get();
    
        $newMonthArray4 = [];
        $newYearArray4 = [];
        $response_array4 = [];
        foreach ($feedBackReason4 as $key => $value) {
            $monthValue4 = [];
            $yearValue4 = [];
            $response_value4 = [];
            foreach ($months4 as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id',4)->select('*')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $monthValue4[] = $results;
                    }
            foreach ($year4 as $keyY => $valueY) {
                $results = DB::table('feedback_rating')->where('feedback_id',4)->select('*')
                        ->whereYear('created_at', $valueY)
                        // ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        $response_value4[] = $results;
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $yearValue4[] = $results;
            }
            $newMonthArray4[$key]['values'] = $monthValue4;
            $newMonthArray4[$key]['text'] = $value->feedback_reason;
            $response_array4[$key][$value->feedback_reason] = array_sum($response_value4);

            $newYearArray4[$key]['values'] = $yearValue4;
            $newYearArray4[$key]['text'] = $value->feedback_reason;
        }
        $monthValues4 = json_encode($months4);
        $yearValues4 = json_encode($year4);
        $this->data['response_array4'] = $response_array4;
        $this->data['monthValues4'] = $monthValues4;
        $this->data['yearValues4'] = $yearValues4;
        // dd(json_encode($newYearArray));
        $this->data['yearValueData4'] = json_encode($newYearArray4);
        $this->data['monthValueData4'] = json_encode($newMonthArray4);

        // developed by Rushi Purohit --- 09-09-2019
        $months5 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear5 = date('Y'); // get cureent year
        $year5 = [$currentYear5-0, $currentYear5-1, $currentYear5-2, $currentYear5-3, $currentYear5-5, $currentYear5-5]; // Current year with last 5 year
        $feedBackReason5 = DB::table('feedback_reason')->where('feedback_id',5)->select('*')->get();
    
        $newMonthArray5 = [];
        $newYearArray5 = [];
        $response_array5 = [];
        foreach ($feedBackReason5 as $key => $value) {
            $monthValue5 = [];
            $yearValue5 = [];
            $response_value5 = [];
            foreach ($months5 as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id',5)->select('*')
                        ->whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $monthValue5[] = $results;
                    }
            foreach ($year5 as $keyY => $valueY) {
                $results = DB::table('feedback_rating')->where('feedback_id',5)->select('*')
                        ->whereYear('created_at', $valueY)
                        // ->whereMonth('created_at', $valueM)
                        ->where('comment', $value->feedback_reason)
                        ->count();
                        $response_value5[] = $results;
                        // if($total > 0){
                        //     $results = round($results*100/$total);
                        // }
                $yearValue5[] = $results;
            }
            $newMonthArray5[$key]['values'] = $monthValue5;
            $newMonthArray5[$key]['text'] = $value->feedback_reason;
            $response_array5[$key][$value->feedback_reason] = array_sum($response_value5);

            $newYearArray5[$key]['values'] = $yearValue5;
            $newYearArray5[$key]['text'] = $value->feedback_reason;
        }
        $monthValues5 = json_encode($months5);
        $yearValues5 = json_encode($year5);
        $this->data['response_array5'] = $response_array5;
        $this->data['monthValues5'] = $monthValues5;
        $this->data['yearValues5'] = $yearValues5;
        // dd(json_encode($newYearArray));
        $this->data['yearValueData5'] = json_encode($newYearArray5);
        $this->data['monthValueData5'] = json_encode($newMonthArray5);


        DB::statement(DB::raw('set @rownum=0'));
        $complains = FeedBackComplains::select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))->get();
       
        $this->data['complains_report'] = $complains; 

        //31/07/2019
        $time_filter =  array('today'=>__('message.today'),'yesterday'=>__('message.yesterday'),'last_14_day'=>__('message.last_14_day') ,'this_week'=>__('message.this_week'),'last_week'=>__('message.last_week'),'this_month'=>__('message.this_month'),'last_month'=>__('message.last_month'),'this_year'=>__('message.this_year'),'last_year'=>__('message.last_year'),'specific_date'=>__('message.specific_date'));
        
        $this->data['time_filter'] = $time_filter;
        $this->data['time_period'] = \Session::get('time_period');


        return view('admin.dashboard.dashboard', $this->data);
    }

    public function getQuestionAnswersDashboard(Request $request, $formId) {

        //to create database for quesiton and given answers for text field
        $this->data['page_title'] = "Question & Answers";
        if (!$request->ajax()) {
            return view('admin.report.default_pie_chart_report', $this->data);
        }

        $from = date('Y-m-d H:i:s');
        DB::statement(DB::raw('set @rownum=0'));

        $result_data = DB::table('tbl_survey_form_info')
                ->join('tbl_participants', 'tbl_participants.id', '=', 'tbl_survey_form_info.participant_id')
                ->where("tbl_survey_form_info.created_at", '<=', $from)
                ->where('tbl_survey_form_info.form_id', $formId)
                ->where(function($result_data) {
                    $result_data->where('tbl_survey_form_info.question_type', 3);
                    $result_data->orWhere('tbl_survey_form_info.question_type', 4);
                })
                ->where('tbl_survey_form_info.status', 1)
                ->select('tbl_survey_form_info.*', 'tbl_participants.first_name', 'tbl_participants.last_name', 'tbl_participants.mobile', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->orderBy('tbl_survey_form_info.id', 'desc')
                ->get();


        return Datatables::of($result_data)
                        ->editColumn('participant_name', function($row) {
                            $participant_name = $row->first_name . ' ' . $row->last_name;
                            return $participant_name;
                        })
                        ->editColumn('question', function($row) {
                            $question = $row->survey_question;
                            return $question;
                        })
                        ->editColumn('mobile', function($row) {
                            $mobile = $row->mobile;
                            return $mobile;
                        })
                        ->editColumn('answer', function($row) {
                            $x = unserialize($row->answer);
                            $answer = $x['answer'][0];
                            return $answer;
                        })
                        ->editColumn('created_at', function($row) {
                            return date('d M, Y', strtotime($row->created_at));
                        })
                        ->editColumn('updated_at', function($row) {
                            return date('d M, Y', strtotime($row->updated_at));
                        })
                        ->make(true);
    }
    // set session for dashboard chart 30-08-2018
    public function dashboardChange(Request $request)
    {
        session(['select_chart_by' => $request->get('select_chart_by')]);
        session(['select_chart_type' => $request->get('select_chart_type')]);
        return redirect()->to('admin/dashboard');
    }
    public function sms_reset(Request $request)
    {
    
                $time = Date('Y-m-d h:m:s' );
                
             $sms = $request->input('sms');
                // dd($sms);
            DB::table('reset_sms_email')
                ->where('id', 1)
                //->where('type','sms')
                ->update(['time' => $time]);
            return redirect()->back();

    }
     public function email_reset(Request $request)
    {
           
            $time = Date('Y-m-d h:m:s');

            DB::table('reset_sms_email')
                ->where('id', 2)
                ->update(['time' => $time]);
                return redirect()->back();

    }
    public function feedback_report(Request $request)
    {
         $question_survey = DB::table('feedback_survey')->select('*')->get();
        $feedback_question = DB::table('feedback_question')->select('*')->get();

        $totalCountArr = array();
        $sum = 0;
        $question_rating = [];
        foreach ($feedback_question as $key => $value) {
            //THIS IS FOR SINGLE QUESTION COUNT
            // $question_rating5 = DB::table('feedback_survey')->select(DB::raw('count(rating) AS rating_5_count'), (DB::raw('sum(rating) AS star_5_sum')))->where('question_id',$value->id)->where('rating',5)->first();
            // $question_rating4 = DB::table('feedback_survey')->select(DB::raw('count(rating) AS rating_4_count'), (DB::raw('sum(rating) AS star_4_sum')))->where('question_id',$value->id)->where('rating',4)->first();
            // $question_rating3 = DB::table('feedback_survey')->select(DB::raw('count(rating) AS rating_3_count'), (DB::raw('sum(rating) AS star_3_sum')))->where('question_id',$value->id)->where('rating',3)->first();
            // $question_rating2 = DB::table('feedback_survey')->select(DB::raw('count(rating) AS rating_2_count'), (DB::raw('sum(rating) AS star_2_sum')))->where('question_id',$value->id)->where('rating',2)->first();
            // $question_rating1 = DB::table('feedback_survey')->select(DB::raw('count(rating) AS rating_1_count'), (DB::raw('sum(rating) AS star_1_sum')))->where('question_id',$value->id)->where('rating',1)->first();


        // $count5 = $question_rating5->rating_5_count;
        // $count4 = $question_rating4->rating_4_count;
        // $count3 = $question_rating3->rating_3_count;
        // $count2 = $question_rating2->rating_2_count;
        // $count1 = $question_rating1->rating_1_count;
        $question_rating = DB::table('feedback_survey')->where('question_id',$value->id);

        if($request->get('user') != null )
        {
            $question_rating = $question_rating->where('user_id',$request->get('user'));
        }
        if($request->get('location') != null )
        {
            $question_rating = $question_rating->where('user_city',$request->get('location'));
        }
        if($request->get('created_from') != null){

            $created_from = $request->get('created_from');
            $created_to = $request->get('created_to');
            $question_rating = $question_rating->whereRaw(" Date(created_at) between '$created_from' and '$created_to'"); 
        }
        $question_rating = $question_rating->select(DB::raw('count(rating) AS rating_count'), (DB::raw('sum(rating) AS rating_sum')))->first();
            
        
        $sum = $question_rating->rating_sum != null ? $question_rating->rating_sum : 0 ;
        $count = $question_rating->rating_count != 0 ? $question_rating->rating_count : 1 ;
        $avg = ($sum / $count);
        

        // $count5 = array('count' => $count5);

        // $count4 = array('count' => $count4);

        // $count3 = array('count' => $count3);

        // $count2 = array('count' => $count2);
        // $count1 = array('count' => $count1);

        $totalCountArr[] = array('avg' => round($avg,2),'response' => $question_rating->rating_count);

        }
        $feedback_question['totle_kpi_count'] = $sum;
        $feedback_question['length'] = count($feedback_question);
        $feedback_question['minimum_value'] = 0;
        $feedback_question['maximum_value'] = 5;
        $this->data['feedback_survey'] = $feedback_question;
        $this->data['final_feedback'] = $totalCountArr;
        $this->data['question_rating'] = $question_rating;
        $this->data['question_survey'] = $question_survey;

        echo json_encode($this->data);
        die();
    }
    //for participant in dashboard
    public  function participant_table(Request $request)
    {
        
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
        $this->data['country'] = Country::Select('id', 'name')->get();
        $scheduleParticipants = !empty($scheduleParticipants)?$scheduleParticipants:array(0);
        $login_user = Auth::user();

        $this->data['page_title'] = "Participant Management";
        
        if (!$request->ajax()) {

            return view('admin.dashboard.dashboard', $this->data);
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
            $survey_option_data = $query->get();
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_option_data)
                        ->addColumn('action', function($row) {
                            $edit_url = route('participant.edit', $row->id);
                            $delete_url = route('participant.destroy', $row->id);
                            $submitted_form_url = route('participant_form', $row->id);
                            // $links = '<a title="Survey Form Details" rel="'.$form_details.'" href="'.$form_details.'" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View Survey Form</a>&nbsp';
                            // $links = '<a title="More details" href="javascript:void(0)" class="btn btn-primary more-details"><i class="fa fa-search" aria-hidden="true"></i></a>&nbsp';
                            // $links .= '<a title="Edit" href="' . $edit_url . '" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp';
                            // $links .= '<a title="Delete" data-href="' . $delete_url . '" class="btn btn-danger delete_data"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            // $links .= '<a title="Get survey forms submitted by ' . $row->first_name . '" href="' . $submitted_form_url . '" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>Survey Report</a>';
                            // return $links;
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
                        ->rawColumns(['first_name'])
                        ->make(true);
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
    public function dashboard_complain(Request $request){

        
        //Here Complains List Start
        DB::statement(DB::raw('set @rownum=0'));
        $complains = FeedBackComplains::select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))->get();
       
        if (!$request->ajax()) {
            
            return view('admin.dashboard.dashboard', $this->data);
        }
        $base_path = $this->data['base_path'];
        return Datatables::of($complains)
            ->addColumn('action', function($row) {
                $links = "";
                return $links;
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })

            ->editColumn('updated_at', function($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })

            ->editColumn('modified_by', function($row) {
                $value = '-';
                if ($row->modified_by) {
                    $user = DB::table('users')->whereId($row->modified_by)->first();
                    $val = $user->name;
                }
                return $value;
            })
            ->addColumn('status',function($row){
                $selected1 = $row->status == 'new' ? 'selected' : '';
                $selected2 = $row->status == 'in_progress' ? 'selected' : '';
                $selected3 = $row->status == 'resolved' ? 'selected' : '';
                $selected4 = $row->status == 'late' ? 'selected' : '';
                $color = 'cornflowerblue';
                if ($row->status == 'new')
                    $color = 'cornflowerblue';
                if ($row->status == 'in_progress')
                    $color = 'dimgrey';
                if ($row->status == 'resolved')
                    $color = 'green';
                if ($row->status == 'late')
                    $color = 'darkred';
                
                $links = '<select name="change_status" id="change_status_'.$row->id.'" class="form-control" onchange="changeStatus('.$row->id.', '.$row->user_id.')" style="color: white; background: '.$color.'">
                <option value="new" '.$selected1.'>new</option>
                <option value="in_progress" '.$selected2.'>In Progress</option>
                <option value="resolved" '.$selected3.'>Resolved</option>
                <option value="late" '.$selected4.'>Late</option>
                
                 </select>';
                return $links;
            })
            
            ->rawColumns(['comment', 'action', 'status'])
            ->make(true);
        //Here Complains List Start
    } 
    //Search Participant 
    function search_participant(Request $request){
        
        $participant_record = Participant::Select('*');
        if($request->get('category_id') != null){
            $participant_record = $participant_record->where('category_id',$request->get('category_id'));
        }
        if($request->get('type_id') != null){
            $participant_record = $participant_record->where('type_id',$request->get('type_id'));
        }
        if($request->get('sub_category_id') != null){
            $participant_record = $participant_record->where('sub_category_id',$request->get('sub_category_id'));
        }
        if($request->get('group_id') != null){
            $participant_record = $participant_record->where('group_id',$request->get('group_id'));
        }
        if($request->get('start_date') != null && $request->get('end_date') != null){
            $participant_record = $participant_record->whereBetween('created_at', array($request->get('start_date'), $request->get('end_date')));
        }  
        $participant_record = $participant_record->where('status',1)->paginate(10);
        $content= '';
        
           $content.='<table id="main_tble" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:5%"  scope="col"class="text-center">S.No</th>
                        <th class="text-center" scope="col">First Name</th>
                        <th class="text-center" scope="col">Last Name</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Mobile</th>
                        <th class="text-center" scope="col">Created Date</th> 
                        <th class="text-center" scope="col">Action</th>
                    </tr>';
                    if(count($participant_record) > 0) {
                        foreach($participant_record as $key => $participantRecord) {
                            $content.='<tr>
                                <th scope="row" style="width:5%" class="text-center">';
                                    $content.= $participantRecord->id;
                                $content.='</th>
                                <td class="text-center">';
                                    $content.= $participantRecord->first_name;
                                $content.='</td>
                                <td class="text-center">';
                                    $content.= $participantRecord->last_name;
                                $content.='</td>
                                <td class="text-center">';
                                    $content.= $participantRecord->email;
                                $content.='</td>
                                <td class="text-center">';
                                    $content.= $participantRecord->mobile;
                                $content.='</td>
                                <td class="text-center">';
                                    $content.= \Carbon\Carbon::parse($participantRecord->created_at)->format('d M Y');
                                $content.='</td>
                                <td class=" text-center">
                                    <a class="text-success mr-2" title="Edit" href="http://localhost/projects/erjaan/admin/participant/66/edit">
                                        <i class="nav-icon i-Pen-2 font-weight-bold text-20" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>';
                        }  
                    } else {
                        $content.='<tr>
                            <td colspan="7" style="text-align: center">Record Not Found
                            </td>
                        </tr>';
                    }      

                $content.='</thead>
            </table> ';
            // dd($content);    
            return $content;  

    }
    //Here Update Participant Record
    function edit_participant(Request $request){
        Participant::where('id', $request->get('id'))->update([
            'first_name'        => $request->get('first_name'),
            'last_name'         => $request->get('last_name'),
            'email'             => $request->get('email'),
            'location_id'       => $request->get('location_id'),
            'mobile'            => $request->get('mobile'),
            'dob'               => $request->get('dob'),
            'gender'            => $request->get('gender'),
            'category_id'       => $request->get('category_id'),
            'sub_category_id'   => $request->get('sub_category_id'),
            'type_id'           => $request->get('type_id'),
            'group_id'          => $request->get('group_id'),
            'comment'           => $request->get('comment'),

            
        ]);
    }

}