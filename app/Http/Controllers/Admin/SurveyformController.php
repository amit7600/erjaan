<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Type;
use App\Category;
use App\Group;
use App\Participant;
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

class SurveyformController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/admin/';
        
    }

    protected function _encrypt($moment_id){
        $A = 929323;
        $B = 239893483274;
        return ($moment_id * $A) ^ $B;
    }

    function get_survey_form_details(Request $request){
        $html = '';
        $id = $request->input('form_id');
        $survey_form_data = Surveyform::with('survey_questions.question_options')
        ->where(['is_deleted'=>0,'id'=>$id])
        ->get();

        $this->data['survey_form_header'] = $survey_form_data;

        $survey_question_data = DB::table('tbl_survey_form')
            ->join('tbl_survey_question', 'tbl_survey_question.survey_form_id', '=', 'tbl_survey_form.id')
            ->select('tbl_survey_question.survey_form_id', 
                    'tbl_survey_form.id', 'tbl_survey_form.survey_form_logo', 'tbl_survey_form.survey_form_header', 'tbl_survey_form.survey_form_footer') 
            ->where('tbl_survey_form.is_deleted', 0)
            ->where('tbl_survey_question.survey_form_id', $id)
            ->first();

        if(empty($survey_question_data)){
            $html.='<div class="row">
                        <div class="col-md-12">
                            <div class="portlet-body form">
                                <div class="form-body"
                                    <p>Please complete question and options information first.</p>
                                </div>
                            </div>
                        </div>
                    </div>';
        }else{ 

            $survey_form_link = $this->data['base_path'].'survey_form/'.$this->_encrypt($id).'/4554556564564';

            $question = 1;
                if($survey_form_data[0]->form_language_type==2){
                    $html .='<div class="adminArbln">';
                }
                $html .='<div class="backgoundImage" style=" background-image : url('.$this->data['base_path'].$survey_form_data[0]->survey_background_image.') ; background-color:'.$survey_form_data[0]->survey_background_color.' ;background-size: cover; background-repeat: no-repeat;    background-position: center; "><div class="modal-header">';
                $html .='<img style="width:60px;height:60px;float:left;" src="'.$this->data['base_path'].$survey_form_data[0]->survey_form_logo.'">';
                  $html .='  <h5 class="modal-title" style="text-align: center; color:'.$survey_form_data[0]->survey_title_color.'; font-size: '.$survey_form_data[0]->survey_title_font_size.';">'.$survey_form_data[0]->survey_form_title.'</h5><button type="button" class="close" data-dismiss="modal">&times;</button>';
                $html .='</div>';
                
                $html .='<div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="portlet-body form">
                                                <div class="form-body">';
                                                $html .='<p style="text-align:center; color:'.$survey_form_data[0]->survey_header_color.'; font-size: '.$survey_form_data[0]->survey_header_font_size.';">'.$survey_form_data[0]->survey_form_header.'</p>';
                foreach ($survey_form_data as $s) { 
                    foreach ($s->survey_questions as $survey_form) {
                            $html .='<div class="form-group">
                                        <label for="recipient-name" class="col-form-label"> <strong">'.$question.'</strong> </label> <label style="color:'.$survey_form->color.'; font-size:'.$survey_form->size.';">'.$survey_form->survey_question.'</label>';
                                    $html .='</div>';
                                        if($survey_form->question_type==1){
                                            $html .='<div class="option_val form-group">
                                                        <div class="radio-list">';    
                                            foreach ($survey_form->question_options as $survey_option) {
                                                $html .='
                                                    <label class="radio radio-primary">
                                                        <input name="optionsRadios" id="optionsRadios'.$survey_option->id.'" type="radio">
                                                        <span>'.$survey_option->survey_option_title.'</span><span class="option_lang">('.$survey_option->option_point.')</span> <br>
                                                        <span class="checkmark"></span>
                                                    </label>  ';
                                            }
                                            $html .='</div>
                                                </div>';

                                        }

                                        if($survey_form->question_type==2){
                                        $html .='<div class="option_val form-group">
                                                    <div class="checkbox-list">';
                                                    foreach ($survey_form->question_options as $survey_option) {
                                                        $html .='<label class="checkbox checkbox-primary">
                                                            <input type="checkbox" name="checkbox[]">
                                                            <span>'.$survey_option->survey_option_title.'</span><span class="option_lang"> ('.$survey_option->option_point.')</span> <br>
                                                            <span class="checkmark"></span>
                                                        </label> ';
                                                    }
                                                $html .='</div>
                                                </div>';

                                        }

                                        if($survey_form->question_type==3){
                                            //foreach ($survey_form->question_options as $survey_option) {
                                                $html .='<div class="option_val form-group col-md-10">';
                                                // $html .='<label>'.$survey_option->survey_option_title.'</label> ('.$survey_option->option_point.')';
                                                $html .='<input type="text" class="form-control" name="textbox[]">';
                                                $html .='</div>';
                                                $html .='<div style="clear:both"></div>';
                                            //}

                                        }

                                        if($survey_form->question_type==4){   
                                            //foreach ($survey_form->question_options as $survey_option) {
                                                $html .='<div class="option_val form-group col-md-10">';
                                                // $html .='<label>'.$survey_option->survey_option_title.'</label> ('.$survey_option->option_point.')';
                                                $html .='<textarea class="form-control" name="survey_option[]"> </textarea>';
                                                $html .='</div>';
                                                $html .='<div style="clear:both"></div>';
                                           // }
                                            
                                        }
                                        if($survey_form->question_type==5){
                                            
                                            //foreach ($survey_form->question_options as $survey_option) {
                                                $html .='<div class="option_val form-group col-md-10">';
                                                // $html .='<label>'.$survey_option->survey_option_title.'</label> ('.$survey_option->option_point.')';
                                                $html .='*****';
                                                $html .='</div>';
                                                $html .='<div style="clear:both"></div>';
                                            //}
                                            
                                        }

                                    $question++;
                                }
                            }
                            $html .='<div class="form-group"> 
                                        <div class="row">
                                            <div class="col-md-12"> 
                                                <div class="col-md-10">                   
                                                    
                                                    <input type="hidden" class="form-control" readonly="readonly" id="copyLink" value="'.$survey_form_link.'"> 
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="recipient-name" class="col-form-label">&nbsp;</label>
                                                    
                                                </div>
                                            <div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p style="text-align:center; color:'.$survey_form_data[0]->survey_footer_color.'; font-size: '.$survey_form_data[0]->survey_footer_font_size.';">'.$survey_form_data[0]->survey_form_footer.'</p>
                    </div>';
                    
            if($survey_form_data[0]->form_language_type==2){
                $html .='</div></div>';
            }              
        
                    

        }

        echo json_encode($html);
        die();
            
        
    }
    

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) { 
        $login_user = Auth::user();
        
        $this->data['page_title'] = "Survey Management";
        
        if (!$request->ajax()) {
            return view('admin.surveyform.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_form_data = DB::table('tbl_survey_form')
            ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc');
          
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_form_data)
            ->addColumn('action', function($row) {
                $edit_url = route('surveyform.edit', $row->id);
                $delete_url = route('surveyform.destroy', $row->id);
                $details_url = route('surveyform.show', $row->id);
                $view_report_url = route('report.show', $row->id);

                $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                $links .= '<a title="View Survey Form Details" rel="'.$row->id.'" href="javascript:void(0)" class="text-info mr-2 text-25 more-details"><i class="i-Magnifi-Glass1 nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                $links .= '<a title="View Survey Form Report" href="'.$view_report_url.'" class="btn btn-primary"><i class="i-Magnifi-Glass1 nav-icon font-weight-bold" aria-hidden="true"></i> '.__('message.survey_reports').' </a>';
                return $links;
            })

            ->editColumn('survey_form_logo', function($row) use ($base_path) {
                $image = $row->survey_form_logo;
                $image = !empty($image) ? $image : "";
                if (!file_exists($image)) {
                    $image = "images/no_image.png";
                }
                $image = $base_path . $image;
                $img_tag = '<img src="' . $image . '" alt="" width="30" height="30"/>';
                return $img_tag;
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
            ->rawColumns(['survey_form_logo', 'action'])
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
        return view('admin.surveyform.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyFormRequest $request) {
            // dd($request);
        try {
                DB::beginTransaction();
                $login_user = Auth::user();
                $survey_form = new Surveyform;
                if (!empty(Input::file('survey_form_logo')) && Input::file('survey_form_logo')->getError() == 0) {

                    if (!empty($survey_form->survey_form_logo) && file_exists($user->survey_form_logo)) {
                        unlink($survey_form->survey_form_logo);
                    }

                    $image = new MediaUploadLib();
                    $path = public_path('uploads/survey_form_logo');
                    list($fileNameImg, $size) = $image->fileUpload(Input::file('survey_form_logo'), $path, '', '');
                    $survey_form->survey_form_logo = 'uploads/survey_form_logo/' . $fileNameImg;
                }
                
                if (!empty(Input::file('survey_form_background')) && Input::file('survey_form_background')->getError() == 0) {

                    if (!empty($survey_form->survey_background_image) && file_exists($user->survey_background_image)) {
                        unlink($survey_form->survey_background_image);
                    }

                    $image = new MediaUploadLib();
                    $path = public_path('uploads/survey_form_logo');
                    list($fileNameImg, $size) = $image->fileUpload(Input::file('survey_form_background'), $path, '', '');
                    $survey_form->survey_background_image = 'uploads/survey_form_logo/' . $fileNameImg;
                }

                // font backgound and question
                $survey_form->survey_background_color = $request->input('survey_background_color');
                // $survey_form->survey_question_font_size = $request->input('survey_question_font_size');
                // $survey_form->survey_question_font_color = $request->input('survey_question_color');

                $survey_form->form_language_type = $request->input('form_language_type');
                $survey_form->survey_form_title = $request->input('survey_form_title');
                $survey_form->survey_form_header = $request->input('survey_form_header');
                $survey_form->survey_form_footer = $request->input('survey_form_footer');

                // font size

                $survey_form->survey_title_font_size = $request->input('survey_title_font_size');
                $survey_form->survey_header_font_size = $request->input('survey_header_font_size');
                $survey_form->survey_footer_font_size = $request->input('survey_footer_font_size');

                // font color

                $survey_form->survey_title_color = $request->input('survey_title_color');
                $survey_form->survey_title_background_color = $request->input('survey_title_background_color');
                $survey_form->survey_header_color = $request->input('survey_header_color');
                $survey_form->survey_footer_color = $request->input('survey_footer_color');

                $survey_form->user_id = $login_user->id;
                $survey_form->save();
                $form_id = $survey_form->id;

                $question_count = count($request->input('survey_question'));
                for($i=0; $i < $question_count; $i++){
                    $question = new SurveyQuestion;
                    $question->survey_form_id = $form_id;
                    $question->survey_question = $request->input('survey_question')[$i];
                    $question->user_id = $login_user->id;
                    $question->color = $request->input('survey_question_color')[$i] ? $request->input('survey_question_color')[$i] : null;
                    $question->size = $request->input('survey_question_font_size')[$i] ? $request->input('survey_question_font_size')[$i] : null;
                    $question->question_type = $request->input('question_type')[$i];

                    if($request->input('question_type')[$i] == 6 ){
                            $question->emoji_rating_5 = $request->input('emoji_rating_5')[$i];
                            $question->emoji_name_5 = $request->input('emoji_name_5')[$i];
                            $question->emoji_rating_4 = $request->input('emoji_rating_4')[$i];
                            $question->emoji_name_4 = $request->input('emoji_name_4')[$i];
                            $question->emoji_rating_3 = $request->input('emoji_rating_3')[$i];
                            $question->emoji_name_3 = $request->input('emoji_name_3')[$i];
                            $question->emoji_rating_2 = $request->input('emoji_rating_2')[$i];
                            $question->emoji_name_2 = $request->input('emoji_name_2')[$i];
                            $question->emoji_rating_1 = $request->input('emoji_rating_1')[$i];
                            $question->emoji_name_1 = $request->input('emoji_name_1')[$i];
                        
                    }

                    $question->created_at = date('Y-m-d');
                    $question->save();
 
                    //Question type 3 Textbox and Question type 5 will not need option
                    $question_type_exclude = array('3','5');
                    if(in_array($request->input('question_type')[$i],$question_type_exclude)){
                        continue;
                    }

                    $option_count = $request->has('survey_option_title_'.($i+1)) ? count($request->input('survey_option_title_'.($i+1))) : 0;

                    for($j=0; $j < $option_count; $j++){

                        if($request->input('option_point')[$j]==""){
                            $option_point = 3;
                        }else{
                            $option_point = $request->input('option_point')[$j];
                        }

                        $survey_option = new SurveyOption;        
                        $survey_option->question_id = $question->id;
                        $survey_option->user_id = $login_user->id;
                        if (!empty($request->input('survey_option_title_'.($i+1)))) {
                            $survey_option->survey_option_title = $request->input('survey_option_title_'.($i+1))[$j];
                        } else {
                            $survey_option->survey_option_title = '';
                        }
                        $survey_option->option_point = $option_point;
                        $survey_option->created_at = date('Y-m-d');
                        $survey_option->save();
                    }
                }


                if ($form_id) {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.content', __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.created').' '.__('message.successfully'));
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
                }
                DB::commit();
                return redirect()->route('surveyform.index');
            } catch (\Exception $e) {
                dd($e);
                DB::rollBack();
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', __('message.internal.error'));
                return redirect()->back()->withInput();
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $login_user = Auth::user();
        $this->data['survey_form_data'] = DB::table('tbl_survey_form')
            ->join('tbl_survey_question', 'tbl_survey_question.survey_form_id', '=', 'tbl_survey_form.id')
            ->join('tbl_survey_options', 'tbl_survey_question.id', '=', 'tbl_survey_options.question_id')
            ->select('tbl_survey_options.*','tbl_survey_question.survey_form_id','tbl_survey_question.*','tbl_survey_question.question_type', 'tbl_survey_form.form_language_type', 'tbl_survey_form.survey_form_title', 'tbl_survey_form.id as form_id')
            ->where('tbl_survey_form.is_deleted', 0)
            ->where('tbl_survey_form.id', $id)
            ->first();

        if (empty($this->data['survey_form_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('surveyform.index');
        }
        return view('admin.surveyform.form_details', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id) {
        $login_user = Auth::user();
        // $this->data['repairman_data'] = DB::table('tbl_types')->select('*')->where('is_deleted', 0)->get();
        $this->data['repairman_data'] = Surveyform::with('survey_questions.question_options')
        ->where(['is_deleted'=>0,'id'=>$id])
        ->get();
        
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('surveyform.index');
        }
        return view('admin.surveyform.edit_survey_form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurveyFormRequest $request, $id) {
        //echo "<pre>"; print_r($_POST)
        try {
                DB::beginTransaction();
                $question_id = $request->input('survey_question_id');
                $login_user = Auth::user();
                $survey_form = Surveyform::find($id);
                if(empty($survey_form)){
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
                    return redirect()->route('surveyform.index');
                }
                

                if (!empty(Input::file('survey_form_logo')) && Input::file('survey_form_logo')->getError() == 0) {

                    if (!empty($survey_form->survey_form_logo) && file_exists($survey_form->survey_form_logo)) {
                        unlink($survey_form->survey_form_logo);
                    }

                    $image = new MediaUploadLib();
                    $path = public_path('uploads/survey_form_logo');
                    list($fileNameImg, $size) = $image->fileUpload(Input::file('survey_form_logo'), $path, '', '');
                    $survey_form->survey_form_logo = 'uploads/survey_form_logo/' . $fileNameImg;
                }else{
                    $survey_form->survey_form_logo = $request->input('hidden_survey_form_logo');
                }


                // survey Image
                if (!empty(Input::file('survey_form_background')) && Input::file('survey_form_background')->getError() == 0) {

                    if (!empty($survey_form->survey_background_image) && file_exists($survey_form->survey_background_image)) {
                        unlink($survey_form->survey_background_image);
                    }

                    $image = new MediaUploadLib();
                    $path = public_path('uploads/survey_form_logo');
                    list($fileNameImg, $size) = $image->fileUpload(Input::file('survey_form_background'), $path, '', '');
                    $survey_form->survey_background_image = 'uploads/survey_form_logo/' . $fileNameImg;
                }else{
                    $survey_form->survey_background_image = $request->input('hidden_survey_form_background');
                }

                // font backgound and question
                $survey_form->survey_background_color = $request->input('survey_background_color');
                /*$survey_form->survey_question_font_size = $request->input('survey_question_font_size');
                $survey_form->survey_question_font_color = $request->input('survey_question_color');*/


                $survey_form->form_language_type = $request->input('form_language_type');
                $survey_form->survey_form_title = $request->input('survey_form_title');
                $survey_form->survey_title_background_color = $request->input('survey_title_background_color');
                $survey_form->survey_form_header = $request->input('survey_form_header');
                $survey_form->survey_form_footer = $request->input('survey_form_footer');
                // font size

                $survey_form->survey_title_font_size = $request->input('survey_title_font_size');
                $survey_form->survey_header_font_size = $request->input('survey_header_font_size');
                $survey_form->survey_footer_font_size = $request->input('survey_footer_font_size');

                // font color

                $survey_form->survey_title_color = $request->input('survey_title_color');
                $survey_form->survey_header_color = $request->input('survey_header_color');
                $survey_form->survey_footer_color = $request->input('survey_footer_color');

                $survey_form->user_id = $login_user->id;
                $survey_form->save();
                $form_id = $survey_form->id;

                // $question_count = $request->input('survey_question_id');
                $question_count = $request->input('survey_question');
                SurveyQuestion::where('survey_form_id', $form_id)->delete();
                for($i=0; $i< count($question_count); $i++){
                    $question = new SurveyQuestion;  

                    $question->survey_form_id = $form_id;
                    $question->survey_question = $request->input('survey_question')[$i];
                    $question->user_id = $login_user->id;
                    $question->question_type = $request->input('question_type')[$i];
                    $question->color = $request->input('survey_question_color')[$i] ? $request->input('survey_question_color')[$i] : null;
                    $question->size = $request->input('survey_question_font_size')[$i] ? $request->input('survey_question_font_size')[$i] : null;


                    if($request->input('question_type')[$i] == 6 ){
                            $question->emoji_rating_5 = $request->input('emoji_rating_5')[$i];
                            $question->emoji_name_5 = $request->input('emoji_name_5')[$i];
                            $question->emoji_rating_4 = $request->input('emoji_rating_4')[$i];
                            $question->emoji_name_4 = $request->input('emoji_name_4')[$i];
                            $question->emoji_rating_3 = $request->input('emoji_rating_3')[$i];
                            $question->emoji_name_3 = $request->input('emoji_name_3')[$i];
                            $question->emoji_rating_2 = $request->input('emoji_rating_2')[$i];
                            $question->emoji_name_2 = $request->input('emoji_name_2')[$i];
                            $question->emoji_rating_1 = $request->input('emoji_rating_1')[$i];
                            $question->emoji_name_1 = $request->input('emoji_name_1')[$i];
                        
                    }

                    $question->created_at = date('Y-m-d');
                    $question->save();
                    $question_id = $question->id;

                    $option_count = $request->input('survey_option_title_'.$question_count[$i]);
                    $option_point_array = $request->input('option_point_'.$question_count[$i]);

                     //Question type 3 Textbox and Question type 5 will not need option
                    $question_type_exclude = array('3','5');
                    if(in_array($request->input('question_type')[$i],$question_type_exclude)){
                        continue;
                    }
                    $count_option = 0;
                    if ($option_count != null) {
                        $count_option = count($option_count);
                    }
                    for($j=0; $j < $count_option; $j++){
                        
                        $option_point = '';
                        
                        SurveyOption::where('question_id', $question_count[$i])->delete();
                        $survey_option = new SurveyOption; 
                        $option_name = $option_count[$j]; 

                        if($option_point_array[$j]==""){
                            $request->session()->flash('message.level', 'danger');
                            $request->session()->flash('message.content', 'Please enter required fields.');
                            //$option_point->option_point = 3;
                            return redirect()->route('surveyform.edit', $form_id);
                            
                        }else{
                            //$option_point->option_point = $option_point_array[$j];@Commented By Shailendra
                            $option_point = $option_point_array[$j];
                        }
                        
                        $survey_option->question_id = $question->id;     
                        $survey_option->user_id = $login_user->id;
                        $survey_option->survey_option_title = $option_name ? $option_name : 0;
                        $survey_option->option_point = $option_point;
                        $survey_option->created_at = date('Y-m-d');
                        $survey_option->save();
                   }
                }
               
                if ($form_id) {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.updated').' '.__('message.successfully'));
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content',  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
                }
            DB::commit();
                return redirect()->route('surveyform.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.internal_error'));
        }
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

        $survey = Surveyform::find($id);
        $response = array('status' => true, 'message' =>  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($survey)) {
            $response = array('status' => false, 'message' =>  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        } else {
            $survey->is_deleted = 1;
            $survey->save();
        }
        echo json_encode($response);
        die();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSurveyOption(Request $request) {
        $id = $request->input('option_id');
        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $response = SurveyOption::where('id', $id)->delete();
        if (empty($response)) {
            $response = array('status' => false, 'message' =>  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        } else {
            $response = array('status' => true, 'message' =>  __('message.survey').' '.__('message.option').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        }
        echo json_encode($response);
        die();
    }//END deleteSurveyOption()



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSurveyQuestion(Request $request) {
        $id = $request->input('id');
        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $response = SurveyQuestion::where('id', $id)->delete();
        if (empty($response)) {
            $response = array('status' => false, 'message' =>  __('message.survey').' '.__('message.form').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        } else {
            $response = SurveyOption::where('id', $id)->delete();
            $response = array('status' => true, 'message' =>  __('message.survey').' '.__('message.option').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        }
        echo json_encode($response);
        die();
    }//END deleteSurveyQuestion()


    


    function check_user_role()
    {
        if(Auth::user()->user_role==2){
            echo "Access Denied";
            die;
        }
    }


    /*
    * Get data of particpiant in send maual
    */

    function getDataManual($extraData)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $query = DB::table('tbl_participants')
            ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc');
        
        if(!empty($extraData['category_id'])){
            $query->where('category_id',$extraData['category_id']);
        }

        if(!empty($extraData['sub_category_id'])){
            $query->where('sub_category_id',$extraData['sub_category_id']);
        }

        if(!empty($extraData['location_id'])){
            $query->where('location_id',$extraData['location_id']);
        }

        if(!empty($extraData['group_id'])){
            $query->where('group_id',$extraData['group_id']);
        }

        if(!empty($extraData['type_id'])){
            $query->where('type_id',$extraData['type_id']);
        }

        if(!empty($extraData['gender'])){
            $query->where('gender',$extraData['gender']);
        }

        if(!empty($extraData['search_filter_value'])){
            $query->where(function($q) use ($extraData){
                $q->where(DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'),'like',"%".$extraData['search_filter_value']."%");
                $q->orWhere('email',$extraData['search_filter_value']);
                $q->orWhere('mobile',$extraData['search_filter_value']);
            });
        }
        return $query;
    }
    
    /*
    * 
    */
    function sendSurveyManual(Request $request)
    {
        $login_user = Auth::user();

        $this->data['page_title'] = "Send Survey To Participant";
        $this->data['on_behalf'] = Setting::where('setting_key','on_behalf_of')->first();
        if (!$request->ajax()) {
            
            $this->data['category'] = Category::Select('id', 'category_name')
            ->where('parent_id',0)
            ->where('is_deleted',0)
            ->get();
            $this->data['group'] = Group::Select('id', 'group_name')->get();
            $this->data['type'] = Type::Select('id', 'type_name')->get();
            $this->data['country'] = Country::Select('id', 'name')->get();
            $this->data['survey_form_data'] = Surveyform::select('id','survey_form_title')
            ->where(['is_deleted'=>0])
            ->orderBy('id','DESC')
            ->get();
            return view('admin.survey.send_survey_to_participant', $this->data);
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
                "<label class='checkbox checkbox-primary'>
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
            ->rawColumns(['first_name', 'action','checkbox'])
            ->make(true);
    }

    /*
    * Send Survey to participant
    */ 

    function sendSurveyToParticipant(Request $request)
    {   
        $params = $request->input('params');        
        $participant = array();


        if($params['send_all']==1){
            $query = $this->getDataManual($params);
            $participant = $query->get();
        }else if(!empty($params['survey'])){

            $participant = Participant::whereIn('id',$params['survey'])->get();
        }


        $this->sendNotifyToParticipant($params,$participant);

        
    }

    function sendNotifyToParticipant($params,$participant)
    {
        
        // dd($params,$participant);
        $count = 0;
        $temp_id = $params['template'];
        $email_type = $params['email_type'];        
        if($email_type==1){ // for send sms
            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title', 'content')
                            ->where('id',$temp_id)
                            ->first();
            
            $domainName = $_SERVER['SERVER_NAME'];
            
            $sender_id = CommonHelper::getSettingByKey('sender_id'); 
            $user_account = CommonHelper::getSettingByKey('user_account'); 
            $user_password = CommonHelper::getSettingByKey('user_password'); 
            $parameterList = \DB::table('tbl_survey_form')
                            ->where('status', 1)
                            ->where('is_deleted', 0)
                            ->get();
            $ids = [];
            $contentData = $template->content;
            foreach($participant as $row){
                $token = md5(time());
                $to_number = $params['on_behalf']==2?$row->dial_code.$row->mobile:$row->dial_code.$row->on_behalf_mobile;
                // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $row->first_name, $contentData);

                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');

                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{
                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row->id).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/';

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }
                $message_content = $template->content;
                $msg = $message_content;//." ".$data->url;
                //$msg .= "Click above link to open the survey form.";
                $MsgID = rand(1,99999);

                $message_body = array("userAccount"=> $user_account->setting_value,
                          "passAccount"=> $user_password->setting_value,
                          "numbers"=> $to_number,
                          "sender"=> $sender_id->setting_value,
                          "msg"=> $msg,
                          "timeSend"=> 0,
                          "dateSend"=> 0,
                          "applicationType"=> '68',
                          "domainName"=> $domainName,
                          "MsgID"=> $MsgID,
                          "deleteKey"=> 0
                );

                $send_sms_status = $send_sms->sendSMS($message_body);

                if(!empty($send_sms_status)){
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 1)
                            ->where('user_id', $params['auth_id'])
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $row->id, 'token'=>$token, 'sms_email' => 1, 'user_id' => $params['auth_id']);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }

                }else{
                    //notify to admin
                }
            }  

        // here is remaining code for send sms api use
        }else{
            $template = EmailTemplate::Select('id', 'title', 'content')
                            ->where('id',$temp_id)
                            ->first();
            // $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($params['survey_id']);
            $ids = [];
            $contentData = $template->content;
            foreach($participant as $row){
                $token = md5(time());

                $mail = new SendEmailLib;
                $to = $params['on_behalf']==2?$row->email:$row->on_behalf_email;
                // set the dynamic username to the sms content
                $template->content = str_replace('(participant_name)', $row->first_name, $contentData);
                // foreach ($parameterList as $key => $value) {
                //     $template->content = str_replace('(' . strtolower(str_replace(' ', '_', $value->survey_form_title)) . ')', $value->survey_form_title, $template->content);    
                // }
                // count how many '(survey_' in the content
                $countSurveyIn = substr_count($template->content, '(survey_');
                // check $countSurveyIn in 0 or grater
                if ($countSurveyIn > 0) {

                    // loop for replace string in th content 
                    for ($i=0; $i <= $countSurveyIn; $i++) {

                        $fullstring = $template->content;
                        
                        //$parsed = get_string_between($fullstring, '[tag]', '[/tag]');
                        $string = ' ' . $fullstring;
                        $start = '(';
                        $end = ')';
                        $ini = strpos($string, $start);
                        if ($ini == 0) break;
                        $ini += strlen($start);
                        $len = strpos($string, $end, $ini) - $ini;
                        $searchResult = substr($string, $ini, $len);
                        
                        if($searchResult == 'complainPopUp'){
                            $link = $this->data['base_path'].'admin/complain_pop_up';
                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($link).'&format=json';

                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(complainPopUp)', $data->data->url, $template->content);
                        }else{
                            $expl = explode('_', $searchResult);
                            array_push($ids, $expl[1]);
                            $link = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);
                            // survey link url
                            $params['survey_form_link'] = $this->data['base_path'].'survey_form/'.$this->_encrypt($expl[1]);

                            // modeified link
                            $longUrl = $link."/".$this->_encrypt($row->id).'/'.$this->_encrypt($params['on_behalf']).'/'.$token.'/'.$this->_encrypt(0);

                            $url = 'http://api.bit.ly/v3/shorten?login=o_81ghdjdmv&apiKey=R_a10411cd21ab40bdbadce6c37cc9d960&uri='.urlencode($longUrl).'&format=json';
                            $ch = curl_init();
                            $timeout = 5;
                            curl_setopt($ch,CURLOPT_URL,$url);
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                            $data = curl_exec($ch);
                            
                            curl_close($ch);
                            $data = json_decode($data);
                            $template->content = str_replace('(survey_' . $expl[1] . ')', $data->data->url, $template->content);
                        }
                    }                    
                }
                if(!empty($to)){
                    $subject = $template->title;
                    $message = $template->content;
                    $message.= "<br>Thanks, <br> Digital Survey Team";
                    $test = $mail->sendEmail($to,$subject,$message);
                    $count++;
                    foreach ($ids as $key => $value) {
                        $survey_count = DB::table('tbl_survey_count')
                            ->select('token') 
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->where('is_submitted_send', 1)
                            ->where('sms_email', 2)
                            ->where('user_id', $params['auth_id'])
                            ->first();

                        if($survey_count){
                            DB::table('tbl_survey_count')
                            ->where('form_id', $value)
                            ->where('participant_id', $row->id)
                            ->update(['token' => $token]);
                        }else{
                            $values = array('form_id' => $value,'participant_id' => $row->id, 'token'=>$token, 'sms_email' => 2, 'user_id' => $params['auth_id']);
                            DB::table('tbl_survey_count')->insert($values);
                        }
                    }

                }
            }                
        }

        
        $response = array('status'=>true,'message'=> __('message.survey').' '.__('message.send').' '.__('message.successfully').' '.__('message.to').$count.__('message.users'));
        if(empty($count)){
            $response = array('status'=>false,'message'=>'Participant not found for sending survey Email/SMS. Please select other filter option.');
        }
        
        echo json_encode($response);
        exit();
    }



    function reSendNotifyToParticipant(Request $request)
    {
        $params = $request->input('params');

        $temp_id = $params['template'];
        $email_type = $params['email_type'];

        $participant = Participant::where('id',$params['participant_id'])->first();
        
        if($email_type==1){ // for send sms
           
            $send_sms = new SendSMSLib;

            $template = SMSTemplate::Select('id', 'title', 'content')
                            ->where('id',$temp_id)
                            ->first();

            $domainName = $_SERVER['SERVER_NAME'];
            
            $sender_id = CommonHelper::getSettingByKey('sender_id'); 
            $user_account = CommonHelper::getSettingByKey('user_account'); 
            $user_password = CommonHelper::getSettingByKey('user_password'); 
           
            foreach($participant as $row){
                $token = md5(time());
                $to_number = $params['on_behalf']==2?$row->dial_code.$row->mobile:$row->dial_code.$row->on_behalf_mobile;
                $sender_name = $row->first_name." ".$row->last_name.",  ".$template->content;

                $msg = $sender_name." ".$params['survey_form_link']."/".$this->_encrypt($row->id).'/'.$this->_encrypt($params['on_behalf']).'/'.$token ;
                $MsgID = rand(1,99999);

                $message_body = array("userAccount"=> $user_account->setting_value,
                          "passAccount"=> $user_password->setting_value,
                          "numbers"=> $to_number,
                          "sender"=> $sender_id->setting_value,
                          "msg"=> $msg,
                          "timeSend"=> 0,
                          "dateSend"=> 0,
                          "applicationType"=> '68',
                          "domainName"=> $domainName,
                          "MsgID"=> $MsgID,
                          "deleteKey"=> 0
                );

                $send_sms = $send_sms->sendSMS($message_body);

                if(!empty($send_sms)){
                    $survey_count = DB::table('tbl_survey_count')
                        ->select('token') 
                        ->where('form_id', $params['survey_id'])
                        ->where('participant_id', $row->id)
                        ->where('is_submitted_send', 1)
                        ->where('sms_email', 1)
                        ->where('user_id', $params['auth_id'])
                        ->first();

                    if($survey_count){
                        DB::table('tbl_survey_count')
                        ->where('form_id', $params['survey_id'])
                        ->where('participant_id', $row->id)
                        ->update(['token' => $token]);
                    }else{
                        $values = array('form_id' => $params['survey_id'],'participant_id' => $row->id, 'token'=>$token, 'sms_email' => 1, 'user_id' => $params['auth_id']);
                        DB::table('tbl_survey_count')->insert($values);
                    }

                }else{
                    //notify to admin
                }
            }                  

        // here is remaining code for send sms api use
        }else{
            $template = EmailTemplate::Select('id', 'title')
                            ->where('id',$temp_id)
                            ->first();

                $token = md5(time());

                $mail = new SendEmailLib;
                $to = $params['on_behalf']==2? $participant->email:$participant->on_behalf_email;
                $survey_form_link = $this->data['base_path'].'survey_form/'.$this->_encrypt($params['survey_id']);
                
                if(!empty($to)){
                    $subject = $template->title;
                    $message = "Hello ".$participant->first_name." ".$participant->last_name." ,<br>";
                    $message.= "Please submit survey on below link <br>";
                    $message.= '<a href="'.$survey_form_link."/".$this->_encrypt($participant->id).'/'.$this->_encrypt(['on_behalf']).'/'.$token.'"> Click Here </a> For submit survey information, Or Copy bellow link and use <br>'. $survey_form_link."/".$this->_encrypt($participant->id).'/'.$this->_encrypt(['on_behalf']).'/'.$token;
                    $message.= "<br>Thanks, <br> Digital Survey Team";
                    $send_link = $mail->sendEmail($to,$subject,$message);
                    
                    $survey_count = DB::table('tbl_survey_count')
                        ->select('token') 
                        ->where('form_id', $params['survey_id'])
                        ->where('participant_id', $participant->id)
                        ->where('is_submitted_send', 1)
                        ->where('sms_email', 2)
                        ->where('user_id', $params['auth_id'])
                        ->first();

                    if($survey_count){
                        DB::table('tbl_survey_count')
                        ->where('form_id', $params['survey_id'])
                        ->where('participant_id', $participant->id)
                        ->update(['token' => $token]);
                    }else{
                        $values = array('form_id' => $params['survey_id'],'participant_id' => $participant->id, 'token'=>$token, 'sms_email' => 2, 'user_id' => $params['auth_id']);
                        DB::table('tbl_survey_count')->insert($values);
                    }

                }           
        }

        
        $response = array('status'=>true,'message'=>'Survey send successfully users');
        if(empty($send_link)){
            $response = array('status'=>false,'message'=>'Participant not found for sending survey Email/SMS. Please select other filter option.');
        }
        
        echo json_encode($response);
        exit();
    }//END reSendNotifyToParticipant()


    /*======================================
    * Send Survey to participant
    */ 

    public function autoTriggerSetting()
    {  
        $this->data['auto_trigger_data'] = "";
        $this->data['page_title'] = "Auto Trigger Setting"; 
        $this->data['category'] = Category::Select('id', 'category_name')
                ->where('parent_id',0)
                ->where('is_deleted',0)
                ->get();
            $this->data['group'] = Group::Select('id', 'group_name')->get();
            $this->data['type'] = Type::Select('id', 'type_name')->get();
            $this->data['country'] = Country::Select('id', 'name')->get();
            $this->data['survey_form_data'] = Surveyform::select('id','survey_form_title')
            ->where(['is_deleted'=>0])
            ->orderBy('id','DESC')
            ->get();

        $this->data['auto_trigger_data'] = DB::table('tbl_auto_trigger_setting')
                        ->select('*') 
                        ->where('id', 1)
                        ->first();

        return view('admin.survey.auto_trigger_seting', $this->data);
    }// END autoTriggerSetting()


    /*======================================
    * Send Survey to participant
    */ 

    public function saveAutoTriggerSetting(Request $request)
    {  
        $id = $request->input('sending_id');
        $sending_method = $request->input('sending_method');
        $on_behalf = $request->input('on_behalf');
        $survey_form_id = $request->input('survey_form_id');
        $waiting_time = $request->input('waiting_time');
        $group_id = $request->input('group_id');
        $location_id = $request->input('location_id');
        $sub_category_id = $request->input('sub_category_id');
        $category_id = $request->input('category_id');
        $type_id = $request->input('type_id');
        $template_dropdown = $request->input('template_dropdown');
        $setting_data = array("type_id"=> $type_id, 
                              "category_id"=> $category_id, 
                              "sub_category_id"=> $sub_category_id, 
                              "group_id"=> $group_id, 
                              "email_templ_id"=> $template_dropdown, 
                              "sending_method"=> $sending_method, 
                              "form_id"=> $survey_form_id, 
                              "location_id"=> $location_id,
                              "send_to"=> $on_behalf, 
                              "waiting_hours"=> $waiting_time
                        );
        if($id>0){
            DB::table('tbl_auto_trigger_setting')->where('id', $id)->update($setting_data);
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', __('message.survey').' '.__('message.auto').' '.__('message.trigger').' '.__('message.setting').' '.__('message.updated').' '.__('message.successfully'));
                return redirect()->route('survey.auto_trigger_setting');
        }else{
            DB::table('tbl_auto_trigger_setting')->insert($setting_data);
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content',  __('message.survey').' '.__('message.auto').' '.__('message.trigger').' '.__('message.setting').' '.__('message.save').' '.__('message.successfully'));
                return redirect()->route('survey.auto_trigger_setting');
        }
    }

}
