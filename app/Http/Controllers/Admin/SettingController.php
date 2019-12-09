<?php

namespace App\Http\Controllers\Admin;
;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Group;
use App\Type;
use App\Category;
use App\Setting;
use App\Package\SendSMSLib;
use App\Http\Requests\ParticipantRequest;
use DB;
use Input;
use Auth;

class SettingController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
    }

    protected function _encrypt($moment_id) {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    /* ======================================
     * Send Survey to participant
     */

    public function commonSetting() {
        $setting = new Setting;
        $this->data['auto_trigger_data'] = "";
        $this->data['page_title'] = "Common Setting";

        $this->data['setting_data'] = DB::table('tbl_settings')
                        ->select('*')->get();
        $survey_form = DB::table('tbl_survey_form')
                ->select('*')
                ->where('is_deleted', 0)
                ->get();

        $this->data['survey_details'] = DB::table('tbl_survey_form')
                        ->join('tbl_survey_question', 'tbl_survey_form.id', '=', 'tbl_survey_question.survey_form_id')
                        ->whereIn('tbl_survey_question.question_type', [1,2,5]);
        if (count($this->data['setting_data']) > 0) {
            $this->data['survey_details'] = $this->data['survey_details']->where('tbl_survey_question.survey_form_id', $survey_form ? $this->data['setting_data'][4]->setting_value : 1);
        }
        $this->data['survey_details'] = $this->data['survey_details']->get();
            
        $this->data['survey_form'] = $survey_form;
        // $this->data['setting_data'] = DB::table('tbl_settings')
        //                 ->pluck('setting_value','setting_key');

        return view('admin.setting.common_seting', $this->data);
    }
    
    public function resetSetting() {
         //sms count 11/9
        $sms_count = DB::table('tbl_survey_count')
                    ->select('*')
                    ->count();
        $this->data['sms_count'] = $sms_count;

        $sms_response_count = DB::table('tbl_survey_count')
                    ->select('*')
                    ->where('is_submitted_send',2)
                    ->count();
        $this->data['sms_response_count'] = $sms_response_count;

        $email_count = DB::table('tbl_survey_count')
                    ->select('*')
                    ->where('sms_email',2)
                    ->count();
        $this->data['email_count'] = $email_count;

        $email_response_count = DB::table('tbl_survey_count')
                    ->select('*')
                    ->where('is_submitted_send',2)
                    ->where('sms_email',2)
                    ->count();
        $this->data['email_response_count'] = $email_response_count;
        return view('admin.setting.reset_setting', $this->data);
    }

// END autoTriggerSetting()


    /* ======================================
     * Send Survey to participant
     */

    public function saveCommonSetting(Request $request) {
        // dd($request);
        if($request->get('selectChart') != null){
            $implodeChart = count($request->get('selectChart'))>0 ? implode('|', $request->get('selectChart')) : '';
        }else{ 
            $implodeChart = '';
        } 
        $setting = Setting::pluck('setting_value', 'setting_key');
                $arrayName = [];
        foreach ($setting as $key => $value) {
            if($key != 'choose_logo' && $key != 'choose_background'){
                if ($request->input($key) != "" || $request->input($key) != $value) {
                    array_push($arrayName, $key);
                    if ($key == 'survey_form_id') {
                        $implodeChartData = $implodeChart ? implode(',', $request->get('selectChart')) : null;
                    } else {
                        $implodeChartData = null;
                    }
                    Setting::where('setting_key', $key)->update(['setting_value' => $request->input($key), 'survey_question_chart' => $implodeChartData]);
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content', 'Please fill required fields.');
                    return redirect()->route('common_setting');
                }
            }
        }
        if($request->hasFile('choose_logo')){
            $logo = $this->uploadImage($request->file('choose_logo'));
            Setting::where('setting_key', 'choose_logo')->update(['setting_value' => $logo]);
        }
        if($request->hasFile('choose_background')){
            $background = $this->uploadImage($request->file('choose_background'));
            Setting::where('setting_key', 'choose_background')->update(['setting_value' => $background]);
        }
        


        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.setting').' '.__('message.save').' '.__('message.successfully'));
        return redirect()->route('common_setting');
    }


    public function get_form_question(Request $request)
    {
        $survey_details = DB::table('tbl_survey_form')
                        ->join('tbl_survey_question', 'tbl_survey_form.id', '=', 'tbl_survey_question.survey_form_id')
                        ->whereIn('tbl_survey_question.question_type', [1,2,5,6])
                        ->where('tbl_survey_question.survey_form_id', $request->get('form_id'))
                        ->get();
        return $survey_details;
    }
    public function quick_participant(Request $request){
        $quick_setting = DB::table('tbl_quick_add_setting')->where('id',1)->first();
        
        $this->data['quick_setting'] = $quick_setting;
        return view('admin.setting.quick_participant_setting',$this->data);
    }
    public function uploadImage($image)
    {
        $tempname = explode('.', $image->getClientOriginalName());
        $tempname = str_replace(' ', '_', $tempname);
        $name = $tempname[0].'_'.time().'.'.$image->getClientOriginalExtension();
        // $path = 'uploads/book'.$request->get('bookId').'/'.$request->get('coverPage');
        $path = '/uploads/loginPage';
        $destinationPath = public_path($path);
        $imagePath = $destinationPath. "/". $name;
        $image->move($destinationPath, $name);
        return $path.'/'.$name;
    }
}