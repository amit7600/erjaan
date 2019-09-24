<?php

namespace App\Http\Controllers\Admin;

use App\FeedbackReason;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $data = array('menu_type' => 1);

    public function __construct()
    {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/';
    }
    protected function _encrypt($moment_id)
    {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    protected function _decrypt($key)
    {
        $A = 929323;
        $B = 239893483274;
        return ($key ^ $B) / $A;
    }
    public function get_reason_setting()
    {
        $question = DB::table('selected_feedback_question')->where('feedback_id','1')->first();
        //
        $feedback_reason = FeedbackReason::where('feedback_id','1')->get();
        //dd($feedback_reason);
        $this->data['feedback_reason'] = $feedback_reason;
        $this->data['question'] = $question;
        return view('admin.feedback_survey.reason_setting', $this->data);
    }
    public function reason_setting(Request $request)
    {
        //dd($request);
        try {
            $selected_feedback_question = DB::table('selected_feedback_question')->where('feedback_id','1')->first();
            $feedback_reason = FeedbackReason::where('feedback_id','1')->get();

                
            if ($request->get('reason')) {
                $reason = $request->get('reason');
                if (count($reason) == 1 && $reason[0] == null) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content', 'Reason field is required');
                    return redirect()->back();
                }
                //dd($request->get('feedback_id'));
                $isExist = FeedbackReason::where('feedback_id','1')->delete();
                if (count($reason) > 0 && $reason[0] != null) {
                    
                    foreach ($reason as $key => $value) {
                        $reason = FeedbackReason::create([
                            'feedback_reason' => $value,
                            'feedback_id' => $request->get('feedback_id'),
                        ]);
                    }
                }
            }

            if ($selected_feedback_question != null) {
                DB::table('selected_feedback_question')->where('id', 1)->update([
                    'feedback_id' => $request->get('feedback_id'),
                    'reason_title' => $request->get('reason_title'),
                    'reason_appear' => $request->get('reason_appear'),
                    'reason_font_size' => $request->get('reason_font_size'),
                    'reason_text_color' => $request->get('reason_text_color'),
                    'reason_text_style' => $request->get('reason_text_style'),
                    'rating_pop_up' => $request->get('rating_pop_up'),
                ]);
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.reason') . ' ' . __('message.setting') . ' ' . __('message.updated') . ' ' . __('message.successfully'));
            } else {
                DB::table('selected_feedback_question')->insert([
                    'feedback_id' => $request->get('feedback_id'),
                    'reason_title' => $request->get('reason_title'),
                    'reason_appear' => $request->get('reason_appear'),
                    'reason_font_size' => $request->get('reason_font_size'),
                    'reason_text_color' => $request->get('reason_text_color'),
                    'reason_text_style' => $request->get('reason_text_style'),
                    'rating_pop_up' => $request->get('rating_pop_up'),
                ]);
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.reason') . ' ' . __('message.setting') . ' ' . __('message.save') . ' ' . __('message.successfully'));
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', __('message.internal_error'));
            return redirect()->back();
        }
    }
}
