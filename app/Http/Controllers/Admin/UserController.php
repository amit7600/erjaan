<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\UserPermission;
use Yajra\Datatables\Datatables;
use App\Http\Requests\RepairmanRequest;
use App\Package\MediaUploadLib;
use DB;
use Input;
use Auth;
use App\City;

class UserController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        
    }

    protected function _encrypt($moment_id){
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    protected function _decrypt($key) {
        $A = 929323;
        $B = 239893483274;
        return ($key ^ $B) / $A;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) {

        $login_user = Auth::user();
        
        $this->data['page_title'] = "User Detail";

        if (!$request->ajax()) {
            return view('admin.user.list', $this->data);
        }
        DB::statement(DB::raw('set @rownum=0'));
        $repariman = User::Select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->where('user_role','!=' , 0)
                ->where('status', 1)
                ->orderBy('id', 'desc');

        if($login_user->user_role!=0){
            $repariman = $repariman->where('created_by',$login_user->id);
        }
               
        $repariman = $repariman;

        $base_path = $this->data['base_path'];

        return Datatables::of($repariman)
            ->addColumn('action', function($row) {
                $edit_url = route('user.edit', $this->_encrypt($row->id));
                $delete_url = route('user.destroy', $row->id);
//                            $active_url = route('activeRepariman', $row->id);
//                            $dactive_url = route('dactiveRepariman', $row->id);

                $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                return $links;
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->editColumn('user_image', function($row) use ($base_path) {
                $image = $row->user_image;
                $image = !empty($image) ? $image : "";
                if (!file_exists($image)) {
                    $image = "public/uploads/nophoto.png";
                }
                $image = $base_path . $image;
                $img_tag = '<img src="' . $image . '" alt="" width="80" height="80"/>';
                return $img_tag;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['user_image', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // $this->check_user_role();
        $userRole = Auth::user();
        if($userRole->user_role != 0){
            $role = DB::table('tbl_user_role')->whereId($userRole->user_role)->where('status',1)->first();
        }else{
            $role = DB::table('tbl_user_role')->where('status',1)->first();
        }
        if($role){     
            $this->data['user_role'] = DB::table('tbl_user_role')->select('id','role')->where('level','>=',$role->level)->where('status',1)->get();       
        }else{
            $this->data['user_role'] = DB::table('tbl_user_role')->select('id','role')->where('status',1)->get();
        }
            $this->data['menu_type'] = 1;
            $this->data['country'] = Country::Select('id', 'name')->get();
            
            $this->data['city'] = City::Select('id', 'cityName')->get();
        return view('admin.user.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepairmanRequest $request) {
        $login_user = Auth::user();
        //print_r($_POST);die;
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->business_name = $request->input('business_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->created_by = $login_user->id;
        // $login_user->user_role=1;
        $user->user_role = $request->input('user_role');

        if (!empty(Input::file('user_image')) && Input::file('user_image')->getError() == 0) {

            if (!empty($user->user_image) && file_exists($user->user_image)) {
                unlink($user->user_image);
            }

            $image = new MediaUploadLib();
            $path = public_path('uploads/Users');
            list($fileNameImg, $size) = $image->fileUpload(Input::file('user_image'), $path, '', '');
            $user->user_image = 'uploads/Users/' . $fileNameImg;
        }

        if ($user->save()) {
            // $user_permission = new UserPermission;
            // $user_permission->user_id = $user->id;

            // $user_permission->view_dashboard = $request->input('view_dashboard');

            // $user_permission->view_setting = $request->input('view_setting');
            // //new for setting
            // $user_permission->view_common_setting = $request->input('common_setting');
            // $user_permission->view_participant_setting = $request->input('view_participant_setting');
            // $user_permission->add_participant_category = $request->input('add_participant_category');
            // $user_permission->view_category_list = $request->input('view_category_list');

            // $user_permission->view_manage_user = $request->input('manage_user');

            // $user_permission->manage_user_list = $request->input('manage_user_list');
            // $user_permission->manage_add_user = $request->input('manage_add_user');

            // $user_permission->view_manage_category = $request->input('manage_category');
            // $user_permission->view_manage_group = $request->input('manage_group');
            // //new
            // $user_permission->group_list = $request->input('group_list');
            // $user_permission->add_group = $request->input('add_group');

            // $user_permission->view_manage_type = $request->input('manage_type');
            // //new
            // $user_permission->type_list = $request->input('type_list');
            // $user_permission->add_list = $request->input('add_type');

            // $user_permission->view_manage_survey_form = $request->input('manage_survey_from');
            // //new
            // $user_permission->add_survey_form = $request->input('add_survey_form');
            // $user_permission->survey_form_list = $request->input('survey_form_list');

            // $user_permission->view_manage_participant = $request->input('manage_participant');
            // //new
            // $user_permission->add_participant = $request->input('add_participant');
            // $user_permission->participant_list = $request->input('participant_list');

            // $user_permission->view_manage_send_survey = $request->input('manage_send_survey');
            // //new report survey
            // $user_permission->manage_survey_report = $request->input('manage_survey_report');
            // $user_permission->manage_kpi_campaign = $request->input('manage_kpi_campaign');
            // $user_permission->manage_create_kpi = $request->input('manage_create_kpi');
            // $user_permission->manage_kpi_report = $request->input('manage_kpi_report');
            // $user_permission->view_manage_report = $request->input('view_manage_report');


            // //new
            // $user_permission->manual_send_survey = $request->input('manual_send_survey');
            // $user_permission->auto_send_survey = $request->input('auto_send_survey');
            // $user_permission->trigger_list_survey = $request->input('trigger_list_survey');
            // $user_permission->add_trigger_survey = $request->input('add_trigger_survey');
            // $user_permission->schedule_survey = $request->input('schedule_survey');
            // $user_permission->schedule_list_survey = $request->input('schedule_list_survey');
            // $user_permission->add_schedule_survey = $request->input('add_schedule_survey');
            

            //     //new 
            // $user_permission->view_manage_template = $request->input('view_manage_template');
            // $user_permission->view_email_campaign = $request->input('manage_email_campaign');
            // $user_permission->manage_email_list = $request->input('manage_email_list');
            // $user_permission->manage_add_email = $request->input('manage_add_email');

            // $user_permission->view_sms_campaign = $request->input('manage_sms_campaign');
            // $user_permission->manage_sms_list = $request->input('manage_sms_list');
            // $user_permission->manage_add_sms = $request->input('manage_add_sms');

            // $user_permission->view_kpi_campaign = $request->input('manage_kpi_campaign');
            
            
            // $user_permission->participant_list = $request->input('participant_list');
            // $user_permission->created_at = date('Y-d-m');
            // $user_permission->feedback_survey = $request->input('feedback_survey');
            // $user_permission->question_list = $request->input('question_list');
            // $user_permission->feedback_setting = $request->input('feedback_setting');
            // $user_permission->show_question_answer = $request->input('show_question_answer');
            // $user_permission->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.user').' '.__('message.created').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.user').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('user.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$key) {
        $id = $this->_decrypt($key);
        $repairman_data = User::where('id',$id);
        $login_user = Auth::user();
        if($login_user->user_role == 0) {
            $role = DB::table('tbl_user_role')->where('status',1)->first();
        }else{
            $role = DB::table('tbl_user_role')->whereId($login_user->user_role)->where('status',1)->first();

        }
        $permission_data = UserPermission::where('user_id', $id)->first();

        if($login_user->user_role!=0){
            $repairman_data = $repairman_data->where('created_by',$login_user->id)->where('status',1);
        }

        $repairman_data = $repairman_data->first();
        $this->data['permission_data'] = $permission_data;
        $this->data['repairman_data'] = $repairman_data;
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['user_role'] = DB::table('tbl_user_role')->select('id','role')->where('level','>=',$role->level)->get();
        $this->data['city'] = City::Select('id', 'cityName')->get();
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.user').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('user.index');
        }
        return view('admin.user.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RepairmanRequest $request, $id) {
        $login_user = Auth::user();
        $user = User::where('id',$id);

        if($login_user->user_role!=0){
            $user = $user->where('created_by',$login_user->id);
        }

        $user = $user->first();

        if(empty($user)){
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.user').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('user.index');
        }

        $user->user_role = $request->input('user_role');
        $user->name = $request->input('name');
        $user->business_name = $request->input('business_name');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->mobile_number = $request->input('mobile_number');
        $user->city = $request->input('city');
        $user->country = $request->input('country');


        if (!empty(Input::file('user_image')) && Input::file('user_image')->getError() == 0) {

            if (!empty($user->user_image) && file_exists($user->user_image)) {
                unlink($user->user_image);
            }

            $image = new MediaUploadLib();
            $path = public_path('uploads/Users');
            list($fileNameImg, $size) = $image->fileUpload(Input::file('user_image'), $path, '', '');
            $user->user_image = 'uploads/Users/' . $fileNameImg;
        }

        if ($user->save()) {
            // $update_user_permission = UserPermission::where('user_id',$id)->first();
                                                                                  
            // $update_user_permission->view_dashboard = $request->input('view_dashboard');
                                   
            // $update_user_permission->view_setting = $request->input('view_setting');

            // $update_user_permission->view_common_setting = $request->input('common_setting');
            // $update_user_permission->view_participant_setting = $request->input('view_participant_setting');
            // $update_user_permission->add_participant_category = $request->input('add_participant_category');
            // $update_user_permission->view_category_list = $request->input('view_category_list');

            // $update_user_permission->view_manage_user = $request->input('manage_user');

            // $update_user_permission->manage_user_list = $request->input('manage_user_list');
            // $update_user_permission->manage_add_user = $request->input('manage_add_user');

            // $update_user_permission->view_manage_category = $request->input('manage_category');
            // $update_user_permission->view_manage_group = $request->input('manage_group');
            // //new
            // $update_user_permission->group_list = $request->input('group_list');
            // $update_user_permission->add_group = $request->input('add_group');

            // $update_user_permission->view_manage_type = $request->input('manage_type');
            // //new
            // $update_user_permission->type_list = $request->input('type_list');
            // $update_user_permission->add_list = $request->input('add_type');

            // $update_user_permission->view_manage_survey_form = $request->input('manage_survey_from');

            // //new
            // $update_user_permission->add_survey_form = $request->input('add_survey_form');
            // $update_user_permission->survey_form_list = $request->input('survey_form_list');

            // $update_user_permission->view_manage_participant = $request->input('manage_participant');
            // //new
            // $update_user_permission->add_participant = $request->input('add_participant');
            // $update_user_permission->participant_list = $request->input('participant_list');

            // $update_user_permission->view_manage_send_survey = $request->input('manage_send_survey');
            // //new report survey
            // $update_user_permission->manage_survey_report = $request->input('manage_survey_report');
            // $update_user_permission->manage_kpi_campaign = $request->input('manage_kpi_campaign');
            // $update_user_permission->manage_create_kpi = $request->input('manage_create_kpi');
            // $update_user_permission->manage_kpi_report = $request->input('manage_kpi_report');

            // //new
            // $update_user_permission->manual_send_survey = $request->input('manual_send_survey');
            // $update_user_permission->auto_send_survey = $request->input('auto_send_survey');
            // $update_user_permission->trigger_list_survey = $request->input('trigger_list_survey');
            // $update_user_permission->add_trigger_survey = $request->input('add_trigger_survey');
            // $update_user_permission->schedule_survey = $request->input('schedule_survey');
            // $update_user_permission->schedule_list_survey = $request->input('schedule_list_survey');
            // $update_user_permission->add_schedule_survey = $request->input('add_schedule_survey');

            // //new 
            // $update_user_permission->view_manage_template = $request->input('view_manage_template');
            // $update_user_permission->view_email_campaign = $request->input('manage_email_campaign');
            // $update_user_permission->manage_email_list = $request->input('manage_email_list');
            // $update_user_permission->manage_add_email = $request->input('manage_add_email');

            // $update_user_permission->view_sms_campaign = $request->input('manage_sms_campaign');
            // $update_user_permission->manage_sms_list = $request->input('manage_sms_list');
            // $update_user_permission->manage_add_sms = $request->input('manage_add_sms');

            // $update_user_permission->view_kpi_campaign = $request->input('manage_kpi_campaign');
            // $update_user_permission->view_manage_report = $request->input('view_manage_report');
            
            // $update_user_permission->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.user').' '.__('message.updated').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.user').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('user.index');
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

        $user = User::where('id',$id);
        $login_user = Auth::user();
        if($login_user->user_role!=0){
            $user = $user->where('created_by',$login_user->id);
        }

        $user = $user->first();

        $response = array('status' => true, 'message' => __('message.user').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($user)) {
            $response = array('status' => false, 'message' => __('message.user').' '.__('message.not').' '.__('message.found'));
        } else {
            $user->status = 0;
            $user->save();
        }
        echo json_encode($response);
    }

    /**
     * active the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activeRepariman(Request $request, $id) {

        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $user = User::find($id);
        $response = array('status' => true, 'message' => __('message.user').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($user)) {
            $response = array('status' => false, 'message' => __('message.user').' '.__('message.not').' '.__('message.found'));
        } else {
            $user->status = 0;
            $user->save();
        }
        echo json_encode($response);
    }

    /**
     * dactive the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dactiveRepariman(Request $request, $id) {
        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $user = User::find($id);
        $response = array('status' => true, 'message' => __('message.user').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($user)) {
            $response = array('status' => false, 'message' => __('message.user').' '.__('message.not').' '.__('message.found'));
        } else {
            $user->status = 0;
            $user->save();
        }
        echo json_encode($response);
    }

    function check_user_role()
    {
        if(Auth::user()->user_role==4){
            echo "Access Denied";
            die;
        }
    }

}
