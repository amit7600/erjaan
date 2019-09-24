<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Yajra\Datatables\Datatables;
use App\UserRoles;

class UserRolesController extends Controller
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
    public function index(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $user_role = DB::table('tbl_user_role')->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))->get();
        // dd($feedback_question);
        $base_path = $this->data['base_path'];
        if (!$request->ajax()) {
            return view('admin.user_roles.index', $this->data);
        }

        return Datatables::of($user_role)
            ->addColumn('action', function($row) {

                $edit_url = route('user_roles.edit', $row->id);
                $delete_url = route('user_roles.destroy', $row->id);
                // $details_url = route('feedback_question.show', $row->id);
//                $view_report_url = route('survey_report', $this->_encrypt($row->id));
                // $view_report_url = route('report.show', $row->id);
                $links = '';
                // if($row->id != 1 && $row->id != 2){
                    $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                if($row->id != '1' && $row->id != '2'){
                    $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                }
                // }
                // $links .= '<a title="View Survey Form Details" rel="'.$row->id.'" href="javascript:void(0)" class="btn btn-warning more-details"><i class="fa fa-search" aria-hidden="true"></i></a>';
                // $links .= '<a title="View Survey Form Report" href="'.$view_report_url.'" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Survey Report</a>';
                
                return $links;
            })
            ->addColumn('status',function($row){
                $check = $row->status == 1 ? 'checked' : '';
                $links = '<label class="switch switch-primary mr-3">
                            <input type="checkbox" class="isActive" '.$check.'>
                            <span class="slider"></span>
                        </label>';
                return $links;
            })

            // ->editColumn('survey_form_logo', function($row) use ($base_path) {
            //     $image = $row->survey_form_logo;
            //     $image = !empty($image) ? $image : "";
            //     if (!file_exists($image)) {
            //         $image = "public/uploads/nophoto.png";
            //     }
            //     $image = $base_path . $image;
            //     $img_tag = '<img src="' . $image . '" alt="" width="30" height="30"/>';
            //     return $img_tag;
            // })

            ->rawColumns(['role','status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['user_role'] = DB::table('tbl_user_role')->select('id','role')->where('status',1)->get();
        return view('admin.user_roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'role'  => 'required|unique:tbl_user_role'
        ]);
        
        try {
            $role = UserRoles::create([
                'role' => $request->get('role'),
                'view_dashboard' => $request->get('view_dashboard'),
                'view_setting' => $request->get('view_setting'),
                'view_common_setting' => $request->get('view_common_setting'),
                'view_manage_user' => $request->get('view_manage_user'),
                'view_manage_category' => $request->get('view_manage_category'),
                'view_manage_group' => $request->get('view_manage_group'),
                'view_manage_type' => $request->get('view_manage_type'),
                'view_manage_survey_form' => $request->get('view_manage_survey_form'),
                'view_manage_participant' => $request->get('view_manage_participant'),
                'add_participant' => $request->get('add_participant'),
                'participant_list' => $request->get('participant_list'),
                'view_manage_send_survey' => $request->get('view_manage_send_survey'),
                'view_email_campaign' => $request->get('view_email_campaign'),
                'view_sms_campaign' => $request->get('view_sms_campaign'),
                'view_kpi_campaign' => $request->get('view_kpi_campaign'),
                'add_survey_form' => $request->get('add_survey_form'),
                'survey_form_list' => $request->get('survey_form_list'),
                'group_list' => $request->get('group_list'),
                'add_group' => $request->get('add_group'),
                'type_list' => $request->get('type_list'),
                'add_list' => $request->get('add_list'),
                'manual_send_survey' => $request->get('manual_send_survey'),
                'auto_send_survey' => $request->get('auto_send_survey'),
                'trigger_list_survey' => $request->get('trigger_list_survey'),
                'add_trigger_survey' => $request->get('add_trigger_survey'),
                'schedule_survey' => $request->get('schedule_survey'),
                'schedule_list_survey' => $request->get('schedule_list_survey'),
                'add_schedule_survey' => $request->get('add_schedule_survey'),
                'auto_send_survey_survey' => $request->get('auto_send_survey_survey'),
                'manage_survey_report' => $request->get('manage_survey_report'),
                'manage_kpi_campaign' => $request->get('manage_kpi_campaign'),
                'manage_create_kpi' => $request->get('manage_create_kpi'),
                'manage_kpi_report' => $request->get('manage_kpi_report'),
                'view_participant_setting' => $request->get('view_participant_setting'),
                'add_participant_category' => $request->get('add_participant_category'),
                'view_category_list' => $request->get('view_category_list'),
                'view_manage_template' => $request->get('view_manage_template'),
                'manage_email_list' => $request->get('manage_email_list'),
                'manage_add_email' => $request->get('manage_add_email'),
                'manage_sms_list' => $request->get('manage_sms_list'),
                'manage_add_sms' => $request->get('manage_add_sms'),
                'manage_user_list' => $request->get('manage_user_list'),
                'manage_add_user' => $request->get('manage_add_user'),
                'view_manage_report' => $request->get('view_manage_report'),
                'quick_participant_setting' => $request->get('quick_participant_setting'),
                'feedback_terminals' => $request->get('feedback_terminals'),
                'question_list' => $request->get('question_list'),
                'feedback_setting' => $request->get('feedback_setting'),
                'feedback_reply' => $request->get('feedback_reply'),
                'feedback_ratings' => $request->get('feedback_ratings'),
                'complainMenu' => $request->get('complainMenu'),
                'complaints' => $request->get('complaints'),
                'user_role' => $request->get('user_role'),
                'question_kpi_report' => $request->get('question_kpi_report'),
                'question_chart' => $request->get('question_chart'),
                'live_link' => $request->get('live_link'),
                'report_kpi' => $request->get('report_kpi'),
                'report_kpi_sms_feedback' => $request->get('report_kpi_sms_feedback'),
                'report_kpi_reasons_complains' => $request->get('report_kpi_reasons_complains'),
                'complains_status' => $request->get('complains_status'),
                'participants_list' => $request->get('participants_list'),
                //'quick_add_participants_button' => $request->get('quick_add_participants_button'),
                'sms' => $request->get('sms'),
                'email' => $request->get('email'),
                'sms_balance' => $request->get('sms_balance'),
                'complaints_box' => $request->get('complaints_box'),
                'feedback_terminal_response' => $request->get('feedback_terminal_response'),
                'new_participant' => $request->get('new_participant'),
                'updated_participant' => $request->get('updated_participant'),
                'complain_kpi' => $request->get('complain_kpi'),
                'complain_chart' => $request->get('complain_chart'),
                'reason_kpi' => $request->get('reason_kpi'),
                'reason_chart' => $request->get('reason_chart'),
                'add_type' => $request->get('add_type'),
                'level' => $request->get('level'),
                'complain_pop_up' => $request->get('complain_pop_up'),
                'get_complain_setting' => $request->get('get_complain_setting'),
                'notification_template' => $request->get('notification_template'),
                'get_reason_setting' => $request->get('get_reason_setting'),
                'city' => $request->get('city'),
                'reset_setting' => $request->get('reset_setting'),


                'feedback_terminals_2' => $request->get('feedback_terminals_2'),
                'question_list_2' => $request->get('question_list_2'),
                'feedback_setting_2' => $request->get('feedback_setting_2'),
                'get_reason_setting_2' => $request->get('get_reason_setting_2'),
                'reason_chart_2' => $request->get('reason_chart_2'),
                'feedback_ratings_2' => $request->get('feedback_ratings_2'),
                'feedback_reply_2' => $request->get('feedback_reply_2'),
                'question_chart_2' => $request->get('question_chart_2'),
                'live_link_2' => $request->get('live_link_2'),
                'complainMenu_2' => $request->get('complainMenu_2'),
                'complaints_2' => $request->get('complaints_2'),
                'complain_chart_2' => $request->get('complain_chart_2'),
                'notification_template_2' => $request->get('notification_template_2'),
                'get_complain_setting_2' => $request->get('get_complain_setting_2'),
                'complain_pop_up_2' => $request->get('complain_pop_up_2'),

                'feedback_terminals_3' => $request->get('feedback_terminals_3'),
                'question_list_3' => $request->get('question_list_3'),
                'feedback_setting_3' => $request->get('feedback_setting_3'),
                'get_reason_setting_3' => $request->get('get_reason_setting_3'),
                'reason_chart_3' => $request->get('reason_chart_3'),
                'feedback_ratings_3' => $request->get('feedback_ratings_3'),
                'feedback_reply_3' => $request->get('feedback_reply_3'),
                'question_chart_3' => $request->get('question_chart_3'),
                'live_link_3' => $request->get('live_link_3'),
                'complainMenu_3' => $request->get('complainMenu_3'),
                'complaints_3' => $request->get('complaints_3'),
                'complain_chart_3' => $request->get('complain_chart_3'),
                'notification_template_3' => $request->get('notification_template_3'),
                'get_complain_setting_3' => $request->get('get_complain_setting_3'),
                'complain_pop_up_3' => $request->get('complain_pop_up_3'),    
                
                'feedback_terminals_4' => $request->get('feedback_terminals_4'),
                'question_list_4' => $request->get('question_list_4'),
                'feedback_setting_4' => $request->get('feedback_setting_4'),
                'get_reason_setting_4' => $request->get('get_reason_setting_4'),
                'reason_chart_4' => $request->get('reason_chart_4'),
                'feedback_ratings_4' => $request->get('feedback_ratings_4'),
                'feedback_reply_4' => $request->get('feedback_reply_4'),
                'question_chart_4' => $request->get('question_chart_4'),
                'live_link_4' => $request->get('live_link_4'),
                'complainMenu_4' => $request->get('complainMenu_4'),
                'complaints_4' => $request->get('complaints_4'),
                'complain_chart_4' => $request->get('complain_chart_4'),
                'notification_template_4' => $request->get('notification_template_4'),
                'get_complain_setting_4' => $request->get('get_complain_setting_4'),
                'complain_pop_up_4' => $request->get('complain_pop_up_4'),


                'feedback_terminals_5' => $request->get('feedback_terminals_5'),
                'question_list_5' => $request->get('question_list_5'),
                'feedback_setting_5' => $request->get('feedback_setting_5'),
                'get_reason_setting_5' => $request->get('get_reason_setting_5'),
                'reason_chart_5' => $request->get('reason_chart_5'),
                'feedback_ratings_5' => $request->get('feedback_ratings_5'),
                'feedback_reply_5' => $request->get('feedback_reply_5'),
                'question_chart_5' => $request->get('question_chart_5'),
                'live_link_5' => $request->get('live_link_5'),
                'complainMenu_5' => $request->get('complainMenu_5'),
                'complaints_5' => $request->get('complaints_5'),
                'complain_chart_5' => $request->get('complain_chart_5'),
                'notification_template_5' => $request->get('notification_template_5'),
                'get_complain_setting_5' => $request->get('get_complain_setting_5'),
                'complain_pop_up_5' => $request->get('complain_pop_up_5'),
                'userReport' => $request->get('userReport'),
                'get_user_report' => $request->get('get_user_report'),
                'get_location_report' => $request->get('get_location_report'),

                'userReport_2' => $request->get('userReport_2'),
                'get_user_report_2' => $request->get('get_user_report_2'),
                'get_location_report_2' => $request->get('get_location_report_2'),

                'userReport_3' => $request->get('userReport_3'),
                'get_user_report_3' => $request->get('get_user_report_3'),
                'get_location_report_3' => $request->get('get_location_report_3'),

                'userReport_4' => $request->get('userReport_4'),
                'get_user_report_4' => $request->get('get_user_report_4'),
                'get_location_report_4' => $request->get('get_location_report_4'),

                'userReport_5' => $request->get('userReport_5'),
                'get_user_report_5' => $request->get('get_user_report_5'),
                'get_location_report_5' => $request->get('get_location_report_5'),


                'dashboard_feedback_terminals_2'=> $request->get('dashboard_feedback_terminals_2'),
                'dashboard_feedback_terminals_3'=> $request->get('dashboard_feedback_terminals_3'),
                'dashboard_feedback_terminals_4'=> $request->get('dashboard_feedback_terminals_4'),
                'dashboard_feedback_terminals_5'=> $request->get('dashboard_feedback_terminals_5'),

                'dashboard_feedback_reason_2' => $request->get('dashboard_feedback_reason_2'),
                'dashboard_feedback_reason_3' => $request->get('dashboard_feedback_reason_3'),
                'dashboard_feedback_reason_4' => $request->get('dashboard_feedback_reason_4'),
                'report_sms_feedback' => $request->get('report_sms_feedback'),
                'kpi_sms_feedback' => $request->get('kpi_sms_feedback'),
                'dashboard_feedback_terminals_1' => $request->get('dashboard_feedback_terminals_1'),
                'dashboard_complain_kpi' => $request->get('dashboard_complain_kpi'),
                'complain_status_chart' => $request->get('complain_status_chart'),
                'dashboard_feedback_reason_1' => $request->get('dashboard_feedback_reason_1'),
                'complain_list' => $request->get('complain_list'),
                'feedback_terminal_responses_1' => $request->get('feedback_terminal_responses_1'),
                'feedback_terminal_responses_2' => $request->get('feedback_terminal_responses_2'),
                'feedback_terminal_responses_3' => $request->get('feedback_terminal_responses_3'),
                'feedback_terminal_responses_4' => $request->get('feedback_terminal_responses_4'),
                'feedback_terminal_responses_5' => $request->get('feedback_terminal_responses_5'),
                'reason_kpi_dashboard' => $request->get('reason_kpi_dashboard'),



            ]);        
        } catch (Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.role').' '.__('message.created').' '.__('message.successfully'));
        return redirect()->route('user_roles.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = UserRoles::find($id);     

        return view('admin.user_roles.edit', compact('role'), $this->data);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role'  => 'required|unique:tbl_user_role,role,'.$id,
        ]);
        try {
            $role = UserRoles::whereId($id)->update([
                'role' => $request->get('role'),
                'view_dashboard' => $request->get('view_dashboard'),
                'view_setting' => $request->get('view_setting'),
                'view_common_setting' => $request->get('view_common_setting'),
                'view_manage_user' => $request->get('view_manage_user'),
                'view_manage_category' => $request->get('view_manage_category'),
                'view_manage_group' => $request->get('view_manage_group'),
                'view_manage_type' => $request->get('view_manage_type'),
                'view_manage_survey_form' => $request->get('view_manage_survey_form'),
                'view_manage_participant' => $request->get('view_manage_participant'),
                'add_participant' => $request->get('add_participant'),
                'participant_list' => $request->get('participant_list'),
                'view_manage_send_survey' => $request->get('view_manage_send_survey'),
                'view_email_campaign' => $request->get('view_email_campaign'),
                'view_sms_campaign' => $request->get('view_sms_campaign'),
                'view_kpi_campaign' => $request->get('view_kpi_campaign'),
                'add_survey_form' => $request->get('add_survey_form'),
                'survey_form_list' => $request->get('survey_form_list'),
                'group_list' => $request->get('group_list'),
                'add_group' => $request->get('add_group'),
                'type_list' => $request->get('type_list'),
                'add_list' => $request->get('add_list'),
                'manual_send_survey' => $request->get('manual_send_survey'),
                'auto_send_survey' => $request->get('auto_send_survey'),
                'auto_send_survey_survey' => $request->get('auto_send_survey_survey'),
                'trigger_list_survey' => $request->get('trigger_list_survey'),
                'add_trigger_survey' => $request->get('add_trigger_survey'),
                'schedule_survey' => $request->get('schedule_survey'),
                'schedule_list_survey' => $request->get('schedule_list_survey'),
                'add_schedule_survey' => $request->get('add_schedule_survey'),
                'manage_survey_report' => $request->get('manage_survey_report'),
                'manage_kpi_campaign' => $request->get('manage_kpi_campaign'),
                'manage_create_kpi' => $request->get('manage_create_kpi'),
                'manage_kpi_report' => $request->get('manage_kpi_report'),
                'view_participant_setting' => $request->get('view_participant_setting'),
                'add_participant_category' => $request->get('add_participant_category'),
                'view_category_list' => $request->get('view_category_list'),
                'view_manage_template' => $request->get('view_manage_template'),
                'manage_email_list' => $request->get('manage_email_list'),
                'manage_add_email' => $request->get('manage_add_email'),
                'manage_sms_list' => $request->get('manage_sms_list'),
                'manage_add_sms' => $request->get('manage_add_sms'),
                'manage_user_list' => $request->get('manage_user_list'),
                'manage_add_user' => $request->get('manage_add_user'),
                'view_manage_report' => $request->get('view_manage_report'),
                'quick_participant_setting' => $request->get('quick_participant_setting'),
                'feedback_terminals' => $request->get('feedback_terminals'),
                'question_list' => $request->get('question_list'),
                'feedback_setting' => $request->get('feedback_setting'),
                'feedback_reply' => $request->get('feedback_reply'),
                'feedback_ratings' => $request->get('feedback_ratings'),
                'user_role' => $request->get('user_role'),
                'complainMenu' => $request->get('complainMenu'),
                'complaints' => $request->get('complaints'),
                'question_kpi_report' => $request->get('question_kpi_report'),
                'question_chart' => $request->get('question_chart'),
                'live_link' => $request->get('live_link'),
                'report_kpi' => $request->get('report_kpi'),
                'report_kpi_sms_feedback' => $request->get('report_kpi_sms_feedback'),
                'report_kpi_reasons_complains' => $request->get('report_kpi_reasons_complains'),
                'complains_status' => $request->get('complains_status'),
                'participants_list' => $request->get('participants_list'),
                'quick_add_participants_button' => $request->get('quick_add_participants_button'),
                'sms' => $request->get('sms'),
                'email' => $request->get('email'),
                'sms_balance' => $request->get('sms_balance'),
                'complaints_box' => $request->get('complaints_box'),
                'feedback_terminal_response' => $request->get('feedback_terminal_response'),
                'new_participant' => $request->get('new_participant'),
                'updated_participant' => $request->get('updated_participant'),
                'complain_kpi' => $request->get('complain_kpi'),
                'complain_chart' => $request->get('complain_chart'),
                'reason_kpi' => $request->get('reason_kpi'),
                'reason_chart' => $request->get('reason_chart'),
                'add_type' => $request->get('add_type'),
                'level' => $request->get('level'),
                'complain_pop_up' => $request->get('complain_pop_up'),
                'get_complain_setting' => $request->get('get_complain_setting'),
                'notification_template' => $request->get('notification_template'),
                'get_reason_setting' => $request->get('get_reason_setting'),
                'city' => $request->get('city'),
                'reset_setting' => $request->get('reset_setting'),

                'feedback_terminals_2' => $request->get('feedback_terminals_2'),
                'question_list_2' => $request->get('question_list_2'),
                'feedback_setting_2' => $request->get('feedback_setting_2'),
                'get_reason_setting_2' => $request->get('get_reason_setting_2'),
                'reason_chart_2' => $request->get('reason_chart_2'),
                'feedback_ratings_2' => $request->get('feedback_ratings_2'),
                'feedback_reply_2' => $request->get('feedback_reply_2'),
                'question_chart_2' => $request->get('question_chart_2'),
                'live_link_2' => $request->get('live_link_2'),
                'complainMenu_2' => $request->get('complainMenu_2'),
                'complaints_2' => $request->get('complaints_2'),
                'complain_chart_2' => $request->get('complain_chart_2'),
                'notification_template_2' => $request->get('notification_template_2'),
                'get_complain_setting_2' => $request->get('get_complain_setting_2'),
                'complain_pop_up_2' => $request->get('complain_pop_up_2'),

                'feedback_terminals_3' => $request->get('feedback_terminals_3'),
                'question_list_3' => $request->get('question_list_3'),
                'feedback_setting_3' => $request->get('feedback_setting_3'),
                'get_reason_setting_3' => $request->get('get_reason_setting_3'),
                'reason_chart_3' => $request->get('reason_chart_3'),
                'feedback_ratings_3' => $request->get('feedback_ratings_3'),
                'feedback_reply_3' => $request->get('feedback_reply_3'),
                'question_chart_3' => $request->get('question_chart_3'),
                'live_link_3' => $request->get('live_link_3'),
                'complainMenu_3' => $request->get('complainMenu_3'),
                'complaints_3' => $request->get('complaints_3'),
                'complain_chart_3' => $request->get('complain_chart_3'),
                'notification_template_3' => $request->get('notification_template_3'),
                'get_complain_setting_3' => $request->get('get_complain_setting_3'),
                'complain_pop_up_3' => $request->get('complain_pop_up_3'),    
                
                'feedback_terminals_4' => $request->get('feedback_terminals_4'),
                'question_list_4' => $request->get('question_list_4'),
                'feedback_setting_4' => $request->get('feedback_setting_4'),
                'get_reason_setting_4' => $request->get('get_reason_setting_4'),
                'reason_chart_4' => $request->get('reason_chart_4'),
                'feedback_ratings_4' => $request->get('feedback_ratings_4'),
                'feedback_reply_4' => $request->get('feedback_reply_4'),
                'question_chart_4' => $request->get('question_chart_4'),
                'live_link_4' => $request->get('live_link_4'),
                'complainMenu_4' => $request->get('complainMenu_4'),
                'complaints_4' => $request->get('complaints_4'),
                'complain_chart_4' => $request->get('complain_chart_4'),
                'notification_template_4' => $request->get('notification_template_4'),
                'get_complain_setting_4' => $request->get('get_complain_setting_4'),
                'complain_pop_up_4' => $request->get('complain_pop_up_4'),


                'feedback_terminals_5' => $request->get('feedback_terminals_5'),
                'question_list_5' => $request->get('question_list_5'),
                'feedback_setting_5' => $request->get('feedback_setting_5'),
                'get_reason_setting_5' => $request->get('get_reason_setting_5'),
                'reason_chart_5' => $request->get('reason_chart_5'),
                'feedback_ratings_5' => $request->get('feedback_ratings_5'),
                'feedback_reply_5' => $request->get('feedback_reply_5'),
                'question_chart_5' => $request->get('question_chart_5'),
                'live_link_5' => $request->get('live_link_5'),
                'complainMenu_5' => $request->get('complainMenu_5'),
                'complaints_5' => $request->get('complaints_5'),
                'complain_chart_5' => $request->get('complain_chart_5'),
                'notification_template_5' => $request->get('notification_template_5'),
                'get_complain_setting_5' => $request->get('get_complain_setting_5'),
                'complain_pop_up_5' => $request->get('complain_pop_up_5'),
                'userReport' => $request->get('userReport'),
                'get_user_report' => $request->get('get_user_report'),
                'get_location_report' => $request->get('get_location_report'),

                'userReport_2' => $request->get('userReport_2'),
                'get_user_report_2' => $request->get('get_user_report_2'),
                'get_location_report_2' => $request->get('get_location_report_2'),

                'userReport_3' => $request->get('userReport_3'),
                'get_user_report_3' => $request->get('get_user_report_3'),
                'get_location_report_3' => $request->get('get_location_report_3'),

                'userReport_4' => $request->get('userReport_4'),
                'get_user_report_4' => $request->get('get_user_report_4'),
                'get_location_report_4' => $request->get('get_location_report_4'),

                'userReport_5' => $request->get('userReport_5'),
                'get_user_report_5' => $request->get('get_user_report_5'),
                'get_location_report_5' => $request->get('get_location_report_5'),

                'dashboard_feedback_terminals_2'=> $request->get('dashboard_feedback_terminals_2'),
                'dashboard_feedback_terminals_3'=> $request->get('dashboard_feedback_terminals_3'),
                'dashboard_feedback_terminals_4'=> $request->get('dashboard_feedback_terminals_4'),
                'dashboard_feedback_terminals_5'=> $request->get('dashboard_feedback_terminals_5'),

                'dashboard_feedback_reason_2' => $request->get('dashboard_feedback_reason_2'),
                'dashboard_feedback_reason_3' => $request->get('dashboard_feedback_reason_3'),
                'dashboard_feedback_reason_4' => $request->get('dashboard_feedback_reason_4'),
                'dashboard_feedback_reason_5' => $request->get('dashboard_feedback_reason_5'),
                'report_sms_feedback' => $request->get('report_sms_feedback'),
                'kpi_sms_feedback' => $request->get('kpi_sms_feedback'),
                'dashboard_feedback_terminals_1' => $request->get('dashboard_feedback_terminals_1'),
                'dashboard_complain_kpi' => $request->get('dashboard_complain_kpi'),
                'complain_status_chart' => $request->get('complain_status_chart'),
                'dashboard_feedback_reason_1' => $request->get('dashboard_feedback_reason_1'),
                'complain_list' => $request->get('complain_list'),
                'feedback_terminal_responses_1' => $request->get('feedback_terminal_responses_1'),
                'feedback_terminal_responses_2' => $request->get('feedback_terminal_responses_2'),
                'feedback_terminal_responses_3' => $request->get('feedback_terminal_responses_3'),
                'feedback_terminal_responses_4' => $request->get('feedback_terminal_responses_4'),
                'feedback_terminal_responses_5' => $request->get('feedback_terminal_responses_5'),
                'reason_kpi_dashboard' => $request->get('reason_kpi_dashboard'),

            ]);        
        } catch (Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.role').' '.__('message.updated').' '.__('message.successfully'));
        return redirect()->route('user_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            $role = UserRoles::destroy($id);   
            // $request->session()->flash('message.level', 'success');
            // $request->session()->flash('message.content', 'Role Deleted successfully!');   

            return response()->json([
                'message'   =>  __('message.role').' '.__('message.deleted').' '.__('message.successfully'),
                'success'   =>  true
            ],200);
        } catch (Exception $e) {
            // $request->session()->flash('message.level', 'danger');
            // $request->session()->flash('message.content', $e->getMessage());

            return response()->json([
                'message'   =>  'Internal server error!',
                'success'   =>  false
            ],200);
        }
    }
    public function user_status(Request $request)
    {
        try {
             $id = $request->get('id');
            DB::table('tbl_user_role')->where('id',$id)->update([
                'status' => $request->get('status')
            ]);
            if($request->get('status') == 1){
            // $request->session()->flash('message.level', 'success');
            // $request->session()->flash('message.content', 'User Role activated successfully!');
            return response()->json([
                'message' => __('message.role').' '.__('message.activated').' '.__('message.successfully'),
                'success' => true
            ],200);
            
            }else{
                // $request->session()->flash('message.level', 'success');
                // $request->session()->flash('message.content', 'User Role inavctive successfully!');
                return response()->json([
                    'message' => __('message.role').' '.__('message.in_active').' '.__('message.successfully'),
                    'success' => true
                ],200);
            }
            

        } catch (Exception $e) {
            // $request->session()->flash('message.level', 'danger');
            // $request->session()->flash('message.content', $e->getMessage());
            return response()->json([
                'message'   =>  'Internal server error!',
                'success'   =>  false
            ],500);
        }
    }
}
