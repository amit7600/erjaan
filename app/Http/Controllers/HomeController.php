<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use App\Surveyform;
use App\SurveyFormInfo;
use App\SurveyFormInfoCheckboxAns;
use App\SurveyQuestion;
use App\SurveyOption;
use Input;
use Auth;
use DB;
use App;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        \Session::put('locale','en');
        $this->data['base_path'] = url('/') . '/';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    protected function _decrypt($key) {
        $A = 929323;
        $B = 239893483274;
        return ($key ^ $B) / $A;
    }

    protected function _encrypt($moment_id) {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    /**
     * [surveyForm description]
     * @return [type] [description]
     */
    public function surveyResult($key) {

        $form_id = $this->_decrypt($key);
        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $form_id])
                ->get();

        $setting_data = DB::table('tbl_settings')
                        ->select('setting_value')
                        ->where('id',6)
                        ->first();

        $this->data['setting_data'] = $setting_data;

        if ($survey_form_data) {
            $this->data['survey_form_data'] = $survey_form_data;
            return view('survey_form_result', $this->data);
        } else {
            return redirect('/');
        }
    }

    public function setLocale($locale)
    {
        Session::put('locale',$locale);
        App::setLocale($locale);
        return redirect()->route('dashboard');
    }

//END::surveyResult

    /**
     * [surveyForm description]
     * @return [type] [description]
     */
    public function surveyForm($key = null, $id = null, $onbhalf = null, $token = null,$submitted_by = null) {
    
        $this->data['participant_id'] = $id;
        $this->data['token'] = $token;
        
        $form_id = $this->_decrypt($key);
        $parti_id = $this->_decrypt($id);
        $onbhalf_id = $this->_decrypt($onbhalf);
        $submitted_by = $this->_decrypt($submitted_by);
        if($submitted_by == 1){
            $customer_details = DB::table('feedback_complains')->where('id',$parti_id)->first();

            $this->data['first_name'] = $customer_details->name;
            $this->data['last_name'] = '';
            $this->data['submitted_by'] = 1;
        }else{
            $participant_details = DB::table('tbl_participants')
                    ->select('first_name', 'last_name')
                    ->where('id', $parti_id)
                    ->first();
            $this->data['first_name'] = $participant_details->first_name;
            $this->data['last_name'] = $participant_details->last_name;
            $this->data['submitted_by'] = 0;
        }

        $this->data['onbhalf_id'] = $onbhalf_id;

        $survey_token = DB::table('tbl_survey_count')
                ->select('token')
                // ->where('form_id', $form_id)
                ->where('participant_id', $parti_id)
                ->where('token', $token)
                ->first();
    
        if (empty($survey_token)) {
            \Session::flash('message.level', 'danger');
            \Session::flash('message.content', 'This is invalid survey form.');
            return redirect('/');
        }

        $this->data['submit_survey_form'] = SurveyFormInfo::where('form_id', $form_id)->get();

        $survey_count = DB::table('tbl_survey_form_info')
                ->select('token')
                ->where('form_id', $form_id)
                ->where('participant_id', $parti_id)
                ->where('token', $token)
                ->first();

        if (!empty($survey_count->token)) {
            \Session::flash('message.level', 'danger');
            \Session::flash('message.content', 'This survey form already submitted by you.');
            return redirect('/');
        }

        if (is_numeric($id)) {
            $this->data['partici_id'] = $this->_decrypt($id);
        } else {
            $this->data['partici_id'] = '';
        }

        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $form_id])
                ->get();

        if ($survey_form_data) {
            $this->data['survey_form_data'] = $survey_form_data;
            //dd($survey_form_data);
            return view('survey_form', $this->data);
        } else {
            return redirect('/');
        }
    }

