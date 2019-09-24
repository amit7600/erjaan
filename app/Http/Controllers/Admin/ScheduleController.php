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
use App\Participant;
use App\Schedule;
use App\Scheduleparticipant;
use App\Schedulereminder;
use App\EmailTemplate;
use App\SMSTemplate;
use App\Surveyform;
use App\SurveyQuestion;
use App\SurveyOption;
use Yajra\Datatables\Datatables;
use App\Package\MediaUploadLib;
use App\Package\SendEmailLib;
use App\Package\SendSMSLib;
use App\Helpers\CommonHelper;
use App\Http\Requests\SurveyFormRequest;
use DB;
use Input;
use Auth;
use App\Setting;

class ScheduleController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
    }

    protected function _encrypt($moment_id) {
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    function addScheduleManual(Request $request) {
        $login_user = Auth::user();
        $this->data['page_title'] = "Add Schedule";
        $this->data['on_behalf'] = Setting::where('setting_key','on_behalf_of')->first();

        if (!$request->ajax()) {
            $this->data['category'] = Category::Select('id', 'category_name')
                    ->where('parent_id', 0)
                    ->where('is_deleted', 0)
                    ->get();
            $this->data['group'] = Group::Select('id', 'group_name')->get();
            $this->data['type'] = Type::Select('id', 'type_name')->get();
            $this->data['country'] = Country::Select('id', 'name')->get();
            $this->data['survey_form_data'] = Surveyform::select('id', 'survey_form_title')
                    ->where(['is_deleted' => 0])
                    ->orderBy('id', 'DESC')
                    ->get();
            return view('admin.schedule.send_survey_to_participant', $this->data);
        }

        $extraData = $request->input('extraData');

        $query = $this->getDataManual($extraData);

        $survey_option_data = $query;

        $base_path = $this->data['base_path'];
        
        return Datatables::of($survey_option_data)
                        ->addColumn('action', function($row) {

                            $links = "";
                            return $links;
                        })
                        ->addColumn('checkbox', function($row) {
                            $links = 
                            "<label  class='checkbox checkbox-primary'>
                            <input type='checkbox' name='select_count' class='select-participant'/>
                            <span class='checkmark'></span> 
                            </label>";
                            return $links;
                        })
                        ->editColumn('created_at', function($row) {
                            return date('d M, Y', strtotime($row->created_at));
                        })
                        ->editColumn('updated_at', function($row) {
                            return date('d M, Y', strtotime($row->updated_at));
                        })
                        ->filterColumn('created_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->filterColumn('updated_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
                        })
                        ->rawColumns(['first_name', 'action', 'checkbox'])
                        ->make(true);
    }

    function addScheduleData(Request $request) {
        $schedule_id = $_POST['params']['schedule_id'];
        //dd($_POST['params']['scheduleDate']);
        if (!empty($schedule_id)) {
            // dd($request->all());
            $scheduleData = array(
                'fitler_select_type_id' => !empty($_POST['params']['type_id']) ? $_POST['params']['type_id'] : '',
                'filter_search_value' => !empty($_POST['params']['search_filter_value']) ? $_POST['params']['search_filter_value'] : '',
                'filter_category_id' => !empty($_POST['params']['category_id']) ? $_POST['params']['category_id'] : '',
                'filter_sub_category_id' => !empty($_POST['params']['sub_category_id']) ? $_POST['params']['sub_category_id'] : '',
                'filter_location_id' => !empty($_POST['params']['location_id']) ? $_POST['params']['location_id'] : '',
                'filter_gender' => !empty($_POST['params']['gender']) ? $_POST['params']['gender'] : '',
                'fitler_group_id' => !empty($_POST['params']['group_id']) ? $_POST['params']['group_id'] : '',
                'schedule_title' => !empty($_POST['params']['scheduleTitle']) ? $_POST['params']['scheduleTitle'] : '',
                'schedule_type' => !empty($_POST['params']['scheduleType']) ? $_POST['params']['scheduleType'] : '',
                'schedule_date' => !empty($_POST['params']['scheduleDate']) ? $_POST['params']['scheduleDate'] : '',
                'schedule_time' => !empty($_POST['params']['scheduleTime']) ? $_POST['params']['scheduleTime'] : '',
                'survey_email_sms_sending_method' => !empty($_POST['params']['email_type']) ? $_POST['params']['email_type'] : '',
                'survey_template_type' => !empty($_POST['params']['template']) ? $_POST['params']['template'] : '',
                'survey_sendto_method' => !empty($_POST['params']['on_behalf']) ? $_POST['params']['on_behalf'] : '',
                // commented by kandarp pandya 01-09-2018
                // 'survey_form_id' => !empty($_POST['params']['survey_id']) ? $_POST['params']['survey_id'] : '',
                'user_id' => !empty($_POST['params']['auth_id']) ? $_POST['params']['auth_id'] : '',
                'send_all' => !empty($_POST['params']['send_all']) ? $_POST['params']['send_all'] : '',
                // edited by kandarp pandya 29-01-2019
                'end_date' => !empty($_POST['params']['end_date']) ? $_POST['params']['end_date'] : null,
                'number_of_times' => !empty($_POST['params']['number_of_times']) ? $_POST['params']['number_of_times'] : null,
            );


            Scheduleparticipant::where('schedule_id', $schedule_id)->delete();
            
            $result = DB::table('tbl_schedule')
                    ->where('id', $schedule_id)
                    ->update($scheduleData);


            $participants = $_POST['params']['survey'];
//            echo '<pre>';
//            print_r($participants);die;

            foreach ($participants as $row) {
                $user_data = array(
                    'participant_id' => $row,
                    'schedule_id' => $schedule_id
                );
                Scheduleparticipant::insertGetId($user_data);
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.schedule').' '.__('message.updated').' '.__('message.successfully'));
            return '1';
        } else {
            $scheduleData = array(
                'fitler_select_type_id' => !empty($_POST['params']['type_id']) ? $_POST['params']['type_id'] : '',
                'filter_search_value' => !empty($_POST['params']['search_filter_value']) ? $_POST['params']['search_filter_value'] : '',
                'filter_category_id' => !empty($_POST['params']['category_id']) ? $_POST['params']['category_id'] : '',
                'filter_sub_category_id' => !empty($_POST['params']['sub_category_id']) ? $_POST['params']['sub_category_id'] : '',
                'filter_location_id' => !empty($_POST['params']['location_id']) ? $_POST['params']['location_id'] : '',
                'filter_gender' => !empty($_POST['params']['gender']) ? $_POST['params']['gender'] : '',
                'fitler_group_id' => !empty($_POST['params']['group_id']) ? $_POST['params']['group_id'] : '',
                'schedule_title' => !empty($_POST['params']['scheduleTitle']) ? $_POST['params']['scheduleTitle'] : '',
                'schedule_type' => !empty($_POST['params']['scheduleType']) ? $_POST['params']['scheduleType'] : '',
                'schedule_date' => !empty(date('Y-m-d',strtotime($_POST['params']['scheduleDate']))) ? date('Y-m-d',strtotime($_POST['params']['scheduleDate'])) : '',
                'schedule_time' => !empty($_POST['params']['scheduleTime']) ? $_POST['params']['scheduleTime'] : '',
                'survey_email_sms_sending_method' => !empty($_POST['params']['email_type']) ? $_POST['params']['email_type'] : '',
                'survey_template_type' => !empty($_POST['params']['template']) ? $_POST['params']['template'] : '',
                'survey_sendto_method' => !empty($_POST['params']['on_behalf']) ? $_POST['params']['on_behalf'] : '',
                // commented by kandarp pandya 01-09-2018
                // 'survey_form_id' => !empty($_POST['params']['survey_id']) ? $_POST['params']['survey_id'] : '',
                'user_id' => !empty($_POST['params']['auth_id']) ? $_POST['params']['auth_id'] : '',
                'send_all' => !empty($_POST['params']['send_all']) ? $_POST['params']['send_all'] : '',
                // edited by kandarp pandya 29-01-2019
                'end_date' => !empty(date('Y-m-d',strtotime($_POST['params']['end_date']))) ? date('Y-m-d',strtotime($_POST['params']['end_date'])) : null,
                'number_of_times' => !empty($_POST['params']['number_of_times']) ? $_POST['params']['number_of_times'] : null,
            );
            //dd($scheduleData);
            $scheduleID = Schedule::insertGetId($scheduleData);
            //dd($scheduleData);
            if ($scheduleID) {
                $participants = $_POST['params']['survey'];
                foreach ($participants as $row) {
                    $user_data = array(
                        'participant_id' => $row,
                        'schedule_id' => $scheduleID
                    );
                    Scheduleparticipant::insertGetId($user_data);
                }
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.schedule').' '.__('message.created').' '.__('message.successfully'));
            return '1';
        }
    }

    function listScheduleData(Request $request) {
        $login_user = Auth::user();

        $this->data['page_title'] = "Schedules List";
        $this->data['email_template'] = EmailTemplate::select('*')
                ->orderBy('id', 'desc')
                ->get();

        if (!$request->ajax()) {
            return view('admin.schedule.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $schedule_data = DB::table('tbl_schedule')
                ->select('id', 'schedule_title', 'schedule_date', 'status', 'schedule_time', 'created_at', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->orderBy('id', 'desc');

        $base_path = $this->data['base_path'];

        return Datatables::of($schedule_data)
                        ->addColumn('action', function($row) {
                            $edit_url = route('schedule.edit', $row->id);
                            $active_inactive_url = route('schedule.activate_schedule', $row->id);
                            $inactive_inactive_url = route('schedule.dactivate_schedule', $row->id);
                            $schedule_participants = route('schedule.list_schedule_participants', $row->id);
//                            $submitted_form_url = route('participant_form', $row->id);
                            // $links = '<a title="Survey Form Details" rel="'.$form_details.'" href="'.$form_details.'" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View Survey Form</a>&nbsp';
                            $links = '<a title="Set Reminder" href="javascript:void(0);" class=" mr-3 text-25 text-info more-details"><i class="i-Calendar-4  nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                            $links .= '<a title="Enrolled Participants" href="' . $schedule_participants . '" class="mr-3 text-25"><i class="i-Administrator nav-icon font-weight-bold"></i></a>&nbsp';
                            $links .= '<a title="Edit" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                            $links .= $row->status == '1' ? '<a title="Active" data-href="' . $active_inactive_url . '" class="text-info mr-3 text-25 change_data"><i class="i-Eye  nav-icon font-weight-bold" aria-hidden="true"></i></a>' : '<a title="In-Active" data-href="' . $inactive_inactive_url . '" class="text-sucess change_data mr-3 text-25 "><i class="i-Eye-Scan nav-icon font-weight-bold" aria-hidden="true"></i></a>';

//                            $links .= '<a title="Get survey forms submitted by ' . $row->first_name . '" href="' . $submitted_form_url . '" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>Survey Report</a>';
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
                        ->rawColumns(['Title', 'Schedule Date', 'Schedule Time', 'action'])
                        ->make(true);
    }

    public function edit(Request $request, $id) {

        $login_user = Auth::user();
        
        $schedule_data = Schedule::where('id', $id)->first();
        $sub_cat_data = Category::where('id', $schedule_data['filter_sub_category_id'])->first();
        $this->data['on_behalf'] = Setting::where('setting_key','on_behalf_of')->first();

        $template_name = '';
        if ($schedule_data['survey_email_sms_sending_method'] == 1) {
            $template_data = SMSTemplate::where('id', $schedule_data['survey_template_type'])->first();
        } else {
            $template_data = EmailTemplate::where('id', $schedule_data['survey_template_type'])->first();
        }

        
        $extraData = array(
            'category_id' => $schedule_data['filter_category_id'],
            'sub_category_id' => $schedule_data['filter_sub_category_id'],
            'sub_category_name' => $sub_cat_data['category_name'],
            'location_id' => $schedule_data['filter_location_id'],
            'group_id' => $schedule_data['fitler_group_id'],
            'type_id' => $schedule_data['fitler_select_type_id'],
            'gender' => $schedule_data['filter_gender'],
            'search_filter_value' => $schedule_data['filter_search_value'],
            'schedule_title' => $schedule_data['schedule_title'],
            'schedule_type' => $schedule_data['schedule_type'],
            'schedule_date' => $schedule_data['schedule_date'],
            'schedule_time' => $schedule_data['schedule_time'],
            'survey_form_id' => $schedule_data['survey_form_id'],
            'survey_sendto_method' => $schedule_data['survey_sendto_method'],
            'survey_email_sms_sending_method' => $schedule_data['survey_email_sms_sending_method'],
            'survey_template_type' => $schedule_data['survey_template_type'],
            'survey_template_title' => $template_data['title'],
            'schedule_id' => $id,
            'number_of_times' => $schedule_data['number_of_times'],
            'end_date' => $schedule_data['end_date'],
        );

        if ($request->has('extraData')) {
            $extraData = $request->input('extraData');
        }


        $this->data['page_title'] = "Edit Schedule";

        if (!$request->ajax()) {
            $this->data['category'] = Category::Select('id', 'category_name')
                    ->where('parent_id', 0)
                    ->where('is_deleted', 0)
                    ->get();
            $this->data['group'] = Group::Select('id', 'group_name')->get();
            $this->data['type'] = Type::Select('id', 'type_name')->get();
            $this->data['country'] = Country::Select('id', 'name')->get();
            $this->data['survey_form_data'] = Surveyform::select('id', 'survey_form_title')
                    ->where(['is_deleted' => 0])
                    ->orderBy('id', 'DESC')
                    ->get();
            $this->data['form_data'] = $extraData;
            return view('admin.schedule.send_survey_to_participant', $this->data);
        }
//       
        $query = $this->getDataManual($extraData);

        $survey_option_data = $query;

        $base_path = $this->data['base_path'];

        //get participant ids schedule wise

        $participant_data = Scheduleparticipant::where('schedule_id', $id)->pluck('participant_id')->toArray();

        return Datatables::of($survey_option_data)
            ->addColumn('action', function($row) {

                $links = "";
                return $links;
            })
            ->addColumn('checkbox', function($row) use($participant_data) {
                $d = in_array($row->id, $participant_data);
                if ($d) {
                    
                    $links = 
                        "<label  class='checkbox checkbox-primary'>
                        <input type='checkbox' name='select_count' class='select-participant' checked='checked'/>
                        <span class='checkmark'></span> 
                        </label>";
                       
                } else {
                    
                    $links = 
                        "<label  class='checkbox checkbox-primary'>
                        <input type='checkbox' name='select_count' class='select-participant'/>
                        <span class='checkmark'></span> 
                        </label>";
                }

                return $links;
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['first_name', 'action', 'checkbox'])
            ->make(true);
        die;
    }

    function activateSchedule(Request $request, $id) {
        $status = DB::table('tbl_schedule')
                ->where('id', $id)
                ->update(['status' => 2]);
        
        $r = array('status' => true);
        echo json_encode($r);

    }

    function dactivateSchedule(Request $request, $id) {
        $status = DB::table('tbl_schedule')
                ->where('id', $id)
                ->update(['status' => 1]);
        $r = array('status' => true,);
        echo json_encode($r);

    }

    //add scheduel reminder 

    function addScheduleReminder(Request $request) {

        $schedule_id = $_POST['params']['schedule_id'];

        $result = Schedulereminder::where('schedule_id', $schedule_id)->first();
        if (!empty($result)) {
            $reminderData = array(
                'reminder_type_id' => !empty($_POST['params']['reminder_send_type']) ? $_POST['params']['reminder_send_type'] : '',
                'reminder_template_id' => !empty($_POST['params']['template_dropdown']) ? $_POST['params']['template_dropdown'] : '',
                'rotation_number' => !empty($_POST['params']['remider_count_number']) ? $_POST['params']['remider_count_number'] : '',
                'rotation_type' => !empty($_POST['params']['rotation_type']) ? $_POST['params']['rotation_type'] : '',
                'updated_at' => date('Y-m-d'),
            );
            DB::table('tbl_schedule_reminder')
                    ->where('schedule_id', $_POST['params']['schedule_id'])
                    ->update($reminderData);

            return '1';
        } else {

            $reminderData = array(
                'schedule_id' => !empty($_POST['params']['schedule_id']) ? $_POST['params']['schedule_id'] : '',
                'reminder_type_id' => !empty($_POST['params']['reminder_send_type']) ? $_POST['params']['reminder_send_type'] : '',
                'reminder_template_id' => !empty($_POST['params']['template_dropdown']) ? $_POST['params']['template_dropdown'] : '',
                'rotation_number' => !empty($_POST['params']['remider_count_number']) ? $_POST['params']['remider_count_number'] : '',
                'rotation_type' => !empty($_POST['params']['rotation_type']) ? $_POST['params']['rotation_type'] : '',
                'created_at' => date('Y-m-d'),
            );
            
            Schedulereminder::insertGetId($reminderData);
            return '1';
        }
    }

    //get scheduel reminder 

    function getScheduleReminderData(Request $request) {

        $schedule_id = $_POST['schedule_id'];
        $reminderData = Schedulereminder::where('schedule_id', $schedule_id)->first();
        if(!empty($reminderData)){
            echo json_encode($reminderData);
        }else{
            echo '2';
        }
        
        exit();
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

        return $query;
    }

}
