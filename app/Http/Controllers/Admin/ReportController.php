<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Type;
use App\Category;
use App\Group;
use App\Surveyform;
use App\SurveyKpi;
use App\SurveyOption;
use App\Package\SendEmailLib;
use App\Package\SendSMSLib;
use App\Helpers\CommonHelper;
use App\SurveyFormInfo;
use Yajra\Datatables\Datatables;
use App\Http\Requests\SurveyFormRequest;
use App\Http\Requests\SurveyKpiRequest;
use DB;
use Input;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) {
        $session_array = array(
            "category_id" => $request->session()->get('category_id'),
            "sub_category_id" => $request->session()->get('sub_category_id'),
            "group_id" => $request->session()->get('group_id'),
            "type_id" => $request->session()->get('type_id'),
            "created_from" => $request->session()->get('created_from'),
            "created_to" => $request->session()->get('created_to'),
            "select_chart_type" => $request->session()->get('select_chart_type'),
            "select_chart_by" => $request->session()->get('select_chart_by'),
            "user_data" => $request->session()->get('user_data')
        );

//        echo '<pre>';
//        print_r($session_array);die;

        if ($request->session()->has('category_id', 'sub_category_id', 'group_id', 'type_id', 'created_to', 'select_chart_type','select_chart_by','user_data')) {
            \Session::forget('created_from');
        }
        $survey_form = DB::table('tbl_survey_form')
                ->select('*')
                ->where('is_deleted', 0)
                ->get();
        $this->data['survey_form'] = $survey_form;
//        $this->data['this'] = $this->_encrypt($id);
        return view('admin.report.index', $this->data);
    }

    function participantSubmittedForms(Request $request) {

        $participant_id = request()->segment(3);

        $submitted_forms = DB::table('tbl_survey_form_info')
                        ->join('tbl_survey_form', 'tbl_survey_form.id', '=', 'tbl_survey_form_info.form_id')
                        ->select('tbl_survey_form_info.form_id', 'tbl_survey_form_info.participant_id', 'tbl_survey_form.survey_form_title', 'tbl_survey_form_info.token', 'tbl_survey_form_info.created_at')
                        ->where('tbl_survey_form_info.participant_id', $participant_id)
                        ->where('tbl_survey_form_info.status', 1)
                        ->groupBy('tbl_survey_form_info.token')
                        ->get()->toArray();

        $submitted_forms_checkbox = DB::table('tbl_survey_form_info_checkbox_ans')
                        ->join('tbl_survey_form', 'tbl_survey_form.id', '=', 'tbl_survey_form_info_checkbox_ans.form_id')
                        ->select('tbl_survey_form_info_checkbox_ans.form_id', 'tbl_survey_form.survey_form_title', 'tbl_survey_form_info_checkbox_ans.participant_id', 'tbl_survey_form_info_checkbox_ans.token', 'tbl_survey_form_info_checkbox_ans.created_at')
                        ->where('tbl_survey_form_info_checkbox_ans.participant_id', $participant_id)
                        ->groupBy('tbl_survey_form_info_checkbox_ans.token')
                        ->get()->toArray();


        $fullData = array_merge($submitted_forms, $submitted_forms_checkbox);


        $this->data['participant_id'] = $participant_id;
        $this->data['survey_form'] = $fullData;

        return view('admin.participant.choose_form', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->data['menu_type'] = 1;
        $survey_form = DB::table('tbl_survey_form')
                ->select('*')
                ->where('is_deleted', 0)
                ->get();

        $this->data['survey_form'] = $survey_form;

        $type = DB::table('tbl_types')
        ->select('*')
        ->where('is_deleted', 0)
        ->get();
        $this->data['type'] = $type;
                
        $group = DB::table('tbl_groups')
        ->select('*')
        ->where('is_deleted', 0)
        ->get();
        $this->data['group'] = $group;

        $category = DB::table('tbl_categories')
        ->select('*')
        ->where('is_deleted', 0)
        ->get();
        $this->data['category'] = $category;

        $user = DB::table('users')
                ->select('*')
                ->get();
        $this->data['user'] = $user;

        return view('admin.report.create_kpi_report_form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyKpiRequest $request) {

        try{
            $kpi = new SurveyKpi;
            $kpi->form_id = $request->input('survey_form');
            $kpi->kpi_name = $request->input('kpi_name');
            $kpi->minimum_value = 0;
            $kpi->maximum_value = $request->input('maximum_value');
            $kpi->question_id = $request->input('selected_questions');
            $kpi->type_id = $request->input('type_id');
            $kpi->group_id = $request->input('group_id');
            $kpi->category_id = $request->input('category_id');
            $kpi->sub_category_id = $request->input('sub_category_id');
            $kpi->user_data = $request->input('user_data');

            if ($kpi->save()) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.kpi').' '.__('message.created').' '.__('message.successfully'));
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', __('message.kpi').' '.__('message.not').' '.__('message.found'));
                $request->session()->flash('kpi', $kpi);
            }
            return redirect()->back();
        }catch(\Exception $e){
             $request->session()->flash('message.level', 'danger');
             $request->session()->flash('message.content', __('message.internal_error'));
              return redirect()->back();
        }
        
    }

    function getSurveyFormDetails(Request $request) {

        $html = '';
        $id = $request->input('form_id');
        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $id])
                ->get();

        $this->data['survey_form_header'] = $survey_form_data;

        // $type = DB::table('tbl_types')
        // ->select('*')
        // ->where('is_deleted', 0)
        // ->get();

        // $this->data['type_id'] = $type;

        $survey_question_data = DB::table('tbl_survey_form')
                ->join('tbl_survey_question', 'tbl_survey_question.survey_form_id', '=', 'tbl_survey_form.id')
                ->select('tbl_survey_question.survey_form_id', 'tbl_survey_form.id', 'tbl_survey_form.survey_form_logo', 'tbl_survey_form.survey_form_header', 'tbl_survey_form.survey_form_footer','tbl_survey_question.question_type')
                ->where('tbl_survey_form.is_deleted', 0)
                ->where('tbl_survey_question.survey_form_id', $id)
                ->where('tbl_survey_question.question_type', 5)
                ->first();


        if (empty($survey_question_data)) {
            $html .= '<div class="modal-body">
                        <div style="padding-left:10%;">
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="col-md-10" style="background-color: #fff;
                                    padding: 2% 4%;border-radius: 2%;margin-top: 1%;margin-left: 1%;float: left;width: 100%;border: 1px solid #639; border-radius: 0px;box-shadow: 2px 2px 0px rgb(102, 51, 153);">
                                        <p>Please complete question and options information first.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {

            $survey_form_link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($id) . '/4554556564564';

            $question = 1;
            $html .= '<div class="modal-body">
                            <div style="padding-left:10%;">
                                <div class="portlet-body form">
                                    <div class="form-body">';
                                        foreach ($survey_form_data as $s) {
                                            foreach ($s->survey_questions as $survey_form) {

                                                $html .= '<div class="col-md-10" style="background-color: #fff;
                                                    padding: 2% 4%;border-radius: 2%;margin-top: 1%;margin-left: 1%;float: left;width: 100%;border: 1px solid #639; border-radius: 0px;box-shadow: 2px 2px 0px rgb(102, 51, 153);">';
                                                if (($survey_form->question_type != 3) && ($survey_form->question_type != 4)) {
                                                    
                                                    $html .= '<div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label"> <strong>' . $question . ' &nbsp;&nbsp;&nbsp;</strong>' . $survey_form->survey_question . ' </label> 
                                                                    <label  class="checkbox checkbox-primary float-right">
                                                                        <input onchange="getSelectedQuestionMaxValue(' . $survey_form->id . ', this)" type="checkbox" style="width:25px;height:25px;float:right;"/>
                                                                        <span class="checkmark"></span>
                                                                    </label>';
                                                    $html .= '</div>';
                                                }
                                                if ($survey_form->question_type == 1) {
                                                    $html .= '<div class="option_val form-group">
                                                                    <div class="radio-list">';
                                                                    foreach ($survey_form->question_options as $survey_option) {
                                                                        //                            $html .= '<input name="optionsRadios" id="optionsRadios' . $survey_option->id . '" type="radio"> ' . $survey_option->survey_option_title . ' (' . $survey_option->option_point . ') <br>';
                                                                        $html .= $survey_option->survey_option_title . ' (' . $survey_option->option_point . ') <br>';
                                                                    }
                                                            $html .= '</div>
                                                                </div>';
                                                }

                                                if ($survey_form->question_type == 2) {
                                                    $html .= '<div class="option_val form-group">
                                                                    <div class="checkbox-list">';
                                                                    foreach ($survey_form->question_options as $survey_option) {
                                                                    //                            $html .= '<input type="checkbox" name="checkbox[]"> ' . $survey_option->survey_option_title . ' (' . $survey_option->option_point . ') <br>';
                                                                        $html .= $survey_option->survey_option_title . ' (' . $survey_option->option_point . ') <br>';
                                                                    }
                                                        $html .= '</div>
                                                            </div>';
                                                }

                                                if ($survey_form->question_type == 5) {

                                                    $html .= '<div class="option_val form-group">
                                                                    <div class="checkbox-list">';
                                                                    $html .= '*****';
                                                            $html .= '</div>
                                                            </div>';
                                                }

                                                $question++;
                                                $html .= '</div>';
                                            }
                                        }
            $html .= '</div></div></div></div>';

        }

        echo json_encode($html);
        die();
    }

    function getKpiReports(Request $request) {
        $survey_form = DB::table('tbl_survey_form')
                ->select('*')
                ->where('is_deleted', 0)
                ->get();
        $this->data['survey_form'] = $survey_form;

        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $time_filter =  array('today'=>__('message.today'),'yesterday'=>__('message.yesterday'),'last_14_day'=>__('message.last_14_day') ,'this_week'=>__('message.this_week'),'last_week'=>__('message.last_week'),'this_month'=>__('message.this_month'),'last_month'=>__('message.last_month'),'this_year'=>__('message.this_year'),'last_year'=>__('message.last_year'),'specific_date'=>__('message.specific_date'));
        $time_period = $request->get('time_period');
        

        $this->data['created_from'] = $request->get('created_from');
        $this->data['created_to'] = $request->get('created_to');
        $this->data['time_period'] = $time_period;
        $this->data['time_filter'] = $time_filter;
        
        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['user_data'] = User::pluck('name','id');
        $this->data['user_name'] = User::get();
        $this->data['subCategory'] = Category::Select('id', 'category_name')->where('is_deleted', 0)->get();

        


        return view('admin.report.guage_chart_kpi_report', $this->data);
    }

    function getKpiReportDetails(Request $request) {

        $id = $request->input('form_id');
        $data = Auth::user();
        $user = $data->id;

        $survey_form = DB::table('tbl_kpi')
                ->join('users','tbl_kpi.user_data','=','users.id')
                // ->join('tbl_participants','users.id','=','tbl_participants.user_id')
                // ->join('tbl_survey_count','tbl_participants.id','=','tbl_survey_count.participant_id')
                ->leftjoin('tbl_types', 'tbl_kpi.type_id', '=', 'tbl_types.id')
                ->leftjoin('tbl_groups', 'tbl_kpi.group_id', '=', 'tbl_groups.id')
                ->leftjoin('tbl_categories', 'tbl_kpi.category_id', '=', 'tbl_categories.id')
                ->select('tbl_kpi.*', 'users.name','tbl_types.type_name','tbl_groups.group_name','tbl_categories.category_name','users.id as user_id')
                ->where('tbl_kpi.form_id', $id)
                ->where('tbl_kpi.status', 0)
                // ->where('tbl_survey_count.is_submitted_send', 1)
                ->get();
        $totalCountArr = array();
        $totalCountSurvey  = 0;
        $totalCountS = 0;
        foreach ($survey_form as $row) {
            
            $tmpQCount = 0;
            $tmpOptionTotal = 0;
            $tmpOptionCount = 0;
            $temStarSum = 0;
            $temRadioSum = 0;
            $temCheckSum = 0;
            $tempSendSum = 0;
            $tempRespSum = 0;

            $join_ids = explode(',', $row->question_id);
            foreach ($join_ids as $row_q) {

                $tmpQCount ++;

                // $result_star_sum = DB::table('tbl_survey_form_info')
                //         ->select(DB::raw('count(start_rating_answer) AS star_count'), (DB::raw('sum(start_rating_answer) AS star_sum')))
                //         ->where('form_id', $id)
                //         ->where('question_id', $row)
                //         ->where('question_type', '=', 5)
                //         ->where('status', 1)
                //         ->first();

                // $result_radio_sum = DB::table('tbl_survey_form_info')
                //         ->select(DB::raw('count(option_value) AS radio_count'), (DB::raw('sum(option_value) AS radio_sum')))
                //         ->where('form_id', $id)
                //         ->where('question_id', $row)
                //         ->where('question_type', '=', 1)
                //         ->where('status', 1)
                //         ->first();

                // $result_check_sum = DB::table('tbl_survey_form_info_checkbox_ans')
                //         ->select(DB::raw('count(option_point) AS check_count'), (DB::raw('sum(option_point) AS check_sum')))
                //         ->where('form_id', $id)
                //         ->where('question_id', $row)
                //         ->first();
                $type = DB::table('tbl_kpi')
                        ->join('tbl_types', 'tbl_kpi.type_id', '=', 'tbl_types.id')
                        ->select('tbl_types.type_name')
                        ->first();
                        
                        
                        
                        
                        
                        //18/09/2018
                        
                        foreach($survey_form as $key=>$value)
                                    {
                                        $sent = 0;
                                        $response = 0;

                                         if($value->user_data != null) {  

                                            $result_sent_sum = DB::table('tbl_survey_count')
                                                                ->where('form_id', $id)
                                                                ->where('user_id', $value->user_data)
                                                                ->get();
                                                                
                                            foreach ($result_sent_sum as $keys => $values) {
                                                if ($values->is_submitted_send == 2) {
                                                    // sent
                                                     $response +=  1;
                                                }
                                                    // response
                                                    $sent +=  1;
                                            }
                                            $value->sent = $sent;
                                            $value->response = $response;  
                                        }else
                                        {
                                            $value->sent = 0;
                                            $value->response = 0;  
                                        }
                                    }
                                    
                                    //end 
                                    //20/09/2018
                                    $result_star_sum = DB::table('tbl_survey_form_info')

                        ->leftJoin('tbl_participants', function($result_star_sum) use ($row) {

                            $result_star_sum->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');

                             if ($row->category_id != 0 && $row->category_id != null) {
                              $result_star_sum =  $result_star_sum->on('category_id', DB::raw($row->category_id ));
                            }
                            if ($row->group_id != 0 && $row->group_id != null) {
                               $result_star_sum =  $result_star_sum->on('group_id', DB::raw($row->group_id));
                            }
                            if ($row->type_id != 0 && $row->type_id != null) {
                               $result_star_sum =  $result_star_sum->on('type_id', DB::raw($row->type_id));
                            }
                        
                        })
                        // ->where('tbl_participants.category_id','=',$row->category_id)
                        // ->where('tbl_participants.type_id','=',$value->type_id)
                        ->where('tbl_survey_form_info.form_id', $id)
                        ->where('tbl_survey_form_info.question_id', $row_q)
                        ->where('tbl_survey_form_info.question_type', '=', 5)
                        ->where('tbl_survey_form_info.status', 1)
                        ->where('tbl_participants.user_id','=',$row->user_id);
                        // ->select('tbl_survey_form_info.*');

                        if ($row->category_id != 0 && $row->category_id != null) {
                        $result_star_sum =  $result_star_sum->where('tbl_participants.category_id','=',$row->category_id);
                             }
                        if ($row->group_id != 0 && $row->group_id != null) {
                        $result_star_sum =  $result_star_sum->where('tbl_participants.group_id','=',$row->group_id);
                         }
                         if ($row->type_id != 0 && $row->type_id != null) {
                        $result_star_sum =  $result_star_sum->where('tbl_participants.type_id','=',$row->type_id);
                         }
                $result_star_sum = $result_star_sum->first([DB::raw('count(start_rating_answer) AS star_count'), (DB::raw('sum(start_rating_answer) AS star_sum'))]);
                

               $result_radio_sum = DB::table('tbl_survey_form_info')
                        ->leftJoin('tbl_participants', function($result_radio_sum) use ($row) {

                            $result_radio_sum->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');

                            if ($row->category_id != 0  && $row->category_id != null) {
                                $result_radio_sum->on('category_id', DB::raw($row->category_id ));
                            }
                            if ($row->group_id != 0 && $row->group_id != null) {
                                $result_radio_sum->on('group_id', DB::raw($row->group_id));
                            }
                            if ($row->type_id != 0 && $row->type_id != null) {
                                $result_radio_sum->on('type_id', DB::raw($row->type_id));
                            }
                        })
                        ->where('tbl_survey_form_info.form_id', $id)
                        ->where('tbl_survey_form_info.question_id', $row_q)
                        ->where('tbl_survey_form_info.question_type', '=', 1)
                        ->where('tbl_survey_form_info.status', 1)   
                        ->where('tbl_participants.user_id','=',$row->user_id);
                        if ($row->category_id != 0 && $row->category_id != null) {
                        $result_radio_sum =  $result_radio_sum->where('tbl_participants.category_id','=',$row->category_id);
                             }
                        if ($row->group_id != 0 && $row->group_id != null) {
                        $result_radio_sum =  $result_radio_sum->where('tbl_participants.group_id','=',$row->group_id);
                         }
                         if ($row->type_id != 0 && $row->type_id != null) {
                        $result_radio_sum =  $result_radio_sum->where('tbl_participants.type_id','=',$row->type_id);
                         }

                     $result_radio_sum = $result_radio_sum->first([DB::raw('count(option_value) AS radio_count'), (DB::raw('sum(option_value) AS radio_sum'))]);
                     $result_check_sum = DB::table('tbl_survey_form_info_checkbox_ans')
                        ->leftJoin('tbl_participants', function($result_check_sum) use ($row) {

                            $result_check_sum->on('tbl_survey_form_info_checkbox_ans.participant_id', '=', 'tbl_participants.id');
                            if ($row->category_id != 0 && $row->category_id != null) {
                                $result_check_sum->on('category_id', DB::raw($row->category_id ));
                            }
                            if ($row->group_id != 0 && $row->group_id != null) {
                                $result_check_sum->on('group_id', DB::raw($row->group_id));
                            }
                            if ($row->type_id != 0 && $row->type_id != null) {
                                $result_check_sum->on('type_id', DB::raw($row->type_id));
                            }
                        })
                        ->where('tbl_survey_form_info_checkbox_ans.form_id', $id)
                        ->where('tbl_survey_form_info_checkbox_ans.question_id', $row_q)
                        ->where('tbl_participants.user_id','=',$row->user_id);

                        if ($row->category_id != 0 && $row->category_id != null) {
                        $result_check_sum =  $result_check_sum->where('tbl_participants.category_id','=',$row->category_id);
                             }
                        if ($row->group_id != 0 && $row->group_id != null) {
                        $result_check_sum =  $result_check_sum->where('tbl_participants.group_id','=',$row->group_id);
                         }
                         if ($row->type_id != 0 && $row->type_id != null) {
                        $result_check_sum =  $result_check_sum->where('tbl_participants.type_id','=',$row->type_id);
                         }
                $result_check_sum = $result_check_sum->first([DB::raw('count(option_point) AS check_count'), (DB::raw('sum(option_point) AS check_sum'))]);
                        //END 20/09/2018
                $result_response_sum = DB::table('tbl_survey_count')
                        ->select('*')
                        ->where('user_id',$user)
                        ->where('form_id', $id)
                        ->where('is_submitted_send',2)
                        ->get();

                $temStarSum += $result_star_sum->star_sum;
                $temRadioSum += $result_radio_sum->radio_sum;
                $temCheckSum += $result_check_sum->check_sum;
                $tempSendSum = count($result_sent_sum);
                $tempRespSum = count($result_response_sum);
                $typeName =$type;

      
                

                
                
                $tmpOptionCount = $tmpOptionCount + $result_star_sum->star_count + $result_radio_sum->radio_count + $result_check_sum->check_count;
                $tmpOptionTotal = $tmpOptionTotal + $result_star_sum->star_sum + $result_radio_sum->radio_sum + $result_check_sum->check_sum;
            }

            $avg = $tmpOptionTotal;
            if ($tmpOptionCount > 0) {
                $avg = ($tmpOptionTotal / $tmpOptionCount);
            }

            $totalCountArr[] = array('avg' => round($avg, 2), 'totle_kpi_count' => $tmpOptionTotal, 'star_sum' => !empty($temStarSum) ? $temStarSum : '0', 'radio_sum' => !empty($temRadioSum) ? $temRadioSum : '0', 'check_sum' => !empty($temCheckSum) ? $temCheckSum : '0', 'sent_value' => !empty($tempSendSum) ? $tempSendSum : '0' , 'resp_value' => !empty($tempRespSum) ? $tempRespSum : '0' , 'type_name' => !empty($typeName) ? $typeName : '');
            
        }
        
        foreach ($survey_form as $key => $value) {
            if($value->response == 0 ){
                $totalCountArr[$key]['avg'] = 0;
            }
        }
        $this->data['survey_form'] = $survey_form;
        $this->data['final_value'] = $totalCountArr;

        // $this->data['sent_value'] = $tempSendSum;
        // $this->data['resp_value'] = $tempRespSum;

        echo json_encode($this->data);
        die();
    }

    function getSurveyReportKpi(Request $request) {
        // dd($request);
        //old code 06/09/2018 
        // $id = $request->input('survey_form_id');
        // $survey_form = DB::table('tbl_kpi')
        //         ->select('*')
        //         ->where('form_id', $id)
        //         ->where('status', 0)
        //         ->get();


        // $columns = array('question_id');
        // $from = $request->get('created_from');
        // $to = $request->get('created_to');

        $id = $request->input('survey_form_id');
        $user_id = $request->input('user_data');
        $type = $request->input('type_id');
        $group = $request->input('group_id');
        $category = $request->input('category_id');
        $sub_category = $request->input('sub_category_id');
        $survey_form = DB::table('tbl_kpi')
                ->select('*')
                ->where('form_id', $id)
                ->where('status', 0);
        
        if($user_id != 0) {
            $survey_form =  $survey_form->where('user_data',$user_id);
        }
        if($type != 0){
            $survey_form =  $survey_form->where('type_id', $type);
        }
        if($group != 0 ){
            $survey_form =  $survey_form->where('group_id', $group);
        }
        if($category != 0){
            $survey_form =  $survey_form->where('category_id', $category);
        }
        if($sub_category != 0){
            $survey_form =  $survey_form->where('sub_category_id', $sub_category);
        }
        $time_period = $request->get('time_period');
            $created_from = $request->get('created_from');
            $created_to = $request->get('created_to');
        if($request->get('time_period') != null){
            
            if($time_period == 'specific_date') {
                if(($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')){
                    $created_from = date('Y-m-d', strtotime($created_from));
                    $created_to = date('Y-m-d', strtotime($created_to));
                    $survey_form = $survey_form->whereBetween("created_at",[$created_from,$created_to]);
                }
            }elseif($time_period == 'today') {
                $survey_form = $survey_form->whereDate('created_at', Carbon::now()->format('Y/m/d'));                
            }elseif ($time_period == 'yesterday'){
                $survey_form = $survey_form->whereDate('created_at','=', Carbon::yesterday()->format('Y-m-d'));
            }elseif ($time_period == 'last_14_day'){
                $survey_form = $survey_form->whereDate('created_at','>=', Carbon::now()->subDays(14)->toDateTimeString());
                
            }elseif ($time_period == 'this_week'){
                $start = Carbon::now()->startOfWeek();
                $end =  Carbon::now()->endOfWeek();
                $survey_form = $survey_form->whereRaw(" Date(created_at) between '$start' and '$end'");
                
            }elseif ($time_period == 'last_week'){
                $start = Carbon::now()->startOfWeek()->subDays(7);
                $end =  Carbon::now()->startOfWeek();
                $survey_form = $survey_form->whereRaw(" Date(created_at) between '$start' and '$end'");
                
            }elseif ($time_period == 'this_month'){
                $survey_form = $survey_form->whereDate('created_at','>=', Carbon::now()->startOfMonth()->toDateTimeString());
                
            }elseif ($time_period == 'last_month'){
                $start = Carbon::now()->startOfMonth()->subMonth()->startOfMonth()->toDateString();
                $end = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString();
                $survey_form = $survey_form->whereRaw(" Date(created_at) between '$start' and '$end'");
                
            }elseif ($time_period == 'this_year'){
                $survey_form = $survey_form->whereYear('created_at','>=',date('Y'));
                // dd($survey_form->get());
            }elseif ($time_period == 'last_year'){
                $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                $end = Carbon::now()->startOfYear()->toDateString();
                $survey_form = $survey_form->whereRaw(" Date(created_at) between '$start' and '$end'");
            }else{
                // if(strlen($years) == 2){
                //     $new = $new->whereYear('created_at','>=',date('Y'));
                //     $in_progress = $in_progress->whereYear('created_at','>=',date('Y'));
                //     $resolved = $resolved->whereYear('created_at','>=',date('Y'));
                //     $late = $late->whereYear('created_at','>=',date('Y'));
                // }else{
                //     $new = $new;
                //     $in_progress = $in_progress;
                //     $resolved = $resolved;
                //     $late = $late;
                // }
            }

        }
    
        $survey_form = $survey_form->get();
        $columns = array('question_id');
        $from = date('Y-m-d', strtotime($created_from));
        $to = date('Y-m-d', strtotime($created_to));
        $totalCountArr = array();


        foreach ($survey_form as $row) {
            $tmpQCount = 0;
            $tmpOptionTotal = 0;
            $tmpOptionCount = 0;

            $temStarSum = 0;
            $temRadioSum = 0;
            $temCheckSum = 0;

            $join_ids = explode(',', $row->question_id);
            foreach ($join_ids as $row) {

                $tmpQCount ++;
                //this section is for response 
                foreach($survey_form as $key=>$value)
                {
                    $sent = 0;
                    $response = 0;

                     if($value->user_data != null) {  

                        $result_sent_sum = DB::table('tbl_survey_count')
                                            ->where('form_id', $id)
                                            ->where('user_id', $value->user_data)
                                            ->get();
                                            
                        foreach ($result_sent_sum as $keys => $values) {
                            if ($values->is_submitted_send == 2) {
                                // sent
                                 $response +=  1;
                            }
                                // response
                                $sent +=  1;
                        }
                        $value->sent = $sent;
                        $value->response = $response;  
                    }else
                    {
                        $value->sent = 0;
                        $value->response = 0;  
                    }
                }
                //end
                //start 
                $result_star_sum = DB::table('tbl_survey_form_info')
                        ->leftJoin('tbl_participants', function($result_star_sum) use ($request) {

                            $result_star_sum->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');
                            if (!empty($request->get('category_id'))) {
                                $result_star_sum->on('category_id', DB::raw($request->get('category_id')));
                            }
                            if (!empty($request->get('sub_category_id'))) {
                                $result_star_sum->on('sub_category_id', DB::raw($request->get('sub_category_id')));
                            }
                            if (!empty($request->get('group_id'))) {
                                $result_star_sum->on('group_id', DB::raw($request->get('group_id')));
                            }
                            if (!empty($request->get('type_id'))) {
                                $result_star_sum->on('type_id', DB::raw($request->get('type_id')));
                            }
                        })
                        ->where('tbl_survey_form_info.form_id', $id)
                        ->where('tbl_survey_form_info.question_id', $row)
                        ->where('tbl_survey_form_info.question_type', '=', 5)
                        ->where('tbl_survey_form_info.status', 1);
                if ($request->get('created_from') && $request->get('created_to')) {
                    $result_star_sum = $result_star_sum->whereRaw(" Date(tbl_survey_form_info.created_at) between '$from' and '$to'");
                }
//                $result_star_sum->select(DB::raw('count(start_rating_answer) AS star_count'), (DB::raw('sum(start_rating_answer) AS star_sum')), 'question_id')
//                        ->first();
                $result_star_sum = $result_star_sum->first([DB::raw('count(start_rating_answer) AS star_count'), (DB::raw('sum(start_rating_answer) AS star_sum'))]);


                //radio
                $result_radio_sum = DB::table('tbl_survey_form_info')
                        ->leftJoin('tbl_participants', function($result_radio_sum) use ($request) {

                            $result_radio_sum->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');
                            if (!empty($request->get('category_id'))) {
                                $result_radio_sum->on('category_id', DB::raw($request->get('category_id')));
                            }
                            if (!empty($request->get('sub_category_id'))) {
                                $result_radio_sum->on('sub_category_id', DB::raw($request->get('sub_category_id')));
                            }
                            if (!empty($request->get('group_id'))) {
                                $result_radio_sum->on('group_id', DB::raw($request->get('group_id')));
                            }
                            if (!empty($request->get('type_id'))) {
                                $result_radio_sum->on('type_id', DB::raw($request->get('type_id')));
                            }
                        })
                        ->where('tbl_survey_form_info.form_id', $id)
                        ->where('tbl_survey_form_info.question_id', $row)
                        ->where('tbl_survey_form_info.question_type', '=', 1)
                        ->where('tbl_survey_form_info.status', 1);
                if ($request->get('created_from') && $request->get('created_to')) {
                    $result_radio_sum = $result_radio_sum->whereRaw(" Date(tbl_survey_form_info.created_at) between '$from' and '$to'");
                }
//                $result_radio_sum->select(DB::raw('count(option_value) AS radio_count'), (DB::raw('sum(option_value) AS radio_sum')))
                //->first();
                $result_radio_sum = $result_radio_sum->first([DB::raw('count(option_value) AS radio_count'), (DB::raw('sum(option_value) AS radio_sum'))]);


                //checkbox

                $result_check_sum = DB::table('tbl_survey_form_info_checkbox_ans')
                        ->leftJoin('tbl_participants', function($result_check_sum) use ($request) {

                            $result_check_sum->on('tbl_survey_form_info_checkbox_ans.participant_id', '=', 'tbl_participants.id');
                            if (!empty($request->get('category_id'))) {
                                $result_check_sum->on('category_id', DB::raw($request->get('category_id')));
                            }
                            if (!empty($request->get('sub_category_id'))) {
                                $result_check_sum->on('sub_category_id', DB::raw($request->get('sub_category_id')));
                            }
                            if (!empty($request->get('group_id'))) {
                                $result_check_sum->on('group_id', DB::raw($request->get('group_id')));
                            }
                            if (!empty($request->get('type_id'))) {
                                $result_check_sum->on('type_id', DB::raw($request->get('type_id')));
                            }
                        })
                        ->where('tbl_survey_form_info_checkbox_ans.form_id', $id)
                        ->where('tbl_survey_form_info_checkbox_ans.question_id', $row);
                if ($request->get('created_from') && $request->get('created_to')) {
                    $result_check_sum = $result_check_sum->whereRaw(" Date(tbl_survey_form_info_checkbox_ans.created_at) between '$from' and '$to'");
                }
//                $result_check_sum->select(DB::raw('count(option_point) AS check_count'), (DB::raw('sum(option_point) AS check_sum')))

                $result_check_sum = $result_check_sum->first([DB::raw('count(option_point) AS check_count'), (DB::raw('sum(option_point) AS check_sum'))]);


                $temStarSum += $result_star_sum->star_sum;
                $temRadioSum += $result_radio_sum->radio_sum;
                $temCheckSum += $result_check_sum->check_sum;

                $tmpOptionCount = $tmpOptionCount + $result_star_sum->star_count + $result_radio_sum->radio_count + $result_check_sum->check_count;
                $tmpOptionTotal = $tmpOptionTotal + $result_star_sum->star_sum + $result_radio_sum->radio_sum + $result_check_sum->check_sum;
            }

            $avg = $tmpOptionTotal;
            if ($tmpOptionCount > 0) {
                $avg = ($tmpOptionTotal / $tmpOptionCount);
            }

            $totalCountArr[] = array('avg' => round($avg, 2), 'totle_kpi_count' => $tmpOptionTotal, 'star_sum' => !empty($temStarSum) ? $temStarSum : '0', 'radio_sum' => !empty($temRadioSum) ? $temRadioSum : '0', 'check_sum' => !empty($temCheckSum) ? $temCheckSum : '0');
        }
        $this->data['survey_form'] = $survey_form;
        $this->data['final_value'] = $totalCountArr;


        echo json_encode($this->data);
        die();
    }

    function getSurveyQuestionOptionHighestValue(Request $request) {
        $questionId = $request->input('question_id');
        $points = '';

        $questionType = DB::table('tbl_survey_question')
                ->select('question_type')
                ->where('id', $questionId)
                ->first();

        $type = $questionType->question_type;
        if ($type == 5) {
            $points = "5";
        } else {
            $optionPoints = DB::table('tbl_survey_options')
                    ->select('option_point')
                    ->where('question_id', $questionId)
                    ->orderBy('option_point', 'desc')
                    ->limit('1')
                    ->first();

            $points = $optionPoints->option_point;
        }
        echo json_encode($points);
        die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $key) {
        
//        $id = $this->_decrypt($key);
        
        $id = $key;
        
        $this->data['form_survey_id'] = $id;

        $this->data['menu_type'] = 1;

        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $id])
                ->get();
        $this->data['survey_form_data'] = $survey_form_data;

        $survey_information = DB::table('tbl_survey_form_info')
                ->select('*')
                ->where('form_id', $id)
                ->get();
                //dd($survey_information);
        $time_filter =  array('today'=>__('message.today'),'yesterday'=>__('message.yesterday'),'last_14_day'=>__('message.last_14_day') ,'this_week'=>__('message.this_week'),'last_week'=>__('message.last_week'),'this_month'=>__('message.this_month'),'last_month'=>__('message.last_month'),'this_year'=>__('message.this_year'),'last_year'=>__('message.last_year'),'specific_date'=>__('message.specific_date'));
        $time_period = $request->get('time_period');

        $this->data['created_from'] = $request->get('created_from');
        $this->data['created_to'] = $request->get('created_to');
        $this->data['time_period'] = $time_period;
        $this->data['time_filter'] = $time_filter;

        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();

        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['sub_category_id'] = $request->get('sub_category_id');
        $this->data['user_name'] = User::get();
        $this->data['subCategory'] = Category::Select('id', 'category_name')->where('is_deleted', 0)->get();

        $response = DB::table('tbl_survey_count')
                    ->where('form_id', $id)
                    ->where('user_id', Auth::id())
                    ->where('is_submitted_send',2)
                    ->count();
        $sent = DB::table('tbl_survey_count')
                    ->where('form_id', $id)
                    ->where('user_id', Auth::id())
                    ->where('is_submitted_send',1)
                    ->count();            
        $this->data['response'] = $response;
        $this->data['sent'] = $sent;

        if (count($survey_information) > 0) {
            //return view('admin.report.default_pie_chart_report', $this->data);
            if ($request->session()->get('select_chart_type') == 2) {
                //For bar chart
                return view('admin.report.bart_chart_report', $this->data);
            } else {
                //For pie chart
                return view('admin.report.default_pie_chart_report', $this->data);
            }
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'This form not submitted by user, thats why can not display survey report.');
//            return redirect()->route('surveyform.index');
            return redirect()->route('report.index');
        }
    }

    public function getQuestionAnswers(Request $request, $formId) {
        //to create database for quesiton and given answers for text field
        $this->data['page_title'] = "Question & Answers";

        if (!$request->ajax()) {
            return view('admin.report.default_pie_chart_report', $this->data);
        }

        $from = $request->session()->get('created_from');
        $to = $request->session()->get('created_to');

        DB::statement(DB::raw('set @rownum=0'));
        $result_data = DB::table('tbl_survey_form_info')
                ->join('tbl_participants', function($result_data) use ($request, $from, $to) {

                    $result_data->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');
                    if (!empty($request->session()->get('category_id'))) {
                        $result_data->on('category_id', DB::raw($request->session()->get('category_id')));
                    }
                    if (!empty($request->session()->get('sub_category_id'))) {
                        $result_data->on('sub_category_id', DB::raw($request->session()->get('sub_category_id')));
                    }
                    if (!empty($request->session()->get('group_id'))) {
                        $result_data->on('group_id', DB::raw($request->session()->get('group_id')));
                    }
                    if (!empty($request->session()->get('type_id'))) {
                        $result_data->on('type_id', DB::raw($request->session()->get('type_id')));
                    }
                    if ($request->session()->get('created_from') && $request->session()->get('created_to')) {
                        $result_data = $result_data->whereRaw(" Date(tbl_survey_form_info.created_at) between '$from' and '$to'");
                    }
                })
                ->where('tbl_survey_form_info.form_id', $formId)
                ->where(function($result_data) {
                    $result_data->where('tbl_survey_form_info.question_type', 3);
                    $result_data->orWhere('tbl_survey_form_info.question_type', 4);
                })
                ->where('tbl_survey_form_info.status', 1)
                ->select('tbl_survey_form_info.*', 'tbl_participants.first_name', 'tbl_participants.last_name', 'tbl_participants.mobile', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->orderBy('tbl_survey_form_info.question_id', 'asc')
                ->get();

        $session_array = array(
            "category_id" => $request->session()->get('category_id'),
            "sub_category_id" => $request->session()->get('sub_category_id'),
            "group_id" => $request->session()->get('group_id'),
            "type_id" => $request->session()->get('type_id'),
            "created_from" => $request->session()->get('created_from'),
            "created_to" => $request->session()->get('created_to'),
            "select_chart_type" => $request->session()->get('select_chart_type'),
            "select_chart_by" => $request->session()->get('select_chart_by'),
            "user_data" => $request->session()->get('user_data')
        );

        if ($request->session()->has('category_id')) {
            \Session::forget($session_array);
        }


        $base_path = $this->data['base_path'];
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

    public function getParticipantQuestionAnswers(Request $request, $parti_id) {
        //to create database for quesiton and given answers for text field
        $this->data['page_title'] = "Question & Answers";

        if (!$request->ajax()) {
            return view('admin.report.default_pie_chart_report', $this->data);
        }

        $from = $request->session()->get('created_from');
        $to = $request->session()->get('created_to');

        DB::statement(DB::raw('set @rownum=0'));
        $result_data = DB::table('tbl_survey_form_info')
                ->join('tbl_participants', function($result_data) use ($request, $from, $to) {

                    $result_data->on('tbl_survey_form_info.participant_id', '=', 'tbl_participants.id');
                    if (!empty($request->session()->get('category_id'))) {
                        $result_data->on('category_id', DB::raw($request->session()->get('category_id')));
                    }
                    if (!empty($request->session()->get('sub_category_id'))) {
                        $result_data->on('sub_category_id', DB::raw($request->session()->get('sub_category_id')));
                    }
                    if (!empty($request->session()->get('group_id'))) {
                        $result_data->on('group_id', DB::raw($request->session()->get('group_id')));
                    }
                    if (!empty($request->session()->get('type_id'))) {
                        $result_data->on('type_id', DB::raw($request->session()->get('type_id')));
                    }
                    if ($request->session()->get('created_from') && $request->session()->get('created_to')) {
                        $result_data = $result_data->whereRaw(" Date(tbl_survey_form_info.created_at) between '$from' and '$to'");
                    }
                })
                ->where('tbl_participants.id', $parti_id)
                ->where(function($result_data) use ($parti_id) {
                    $result_data->where('tbl_survey_form_info.question_type', 3);
                    $result_data->orWhere('tbl_survey_form_info.question_type', 4);
                })
                ->where('tbl_participants.status', 1)
                ->select('tbl_survey_form_info.*', 'tbl_participants.first_name', 'tbl_participants.last_name', 'tbl_participants.mobile', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->orderBy('tbl_survey_form_info.question_id', 'asc')
                ->get();

        $session_array = array(
            "category_id" => $request->session()->get('category_id'),
            "sub_category_id" => $request->session()->get('sub_category_id'),
            "group_id" => $request->session()->get('group_id'),
            "type_id" => $request->session()->get('type_id'),
            "created_from" => $request->session()->get('created_from'),
            "created_to" => $request->session()->get('created_to'),
            "select_chart_type" => $request->session()->get('select_chart_type'),
            "select_chart_by" => $request->session()->get('select_chart_by'),
            "user_data" => $request->session()->get('user_data')
        );

        if ($request->session()->has('category_id')) {
            \Session::forget($session_array);
        }



        $base_path = $this->data['base_path'];
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

    /* ========================================
     * Get data of particpiant in send maual
     */

    public function getParticipant($request) {

        $query = DB::table('tbl_participants')
                ->where('is_deleted', 0)
                ->orderBy('id', 'desc');

        if (!empty($request->session()->get('category_id'))) {
            $query->where('category_id', $request->session()->get('category_id'));
        }

        if (!empty($request->session()->get('sub_category_id'))) {
            $query->where('sub_category_id', $request->session()->get('sub_category_id'));
        }

        if (!empty($request->session()->get('group_id'))) {
            $query->where('group_id', $request->session()->get('group_id'));
        }

        if (!empty($request->session()->get('type_id'))) {
            $query->where('type_id', $request->session()->get('type_id'));
        }

        if ($request->session()->get('created_from') && $request->session()->get('created_to')) {
            $query->whereBetween('created_at', [$request->session()->get('created_from'), $request->session()->get('created_to')]);
        }

        return $query;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSurveyReport(Request $request, $key) {   
//        $id = $this->_decrypt($key);
        $id = $key;
        $this->data['form_survey_id'] = $id;
        $this->data['menu_type'] = 1;
        $session_array = array(
            "category_id" => $request->input('category_id'),
            "sub_category_id" => $request->input('sub_category_id'),
            "group_id" => $request->input('group_id'),
            "type_id" => $request->input('type_id'),
            "created_from" => $request->input('created_from'),
            "created_to" => $request->input('created_to'),
            "select_chart_type" => $request->input('select_chart_type'),
            "select_chart_by" => $request->input('select_chart_by'),
            "user_data" => $request->session()->get('user_data'),
            'time_period' => $request->get('time_period')
        );
        $request->session()->put($session_array);

        $participant_result = $this->getParticipant($request)->pluck('id');
        
        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $id])
                ->get();
        
        $this->data['survey_form_data'] = $survey_form_data;

        $survey_form = DB::table('tbl_survey_form')
                ->select('*')
                ->where('is_deleted', 0)
                ->get();
        $this->data['survey_form'] = $survey_form;

        $survey_information = DB::table('tbl_survey_form_info')
                ->select('*')
                ->where('form_id', $id)
                ->get();
//        echo '<pre>';
//        print_r($survey_information);die;

        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();

        $time_filter =  array('today'=>__('message.today'),'yesterday'=>__('message.yesterday'),'last_14_day'=>__('message.last_14_day') ,'this_week'=>__('message.this_week'),'last_week'=>__('message.last_week'),'this_month'=>__('message.this_month'),'last_month'=>__('message.last_month'),'this_year'=>__('message.this_year'),'last_year'=>__('message.last_year'),'specific_date'=>__('message.specific_date'));
        $time_period = $request->get('time_period');
        $response = DB::table('tbl_survey_count')
                    ->where('form_id', $id)
                    ->where('user_id', Auth::id())
                    ->where('is_submitted_send',2)
                    ->count();
        $sent = DB::table('tbl_survey_count')
                    ->where('form_id', $id)
                    ->where('user_id', Auth::id())
                    ->where('is_submitted_send',1)
                    ->count();            
        $this->data['response'] = $response;
        $this->data['sent'] = $sent;
        $this->data['created_from'] = $request->get('created_from');
        $this->data['created_to'] = $request->get('created_to');
        $this->data['time_period'] = $time_period;
        $this->data['time_filter'] = $time_filter;
        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['user_name'] = User::get();
        $this->data['subCategory'] = Category::Select('id', 'category_name')->where('is_deleted', 0)->get();
        $this->data['sub_category_id'] = $request->get('sub_category_id');

        $this->data['participant_id'] = $participant_result;
        if (count($survey_information) > 0) {
            if ($request->session()->get('select_chart_type') == 2) {
                //For bar chart
                return view('admin.report.bart_chart_report', $this->data);
            } else {
                //For pie chart
                return view('admin.report.default_pie_chart_report', $this->data);
            }
            if ($request->session()->get('select_chart_by') == 2) {
                //For bar chart
                return view('admin.report.bart_chart_report', $this->data);
            } else {
                //For pie chart
                return view('admin.report.default_pie_chart_report', $this->data);
            }

        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'This form not submitted by user, thats why can not display survey report.');
//            return redirect()->route('surveyform.index');
            return redirect()->route('report.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSurveyReportForParticipant(Request $request, $token) {

        $form_data = DB::table('tbl_survey_form_info')
                ->join('tbl_survey_question', 'tbl_survey_question.id', '=', 'tbl_survey_form_info.question_id')
                ->select('tbl_survey_form_info.question_id', 'tbl_survey_form_info.form_id', 'tbl_survey_form_info.question_type', 'tbl_survey_form_info.participant_id', 'tbl_survey_question.survey_question', 'tbl_survey_form_info.survey_answer', 'tbl_survey_form_info.answer', 'tbl_survey_form_info.start_rating_answer')
                ->where('tbl_survey_form_info.token', $token)
                ->where('tbl_survey_form_info.status', 1)
                ->get();
        
        $form_data_check_box = DB::table('tbl_survey_form_info_checkbox_ans')
                ->join('tbl_survey_question', 'tbl_survey_question.id', '=', 'tbl_survey_form_info_checkbox_ans.question_id')
                ->select('tbl_survey_form_info_checkbox_ans.question_id', 'tbl_survey_form_info_checkbox_ans.form_id', 'tbl_survey_form_info_checkbox_ans.participant_id', 'tbl_survey_question.survey_question', 'tbl_survey_form_info_checkbox_ans.check_box_ans')
                ->where('tbl_survey_form_info_checkbox_ans.token', $token)
                ->get();

        
        $form_details = DB::table('tbl_survey_form_info')
                ->join('tbl_survey_form', 'tbl_survey_form.id', '=', 'tbl_survey_form_info.form_id')
                ->select('tbl_survey_form.survey_form_title','tbl_survey_form.survey_form_logo','tbl_survey_form_info.created_at')
                ->where('tbl_survey_form_info.token', $token)
                ->where('tbl_survey_form_info.status', 1)
                ->orderBy('tbl_survey_form_info.id', 'asc')
                ->first();
        
        $this->data['form_data'] = $form_data;
        $this->data['form_details'] = $form_details;
        $this->data['form_data_check_box'] = $form_data_check_box;
        return view('admin.participant.show_question_answers_separately', $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterSurveyReport($key) {
        $id = $this->_decrypt($key);
        
        $this->data['menu_type'] = 1;

        $survey_form_data = Surveyform::with('survey_questions.question_options')
                ->where(['is_deleted' => 0, 'id' => $id])
                ->get();
        $this->data['survey_form_data'] = $survey_form_data;

        $survey_information = DB::table('tbl_survey_form_info')
                ->select('*')
                ->where('form_id', $id)
                ->get();
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id', 0)
                ->where('is_deleted', 0)
                ->get();
        $this->data['group'] = Group::Select('id', 'group_name')->get();
        $this->data['type'] = Type::Select('id', 'type_name')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();

        if (count($survey_information) > 0) {
            return view('admin.report.survey_report_form', $this->data);
        } else {
            \Session::flash('message.level', 'danger');
            \Session::flash('message.content', 'This form not submitted by user, so thats why can not display survey report.');
            return redirect()->route('surveyform.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function createKpiReportForm(Request $request) {
//        $this->data['menu_type'] = 1;
//        $survey_form = DB::table('tbl_survey_form')
//                ->select('*')
//                ->where('is_deleted', 0)
//                ->get();
//
//        $this->data['survey_form'] = $survey_form;
//        return view('admin.report.create_kpi_report_form', $this->data);
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSurveyForm(Request $request) {
        $form_id = $request->input('form_id');
        if ($form_id > 0) {
            $survey_form = DB::table('tbl_survey_question')
                    ->select('*')
                    ->where('survey_form_id', $form_id)
                    ->where('is_deleted', 0)
                    ->get();

            $response = array("type" => "success", "data" => $survey_form);
            echo json_encode($response);
            die;
        } else {
            $response = array("type" => "error", "message" => __('message.please').' '.__('message.select').' '.__('message.survey').' '.__('message.form'));
            echo json_encode($response);
            die;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        
    }
    public function deleteKpiReportDetails(Request $request)
    {
        $id = $request->get('id');
        DB::table('tbl_kpi')->where('id', $id)->delete();

        return response()->json([
            'message'   =>  __('message.kpi').' '.__('message.deleted').' '.__('message.successfully'),
            'success'   =>  true
        ],200);
    }
    
    //24/09/2018
    function get_Kpi_ReportDetails(Request $request) {
        $id = $request->input('form_id');

        $survey_form = DB::table('tbl_kpi')
                ->select('*')
                ->where('form_id', $id)
                ->where('status', 0)
                ->get();
        


        $totalCountArr = array();

        foreach ($survey_form as $row) {

            $tmpQCount = 0;
            $tmpOptionTotal = 0;
            $tmpOptionCount = 0;
            $temStarSum = 0;
            $temRadioSum = 0;
            $temCheckSum = 0;

            $join_ids = explode(',', $row->question_id);
            foreach ($join_ids as $row) {

                $tmpQCount ++;
                //this section is for response 
                foreach($survey_form as $key=>$value)
                {
                    $sent = 0;
                    $response = 0;

                     if($value->user_data != null) {  

                        $result_sent_sum = DB::table('tbl_survey_count')
                                            ->where('form_id', $id)
                                            ->where('user_id', $value->user_data)
                                            ->get();
                                            
                        foreach ($result_sent_sum as $keys => $values) {
                            if ($values->is_submitted_send == 2) {
                                // sent
                                 $response +=  1;
                            }
                                // response
                                $sent +=  1;
                        }
                        $value->sent = $sent;
                        $value->response = $response;  
                    }else
                    {
                        $value->sent = 0;
                        $value->response = 0;  
                    }
                }
                //end
                $result_star_sum = DB::table('tbl_survey_form_info')
                        ->select(DB::raw('count(start_rating_answer) AS star_count'), (DB::raw('sum(start_rating_answer) AS star_sum')))
                        ->where('form_id', $id)
                        ->where('question_id', $row)
                        ->where('question_type', '=', 5)
                        ->where('status', 1)
                        ->first();

                $result_radio_sum = DB::table('tbl_survey_form_info')
                        ->select(DB::raw('count(option_value) AS radio_count'), (DB::raw('sum(option_value) AS radio_sum')))
                        ->where('form_id', $id)
                        ->where('question_id', $row)
                        ->where('question_type', '=', 1)
                        ->where('status', 1)
                        ->first();

                $result_check_sum = DB::table('tbl_survey_form_info_checkbox_ans')
                        ->select(DB::raw('count(option_point) AS check_count'), (DB::raw('sum(option_point) AS check_sum')))
                        ->where('form_id', $id)
                        ->where('question_id', $row)
                        ->first();

                $temStarSum += $result_star_sum->star_sum;
                $temRadioSum += $result_radio_sum->radio_sum;
                $temCheckSum += $result_check_sum->check_sum;

                $tmpOptionCount = $tmpOptionCount + $result_star_sum->star_count + $result_radio_sum->radio_count + $result_check_sum->check_count;
                $tmpOptionTotal = $tmpOptionTotal + $result_star_sum->star_sum + $result_radio_sum->radio_sum + $result_check_sum->check_sum;
            }

            $avg = $tmpOptionTotal;
            if ($tmpOptionCount > 0) {
                $avg = ($tmpOptionTotal / $tmpOptionCount);
            }
            $totalCountArr[] = array('avg' => round($avg, 2), 'totle_kpi_count' => $tmpOptionTotal, 'star_sum' => !empty($temStarSum) ? $temStarSum : '0', 'radio_sum' => !empty($temRadioSum) ? $temRadioSum : '0', 'check_sum' => !empty($temCheckSum) ? $temCheckSum : '0');
        }

        $this->data['survey_form'] = $survey_form;
        $this->data['final_value'] = $totalCountArr;

        echo json_encode($this->data);
        die();
    }
    function get_sub_category_by_category_id(Request $request){  
        $category_id = $request->get('category_id');   
        $sub_cat_data = DB::table('tbl_categories')
                ->select('*')
                ->where('parent_id', $category_id)
                ->get();        
        return response()->json([
            'data'  =>  $sub_cat_data
        ],200);        
    }


}
