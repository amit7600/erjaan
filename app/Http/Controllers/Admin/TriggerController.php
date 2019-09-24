<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Trigger;
use App\EmailTemplate;
use App\SMSTemplate;
use App\Group;
use App\Type;
use App\Category;
use App\Participant;
use App\Surveyform;
use App\SurveyQuestion;
use App\SurveyOption;
use App\SurveyFormInfo;

use Yajra\Datatables\Datatables;
use App\Http\Requests\TriggerRequest;
use DB;
use Input;
use Auth;

class TriggerController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) { 

        $login_user = Auth::user();

        $this->data['page_title'] = "Trigger Management";

        if (!$request->ajax()) {
            return view('admin.trigger.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
       
        /*$trigger_data = DB::table('tbl_auto_trigger_setting')
            // ->join('tbl_survey_form as s_form', 's_form.id', '=', 'tbl_auto_trigger_setting.form_id')
            ->join('tbl_sms_template as s_teml', 's_teml.id', '=', 'tbl_auto_trigger_setting.email_templ_id')
            ->join('tbl_email_template as e_teml', 'e_teml.id', '=', 'tbl_auto_trigger_setting.email_templ_id')
            ->select('tbl_auto_trigger_setting.*',
                // 's_form.survey_form_title',
                's_teml.title as sms_title', 
                'e_teml.title as email_title', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->get();*/
        $trigger_data = DB::table('tbl_auto_trigger_setting')
        ->select('tbl_auto_trigger_setting.*', DB::raw('@rownum := @rownum + 1 AS rownum'))->get();
        // foreach ($trigger_data as $key => $value) {
        //     if ($value->sending_method == 1) {
        //         // for sms
        //         $triggerTempSMS = DB::table('tbl_sms_template')
        //                         ->where('id', $value->email_templ_id)
        //                         ->first();

        //         $value->sms_title = $triggerTempSMS->title;
        //     } else {
        //         // for email
        //         $triggerTempEmail = DB::table('tbl_email_template')
        //                         ->where('id', $value->email_templ_id)
        //                         ->first();
        //         $value->email_title = $triggerTempEmail ? $triggerTempEmail->title : '';
        //     }
        // }
        $base_path = $this->data['base_path'];
        $trigger_data = DB::table('tbl_auto_trigger_setting')
        ->select('tbl_auto_trigger_setting.*', DB::raw('@rownum := @rownum + 1 AS rownum'));
        return Datatables::of($trigger_data)
            ->addColumn('action', function($row) {
                $edit_url = route('trigger.edit', $row->id);
                $delete_url = route('trigger.destroy', $row->id);
                $view_details = route('trigger.show', $row->id);

                $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                //$links .= '<a title="View" href="' . $view_details . '" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> View Trigger</a>';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data" style="cursor:pointer;"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                return $links;
            })

            ->editColumn('template_title', function ($row) {
                
                if ($row->sending_method == 1) {
                // for sms
                $triggerTempSMS = DB::table('tbl_sms_template')
                                ->where('id', $row->email_templ_id)
                                ->first();
                return $triggerTempSMS != null ? $triggerTempSMS->title : '';
                    } else {
                        // for email
                        $triggerTempEmail = DB::table('tbl_email_template')
                                        ->where('id', $row->email_templ_id)
                                        ->first();
                        return $triggerTempEmail ? $triggerTempEmail->title : '';
                    }
                
            })

            ->editColumn('trigger_type', function ($row) {
                if ($row->trigger_event == 1) {return "New Participant";}
                return "Updated Participant";
            })

            ->editColumn('waiting_time', function ($row) {
                if ($row->immediately) {
                    return 'Immediately';
                } else {
                    return $row->waiting_hours.' '.ucfirst($row->waiting_time_formate);    
                }
                
            })
            

            ->editColumn('sending_method', function ($row) {
                if ($row->sending_method == 1) {return "SMS";}
                return "Email";
            })

           
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
           
            ->rawColumns(['trigger_name', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->check_user_role();
        $this->data['menu_type'] = 1;

        $this->data['group'] = Group::Select('id', 'group_name')->get();
        // $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['survey_form_data'] = Surveyform::select('id','survey_form_title')
        ->where(['is_deleted'=>0])
        ->orderBy('id','DESC')
        ->get();
        //16-01-2019
        $this->data['group'] = DB::table('tbl_groups')->where('is_deleted', 0)->select('*')->get();
        $this->data['type'] = DB::table('tbl_types')->select('*')->where('is_deleted', 0)->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();

        $this->data['auto_trigger_data'] = DB::table('tbl_auto_trigger_setting')
                        ->select('*') 
                        ->where('id', 1)
                        ->first();

        return view('admin.trigger.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TriggerRequest $request) {

        if($request->get('type_id') != null ){
            $type = implode(',', $request->get('type_id'));
        }else{
            $type = null;
        }
        if($request->get('group_id') != null ){
            $group = implode(',', $request->get('group_id'));
        }else{
            $group = null;
        }
        if($request->get('category_id') != null ){
            $category = implode(',', $request->get('category_id'));
        }else{
            $category = null;
        }
        $login_user = Auth::user();
        
        $auto_trigger = new Trigger;        
        $auto_trigger->trigger_name = $request->input('trigger_name');
        $auto_trigger->waiting_hours = $request->input('waiting_time');
        $auto_trigger->trigger_time = $request->input('selecTime');
        // added immidiately dated:- 14-09-2018
        $auto_trigger->immediately = $request->has('immediately') ? 1 : 0;
        $auto_trigger->waiting_time_formate = $request->input('waiting_time_formate');
        $auto_trigger->trigger_event = $request->input('trigger_event');
        // comented by kandarp pandya 01-09-2018
        // $auto_trigger->form_id = $request->input('survey_form_id');
        // created on 07-09-2018
        $auto_trigger->user_id = \Auth::user()->id;
        $auto_trigger->sending_method = $request->input('sending_method');
        $auto_trigger->email_templ_id = $request->input('template_dropdown');
        // $auto_trigger->created_at = date('Y-m-d');
        $auto_trigger->type = $type;
        $auto_trigger->category = $group;
        $auto_trigger->group = $category;
       
        if ($auto_trigger->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.created').' '.__('message.successfully'));
            return redirect()->route('trigger.index');
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('trigger.create');
        }

        //return redirect()->route('trigger.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id) {
        $login_user = Auth::user();

        $this->data['page_title'] = "Trigger Participant Management";

        if (!$request->ajax()) {
            return view('admin.trigger.participat_list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
            $trigger_data = DB::table('tbl_participants as parti')
            ->select('parti.id as parti_id','parti.first_name','parti.last_name',
                'parti.on_behalf_first_name','parti.on_behalf_last_name',
                's_count.token','s_count.is_submitted_send','s_count.trigger_id','s_count.created_at as created',
                's_form.survey_form_title',
                's_teml.title as sms_title', 
                'e_teml.title as email_title',
                'trigger.*',

                DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->join('tbl_survey_count as s_count', 'parti.id', '=', 's_count.participant_id')
            ->join('tbl_survey_form as s_form', 's_count.form_id', '=', 's_form.id')
            ->join('tbl_auto_trigger_setting as trigger', 'trigger.id', '=', 's_count.trigger_id')
            ->join('tbl_sms_template as s_teml', 's_teml.id', '=', 'trigger.email_templ_id')
            ->join('tbl_email_template as e_teml', 'e_teml.id', '=', 'trigger.email_templ_id')
            
            ->where('s_count.trigger_id',$id)
            ->orderBy('s_count.id', 'desc')
            //->groupBy('s_count.token')
            ->get();

        return Datatables::of($trigger_data)
            ->addColumn('action', function($row) {

                $form_details = route('participant_form_details',$row->form_id.'/'.$row->token);
                $delete_url = route('trigger.destroy', $row->id);
                if($row->is_submitted_send==2){
                    $links = '<a title="Survey Form Details" rel="'.$form_details.'" href="javascript:void(0)" class="text-success mr-2 text-25 survey_form_details"><i class="i-Eye nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                }else{
                    $links = '<a title="Resend survey link to participant" form-data="'.$row->form_id.'" rel="'.$row->parti_id.'" href="javascript:void(0)" class="text-info mr-2 text-25 send_survey_form_link"><i class="i-Email nav-icon font-weight-bold" aria-hidden="true"></i> Send Survey Link</a>&nbsp';
                }

                $links .= '<a title="Delete" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data" style="cursor:pointer;"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                return $links;
            })

            
            ->editColumn('trigger_type', function ($row) {
                if ($row->trigger_event == 1) {return "New Participant";}
                return "Updated Participant";
            })

            
            ->editColumn('sending_method', function ($row) {
                if ($row->sending_method == 1) {return "SMS";}
                return "Email";
            })

           
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created));
            })
            
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
           
            ->rawColumns(['trigger_name', 'action'])
            ->make(true);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id) { 
        $trigger_data = Trigger::where('id',$id);
        $login_user = Auth::user();

        // $this->data['group'] = Group::Select('id', 'group_name')->get();
        // $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['survey_form_data'] = Surveyform::select('id','survey_form_title')
        ->where(['is_deleted'=>0])
        ->orderBy('id','DESC')
        ->get();
        //16-01-2019
        $this->data['group'] = DB::table('tbl_groups')->where('is_deleted', 0)->select('*')->get();
        $this->data['type'] = DB::table('tbl_types')->select('*')->where('is_deleted', 0)->get();
        $this->data['category'] = DB::table('tbl_categories')->select('*')->where('parent_id', 0)->where('is_deleted', 0)->get();

        
        $this->data['repairman_data'] = $trigger_data->first();
        
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('type.index');
        }
        return view('admin.trigger.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TriggerRequest $request, $id) {
        $login_user = Auth::user();
        $trigger = Trigger::find($id);
        if(empty($trigger)){
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('trigger.index');
        }

       
        $trigger->trigger_name = $request->input('trigger_name');
        $trigger->waiting_hours = $request->input('waiting_time');
        // added immidiately dated:- 14-09-2018
        $trigger->immediately = $request->has('immediately') ? 1 : 0;
        $trigger->trigger_time = $request->input('selecTime');
        $trigger->waiting_time_formate = $request->input('waiting_time_formate');
        $trigger->trigger_event = $request->input('trigger_event');
        $trigger->form_id = $request->input('survey_form_id');
        $trigger->sending_method = $request->input('sending_method');
        $trigger->email_templ_id = $request->input('template_dropdown');

        if ($trigger->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.updated').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('trigger.index');
    }

    
    public function destroy(Request $request, $id) {

        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $trigger = Trigger::find($id);
        $trigger->delete();

        $response = array('status' => true, 'message' =>  __('message.auto').' '.__('message.trigger').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        echo json_encode($response);
        die();
        
    }



    function check_user_role()
    {
        if(Auth::user()->user_role==2){
            echo "Access Denied";
            die;
        }
    }

}
