<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    protected function _decrypt($key) {
        $A = 929323;
        $B = 239893483274;
        return ($key ^ $B) / $A;
    }
    public function get_complain_setting()
    {
        $question = DB::table('selected_feedback_question')->first();

        $this->data['question'] = $question;
        return view('admin.complain.complain_setting',$this->data);
    }
    public function complain_setting(Request $request)
    {
        $this->validate($request,[
            'complain_button_name'   => 'required',
            'complain_status_day'    => 'required'   
        ]);
        try {
            $selected_feedback_question = DB::table('selected_feedback_question')->get();
            if($selected_feedback_question != null){
                for ($i=1; $i <= count($selected_feedback_question); $i++) { 
                    DB::table('selected_feedback_question')->where('id',$i)->update([
                        'complain_status_day' => $request->get('complain_status_day'),
                        'complain_button_name' => $request->get('complain_button_name'),
                        'complain_button_text_size' => $request->get('complain_button_text_size'),
                        'label_language' => $request->get('label_language'),
                        'complain_button_text_color' => $request->get('complain_button_text_color'),
                        'complain_title' => $request->get('complain_title'),
                        'complain_button' => $request->get('complain_button'),
                        'complain_button_color' => $request->get('complain_button_color'),
                        'complain_header_color' => $request->get('complain_header_color')
                    ]);
                }
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.complain').' '.__('message.setting').' '.__('message.updated').' '.__('message.successfully'));
            }else{
                DB::table('selected_feedback_question')->insert([
                    'complain_status_day' => $request->get('complain_status_day'),
                    'complain_button_name' => $request->get('complain_button_name'),
                    'complain_button_text_size' => $request->get('complain_button_text_size'),
                    'complain_button_text_color' => $request->get('complain_button_text_color'),
                    'complain_title' => $request->get('complain_title'),
                    'complain_button' => $request->get('complain_button'),
                    'complain_button_color' => $request->get('complain_button_color'),
                    'complain_header_color' => $request->get('complain_header_color'),
                    'name_label'            => 'Name',
                    'name_label_ar'            => 'اسم',
                    'email_label'            => 'E-mail',
                    'email_label_ar'            => 'البريد الإلكتروني',
                    'number_label'            => 'Number',
                    'number_label_ar'            => 'رقم',
                    'comment_label'            => 'Comment',
                    'comment_label_ar'            => 'تعليق',
                    'label_language' => $request->get('label_language'),
                ]);
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content',  __('message.complain').' '.__('message.setting').' '.__('message.save').' '.__('message.successfully'));
            }
    
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