//END::surveyForm

    /**
     * [surveyForm description]
     * @return [type] [description]
     */
    public function submitSurveyForm(Request $request) {
        

        $question_count = $request->input('survey_question_id');

        $participant_id = $request->input('participantId');
        $form_id = $request->input('surveyFormId');
        $token = $request->input('survey_token');

        $survey_count = DB::table('tbl_survey_form_info')
                ->select('token')
                ->where('form_id', $this->_decrypt($form_id))
                ->where('participant_id', $this->_decrypt($participant_id))
                ->where('token', $token)
                ->first();

        if (!empty($survey_count->token)) {
            \Session::flash('message.level', 'danger');
            \Session::flash('message.content', 'This survey form already submitted by you.');
            return redirect('/');
        }

        $form_data = array();

        $data = array();
        for ($i = 0; $i < count($question_count); $i++) {
            $survey_info = new \stdClass;

            if ($request->input('question_type')[$i] == 1) {
                $survey_info->survey_answer = $request->input('q_option_' . $question_count[$i]);
                $option_data = SurveyOption::where('question_id', $question_count[$i])
                                ->where('survey_option_title', $request->input('q_option_' . $question_count[$i]))->first(array('option_point'));
                $survey_info->option_value = $option_data['option_point'];
            } else {
                $survey_info->option_value = "";
                $survey_info->survey_answer = "";
            }

           if ($request->input('question_type')[$i] == 5) {
                $survey_info->start_rating_answer = $request->input('q_option_' . $question_count[$i])[0];
            } else if($request->input('question_type')[$i] == 6){
                
                $survey_info->start_rating_answer = $request->input('q_option_' . $question_count[$i])[0];
            }else{    
                $survey_info->start_rating_answer = "";
            }

            if ($request->input('question_type')[$i] == 2) {

                $check_box_answer = $request->input('q_option_' . $question_count[$i]);

                for ($j = 0; $j < count($check_box_answer); $j++) {
                    $check_box_info = new SurveyFormInfoCheckboxAns;
                    $point_data = SurveyOption::where('question_id', $question_count[$i])
                                    ->where('survey_option_title', $check_box_answer[$j])->first(array('option_point'))->toArray();

                    $check_box_info->option_point = $point_data['option_point'];
                    $check_box_info->participant_id = $this->_decrypt($participant_id);
                    $check_box_info->question_id = $question_count[$i];
                    $check_box_info->form_id = $this->_decrypt($form_id);
                    $check_box_info->check_box_ans = $check_box_answer[$j];
                    $check_box_info->token = $request->input('survey_token');
                    $check_box_info->created_at = date('Y-m-d');
                    $check_box_info->save();
                }
            }

            $question_id = $request->input('survey_question_id')[$i];
            $survey_info->participant_id = $this->_decrypt($participant_id);
            $survey_info->form_id = $this->_decrypt($form_id);
            $survey_info->question_id = $request->input('survey_question_id')[$i];
            $survey_info->survey_question = $request->input('survey_question')[$i];
            $survey_info->question_type = $request->input('question_type')[$i];

            $survey_info->token = $request->input('survey_token');

            $questionData = SurveyQuestion::where('id', $question_count[$i])
                    ->first(array('question_type'));

            if (empty($questionData)) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Something went wrong please try again.');
                return redirect('survey_form/' . $form_id . '/' . $participant_id . '/' . $request->input('survey_token'));
            }

            $form_data['answer'] = (array) $request->input('q_option_' . $question_count[$i]);
            if (empty($form_data['answer'][0])) {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Please fill question no.' . ($i + 1));
                if($request->get('submitted_by') == 1){
                    return redirect('survey_form/'.$form_id.'/'.$participant_id.'/'.$this->_encrypt(1).'/'.$request->input('survey_token').'/'.$this->_encrypt(1));
                }else{
                    return redirect('survey_form/' . $form_id . '/' . $participant_id . '/'.$this->_encrypt(1).'/'.$request->input('survey_token').'/'.$this->_encrypt(0));
                }
                
            }


            $pointData = SurveyOption::where('question_id', $question_count[$i])
                            ->whereIn('survey_option_title', $form_data['answer'])->get(array('option_point'))->toArray();

            $form_data['option_point'] = $pointData;

            $form_data['survey_question'] = $survey_info->survey_question;
            $form_data['question_type'] = $survey_info->question_type;

            $survey_info->answer = serialize($form_data);
            $survey_info->created_at = date('Y-m-d');
            $data[] = (array) $survey_info;
        }
        //die;
        SurveyFormInfo::insert($data);

        DB::table('tbl_survey_count')
                ->where('form_id', $this->_decrypt($form_id))
                ->where('participant_id', $this->_decrypt($participant_id))
                ->update(['token' => $request->input('survey_token'), 'is_submitted_send' => 2]);

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Survey form submitted successfully.');
        return redirect('survey_result/' . $form_id);
    }

