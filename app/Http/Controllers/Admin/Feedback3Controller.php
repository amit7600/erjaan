<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\FeedBackComplains;
use App\FeedBackRatings;
use App\FeedbackReason;
use App\Http\Controllers\Controller;
use App\Package\SendEmailLib;
use App\StatusNotification;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;

class Feedback3Controller extends Controller
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
    public function index(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $feedback_question = DB::table('feedback_question')->where('feedback_id','3')->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'));

        $base_path = $this->data['base_path'];
        if (!$request->ajax()) {
            return view('admin.feedback_survey_3.index_3', $this->data);
        }
        return Datatables::of($feedback_question)
            ->addColumn('action', function ($row) {
                $edit_url = route('feedback_survey_3.edit', $row->id);
                $delete_url = route('feedback_survey_3.destroy', $row->id);

                $links = '<a title="Edit" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="Delete" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';

                return $links;
            })
            ->addColumn('status', function ($row) {

                $check = $row->is_selected ? 'checked' : '';
                $links = '<label class="switch switch-primary mr-3">
                            <input type="checkbox" class="isActive" ' . $check . '>
                            <span class="slider"></span>
                        </label>';
                return $links;
            })
            ->addColumn('question_order', function ($row) {
                $links = '<input type="number" id="question_order_' . $row->id . '" name="question_order" class="question_order form-control" value="' . $row->question_order . '"> ';
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

            ->editColumn('created_at', function ($row) {

                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function ($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['question', 'status', 'question_order', 'action'])
            ->make(true);
        // return view('admin.feedback_survey.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feedback_survey_3.create_3', $this->data);
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
            'question' => 'required',

        ]);
        try {
            $question = DB::table('feedback_question')->insert([
                'question' => $request->get('question'),
                'feedback_id' => $request->get('feedback_id'),
                'emoji_rating_5' => $request->get('emoji_rating_5'),
                'emoji_name_5' => $request->get('emoji_name_5'),
                'emoji_rating_4' => $request->get('emoji_rating_4'),
                'emoji_name_4' => $request->get('emoji_name_4'),
                'emoji_rating_3' => $request->get('emoji_rating_3'),
                'emoji_name_3' => $request->get('emoji_name_3'),
                'emoji_rating_2' => $request->get('emoji_rating_2'),
                'emoji_name_2' => $request->get('emoji_name_2'),
                'emoji_rating_1' => $request->get('emoji_rating_1'),
                'emoji_name_1' => $request->get('emoji_name_1'),
                'question_font_size' => $request->get('question_font_size'),
                'question_title_color' => $request->get('question_title_color'),
                'emoji_rating' => $request->get('emoji_rating'),
                'is_selected' => '1',

            ]);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.question') . ' ' . __('message.created') . ' ' . __('message.successfully'));

        } catch (Exception $e) {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }

        return redirect()->to('admin/feedback_survey_3')->with('success', __('message.question') . ' ' . __('message.created') . ' ' . __('message.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = DB::table('feedback_question')->where('id', $id)->where('feedback_id', '3')->first();

        return view('admin.feedback_survey_3.edit_3', $this->data, compact('feedback'));
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
        $question = DB::table('feedback_question')->where('id', $id)->update([
            'question' => $request->get('question'),
            'emoji_rating_5' => $request->get('emoji_rating_5'),
            'emoji_name_5' => $request->get('emoji_name_5'),
            'emoji_rating_4' => $request->get('emoji_rating_4'),
            'emoji_name_4' => $request->get('emoji_name_4'),
            'emoji_rating_3' => $request->get('emoji_rating_3'),
            'emoji_name_3' => $request->get('emoji_name_3'),
            'emoji_rating_2' => $request->get('emoji_rating_2'),
            'emoji_name_2' => $request->get('emoji_name_2'),
            'emoji_rating_1' => $request->get('emoji_rating_1'),
            'emoji_name_1' => $request->get('emoji_name_1'),
            'question_font_size' => $request->get('question_font_size'),
            'question_title_color' => $request->get('question_title_color'),
            'emoji_rating' => $request->get('emoji_rating'),
        ]);
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.question') . ' ' . __('message.updated') . ' ' . __('message.successfully'));
        return redirect()->to('admin/feedback_survey_3');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = DB::table('feedback_question')->where('id', $id)->delete();

        return response()->json([
            'message' => __('message.question') . ' ' . __('message.deleted') . ' ' . __('message.successfully'),
            'status' => true,
        ], 200);
    }
    public function show_feedback_survey(Request $request)
    {
        //dd($request);
        $question = DB::table('selected_feedback_question')->where('feedback_id','3')->first();
        $feedback_reason = FeedbackReason::where('feedback_id','3')->get();

        $this->data['feedback_reason'] = $feedback_reason;
        $this->data['question'] = $question;
        if (!$request->ajax()) {
            return view('admin.feedback_survey_3.choose_question_3', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $feedback_question = DB::table('feedback_question')->where('feedback_id','3')->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'));
        $select = DB::table('selected_feedback_question')->where('feedback_id','3')->get();
        $base_path = $this->data['base_path'];
        return Datatables::of($feedback_question)
            ->addColumn('action', function ($row) {
                $links = "";
                return $links;
            })
            ->addColumn('checkbox', function ($row) {
                $select = DB::table('selected_feedback_question')->where('feedback_id','3')->first();
                $se = explode(',', $select->question_id);
                foreach ($se as $key => $value) {
                    // dd($row->id,(int)$value);
                    if ((int) $value == $row->id) {
                        $check = 'checked';
                        break;
                    } else {
                        $check = '';
                    }
                }
                $links = "<input type='checkbox' class='select-question' $check />";
                return $links;
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function ($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['question', 'action', 'checkbox'])
            ->make(true);
    }
    //this is for feedback setting menu store data.
    public function store_question(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'thank_you_message' => 'required',
        ]);

        $selected_feedback_question = DB::table('selected_feedback_question')->where('feedback_id',3)->first();
        $question_form_background = $selected_feedback_question ? $selected_feedback_question->question_form_background : null;
        $question_form_logo = $selected_feedback_question ? $selected_feedback_question->question_form_logo : null;
        $feedback_reason = FeedbackReason::get();

        $path = public_path('uploads/question');
        if ($request->hasFile('question_form_background')) {
            $file = $request->file('question_form_background');
            $tempname = explode('.', $file->getClientOriginalName());
            $tempname = str_replace(' ', '_', $tempname);
            $name = $tempname[0] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);

            $question_form_background = 'uploads/question/' . $name;
        }

        if ($request->hasFile('question_form_logo')) {
            $file = $request->file('question_form_logo');
            $tempname = explode('.', $file->getClientOriginalName());
            $tempname = str_replace(' ', '_', $tempname);
            $name = $tempname[0] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);

            $question_form_logo = 'uploads/question/' . $name;
        }
        if($request->get('question_sequence') == 1){
            $displayOption = $request->get('display_option');
        }else {
            $displayOption = null;
        }

        if ($selected_feedback_question != null) {
            DB::table('selected_feedback_question')->where('id', 3)->update([
                'question_background_color' => $request->get('question_background_color'),
                'feedback_id' => $request->get('feedback_id'),
                'question_form_background' => $question_form_background,
                'question_form_logo' => $question_form_logo,
                'thank_you_message' => $request->get('thank_you_message'),
                'high_rating_name' => $request->get('high_rating_name'),
                'low_rating_name' => $request->get('low_rating_name'),
                'fullscreen_button' => $request->get('fullscreen_button'),
                'question_sequence' => $request->get('question_sequence'),
                'label_language' => $request->get('label_language'),
                'logo_size' => $request->get('logo_size'),
                'emoji_and_rating_size' => $request->get('emoji_and_rating_size'),
                'display_option' => $displayOption
            ]);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.feedback') . ' ' . __('message.setting') . ' ' . __('message.updated') . ' ' . __('message.successfully'));
        } else {
            DB::table('selected_feedback_question')->insert([
                'question_background_color' => $request->get('question_background_color'),
                'question_form_background' => $question_form_background,
                'question_form_logo' => $question_form_logo,
                'thank_you_message' => $request->get('thank_you_message'),
                'high_rating_name' => $request->get('high_rating_name'),
                'low_rating_name' => $request->get('low_rating_name'),
                'fullscreen_button' => $request->get('fullscreen_button'),
                'question_sequence' => $request->get('question_sequence'),
                'label_language' => $request->get('label_language'),
                'logo_size' => $request->get('logo_size'),
                'emoji_and_rating_size' => $request->get('emoji_and_rating_size'),
                'name_label' => 'Name',
                'name_label_ar' => 'اسم',
                'email_label' => 'E-mail',
                'email_label_ar' => 'البريد الإلكتروني',
                'number_label' => 'Number',
                'number_label_ar' => 'رقم',
                'comment_label' => 'Comment',
                'comment_label_ar' => 'تعليق',
                'display_option' => $displayOption
            ]);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.feedback') . ' ' . __('message.setting') . ' ' . __('message.save') . ' ' . __('message.successfully'));
        }

        return redirect()->to('admin/show_feedback_survey_3');
    }
    //show question form in fron end
    public function get_question_form()
    {
        $question = DB::table('feedback_question')->where('feedback_id', 3)->where('is_selected', 1)->orderBy('question_order', 'asc')->get();
        $selected_feedback_question = DB::table('selected_feedback_question')->where('feedback_id', 3)->first();

        $feedback_reason = FeedbackReason::where('feedback_id', 3)->get();
        //this is for complain model language
        if (isset($selected_feedback_question) && $selected_feedback_question->label_language == "english") {
            $name_label = $selected_feedback_question ? $selected_feedback_question->name_label : '';
            $email_label = $selected_feedback_question ? $selected_feedback_question->email_label : '';
            $number_label = $selected_feedback_question ? $selected_feedback_question->number_label : '';
            $comment_label = $selected_feedback_question ? $selected_feedback_question->comment_label : '';
        } else {
            $name_label = $selected_feedback_question ? $selected_feedback_question->name_label_ar : '';
            $email_label = $selected_feedback_question ? $selected_feedback_question->email_label_ar : '';
            $number_label = $selected_feedback_question ? $selected_feedback_question->number_label_ar : '';
            $comment_label = $selected_feedback_question ? $selected_feedback_question->comment_label_ar : '';
        }
        $reason_color = $selected_feedback_question ? $selected_feedback_question->reason_text_color : '';
        $align = $selected_feedback_question ? $selected_feedback_question->reason_appear : '';
        $reason_style = $selected_feedback_question ? $selected_feedback_question->reason_text_style : '';
        $text_size = $selected_feedback_question ? $selected_feedback_question->reason_font_size : '';
        $emoji_and_rating_size = $selected_feedback_question ? $selected_feedback_question->emoji_and_rating_size : '';
        $complain_header_color = $selected_feedback_question ? $selected_feedback_question->complain_header_color : '';
        $complain_button_color = $selected_feedback_question ? $selected_feedback_question->complain_button_color : '';

        $complain_button_text_color = $selected_feedback_question ? $selected_feedback_question->complain_button_text_color : '';
        $complain_button_text_size = $selected_feedback_question ? $selected_feedback_question->complain_button_text_size : '';

        $this->data['name_label'] = $name_label;
        $this->data['email_label'] = $email_label;
        $this->data['number_label'] = $number_label;
        $this->data['comment_label'] = $comment_label;
        $this->data['reason_color'] = $reason_color;
        $this->data['align'] = $align;
        $this->data['reason_style'] = $reason_style;
        $this->data['text_size'] = $text_size;
        $this->data['emoji_and_rating_size'] = $emoji_and_rating_size;
        $this->data['complain_header_color'] = $complain_header_color;
        $this->data['complain_button_color'] = $complain_button_color;
        $this->data['complain_button_text_color'] = $complain_button_text_color;
        $this->data['complain_button_text_size'] = $complain_button_text_size;

        return view('feedback_survey_3', compact('selected_feedback_question', 'question', 'feedback_reason'), $this->data);
    }
    //store survey question from front end
    public function store_survey_question(Request $request)
    {
        try {
            DB::table('feedback_survey')->insert([
                'rating' => $request->get('rating'),
                'question_id' => $request->get('question_id'),
                'user_id' => Auth::id(),
                'user_city' => Auth::user()->city,
                'feedback_id'=> $request->get('feedback_id'),
            ]);

        } catch (Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }
        return response()->json([
            'message' => __('message.thank') . ' ' . __('message.for') . ' ' . __('message.your') . ' ' . __('message.feedback'),
            'success' => true,
        ], 200);
    }
    //question status in feedback setting
    public function change_status(Request $request)
    {
        try {
            $id = $request->get('id');
            DB::table('feedback_question')->where('id', $id)->update([
                'is_selected' => $request->get('is_selected'),
            ]);
            if ($request->get('is_selected') == 1) {
                //$request->session()->flash('message.level', 'success');
                //$request->session()->flash('message.content', 'Question activated successfully!');
            } else {
                //$request->session()->flash('message.level', 'success');
                //$request->session()->flash('message.content', 'Question inavctive successfully!');
            }

        } catch (Exception $e) {

        }
        return response()->json([
            'message' => __('message.status') . ' ' . __('message.change') . ' ' . __('message.successfully'),
            'success' => true,
        ], 200);
    }
    // this is for show question answer in admin panel
    public function show_question_answer(Request $request)
    {

        DB::statement(DB::raw('set @rownum=0'));
        $question_answer = DB::table('feedback_survey')->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))->where('feedback_id','3');
        if (!$request->ajax()) {
            return view('admin.feedback_survey_3.show_question_answer_3', $this->data);
        }
        $base_path = $this->data['base_path'];
        return Datatables::of($question_answer)
            ->addColumn('action', function ($row) {
                $links = "";
                return $links;
            })
            ->addColumn('question', function ($row) {
                $select = DB::table('feedback_question')->where('id', $row->question_id)->first();

                $links = $select ? $select->question : '';

                return $links;
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })

            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })

            ->rawColumns(['question', 'action', 'rating'])
            ->make(true);
    }

    public function removeImage(Request $request)
    {
        try {
            $question = DB::table('selected_feedback_question')->where('id', '1')->update([
                $request->get('field') => null,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => true,
            ], 500);
        }
        return response()->json([
            'message' => __('message.image') . ' ' . __('message.remove') . ' ' . __('message.successfully'),
            'success' => true,
        ], 200);
    }
    //for question order
    public function question_order(Request $request)
    {
        try {
            if ($request->get('question_order') != null) {
                $feedback_question_count = DB::table('feedback_question')->where('id', '!=', $request->get('id'))->where('question_order', $request->get('question_order'))->get();

                if (count($feedback_question_count) > 0) {
                    return response()->json([
                        'message' => __('message.already_exist'),
                        'success' => false,
                    ], 500);
                }
            }

            $feedback_question = DB::table('feedback_question')->count();
            if ($feedback_question < $request->get('question_order')) {
                return response()->json([
                    'message' => __('message.enter_below_value'),
                    'success' => false,
                ], 500);
            }

            $id = $request->get('id');
            $data = DB::table('feedback_question')->where('id', $id)->update([
                'question_order' => $request->get('question_order'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => true,
            ], 500);
        }
        return response()->json([
            'success' => true,
        ], 200);
    }

    // feedback rating popup data store
    public function feedBackRatings(Request $request)
    {
        $user_city = Auth::user()->city;
        FeedBackRatings::create([
            'comment' => $request->get('comment'),
            'user_id' => Auth::id(),
            'user_city' => $user_city,
            'feedback_id' => $request->get('feedback_id')
        ]);
        return response()->json([
            'message' => __('message.thank') . ' ' . __('message.for') . ' ' . __('message.your') . ' ' . __('message.feedback'),
            'success' => true,
        ], 200);
    }

    public function feedBackComplaints(Request $request)
    {

        $FeedBackComplains = FeedBackComplains::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile' => $request->get('number'),
            'comment' => $request->get('comment'),
            'user_id' => Auth::id(),
        ]);
        $customerID = $FeedBackComplains->id;
        $admin = User::where('user_role', 0)->get();
        $status_notification = StatusNotification::where('id', 1)->first();
        $users = $status_notification ? explode(',', $status_notification->users) : null;

        //send email to customer
        if (isset($status_notification) && $status_notification->send_to_customer == 'yes' && ($status_notification->status_template == 'email' || $status_notification->status_template == 'both')) {
            $customer_token = md5(time());
            $mail = new SendEmailLib;
            $to = $request->get('email');
            $ids = [];
            $countSurveyIn = substr_count($status_notification->customer_email_template, '(survey_');
            if ($countSurveyIn > 0) {

                for ($i = 0; $i <= $countSurveyIn; $i++) {
                    $fullstring = $status_notification->customer_email_template;
                    //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                    $string = ' ' . $fullstring;
                    $start = '(';
                    $end = ')';
                    $ini = strpos($string, $start);
                    if ($ini == 0) {
                        break;
                    }

                    $ini += strlen($start);
                    $len = strpos($string, $end, $ini) - $ini;
                    $searchResult = substr($string, $ini, $len);
                    $expl = explode('_', $searchResult);
                    array_push($ids, $expl[1]);
                    $link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                    $params['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                    // modeified link
                    $longUrl = $link . "/" . $this->_encrypt($customerID) . '/' . $this->_encrypt(1) . '/' . $customer_token . '/' . $this->_encrypt(1);

                    $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri=' . urlencode($longUrl) . '&format=json';

                    $ch = curl_init();
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $data = curl_exec($ch);

                    curl_close($ch);
                    $data = json_decode($data);
                    $status_notification->customer_email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->customer_email_template);

                }
            }
            //this section for create entry into the survey count
            foreach ($ids as $key => $value) {
                $survey_count = DB::table('tbl_survey_count')
                    ->select('token')
                    ->where('form_id', $value)
                    ->where('participant_id', $customerID)
                    ->where('is_submitted_send', 1)
                    ->where('sms_email', 2)
                    ->where('user_id', Auth::id())
                    ->first();

                if ($survey_count) {
                    DB::table('tbl_survey_count')
                        ->where('form_id', $value)
                        ->where('participant_id', $customerID)
                        ->update(['token' => $customer_token]);
                } else {
                    $values = array('form_id' => $value, 'participant_id' => $customerID, 'token' => $customer_token, 'sms_email' => 2, 'user_id' => Auth::id());
                    DB::table('tbl_survey_count')->insert($values);

                }
            }

            $messageContent = str_replace('{var_customer_name}', $request->get('name'), $status_notification->customer_email_template);
            $messageContent1 = str_replace('{var_customer_email}', $request->get('email'), $messageContent);

            $message_content = "Name : " . $request->get('name') . "<br>
                                    Email : " . $request->get('email') . ",<br>
                                    Mobile : " . $request->get('number') . ",<br>
                                    Comment : " . $request->get('comment') . ",<br>
                                    User Name : " . Auth::user()->name . ",<br>
                                    Complain Date : " . date('Y-m-d', strtotime('now')) . ",<br>
                                    Message : " . $messageContent1;
            $subject = "User Complaints";
            $message = $message_content;
            $message .= "<br><br><br>Thanks, <br> Digital Survey Team";

            $test = $mail->sendEmail($to, $subject, $message);
        }
        //send email to all admin
        if (isset($status_notification) && ($status_notification->status_template == 'email' || $status_notification->status_template == 'both')) {
            foreach ($admin as $key => $value) {
                if ($value->email) {
                    $token = md5(time());
                    $mail = new SendEmailLib;
                    $to = $value->email;
                    $message_content = "Name : " . $request->get('name') . "<br>
                                        Email : " . $request->get('email') . ",<br>
                                        Mobile : " . $request->get('number') . ",<br>
                                        Comment : " . $request->get('comment') . ",<br>
                                        User Name : " . Auth::user()->name . ",<br>
                                        Complain Date : " . date('Y-m-d', strtotime('now'));
                    // .",<br>
                    // Message : " .$status_notification->email_template;
                    $subject = "User Complaints";
                    $message = $message_content;
                    $message .= "<br><br><br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                }
            }
        }
        //send email to selected users
        if (isset($status_notification) && ($status_notification->status_template == 'email' || $status_notification->status_template == 'both')) {
            foreach ($users as $key => $value) {
                $user = User::where('id', $value)->first();

                if ($user && $user->email) {
                    $token = md5(time());
                    $mail = new SendEmailLib;
                    $to = $user->email;

                    $ids = [];
                    $countSurveyIn = substr_count($status_notification->email_template, '(survey_');
                    if ($countSurveyIn > 0) {

                        for ($i = 0; $i <= $countSurveyIn; $i++) {
                            $fullstring = $status_notification->email_template;
                            //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                            $string = ' ' . $fullstring;
                            $start = '(';
                            $end = ')';
                            $ini = strpos($string, $start);
                            if ($ini == 0) {
                                break;
                            }

                            $ini += strlen($start);
                            $len = strpos($string, $end, $ini) - $ini;
                            $searchResult = substr($string, $ini, $len);
                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                            $params['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link . "/" . $this->_encrypt($customerID) . '/' . $this->_encrypt(1) . '/' . $token . '/' . $this->_encrypt(1);

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri=' . urlencode($longUrl) . '&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                            $data = curl_exec($ch);

                            curl_close($ch);
                            $data = json_decode($data);
                            $status_notification->email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->email_template);

                        }
                    }
                    //this section for create entry into the survey count
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token')
                            ->where('form_id', $value)
                            ->where('participant_id', $customerID)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', Auth::id())
                            ->first();
                        if ($survey_count) {
                            DB::table('tbl_survey_count')
                                ->where('form_id', $value)
                                ->where('participant_id', $customerID)
                                ->update(['token' => $token]);
                        } else {
                            $values = array('form_id' => $value, 'participant_id' => $customerID, 'token' => $token, 'sms_email' => 2, 'user_id' => Auth::id());
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }
                    $messageContent = str_replace('{var_user_name}', $user->name, $status_notification->email_template);
                    $messageContentFinal = str_replace('{var_user_email}', $user->email, $messageContent);

                    $message_content = "Name : " . $request->get('name') . "<br>
                                        Email : " . $request->get('email') . ",<br>
                                        Mobile : " . $request->get('number') . ",<br>
                                        Comment : " . $request->get('comment') . ",<br>
                                        User Name : " . Auth::user()->name . ",<br>
                                        Complain Date : " . date('Y-m-d', strtotime('now')) . ",<br>
                                        Message : " . $messageContentFinal;

                    $subject = "User Complaints";
                    $message = $message_content;
                    $message .= "<br><br><br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                }
            }
        }
        return response()->json([
            'message' => __('message.thanks') . ' ' . __('message.for') . ' ' . __('message.your') . ' ' . __('message.feedback'),
            'success' => true,
        ], 200);
    }

    // update status in feedback_complaints table
    public function change_status_feedback(Request $request)
    {
        FeedBackComplains::where('id', $request->get('id'))->update([
            'status' => $request->get('status'),
            'modified_by' => \Auth::id(),
        ]);
        //this section for set template id static.
        if ($request->get('status') == 'new') {
            $template_id = 1;
            $status_notification = StatusNotification::where('id', $template_id)->first();
            $email_template = $status_notification->email_template;
        }
        if ($request->get('status') == 'in_progress') {
            $template_id = 2;
            $status_notification = StatusNotification::where('id', $template_id)->first();
            $email_template = $status_notification->email_template;
        }
        if ($request->get('status') == 'resolved') {
            $template_id = 3;
            $status_notification = StatusNotification::where('id', $template_id)->first();
            $email_template = $status_notification->email_template;
        }
        if ($request->get('status') == 'late') {
            $template_id = 4;
            $status_notification = StatusNotification::where('id', $template_id)->first();
            $email_template = $status_notification->email_template;
        }

        $users = $status_notification ? explode(',', $status_notification->users) : null;
        $feedbackDetails = FeedBackComplains::where('id', $request->get('id'))->first();
        $customerID = $request->get('id');
        //send email to customer
        if (isset($status_notification) && $status_notification->send_to_customer == 'yes' && $status_notification->status_template == 'email') {
            $token = md5(time() + 1);
            $mail = new SendEmailLib;
            $to = $feedbackDetails->email;

            $ids = [];
            $countSurveyIn = substr_count($status_notification->customer_email_template, '(survey_');
            if ($countSurveyIn > 0) {

                for ($i = 0; $i <= $countSurveyIn; $i++) {
                    $fullstring = $status_notification->customer_email_template;
                    //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                    $string = ' ' . $fullstring;
                    $start = '(';
                    $end = ')';
                    $ini = strpos($string, $start);
                    if ($ini == 0) {
                        break;
                    }

                    $ini += strlen($start);
                    $len = strpos($string, $end, $ini) - $ini;
                    $searchResult = substr($string, $ini, $len);
                    $expl = explode('_', $searchResult);
                    array_push($ids, $expl[1]);
                    $link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                    $params['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                    // modeified link
                    $longUrl = $link . "/" . $this->_encrypt($customerID) . '/' . $this->_encrypt(1) . '/' . $token . '/' . $this->_encrypt(1);

                    $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri=' . urlencode($longUrl) . '&format=json';

                    $ch = curl_init();
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $data = curl_exec($ch);

                    curl_close($ch);
                    $data = json_decode($data);
                    $status_notification->customer_email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->customer_email_template);

                }
            }
            //this section for create entry into the survey count
            foreach ($ids as $key => $value) {
                $survey_count = DB::table('tbl_survey_count')
                    ->select('token')
                    ->where('form_id', $value)
                    ->where('participant_id', $customerID)
                    ->where('is_submitted_send', 1)
                    ->where('sms_email', 2)
                    ->where('user_id', Auth::id())
                    ->first();
                if ($survey_count) {
                    DB::table('tbl_survey_count')
                        ->where('form_id', $value)
                        ->where('participant_id', $customerID)
                        ->update(['token' => $token]);
                } else {
                    $values = array('form_id' => $value, 'participant_id' => $customerID, 'token' => $token, 'sms_email' => 2, 'user_id' => Auth::id());
                    DB::table('tbl_survey_count')->insert($values);
                }
            }
            $messageContent = str_replace('{var_customer_name}', $feedbackDetails->name, $status_notification->customer_email_template);
            $messageContentFinal = str_replace('{var_customer_email}', $feedbackDetails->email, $messageContent);

            $message_content = "Your complaint status is " . str_replace('_', ' ', $request->get('status')) . ", <br> Complain Date : " . $feedbackDetails->created_at . ", <br> message : " . $messageContentFinal;

            $subject = "User Complaints";
            $message = $message_content;
            $message .= "<br><br><br>Thanks, <br> Digital Survey Team";
            $test = $mail->sendEmail($to, $subject, $message);
        }
        //send email to all admin
        if (isset($status_notification) && $status_notification->status_template == 'email') {
            $admin = User::where('user_role', 0)->get();
            foreach ($admin as $key => $value) {
                if ($value->email) {
                    $token = md5(time());
                    $mail = new SendEmailLib;
                    $to = $value->email;
                    $messageContent = str_replace('{var_customer_name}', $feedbackDetails->name, $status_notification->customer_email_template);
                    $messageContentFinal = str_replace('{var_customer_email}', $feedbackDetails->email, $messageContent);
                    $message_content = $message_content = "Customer complaint status is " . str_replace('_', ' ', $request->get('status')) . ",<br> Complain Date : " . $feedbackDetails->created_at . ", <br> message : " . $messageContentFinal;

                    $subject = "User Complaints";
                    $message = $message_content;
                    $message .= "<br><br><br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                }
            }
        }
        //send email to selected users
        if (isset($status_notification) && $status_notification->status_template == 'email') {
            foreach ($users as $key => $value) {
                $user = User::where('id', $value)->first();
                if ($user != null && $user->email) {
                    $token = md5(time());
                    $mail = new SendEmailLib;
                    $to = $user->email;

                    $ids = [];
                    $countSurveyIn = substr_count($status_notification->email_template, '(survey_');
                    if ($countSurveyIn > 0) {

                        for ($i = 0; $i <= $countSurveyIn; $i++) {
                            $fullstring = $status_notification->email_template;
                            //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                            $string = ' ' . $fullstring;
                            $start = '(';
                            $end = ')';
                            $ini = strpos($string, $start);
                            if ($ini == 0) {
                                break;
                            }

                            $ini += strlen($start);
                            $len = strpos($string, $end, $ini) - $ini;
                            $searchResult = substr($string, $ini, $len);
                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                            $params['survey_form_link'] = $this->data['base_path'] . 'survey_form/' . $this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link . "/" . $this->_encrypt($customerID) . '/' . $this->_encrypt(1) . '/' . $token . '/' . $this->_encrypt(1);

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri=' . urlencode($longUrl) . '&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                            $data = curl_exec($ch);

                            curl_close($ch);
                            $data = json_decode($data);
                            $status_notification->email_template = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $status_notification->email_template);

                        }
                    }
                    //this section for create entry into the survey count
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token')
                            ->where('form_id', $value)
                            ->where('participant_id', $customerID)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', Auth::id())
                            ->first();
                        if ($survey_count) {
                            DB::table('tbl_survey_count')
                                ->where('form_id', $value)
                                ->where('participant_id', $customerID)
                                ->update(['token' => $token]);
                        } else {
                            $values = array('form_id' => $value, 'participant_id' => $customerID, 'token' => $token, 'sms_email' => 2, 'user_id' => Auth::id());
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }

                    $messageContent = str_replace('{var_user_name}', $user->name, $status_notification->email_template);
                    $messageContentFinal = str_replace('{var_user_email}', $user->email, $messageContent);
                    $message_content = $message_content = "Your complaint status is " . str_replace('_', ' ', $request->get('status')) . ", <br> Complain Date : " . $feedbackDetails->created_at . ", <br> message : " . $messageContentFinal;

                    $subject = "User Complaints";
                    $message = $message_content;
                    $message .= "<br><br><br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to, $subject, $message);
                }
            }
        }

        return response()->json([
            'message' => __('message.status') . ' ' . __('message.change') . ' ' . __('message.successfully'),
            'success' => true,
        ], 200);
    }

    //for get complain
    public function show_complain(Request $request)
    {

        DB::statement(DB::raw('set @rownum=0'));

        if (!$request->ajax()) {
            return view('admin.feedback_survey.show_complain', $this->data);
        }

        $extraData = $request->input('extraData');

        $query = $this->getDataManual($extraData);
        $complains = $query;

        $base_path = $this->data['base_path'];
        return Datatables::of($complains)
            ->addColumn('action', function ($row) {
                $links = "";
                return $links;
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })

            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })

            ->editColumn('updated_at', function ($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })

            ->editColumn('modified_by', function ($row) {
                $value = '-';
                if ($row->modified_by != null) {
                    $user = DB::table('users')->whereId($row->modified_by)->first();
                    $value = $user->name;

                }
                return $value;
            })
            ->addColumn('status', function ($row) {
                $selected1 = $row->status == 'new' ? 'selected' : '';
                $selected2 = $row->status == 'in_progress' ? 'selected' : '';
                $selected3 = $row->status == 'resolved' ? 'selected' : '';
                $selected4 = $row->status == 'late' ? 'selected' : '';
                $color = 'cornflowerblue';
                if ($row->status == 'new') {
                    $color = '#639';
                }

                if ($row->status == 'in_progress') {
                    $color = '#e0a800';
                }

                if ($row->status == 'resolved') {
                    $color = '#409444';
                }

                if ($row->status == 'late') {
                    $color = 'rgb(244, 67, 54)';
                }

                $links = '<select name="change_status" id="change_status_' . $row->id . '" class="form-control" onchange="changeStatus(' . $row->id . ', ' . $row->user_id . ')" style="color: white; background: ' . $color . '">
                <option value="new" ' . $selected1 . '>new</option>
                <option value="in_progress" ' . $selected2 . '>In Progress</option>
                <option value="resolved" ' . $selected3 . '>Resolved</option>
                <option value="late" ' . $selected4 . '>Late</option>

                 </select>';
                return $links;
            })

            ->rawColumns(['comment', 'action', 'status'])
            ->make(true);
    }
    public function getDataManual($extraData)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $query = FeedBackComplains::select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->orderBy('id', 'DESC');

        if (!empty($extraData['status'])) {
            $query->where('status', $extraData['status']);
        }

        return $query;
    }
    public function question_report()
    {
        $question = DB::table('feedback_question')->where('is_selected', 1)->get();
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));

        $this->data['user_name'] = DB::table('users')->get();
        $this->data['time_filter'] = $time_filter;
        $this->data['location'] = $location;
        $this->data['user'] = $user;
        $this->data['question'] = $question;
        return view('admin.feedback_survey.question_report', $this->data);
    }
    //get question report for all user;
    public function get_question_report(Request $request)
    {
        $question_survey = DB::table('feedback_survey')->select('*')->get();
        $feedback_question = DB::table('feedback_question')->select('*')->get();

        $totalCountArr = array();
        $sum = 0;
        $question_rating = [];
        foreach ($feedback_question as $key => $value) {

            $question_rating = DB::table('feedback_survey')->where('question_id', $value->id)->select(DB::raw('count(rating) AS rating_count'), (DB::raw('sum(rating) AS rating_sum')))->first();

            $sum = $question_rating->rating_sum != null ? $question_rating->rating_sum : 0;
            $count = $question_rating->rating_count != 0 ? $question_rating->rating_count : 1;
            $avg = ($sum / $count);

            $totalCountArr[] = array('avg' => round($avg, 2), 'response' => $count);

        }
        $feedback_question['totle_kpi_count'] = $sum;
        $feedback_question['length'] = count($feedback_question);
        $feedback_question['minimum_value'] = 0;
        $feedback_question['maximum_value'] = 5;
        $this->data['survey_form'] = $feedback_question;
        $this->data['final_value'] = $totalCountArr;
        $this->data['question_rating'] = $question_rating;
        $this->data['question_survey'] = $question_survey;

        echo json_encode($this->data);
        die();
    }
    //get question report kpi as per filter
    public function get_question_report_kpi(Request $request)
    {
        $question_survey = DB::table('feedback_survey')->select('*')->get();
        $feedback_question = DB::table('feedback_question')->select('*')->get();

        $totalCountArr = array();

        foreach ($feedback_question as $key => $value) {
            $question_rating = DB::table('feedback_survey')->where('question_id', $value->id);
            if ($request->get('user') != null) {
                $question_rating = $question_rating->where('user_id', $request->get('user'));
            }
            if ($request->get('location') != null && $request->get('location') != __('message.all')) {
                $question_rating = $question_rating->where('user_city', $request->get('location'));
            }
            if ($request->get('time_filter') != null && $request->get('time_filter') != __('message.all')) {
                $time_period = $request->get('time_filter');
                $created_from = $request->get('created_from');
                $created_to = $request->get('created_to');

                if ($time_period == 'specific_date') {
                    if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                        $created_from = date('Y/m/d', strtotime($created_from));
                        $created_to = date('Y/m/d', strtotime($created_to));

                        $question_rating = $question_rating->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                    }
                } elseif ($time_period == 'today') {
                    $question_rating = $question_rating->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                } elseif ($time_period == 'yesterday') {
                    $question_rating = $question_rating->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                } elseif ($time_period == 'last_14_day') {
                    $question_rating = $question_rating->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());

                } elseif ($time_period == 'this_week') {
                    $start = Carbon::now()->startOfWeek();
                    $end = Carbon::now()->endOfWeek();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'last_week') {
                    $start = Carbon::now()->startOfWeek()->subDays(7);
                    $end = Carbon::now()->startOfWeek();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'this_month') {
                    $question_rating = $question_rating->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());

                } elseif ($time_period == 'last_month') {
                    $start = Carbon::now()->startOfMonth()->subMonth()->toDateString();
                    $end = Carbon::now()->startofMonth()->subMonth()->endOfMonth()->toDateString();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'this_year') {
                    $question_rating = $question_rating->whereYear('created_at', '>=', date('Y'));
                } elseif ($time_period == 'last_year') {
                    $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                    $end = Carbon::now()->startOfYear()->toDateString();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");
                } else {
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
            $question_rating = $question_rating->select(DB::raw('count(rating) AS rating_count'), (DB::raw('sum(rating) AS rating_sum')))->first();

            $sum = $question_rating->rating_sum != null ? $question_rating->rating_sum : 0;
            $count = $question_rating->rating_count != 0 ? $question_rating->rating_count : 1;
            $avg = ($sum / $count);

            $totalCountArr[] = array('avg' => round($avg, 2), 'response' => $question_rating->rating_count);

        }
        $feedback_question['totle_kpi_count'] = $sum;
        $feedback_question['length'] = count($feedback_question);
        $feedback_question['minimum_value'] = 0;
        $feedback_question['maximum_value'] = 5;
        $this->data['survey_form'] = $feedback_question;
        $this->data['final_value'] = $totalCountArr;
        $this->data['question_rating'] = $question_rating;
        $this->data['question_survey'] = $question_survey;

        echo json_encode($this->data);
        die();
    }
    public function question_chart($user_id = null, $city = null, $created_from = null, $created_to = null, $time_period = null)
    {

        $question = DB::table('feedback_question')
            ->join('feedback_survey', 'feedback_survey.question_id', '=', 'feedback_question.id')
            ->select('feedback_survey.*', 'feedback_question.*')
            ->where('feedback_question.feedback_id','3')
            ->get();
            //dd($question);
        $feedback_question[] = $question;
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');
        $total_question = DB::table('feedback_question')->select('*')->where('feedback_question.feedback_id','3')->get();
        //'all_result'=>__('message.all_result'),
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        // dd($time_filter);

        $this->data['time_filter'] = $time_filter;
        $this->data['time_period'] = $time_period;
        $this->data['user_id'] = $user_id;
        $this->data['location'] = $location;
        $this->data['city'] = $city;
        $this->data['user'] = $user;
        $this->data['total_question'] = $total_question;
        $this->data['feedback_question'] = $feedback_question;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;

        return view('admin.feedback_survey_3.question_chart_3', $this->data);
    }
    public function chart_session(Request $request)
    {
        if ($request->get('select_chart_by')) {
            Session::put('select_chart_by', $request->get('select_chart_by'));
        }

        Session::put('user', $request->get('user'));
        Session::put('city', $request->get('city'));
        Session::put('created_from', $request->get('created_from'));
        Session::put('created_to', $request->get('created_to'));
        Session::put('select_chart_type', $request->get('select_chart_type'));
        Session::put('time_period', $request->get('time_period'));

        $user = $request->get('user');
        $city = $request->get('city');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');
        $time_period = $request->get('time_period');
        return $this->question_chart($user, $city, $created_from, $created_to, $time_period);

    }

    public function getFeedbackRatings(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));

        $feedback_question = DB::table('feedback_rating')
            ->join('users', 'users.id', '=', 'feedback_rating.user_id')
            ->where('feedback_rating.feedback_id','3')
            ->select('feedback_rating.*', DB::raw('@rownum := @rownum + 1 AS rownum'), 'users.*');
        //dd($feedback_question->get());    
        $base_path = $this->data['base_path'];
        if (!$request->ajax()) {
            return view('admin.feedback_survey_3.feedback_rating_3', $this->data);
        }
        return Datatables::of($feedback_question)
            ->addColumn('action', function ($row) {
                $edit_url = route('feedback_survey.edit', $row->id);
                $delete_url = route('feedback_survey.destroy', $row->id);
                $links = '<a title="Edit" href="' . $edit_url . '" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="Delete" data-href="' . $delete_url . '" class="btn btn-danger delete_data"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                return $links;
            })

            ->editColumn('created_at', function ($row) {

                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function ($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['comment', 'name'])
            ->make(true);
    }

    public function complain_chart($user_id = null, $city = null, $created_from = null, $created_to = null, $time_period = null)
    {

        $feedback_complain = DB::table('feedback_complains')
            ->select('*');

        $new = DB::table('feedback_complains')->select('*')->where('status', 'new')->get();
        $in_progress = DB::table('feedback_complains')->select('*')->where('status', 'in_progress')->get();
        $resolved = DB::table('feedback_complains')->select('*')->where('status', 'resolved')->get();
        $late = DB::table('feedback_complains')->select('*')->where('status', 'late')->get();

        $feedback_complain = array($new, $in_progress, $resolved, $late);
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');
        //'all_result'=>__('message.all_result'),
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        // dd($time_filter);

        $data[] = '';
        $this->data['user_id'] = $user_id;
        $this->data['location'] = $location;
        $this->data['city'] = $city;
        $this->data['user'] = $user;
        $this->data['data'] = $data;
        $this->data['feedback_complain'] = $feedback_complain;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['time_period'] = $time_period;
        $this->data['time_filter'] = $time_filter;

        return view('admin.feedback_survey.complain_chart', $this->data);
    }
    public function complain_chart_filter(Request $request)
    {
        if ($request->get('select_chart_by')) {
            Session::put('select_chart_by', $request->get('select_chart_by'));
        }
        Session::put('user', $request->get('user'));
        Session::put('city', $request->get('city'));
        Session::put('created_from', $request->get('created_from'));
        Session::put('created_to', $request->get('created_to'));
        Session::put('select_chart_type', $request->get('select_chart_type'));
        Session::put('time_period', $request->get('time_period'));

        $user = $request->get('user');
        $city = $request->get('city');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');
        $time_period = $request->get('time_period');
        return $this->complain_chart($user, $city, $created_from, $created_to, $time_period);

    }
    public function complain_report()
    {
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));

        $this->data['user_name'] = DB::table('users')->get();
        $this->data['location'] = $location;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.feedback_survey.complain_report', $this->data);
    }
    public function get_complain_report(Request $request)
    {
        $complain_count = DB::table('feedback_complains')->select('*')->count();

        $new = DB::table('feedback_complains')->select('*')->where('status', 'new')->get();
        $in_progress = DB::table('feedback_complains')->select('*')->where('status', 'in_progress')->get();
        $resolved = DB::table('feedback_complains')->select('*')->where('status', 'resolved')->get();
        $late = DB::table('feedback_complains')->select('*')->where('status', 'late')->get();

        $feedback_complain = array($new, $in_progress, $resolved, $late);

        $totalCountArr = array(count($new), count($in_progress), count($resolved), count($late));

        $feedback_complain['length'] = count($feedback_complain);
        $feedback_complain['minimum_value'] = 0;
        $feedback_complain['maximum_value'] = $complain_count;
        $this->data['compalin_count'] = $feedback_complain;
        $this->data['status_count'] = $totalCountArr;

        echo json_encode($this->data);
        die();
    }
    public function get_complain_report_kpi(Request $request)
    {
        $complain_count = DB::table('feedback_complains')->select('*')->count();

        $new = FeedBackComplains::select('*')->where('status', 'new');
        $in_progress = FeedBackComplains::select('*')->where('status', 'in_progress');
        $resolved = FeedBackComplains::select('*')->where('status', 'resolved');
        $late = FeedBackComplains::select('*')->where('status', 'late');
        $this->data['user_name'] = $request->get('user');
        if ($request->get('user') != null && $request->get('user') != '0') {
            $new = $new->where('user_id', $request->get('user'));
            $in_progress = $in_progress->where('user_id', $request->get('user'));
            $resolved = $resolved->where('user_id', $request->get('user'));
            $late = $late->where('user_id', $request->get('user'));
        }
        if ($request->get('location') != null && $request->get('location') != __('message.all')) {
            $new = $new->where('user_city', $request->get('location'));
            $in_progress = $in_progress->where('user_city', $request->get('location'));
            $resolved = $resolved->where('user_city', $request->get('location'));
            $late = $late->where('user_city', $request->get('location'));
        }
        if ($request->get('time_filter') != __('message.all')) {

            $time_period = $request->get('time_filter');
            $created_from = $request->get('created_from');
            $created_to = $request->get('created_to');

            if ($time_period == 'specific_date') {
                if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                    $created_from = date('Y/m/d', strtotime($created_from));
                    $created_to = date('Y/m/d', strtotime($created_to));

                    $new = $new->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                    $in_progress = $in_progress->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                    $resolved = $resolved->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                    $late = $late->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                }
            } elseif ($time_period == 'today') {
                $new = $new->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                $in_progress = $in_progress->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                $resolved = $resolved->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                $late = $late->whereDate('created_at', Carbon::now()->format('Y/m/d'));
            } elseif ($time_period == 'yesterday') {
                $new = $new->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                $in_progress = $in_progress->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                $resolved = $resolved->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                $late = $late->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
            } elseif ($time_period == 'last_14_day') {
                $new = $new->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
                $in_progress = $in_progress->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
                $resolved = $resolved->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
                $late = $late->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
            } elseif ($time_period == 'this_week') {
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();

                $new = $new->whereRaw(" Date(created_at) between '$start' and '$end'");
                $in_progress = $in_progress->whereRaw(" Date(created_at) between '$start' and '$end'");
                $resolved = $resolved->whereRaw(" Date(created_at) between '$start' and '$end'");
                $late = $late->whereRaw(" Date(created_at) between '$start' and '$end'");
            } elseif ($time_period == 'last_week') {
                $start = Carbon::now()->startOfWeek()->subDays(7);
                $end = Carbon::now()->startOfWeek();

                $new = $new->whereRaw(" Date(created_at) between '$start' and '$end'");
                $in_progress = $in_progress->whereRaw(" Date(created_at) between '$start' and '$end'");
                $resolved = $resolved->whereRaw(" Date(created_at) between '$start' and '$end'");
                $late = $late->whereRaw(" Date(created_at) between '$start' and '$end'");
            } elseif ($time_period == 'this_month') {

                $new = $new->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());
                $in_progress = $in_progress->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());
                $resolved = $resolved->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());
                $late = $late->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());
            } elseif ($time_period == 'last_month') {
                $start = Carbon::now()->startOfMonth()->subMonth()->toDateString();
                $end = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString();

                $new = $new->whereRaw(" Date(created_at) between '$start' and '$end'");
                $in_progress = $in_progress->whereRaw(" Date(created_at) between '$start' and '$end'");
                $resolved = $resolved->whereRaw(" Date(created_at) between '$start' and '$end'");
                $late = $late->whereRaw(" Date(created_at) between '$start' and '$end'");
            } elseif ($time_period == 'this_year') {
                $new = $new->whereYear('created_at', '>=', date('Y'));
                $in_progress = $in_progress->whereYear('created_at', '>=', date('Y'));
                $resolved = $resolved->whereYear('created_at', '>=', date('Y'));
                $late = $late->whereYear('created_at', '>=', date('Y'));
            } elseif ($time_period == 'last_year') {
                $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                $end = Carbon::now()->startOfYear()->toDateString();

                $new = $new->whereRaw(" Date(created_at) between '$start' and '$end'");
                $in_progress = $in_progress->whereRaw(" Date(created_at) between '$start' and '$end'");
                $resolved = $resolved->whereRaw(" Date(created_at) between '$start' and '$end'");
                $late = $late->whereRaw(" Date(created_at) between '$start' and '$end'");
            } else {
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
        $new = $new->get();
        $in_progress = $in_progress->get();
        $resolved = $resolved->get();
        $late = $late->get();
        $feedback_complain = array($new, $in_progress, $resolved, $late);
        $totalCountArr = array(count($new), count($in_progress), count($resolved), count($late));

        $feedback_complain['length'] = count($feedback_complain);
        $feedback_complain['minimum_value'] = 0;
        $feedback_complain['maximum_value'] = $complain_count;

        $this->data['compalin_count'] = $feedback_complain;
        $this->data['status_count'] = $totalCountArr;

        echo json_encode($this->data);
        die();
    }
    public function reason_chart($user_id = null, $city = null, $created_from = null, $created_to = null, $time_period = null)
    {

        $reason = DB::table('feedback_reason')->where('feedback_id','3')->select('*');

        $reason = $reason->get();
        $feedback_reason = $reason;
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');

        $total = 0;
        $results_total = DB::table('feedback_reason')->where('feedback_id','3')->select('*')->get();
        foreach ($reason as $key => $value) {
            $results = DB::table('feedback_rating')->select('*')
                ->where('feedback_id','3')
                ->where('comment', $value->feedback_reason)->count();
            $total = $total + $results;
        }
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));

        $this->data['time_period'] = $time_period;
        $this->data['time_filter'] = $time_filter;
        $this->data['user_id'] = $user_id;
        $this->data['location'] = $location;
        $this->data['city'] = $city;
        $this->data['user'] = $user;
        $this->data['total_reason'] = $total;
        $this->data['feedback_reason_data'] = $feedback_reason;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;

        // developed by kandarp pandya --- 16-06-2019
        // $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; // Months 1 to 12
        $currentYear = date('Y'); // get cureent year
        $year = [$currentYear - 0, $currentYear - 1, $currentYear - 2, $currentYear - 3, $currentYear - 4, $currentYear - 5]; // Current year with last 5 year
        $months = [];
        if ($time_period == 'last_14_day') {
            $monthData = array();
            if (count($months) == 0) {
                for ($i = 0; $i <= 13; $i++) {
                    $months[] = date('Y-m-d', strtotime(date('Y-m-d') . "-" . $i . "day"));
                    $monthData[] = date('d/m', strtotime(date('Y-m-d') . "-" . $i . "day"));

                }
            }
        } elseif ($time_period == 'this_week') {
            for ($i = 0; $i <= 6; $i++) {
                $x = date('Y-m-d', strtotime("-" . $i . "day"));

                if (date('D', strtotime($x)) == 'Mon') {
                    break;
                }

            }
            $start_number = 0;
            $year_month_value = 6;
            $m = $x;
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= 6; $i++) {
                    $months[] = date('Y-m-d', strtotime($m . $inc_dec . $i . $month));
                    $monthData[] = date('d/m', strtotime($m . $inc_dec . $i . $month));
                }
            }
        } elseif ($time_period == 'last_week') {
            for ($i = 0; $i <= 6; $i++) {
                $first_of_week = date('Y-m-d', strtotime("-" . $i . "day"));

                if (date('D', strtotime($first_of_week)) == 'Mon') {
                    break;
                }

            }
            $start_number = 0;
            $year_month_value = 6;
            $m = date('Y-m-d', strtotime($first_of_week . "-7" . "day"));
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= 6; $i++) {
                    $months[] = date('Y-m-d', strtotime($m . $inc_dec . $i . $month));
                    $monthData[] = date('d/m', strtotime($m . $inc_dec . $i . $month));
                }
            }

        } elseif ($time_period == 'this_month') {
            $first_of_month = date('Y-m-d', strtotime(date('Y-m-01')));

            $start_number = 0;
            $year_month_value = date('t');
            $m = $first_of_month;
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i < $year_month_value; $i++) {
                    $months[] = date('Y-m-d', strtotime($m . $inc_dec . $i . $month));
                    $monthData[] = date('d', strtotime($m . $inc_dec . $i . $month));
                }
            }
        } elseif ($time_period == 'last_month') {
            $first_of_month = date('Y-m-d', strtotime(date('Y-m-01') . "-1 month"));
            $days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime("-1 month")), date('Y'));

            $start_number = 0;
            $year_month_value = $days;
            $m = $first_of_month;
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i < $year_month_value; $i++) {
                    $months[] = date('Y-m-d', strtotime($m . $inc_dec . $i . $month));
                    $monthData[] = date('d', strtotime($m . $inc_dec . $i . $month));
                }
            }
            // dd($monthData);
        } elseif ($time_period == 'last_year') {
            $first_month_last_year = date('Y-m-d', strtotime(date('Y-01-d') . "-1 year"));

            $start_number = 0;
            $year_month_value = 11;
            $m = date("Y/01/01", strtotime("-1 year"));
            $month = 'month';
            $tp = 'm';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= $year_month_value; $i++) {
                    $months[] = date('m', strtotime(date("Y/01/01", strtotime("-1 year")) . $inc_dec . $i . $month));
                    $monthData[] = date('m/Y', strtotime(date("Y/01/01", strtotime("-1 year")) . $inc_dec . $i . $month));
                }
            }
        } elseif ($time_period == 'today') {
            $start_number = 0;
            $year_month_value = 0;
            $m = date('Y-m-d');
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= $year_month_value; $i++) {
                    $months[] = date('d/m', strtotime('d' . $inc_dec . $i . $month));
                    $monthData[] = date('Y-m-d', strtotime('d' . $inc_dec . $i . $month));
                }
            }
        } elseif ($time_period == 'yesterday') {

            $start_number = 0;
            $year_month_value = 0;
            $m = date('Y-m-d', strtotime("-1 day"));
            $month = 'day';
            $tp = 'Y-m-d';
            $inc_dec = "-";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= $year_month_value; $i++) {
                    $months[] = date('Y-m-d', strtotime(date('Y-m-d', strtotime("-1 day")) . $inc_dec . $i . $month));
                    $monthData[] = date('Y-m-d', strtotime(date('Y-m-d', strtotime("-1 day")) . $inc_dec . $i . $month));
                }
            }
            // dd($months);
        } elseif ($time_period == 'specific_date') {
            $first_month_year = date('Y-m-d', strtotime(date('Y-01-d')));

            $start_number = 0;
            $year_month_value = 11;
            $m = 'm';
            $month = 'month';
            $tp = 'm';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= $year_month_value; $i++) {
                    $months[] = date('m', strtotime(date("Y/01/01") . $inc_dec . $i . $month));
                    $monthData[] = date('m', strtotime(date("Y/01/01") . $inc_dec . $i . $month));
                }
            }
            // dd($months);
        } else {
            $first_month_year = date('Y-m-d', strtotime(date('Y-01-d')));

            $start_number = 0;
            $year_month_value = 11;
            $m = $first_month_year;
            $month = 'month';
            $tp = 'm';
            $inc_dec = "+";
            $monthData = array();

            if (count($months) == 0) {
                for ($i = 0; $i <= $year_month_value; $i++) {
                    $months[] = date('m', strtotime(date("Y/01/01") . $inc_dec . $i . $month));
                    $monthData[] = date('m/Y', strtotime(date("Y/01/01") . $inc_dec . $i . $month));
                }
            }
        }
        // dd($monthData);
        $feedBackReason = DB::table('feedback_reason')->where('feedback_id','3')->select('*')->get();

        $newMonthArray = [];
        $newYearArray = [];
        $response_array = [];
        foreach ($feedBackReason as $key => $value) {
            $monthValue = [];
            $yearValue = [];
            $response_value = [];
            foreach ($months as $keyM => $valueM) {
                $results = DB::table('feedback_rating')->where('feedback_id','3')->select('*');
                // ->whereYear('created_at', $currentYear)
                // ->whereMonth('created_at', $valueM)
                if ($time_period != null) {
                    if ($time_period == 'specific_date') {
                        if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                            $created_from = date('Y/m/d', strtotime($created_from));
                            $created_to = date('Y/m/d', strtotime($created_to));

                            $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                            // dd($results->get(),$created_from,$created_to,$months);
                            $results->whereMonth('created_at', $valueM);
                        }
                    } elseif ($time_period == 'today') {
                        $results = $results->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                    } elseif ($time_period == 'yesterday') {
                        $results = $results->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                    } elseif ($time_period == 'last_14_day') {
                        $results = $results->whereDate('created_at', $valueM);

                    } elseif ($time_period == 'this_week') {
                        $results = $results->whereDate('created_at', $valueM);

                    } elseif ($time_period == 'last_week') {
                        $results = $results->whereDate('created_at', $valueM);

                    } elseif ($time_period == 'this_month') {
                        $results = $results->whereDate("created_at", $valueM);

                    } elseif ($time_period == 'last_month') {
                        $results = $results->whereDate("created_at", $valueM);
                    } elseif ($time_period == 'this_year') {
                        $results = $results->whereMonth('created_at', $valueM)->whereYear('created_at', date('Y'));
                    } elseif ($time_period == 'last_year') {
                        $results = $results->whereMonth('created_at', $valueM)->whereYear('created_at', date('Y', strtotime("-1 Year")));

                    }
                } else {
                    $results = $results->whereYear('created_at', $currentYear)->whereMonth('created_at', $valueM);
                }
                $results = $results->where('comment', $value->feedback_reason)->count();
                $response_value[] = $results;
                // if ($total > 0) {
                //     $results = round($results * 100 / $total);
                // }
                $monthValue[] = $results;
            }
            $newMonthArray[$key]['values'] = $monthValue;
            $newMonthArray[$key]['text'] = $value->feedback_reason;
            $response_array[$key][$value->feedback_reason] = array_sum($response_value);
        }
        $monthValues = json_encode($monthData);
        $yearValues = json_encode($year);

        $this->data['response_array'] = $response_array;
        $this->data['monthValues'] = $monthValues;
        $this->data['yearValues'] = $yearValues;
        $this->data['yearValueData'] = json_encode($newYearArray);
        $this->data['monthValueData'] = json_encode($newMonthArray);

        return view('admin.feedback_survey_3.reason_chart_3', $this->data);
    }
    public function reason_chart_filter(Request $request)
    {
        if ($request->get('select_chart_by')) {
            Session::put('select_chart_by', $request->get('select_chart_by'));
        }
        Session::put('user', $request->get('user'));
        Session::put('city', $request->get('city'));
        Session::put('created_from', $request->get('created_from'));
        Session::put('created_to', $request->get('created_to'));
        Session::put('select_chart_type', $request->get('select_chart_type'));
        Session::put('time_period', $request->get('time_period'));

        $time_period = $request->get('time_period');
        $user = $request->get('user');
        $city = $request->get('city');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');
        return $this->reason_chart($user, $city, $created_from, $created_to, $time_period);

    }
    //for reason kpi report
    public function reason_report()
    {
        $question = DB::table('feedback_complains')->get();
        $user = User::pluck('name', 'id');
        $location = City::pluck('cityName', 'cityName');
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));

        $this->data['user_name'] = DB::table('users')->get();
        $this->data['time_filter'] = $time_filter;
        $this->data['location'] = $location;
        $this->data['user'] = $user;
        $this->data['question'] = $question;

        return view('admin.feedback_survey.reason_report', $this->data);
    }

    public function get_kpi_report(Request $request)
    {

        $complain_count = DB::table('feedback_rating')->select('*')->count();
        $question_survey = DB::table('feedback_rating')->select('*')->get();
        $feedback_question = DB::table('feedback_reason')->select('*')->get();

        $totalCountArr = array();
        $array = array();

        foreach ($feedback_question as $key => $value) {

            $question_rating = DB::table('feedback_rating')->select('*')->where('comment', $value->feedback_reason)->count();
            $array = array($question_rating);

            $totalCountArr[] = $array;

        }
        $feedback_question['length'] = count($feedback_question);
        $feedback_question['minimum_value'] = 0;
        $feedback_question['maximum_value'] = $complain_count;
        $this->data['reason_count'] = $feedback_question;
        $this->data['reason_value'] = $totalCountArr;

        echo json_encode($this->data);
        die();
    }

    //get question report kpi as per filter
    public function get_reason_report_kpi(Request $request)
    {
        $complain_count = DB::table('feedback_complains')->select('*')->count();
        $question_survey = DB::table('feedback_complains')->select('*')->get();
        $feedback_question = DB::table('feedback_reason')->select('*')->get();

        $totalCountArr = array();

        foreach ($feedback_question as $key => $value) {

            $question_rating = DB::table('feedback_rating')->select('*')->where('comment', $value->feedback_reason);

            if ($request->get('user') != null) {
                $question_rating = $question_rating->where('user_id', $request->get('user'));
            }
            if ($request->get('location') != null && $request->get('location') != __('message.all')) {
                $question_rating = $question_rating->where('user_city', $request->get('location'));
            }
            if ($request->get('time_filter') != null && $request->get('time_filter') != __('message.all')) {

                $time_period = $request->get('time_filter');
                $created_from = $request->get('created_from');
                $created_to = $request->get('created_to');

                if ($time_period == 'specific_date') {
                    if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                        $created_from = date('Y/m/d', strtotime($created_from));
                        $created_to = date('Y/m/d', strtotime($created_to));

                        $question_rating = $question_rating->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                    }
                } elseif ($time_period == 'today') {
                    $question_rating = $question_rating->whereDate('created_at', Carbon::now()->format('Y/m/d'));
                } elseif ($time_period == 'yesterday') {
                    $question_rating = $question_rating->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
                } elseif ($time_period == 'last_14_day') {
                    $question_rating = $question_rating->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());

                } elseif ($time_period == 'this_week') {
                    $start = Carbon::now()->startOfWeek();
                    $end = Carbon::now()->endOfWeek();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'last_week') {
                    $start = Carbon::now()->startOfWeek()->subDays(7);
                    $end = Carbon::now()->startOfWeek();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'this_month') {
                    $question_rating = $question_rating->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());

                } elseif ($time_period == 'last_month') {
                    $start = Carbon::now()->startOfMonth()->subMonth()->startOfMonth()->toDateString();
                    $end = Carbon::now()->startOfMonth()->subMonth()->endOfMonth()->toDateString();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");

                } elseif ($time_period == 'this_year') {
                    $question_rating = $question_rating->whereYear('created_at', '>=', date('Y'));
                    // dd($question_rating->get());
                } elseif ($time_period == 'last_year') {
                    $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                    $end = Carbon::now()->startOfYear()->toDateString();
                    $question_rating = $question_rating->whereRaw(" Date(created_at) between '$start' and '$end'");
                } else {
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
            $question_rating = $question_rating->count();
            $array = array($question_rating);
            $totalCountArr[] = $array;

        }
        // dd($totalCountArr);
        $feedback_question['length'] = count($feedback_question);
        $feedback_question['minimum_value'] = 0;
        $feedback_question['maximum_value'] = $complain_count;
        $this->data['reason_count'] = $feedback_question;
        $this->data['reason_value'] = $totalCountArr;

        echo json_encode($this->data);
        die();
    }
    //this section for notifiaction for compalain status
    public function notification_template()
    {
        $new = StatusNotification::where('id', 1)->first();
        $in_progress = StatusNotification::where('id', 2)->first();
        $resolve = StatusNotification::where('id', 3)->first();
        $late = StatusNotification::where('id', 4)->first();

        $this->data['new_status'] = $new ? $new->status : 0;
        $this->data['in_progress_status'] = $in_progress ? $in_progress->status : 0;
        $this->data['resolve_status'] = $resolve ? $resolve->status : 0;
        $this->data['late_status'] = $late ? $late->status : 0;

        return view('admin.feedback_survey.notification_template', $this->data);
    }
    public function view_reason_template($id)
    {
        $this->data['id'] = $id;
        $status_notification = StatusNotification::where('id', $id)->first();
        $usersDetails = User::where('user_role', 1)->pluck('name', 'id');

        $users = $status_notification ? explode(',', $status_notification->users) : null;

        $this->data['status_template'] = $status_notification ? $status_notification->status_template : '';
        $this->data['sms_template'] = $status_notification ? $status_notification->sms_template : '';
        $this->data['email_template'] = $status_notification ? $status_notification->email_template : '';
        $this->data['customer_sms_template'] = $status_notification ? $status_notification->customer_sms_template : '';
        $this->data['customer_email_template'] = $status_notification ? $status_notification->customer_email_template : '';
        $this->data['send_to_customer'] = $status_notification ? $status_notification->send_to_customer : '';
        $this->data['users'] = $users;
        $this->data['status_notification'] = $status_notification;
        $this->data['usersDetails'] = $usersDetails;

        $this->data['parameter_list'] = \DB::table('tbl_survey_form')
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get();

        return view('admin.feedback_survey.view_reason_template', $this->data);
    }
    public function save_reason_status_template(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->get('id');
            $users = $request->get('users') ? implode(',', $request->get('users')) : '';

            if (StatusNotification::where('id', $id)->first() != null) {

                StatusNotification::where('id', $id)->update([
                    'status_template' => $request->get('status_template'),
                    'sms_template' => $request->get('sms_template'),
                    'email_template' => $request->get('email_template'),
                    'users' => $users,
                    'send_to_customer' => $request->get('send_to_customer'),
                    'customer_sms_template' => $request->get('customer_sms_template'),
                    'customer_email_template' => $request->get('customer_email_template'),
                ]);

                DB::commit();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.notification') . ' ' . __('message.status') . ' ' . __('message.updated') . ' ' . __('message.successfully'));
                return redirect()->to('admin/notification_template');
            } else {
                StatusNotification::create([
                    'status_template' => $request->get('status_template'),
                    'sms_template' => $request->get('sms_template'),
                    'email_template' => $request->get('email_template'),
                    'users' => $users,
                    'send_to_customer' => $request->get('send_to_customer'),
                    'customer_sms_template' => $request->get('customer_sms_template'),
                    'customer_email_template' => $request->get('customer_email_template'),
                ]);
                DB::commit();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.notification') . ' ' . __('message.status') . ' ' . __('message.created') . ' ' . __('message.successfully'));
                return redirect()->to('admin/notification_template');
            }

        } catch (Exception $e) {
            DB::rollBack();

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());

            return redirect()->back();
        }
    }
    public function template_status(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->get('id');

            if (StatusNotification::where('id', $id)->first() != null) {

                StatusNotification::where('id', $id)->update([
                    'status' => $request->get('status'),
                ]);

                DB::commit();
                return response()->json([
                    'message' => __('message.status') . ' ' . __('message.change') . ' ' . __('message.successfully'),
                ], 200);
            } else {
                StatusNotification::create([
                    'status' => $request->get('status'),
                ]);
                DB::commit();
                return response()->json([
                    'message' => __('message.status') . ' ' . __('message.change') . ' ' . __('message.successfully'),
                ], 200);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => __('message.internal_error'),
            ], 200);
        }
    }
    public function show_table_value(Request $request)
    {
        try {
            DB::statement(DB::raw('set @rownum=0'));
            $responses = DB::table('feedback_survey')->select(DB::raw('DATE_FORMAT(created_at,"%d/%m") as date'), DB::raw('DATE(created_at) as full_date'), DB::raw('count(*) as responses'))
                ->where('feedback_id','3')
                ->groupBy('full_date')
                ->orderBy('full_date', 'desc');

            //dd($responses);
            $this->data['users'] = DB::table('users')->select('*')->get();
            $this->data['time_filter'] = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));    
            $this->data['location'] = City::pluck('cityName', 'cityName');
            if (!$request->ajax()) {
                return view('admin.feedback_survey_3.show_table_value_3', $this->data);
            }
            if($request->get('extraData')){

            $extraData = $request->input('extraData');

            $query = $this->getResponseData($extraData);
            $responses = $query;
            }
            $base_path = $this->data['base_path'];
            return Datatables::of($responses)
                ->addColumn('day', function ($row) {
                    $day = $row->date;
                    return $day;
                })
                ->addColumn('responses', function ($row) {
                    $responses = $row->responses;
                    return $responses;
                })
                ->addColumn('fantastic', function ($row) {
                    $fantastic = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->where('rating', 5)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->count();
                    $fantastic_percentage = $fantastic * 100 / $total_count;

                    return round($fantastic_percentage, 1) . '%(' . $fantastic . ')';
                })
                ->addColumn('good', function ($row) {
                    $good = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->where('rating', 4)->count();

                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->count();
                    $good_percentage = $good * 100 / $total_count;

                    return round($good_percentage, 1) . '%(' . $good . ')';
                })
                ->addColumn('average', function ($row) {
                    $average = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->where('rating', 3)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->count();
                    $average_percentage = $average * 100 / $total_count;

                    return round($average_percentage, 1) . '%(' . $average . ')';
                })
                ->addColumn('poor', function ($row) {
                    $poor = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->where('rating', 2)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->count();
                    $poor_percentage = $poor * 100 / $total_count;

                    return round($poor_percentage, 1) . '%(' . $poor . ')';
                })
                ->addColumn('very_poor', function ($row) {
                    $very_poor = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->where('rating', 1)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $row->full_date)->count();
                    $very_poor_percentage = $very_poor * 100 / $total_count;

                    return round($very_poor_percentage, 1) . '%(' . $very_poor . ')';
                })
            // ->addColumn('happy_index', function($row) {
            //         $happy_index = DB::table('feedback_survey')->whereDate('created_at',$row->full_date)->where('rating',5)->count();
            //         $total_count = DB::table('feedback_survey')->whereDate('created_at',$row->full_date)->count();
            //         $fantastic_percentage = $fantastic * 100 /$total_count;

            //         return round($fantastic_percentage,1).'%('.$fantastic.')';
            //     })
                ->rawColumns(['day', 'responses', 'fantastic'])
                ->make(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getResponseData($extraData)
    {
        //dd($extraData);
        DB::statement(DB::raw('set @rownum=0'));
            $query = DB::table('feedback_survey')->where('feedback_survey.feedback_id', '3');
                //dd($query->get());
        if (!empty($extraData['user_id']) && $extraData['user_id'] != null) {           
            $query->where('user_id', $extraData['user_id']);
        }
        if (!empty($extraData['location']) && $extraData['location'] != null) {
            $query->where('user_city', $extraData['location']);
        }
        if (!empty($extraData['time_period']) && $extraData['time_period'] != null) {

            $time_period = $extraData['time_period'];
            $created_from ='';
            $created_to = '';
            if (!empty($extraData['created_from']) && $extraData['created_from'] != null) {
                $created_from = $extraData['created_from'];
                
            }
            if (!empty($extraData['created_to']) && $extraData['created_to'] != null) {
                $created_to = $extraData['created_to'];
            }    
            //dd($time_period);
            if ($time_period == 'specific_date') {
                if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                    $created_from = date('Y/m/d', strtotime($created_from));
                    $created_to = date('Y/m/d', strtotime($created_to));

                    $query = $query->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                }
            } elseif ($time_period == 'today') {
                $query = $query->whereDate('created_at', Carbon::now()->format('Y/m/d'));
            }  elseif ($time_period == 'yesterday') {
                $query = $query->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
            } elseif ($time_period == 'last_14_day') {
                $query = $query->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
                
            } elseif ($time_period == 'this_week') {
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                $query = $query->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'last_week') {
                $start = Carbon::now()->startOfWeek()->subDays(7);
                $end = Carbon::now()->startOfWeek();
                $query = $query->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'this_month') {
                $query = $query->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());

            } elseif ($time_period == 'last_month') {
                $start = Carbon::now()->startOfMonth()->subMonth()->toDateString();
                $end = Carbon::now()->startofMonth()->subMonth()->endOfMonth()->toDateString();
                $query = $query->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'this_year') {
                $query = $query->whereYear('created_at', '>=', date('Y'));
            } elseif ($time_period == 'last_year') {
                $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                $end = Carbon::now()->startOfYear()->toDateString();
                $query = $query->whereRaw(" Date(created_at) between '$start' and '$end'");
            }else {

            }

        }
        //dd($query->get());
        return $query->select(DB::raw('DATE_FORMAT(created_at,"%d/%m") as date'), DB::raw('DATE(created_at) as full_date'), DB::raw('count(*) as responses'))
                ->groupBy('full_date')
                ->orderBy('full_date', 'desc');
    }
    public function complain_pop_up()
    {
        try {
            $selected_feedback_question = DB::table('selected_feedback_question')->first();

            $feedback_reason = FeedbackReason::get();
            //this is for complain model language
            if (isset($selected_feedback_question) && $selected_feedback_question->label_language == "english") {
                $name_label = $selected_feedback_question ? $selected_feedback_question->name_label : '';
                $email_label = $selected_feedback_question ? $selected_feedback_question->email_label : '';
                $number_label = $selected_feedback_question ? $selected_feedback_question->number_label : '';
                $comment_label = $selected_feedback_question ? $selected_feedback_question->comment_label : '';
            } else {
                $name_label = $selected_feedback_question ? $selected_feedback_question->name_label_ar : '';
                $email_label = $selected_feedback_question ? $selected_feedback_question->email_label_ar : '';
                $number_label = $selected_feedback_question ? $selected_feedback_question->number_label_ar : '';
                $comment_label = $selected_feedback_question ? $selected_feedback_question->comment_label_ar : '';
            }
            $reason_color = $selected_feedback_question ? $selected_feedback_question->reason_text_color : '';
            $align = $selected_feedback_question ? $selected_feedback_question->reason_appear : '';
            $reason_style = $selected_feedback_question ? $selected_feedback_question->reason_text_style : '';
            $text_size = $selected_feedback_question ? $selected_feedback_question->reason_font_size : '';
            $emoji_and_rating_size = $selected_feedback_question ? $selected_feedback_question->emoji_and_rating_size : '';
            $complain_header_color = $selected_feedback_question ? $selected_feedback_question->complain_header_color : '';
            $complain_button_color = $selected_feedback_question ? $selected_feedback_question->complain_button_color : '';

            $complain_button_text_color = $selected_feedback_question ? $selected_feedback_question->complain_button_text_color : '';
            $complain_button_text_size = $selected_feedback_question ? $selected_feedback_question->complain_button_text_size : '';

            $this->data['name_label'] = $name_label;
            $this->data['email_label'] = $email_label;
            $this->data['number_label'] = $number_label;
            $this->data['comment_label'] = $comment_label;
            $this->data['reason_color'] = $reason_color;
            $this->data['align'] = $align;
            $this->data['reason_style'] = $reason_style;
            $this->data['text_size'] = $text_size;
            $this->data['emoji_and_rating_size'] = $emoji_and_rating_size;
            $this->data['complain_header_color'] = $complain_header_color;
            $this->data['complain_button_color'] = $complain_button_color;
            $this->data['complain_button_text_color'] = $complain_button_text_color;
            $this->data['complain_button_text_size'] = $complain_button_text_size;
            $this->data['selected_feedback_question'] = $selected_feedback_question;

            return view('complain_pop_up', $this->data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
    public function post_complain(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'comment' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $FeedBackComplains = FeedBackComplains::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('number'),
                'comment' => $request->get('comment'),
                // 'user_id'   =>  Auth::id()
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', __('message.something_wrong'));
            return redirect()->back();
        }
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.thank') . ' ' . __('message.for') . ' ' . __('message.your') . ' ' . __('message.feedback'));

        return redirect()->back();
    }
    
}
