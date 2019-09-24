<style type="text/css">
    .myoption {
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }

    .highcharts-credits {
        display: none;
    }
</style>

@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

@stop
{{-- Page content --}}
@section('inner_body')

<script src="{{asset('admin_css/assets/js/pie_chart/loader.js')}}"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div class="breadcrumb">
    <h1>Filter Participants For View Survey Report</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-lg-12 mb-3">
        @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-card alert-danger">
            <strong class="text-capitalize">{{$error}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @break
        @endforeach
        @endif

        @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}">
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!--begin::form 2-->
        <form name="survey_report_form" method="post" action="{{route('get_survey_report',Request::segment(3))}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{$survey_form_data[0]->survey_form_title}}</h3>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="name"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Type <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="type_id" name="type_id">
                                            @foreach ($type as $row)
                                            <option <?php if(Session::get('type_id')==$row->id){ echo "selected"; } ?>
                                                value="{{ $row->id }}">{{$row->type_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="business_name"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Group <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="group_id" name="group_id">
                                            <option value="0">Select Group</option>
                                            @foreach ($group as $row)
                                            <option <?php if(Session::get('group_id')==$row->id){ echo "selected"; } ?>
                                                value="{{ $row->id }}">{{$row->group_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Category <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="category_id" name="category_id">
                                            <option value="0">Select Category</option>
                                            @foreach ($category as $row)
                                            <option
                                                <?php if(Session::get('category_id')==$row->id){ echo "selected"; } ?>
                                                value="{{ $row->id }}">{{$row->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Sub Category <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="sub_category_id"
                                            name="sub_category_id">
                                            <option value="0">Select Sub Category</option>
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    From <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <input name="created_from"
                                            value="<?php if(Session::get('created_from')){ echo Session::get('created_from'); } ?>"
                                            readonly type="text" class="form-control has-feedback-left" id="single_cal5"
                                            placeholder="From Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Calendar-4"></i>
                                        </span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    To <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <input name="created_to"
                                        value="<?php if(Session::get('created_to')){ echo Session::get('created_to'); } ?>"
                                        readonly type="text" class="form-control has-feedback-left" id="single_cal4"
                                        placeholder="To Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Calendar-4"></i>
                                    </span>
                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Chart Type <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="select_chart_type"
                                            name="select_chart_type">
                                            <option
                                                <?php if(Session::get('select_chart_type')==1){ echo "selected"; } ?>
                                                value="1">Pie Chart</option>
                                            <option
                                                <?php if(Session::get('select_chart_type')==2){ echo "selected"; } ?>
                                                value="2">Bar Chart</option>
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success" id="btn-search">View Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>

        <div class="row">
            <?php 
                    $chart_bar = array();
                    foreach ($survey_form_data as $question) { 
                        $form_id = $survey_form_data[0]->id;
            
                        foreach ($question->survey_questions as $survey_form) {
                            if($survey_form->question_type==1){
            
                                $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
                        
                                $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                                
                                $answer_array = array();
            
                                $push_answer_array = array('Year');
                                
                                foreach ($quest_option as $key=>$opt_value) {
                                    array_push($push_answer_array, $opt_value->survey_option_title);
                                }   
            
                                    $answer_array[] = $push_answer_array;
                                    
                                    for ($y = 5; $y >= 0; $y--) {
                                        
                                        $year_data = date('Y', strtotime("-" . $y . " year"));
                                        $computed_arr = array($year_data);
                                        foreach ($push_answer_array as $ans_value) {
                                            
                                            if($ans_value!='Year'){
                                                $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "");
                                                
                                                $radiobutton_ans_percent = 0;
                                                if(count($total_result_count)>0){
                                                    $total_ans_count = count($total_result_count);
                                                    $radiobutton_ans_percent = ($answer_count->ans_count*100/$total_ans_count);
                                                }
                                                array_push($computed_arr, $radiobutton_ans_percent);
            
                                            }
                                        }
                                        $answer_array[]= $computed_arr;
                                        
                                }
                                    
                                $radiobutton_chart_label = json_encode($answer_array); 
            
                            ?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 p-3 ">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                                        google.charts.setOnLoadCallback(drawChart);
                    
                                        function drawChart() {
                                            var data = google.visualization.arrayToDataTable(
                                            
                                            <?php echo $radiobutton_chart_label; ?>
                                            );
                    
                                            var options = {
                                            chart: {
                                                title: '<?php echo $survey_form->survey_question; ?>',
                                                subtitle: '',
                                            }
                                            };
                    
                                            var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));
                    
                                            chart.draw(data, google.charts.Bar.convertOptions(options));
                                        }
                    </script>
                    <div id="columnchart_material_<?php echo $survey_form->id; ?>"
                        style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                </div>
            </div>
            <?php } 
            
                            //==========Here End question type 1 radiobox answer===============
            
                            
                            if($survey_form->question_type==2){
            
                                $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
                        
                                $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                                
                                $answer_array = array();
            
                                $push_answer_array = array('Year');
                                
                                foreach ($quest_option as $key=>$opt_value) {
                                    array_push($push_answer_array, $opt_value->survey_option_title);
                                    
                                }
                                    $answer_array[]=$push_answer_array;
                                    
                                    for ($y = 5; $y >= 0; $y--) {
                                        
                                        $year_data = date('Y', strtotime("-" . $y . " year"));
                                        $computed_arr = array($year_data);
                                        foreach ($push_answer_array as $ans_value) {
                                            
                                            if($ans_value!='Year'){
                                                $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "");
                                                
                                                $checkbox_ans_percent = 0;
                                                if(count($total_result_count)>0){
                                                    $total_ans_count = count($total_result_count);
                                                    $checkbox_ans_percent = ($answer_count->ans_count*100/$total_ans_count);
                                                }
                                                array_push($computed_arr, $checkbox_ans_percent);
            
                                            }
                                        }
                                        $answer_array[]= $computed_arr;
                                        
                                }
                                    
                                $checkbox_chart_label = json_encode($answer_array); 
            
                            ?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 p-3 ">

                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                                    google.charts.setOnLoadCallback(drawChart);
            
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(
                                    
                                        <?php echo $checkbox_chart_label; ?>
                                    );
            
                                    var options = {
                                        chart: {
                                        title: '<?php echo $survey_form->survey_question; ?>',
                                        subtitle: '',
                                        }
                                    };
            
                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));
            
                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
                    </script>
                    <div id="columnchart_material_<?php echo $survey_form->id; ?>"
                        style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                </div>
            </div>
            <?php } 
            
                            //==========Here End question type 2 checkbox answer===============
                            ?>


            <?php 
                        if($survey_form->question_type==5){
                                                    
                            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                            
                            $answer_array = array();
                            $answer_array[] = array('0'=>'Year', '1'=>'Terrible', '2'=>'Poor', '3'=>'Good', '4'=>'Great', '5'=>'Fantastic');
                            
                            $i=1;
                            for ($y = 5; $y >= 0; $y--) {
                                $year_data = date('Y', strtotime("-" . $y . " year"));
        
                                
                                $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id = "");
                                $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id = "");
                                $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id = "");
                                $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id = "");
                                $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id = "");
                                
        
                                $tarrible_ans_percent = 0;
                                if(count($total_result_count)>0){
                                    $total_ans_count = count($total_result_count);
                                    $tarrible_ans_percent = ($tarrible_count->ans_count*100/$total_ans_count);
                                }
        
                                $poor_ans_percent = 0;
                                if(count($total_result_count)>0){
                                    $total_ans_count = count($total_result_count);
                                    $poor_ans_percent = ($poor_count->ans_count*100/$total_ans_count);
                                }
        
                                $good_ans_percent = 0;
                                if(count($total_result_count)>0){
                                    $total_ans_count = count($total_result_count);
                                    $good_ans_percent = ($good_count->ans_count*100/$total_ans_count);
                                }
        
        
                                $great_ans_percent = 0;
                                if(count($total_result_count)>0){
                                    $total_ans_count = count($total_result_count);
                                    $great_ans_percent = ($great_count->ans_count*100/$total_ans_count);
                                }
        
                                $fantastic_ans_percent = 0;
                                if(count($total_result_count)>0){
                                    $total_ans_count = count($total_result_count);
                                    $fantastic_ans_percent = ($fantastic_count->ans_count*100/$total_ans_count);
                                }
        
        
                                $answer_array[]=array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);
                            }
                            
                            $star_rating_bar_chart_label = json_encode($answer_array); 
                            
                        ?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 p-3 ">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);
        
                                function drawChart() {
                                var data = google.visualization.arrayToDataTable(
                                
                                    <?php echo $star_rating_bar_chart_label; ?>
                                );
        
                                var options = {
                                    chart: {
                                    title: '<?php echo $survey_form->survey_question; ?>',
                                    subtitle: '',
                                    }
                                };
        
                                var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));
        
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                    </script>
                    <div id="columnchart_material_<?php echo $survey_form->id; ?>"
                        style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                </div>
            </div>
            <?php } ?>
            <?php 
                        } 
                    } 
                ?>
        </div>
        <!-- end::form 2-->
    </div>
</div>




@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
    $('#category_id').change(function(){
        //debugger;
        var me = this;
        var url = '{{route("get_sub_category_by_category_id")}}';
        var categoryId = $(this).find(':selected').val();
        $.ajax({
            url  : url,
            type : 'GET',
            data : {category_id:categoryId},
            dataType: 'json',
            success: function(resp){
                if(resp.data.length==0){
                    return false;
                }
                //debugger;
                $('#sub_category_id').html('<option value="0">Select sub category</option>');
                selectedSubCategory = '<?php echo !empty(Input::old('sub_category_id'))?Input::old('sub_category_id'):((!empty($repairman_data->sub_category_id)?$repairman_data->sub_category_id:0)) ?>';
                $.each(resp.data, function (index, value) {
                    //debugger;
                    var obj = { 
                        value: value.id,
                        text : value.category_name,
                    };

                    if(selectedSubCategory==value.id){
                        obj.selected = 'selected';
                    }

                    $('#sub_category_id').append($('<option/>',obj));
                });  
            },
            error: function(resp){

            }
        });
    });
});
</script>

@stop