//END::submitSurveyForm

    /**
     * [change_password description]
     * @return [type] [description]
     */
    public function change_password($token = null) {
        $this->data['pass_token'] = $token;
        return view('email.change_password', $this->data);
    }

//END::change_password

    /**
     * [password_data description]
     * @return [type] [description]
     */
    public function save_new_password(ChangePasswordRequest $request) {
        $user_data = User::Select('*')
                ->where('email_token', $request->pass_token)
                ->first();

        if (!empty($user_data)) {
            if ($request->new_password != $request->confirm_password) {
                \Session::flash('message.level', 'danger');
                \Session::flash('message.content', 'Confirm password does not match');
            } else {
                $user_data->email_token = '';
                $user_data->password = bcrypt($request->new_password);
                $user_data->save();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'Your password changed successfully.');
            }

            return redirect()->route('change_password', [$request->pass_token]);
        } else {
            \Session::flash('message.level', 'danger');
            \Session::flash('message.content', 'Invalid token');
            return redirect()->route('change_password', [$request->pass_token]);
        }
    }

    public function adminLogin() {
        return view('admin/login');
    }

//END :: adminLogin 

    public function loginData(LoginRequest $request) {
        $credential = array('email' => $request->input('email'), 'password' => $request->input('password'));
        if (Auth::attempt($credential)) {
            return Redirect::route('admin_dashboard');
        } else {
            session()->flash('msg', 'Invalid details.');
            return redirect()->back();
        }
    }

//END :: login_data  

    function testSMS() {

        $userAccount = "966597424440";
        $passAccount = "mobily@12";
        $sender = "Erjaan";
        //$numbers = "0918878089009";
        $numbers = "966597424440";
        $msg = "Hello this is Test";
        $MsgID = rand(1, 99999);
        $timeSend = 0;
        $dateSend = 0;
        $deleteKey = 152485;
        $resultType = 1;

        $result = $this->sendSMS($userAccount, $passAccount, $numbers, $sender, $msg, $MsgID, $timeSend = 0, $dateSend = 0, $deleteKey = 0, $viewResult = 1);
        //var_dump($result);
        //die;
    }

    //Send SMS API using CURL method
    function sendSMS($userAccount, $passAccount, $numbers, $sender, $msg, $MsgID, $timeSend = 0, $dateSend = 0, $deleteKey = 0, $viewResult = 1) {
        global $arraySendMsg;
        $url = "www.mobily.ws/api/msgSend.php";
        $applicationType = "68";
        $msg = $msg;
        $sender = urlencode($sender);
        $domainName = $_SERVER['SERVER_NAME'];
        $stringToPost = "mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $numbers . "&sender=" . $sender . "&msg=" . $msg . "&timeSend=" . $timeSend . "&dateSend=" . $dateSend . "&applicationType=" . $applicationType . "&domainName=" . $domainName . "&msgId=" . $MsgID . "&deleteKey=" . $deleteKey . "&lang=3";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $result = curl_exec($ch);

        var_dump($result);
        die("test1");
    }

    //Send SMS API using CURL method
    function checkSmsBalence() {
        $userAccount = "966597424440";
        $passAccount = "mobily@12";
        $sender = "Erjaan";

        $url = "www.mobily.ws/api/balance.php";
        $applicationType = "68";

        $stringToPost = "mobile=" . $userAccount . "&password=" . $passAccount;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $result = curl_exec($ch);

        var_dump($result);
        die("test1");
    }
}
