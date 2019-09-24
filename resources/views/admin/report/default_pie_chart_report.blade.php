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

<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echarts.script.min.js')}}"></script>

<div class="breadcrumb">
    <h1> {{__('message.filter_participants_for_view_survey_report')}}</h1>
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
                    <h3 class="card-title"><a title="click for filter" style="cursor:pointer;"
                            class="collapse-link">{{$survey_form_data[0]->survey_form_title}}</a></h3>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a title="click for filter" style="border: 1px solid #cccccc;" class="collapse-link"><i
                                    class="fa fa-chevron-down"></i></a></li>
                    </ul>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="name"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_type')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="type_id" name="type_id">
                                            <option value="0">{{__('message.select_type')}}</option>
                                            @foreach ($type as $row)
                                            <option <?php
                                            if (Session::get('type_id') == $row->id) {
                                                echo "selected";
                                            }
                                            ?> value="{{ $row->id }}">{{$row->type_name}}</option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_group')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="group_id" name="group_id">
                                            <option value="0">{{__('message.select_group')}}</option>
                                            @foreach ($group as $row)
                                            <option <?php
                                            if (Session::get('group_id') == $row->id) {
                                                echo "selected";
                                            }
                                            ?> value="{{ $row->id }}">{{$row->group_name}}</option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_category')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="category_id" name="category_id">
                                            <option value="0">{{__('message.select_category')}}</option>
                                            @foreach ($category as $row)
                                            <option <?php
                                            if (Session::get('category_id') == $row->id) {
                                                echo "selected";
                                            }
                                            ?> value="{{ $row->id }}">{{$row->category_name}}</option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_sub_category')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="sub_category_id"
                                            name="sub_category_id">
                                            <option value="0">{{__('message.select_sub_category')}}</option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_time_period')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        @php
                                        $time_period_selected = Session::get('time_period') ;
                                        @endphp
                                        {!!
                                        Form::select('time_period',$time_filter,$time_period_selected,['class'=>'form-control','id'=>'time_period','placeholder'=>__('message.select_time_period')])
                                        !!}
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3" id="created_from" style="display:none;">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_from')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <input name="created_from" value="<?php echo Session::get('created_from') ?>"
                                            readonly type="text" class="form-control has-feedback-left" id="single_cal5"
                                            placeholder="From Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                        <span class="fa fa-calendar-o span-right-input-icon form-control-feedback left">
                                            <i class="ul-form__icon i-Calendar-4"></i>
                                        </span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3" id="created_to" style="display:none;">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_to')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <input name="created_to" value="<?php echo Session::get('created_to') ?>"
                                            readonly type="text" class="form-control has-feedback-left" id="single_cal4"
                                            placeholder="To Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                        <span class="fa fa-calendar-o span-right-input-icon form-control-feedback left">
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_chart_type')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="select_chart_type"
                                            name="select_chart_type">
                                            <option value="1">{{__('message.pie_chart')}}</option>
                                            <option value="2">{{__('message.bar_chart')}}</option>
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
                                <button type="submit" class="btn btn-success"
                                    id="btn-search">{{__('message.view_report')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>

        <div id="append_filter" class="card card-icon-bg card-icon-bg-primary o-hidden "></div>
        <div class="row" id="printableArea">
            <div id="showList" style="display:none;"></div>
            <?php
            //if(count($participant_id)>0){
            $chart_pie = array();
            foreach ($survey_form_data as $question) {
                $form_id = $survey_form_data[0]->id;
                foreach ($question->survey_questions as $key => $survey_form) {
                    if ($survey_form->question_type == 1) {
                        $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                        $responses_1 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();

                        $answer_array = array();
                        $allRecord = [];
                        foreach ($quest_option as $opt_value) {
                            $answer_array['answer_value'][] = $opt_value->survey_option_title;
                        }

                        $i = 0;

                        foreach ($answer_array['answer_value'] as $ans_value) {

                            $start_number = 0;
                            $tp = 'm';
                            $inc_dec  = '-';
                        if($time_period == 'last_14_day'){
                            $start_number = 0;
                            $year_month_value = 13;
                            $m=date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = '-';
                            if(count($year) == 0 ){
                                for($i = 0; $i <= 13; $i++){
                                    $year[] = date('m/d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'this_week') {
                            for($i = 0; $i <= 6; $i++){
                            $x = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($x)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m=$x;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_week') {
                            for($i = 0; $i <= 6; $i++){
                            $first_of_week = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($first_of_week)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m= date('Y-m-d',strtotime($first_of_week."-7"."day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }

                        }elseif ($time_period == 'this_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')));
                            
                            $start_number = 0;
                            $year_month_value = date('t');
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')."-1 month"));
                            $days = cal_days_in_month(CAL_GREGORIAN, date('m',strtotime("-1 month")), date('Y'));
                            
                            $start_number = 0;
                            $year_month_value = $days;
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_year') {
                            $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                            
                            $start_number = 0;
                            $year_month_value = 11;
                            $m = date("Y/01/01",strtotime("-1 year"));
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'today') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'yesterday') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d',strtotime("-1 day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "-";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'specific_date') {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 1;
                            $year_month_value = 12;
                            $m = 'm';
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }else {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 0;
                            $year_month_value = 11;
                            $m = $first_month_year;
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }
                            $total_chart_value = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }
                            $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$created_from,$created_to,$time_period);

                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }

                            // $chart_ans_percent = 0;
                            $total_chart_value[] = $chart_ans_count;
                            // if (count($total_result_count) > 0) {
                            //     $total_ans_count = count($total_result_count);
                            //     $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                            // }

                        }

                        $chart_ans_percent = 0;
                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                            }

                        $chart_pie[0] = $chart_ans_percent;
                        $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                        }
                        $tempChart = [];
                        foreach ($allRecord as $key => $value) {
                            // dd($value);
                            $tempChart[$key]['value'] = $value[0];
                            $tempChart[$key]['name'] = $value[1];
                        }
                        $chart_label = json_encode($tempChart);

                        ?>
            {{-- pie chart div --}}
            <div class="col-sm-6 col-md-6 col-xs-12">
                <div class="card mb-4">
                    <h3 class="text-center m-0 p-2"
                        style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                        {{$survey_form->survey_question}}</h3>
                    <div class="card-body">
                        <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}}:</b>
                                    {{$responses_1}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center !important;">
                                <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                    onclick="printChart('chart_container_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_1}}')">{{__('message.print')}}
                                    !</button>
                            </div>
                        </div>
                        <div class="append_filter"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    let chart_container_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                                        if (chart_container_<?php echo $survey_form->id; ?>) {
                                            let chart_label_Pie = echarts.init(chart_container_<?php echo $survey_form->id; ?>);
                                            chart_label_Pie.setOption({
                                                color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                                tooltip: {
                                                    show: true,
                                                    backgroundColor: 'rgba(0, 0, 0, .8)'
                                                },
                
                                                series: [{
                                                        name: '{{$survey_form->survey_question}}',
                                                        type: 'pie',
                                                        radius: '60%',
                                                        center: ['50%', '50%'],
                                                        data: <?php echo $chart_label; ?>,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                            }
                                                        }
                                                    }
                
                                                ]
                                            });
                                            $(window).on('resize', function() {
                                                setTimeout(() => {
                                                    chart_label_Pie.resize();
                                                }, 500);
                                            });
                                        }
                </script>
            </div>

            <?php
                    }

                    if ($survey_form->question_type == 2) {
                        $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                        $responses_2 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();

                        $answer_array = array();
                        foreach ($quest_option as $opt_value) {
                            $answer_array['answer_value'][] = $opt_value->survey_option_title;
                        }

                        $i = 0;
                        $allRecord = [];
                        foreach ($answer_array['answer_value'] as $ans_value) {

                            $start_number = 0;
                            $tp = 'm';
                            $inc_dec  = '-';
                        if($time_period == 'last_14_day'){
                            $start_number = 0;
                            $year_month_value = 13;
                            $m=date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = '-';
                            if(count($year) == 0 ){
                                for($i = 0; $i <= 13; $i++){
                                    $year[] = date('m/d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'this_week') {
                            for($i = 0; $i <= 6; $i++){
                            $x = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($x)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m=$x;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_week') {
                            for($i = 0; $i <= 6; $i++){
                            $first_of_week = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($first_of_week)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m= date('Y-m-d',strtotime($first_of_week."-7"."day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }

                        }elseif ($time_period == 'this_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')));
                            
                            $start_number = 0;
                            $year_month_value = date('t');
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')."-1 month"));
                            $days = cal_days_in_month(CAL_GREGORIAN, date('m',strtotime("-1 month")), date('Y'));
                            
                            $start_number = 0;
                            $year_month_value = $days;
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_year') {
                            $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                            
                            $start_number = 0;
                            $year_month_value = 11;
                            $m = date("Y/01/01",strtotime("-1 year"));
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'today') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'yesterday') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d',strtotime("-1 day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "-";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'specific_date') {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 1;
                            $year_month_value = 12;
                            $m = 'm';
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }else {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 0;
                            $year_month_value = 11;
                            $m = $first_month_year;
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }
                            $total_chart_value = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }

                            $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                            
                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }


                            $total_chart_value[] = $chart_ans_count;
                            // $chart_pie[$i][0] = $ans_value;
                            // $chart_pie[$i][1] = $chart_ans_percent;
                            }
                            // dd(array_sum($total_chart_value));
                            $chart_ans_percent = 0;
                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                            }
                            $chart_pie[0] = $chart_ans_percent;
                            $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                            $total_chart_value = [];
                        }
                        $checkboxArray = [];
                        foreach ($allRecord as $key => $value) {
                            $checkboxArray[$key]['value'] = $value[0];
                            $checkboxArray[$key]['name'] = $value[1];
                        }

                        $checkbox_chart_label = json_encode($checkboxArray);
                        // dd($checkbox_chart_label);
                        ?>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <div class="card mb-4">
                    <h3 class="text-center m-0 p-2"
                        style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                        {{$survey_form->survey_question}}</h3>
                    <div class="card-body">
                        <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}} :</b>
                                    {{$responses_2}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center !important;">
                                <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                    onclick="printChart('chart_container_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_2}}')">{{__('message.print')}}
                                    !</button>
                            </div>
                        </div>
                        <div class="append_filter"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    let checkbox_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                                        if (checkbox_chart_label_<?php echo $survey_form->id; ?>) {
                                            let checkbox_chart_Pie_<?php echo $survey_form->id; ?> = echarts.init(checkbox_chart_label_<?php echo $survey_form->id; ?>);
                                            checkbox_chart_Pie_<?php echo $survey_form->id; ?>.setOption({
                                                color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                                tooltip: {
                                                    show: true,
                                                    backgroundColor: 'rgba(0, 0, 0, .8)'
                                                },

                                                series: [{
                                                        name: '<?php echo $survey_form->survey_question; ?>',
                                                        type: 'pie',
                                                        radius: '60%',
                                                        center: ['50%', '50%'],
                                                        data: <?php echo $checkbox_chart_label; ?>,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                            }
                                                        }
                                                    }

                                                ]
                                            });
                                            $(window).on('resize', function() {
                                                setTimeout(() => {
                                                    checkbox_chart_Pie_<?php echo $survey_form->id; ?>.resize();
                                                }, 500);
                                            });
                                        }
                </script>
            </div>
            <?php
                    }

                    if ($survey_form->question_type == 5) {

                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                        $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

                        // $responses_5 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();

                        $i = 0;
                        $allRecord = [];
                        $responses_5 = [];
                        foreach ($answer_array as $key => $ans_value) {

                            $start_number = 0;
                            $tp = 'm';
                            $inc_dec  = '-';
                        if($time_period == 'last_14_day'){
                            $start_number = 0;
                            $year_month_value = 13;
                            $m=date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = '-';
                            if(count($year) == 0 ){
                                for($i = 0; $i <= 13; $i++){
                                    $year[] = date('m/d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'this_week') {
                            for($i = 0; $i <= 6; $i++){
                            $x = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($x)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m=$x;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_week') {
                            for($i = 0; $i <= 6; $i++){
                            $first_of_week = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($first_of_week)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m= date('Y-m-d',strtotime($first_of_week."-7"."day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }

                        }elseif ($time_period == 'this_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')));
                            
                            $start_number = 0;
                            $year_month_value = date('t');
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')."-1 month"));
                            $days = cal_days_in_month(CAL_GREGORIAN, date('m',strtotime("-1 month")), date('Y'));
                            
                            $start_number = 0;
                            $year_month_value = $days;
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_year') {
                            $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                            
                            $start_number = 0;
                            $year_month_value = 11;
                            $m = date("Y/01/01",strtotime("-1 year"));
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'today') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'yesterday') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d',strtotime("-1 day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "-";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'specific_date') {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 1;
                            $year_month_value = 12;
                            $m = 'm';
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }else {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 0;
                            $year_month_value = 11;
                            $m = $first_month_year;
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }
                            $total_chart_value = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }

                                $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, $key, $participant_id = "",$created_from,$created_to,$time_period);                            

                                $chart_ans_count = 0;
                                if (!empty($answer_count)) {
                                    $chart_ans_count = $answer_count->ans_count;
                                }

                                $total_chart_value[] = $chart_ans_count;
                                $responses_5[] = $chart_ans_count;

                            }
                                $chart_ans_percent = 0;

                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                                }
                            // $chart_pie[$i][0] = $ans_value;
                            // $chart_pie[$i][1] = $chart_ans_percent;
                            // $i++;
                            $chart_pie[0] = $chart_ans_percent;
                            $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                            $total_chart_value = [];
                        }

                        $ratingArray = [];
                        foreach ($allRecord as $key => $value) {
                            $ratingArray[$key]['value'] = $value[0];
                            $ratingArray[$key]['name'] = $value[1];
                        }   
                        $responses_5 = array_sum($responses_5);
                        $star_rating_chart_label = json_encode($ratingArray);
                        ?>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <div class="card mb-4">
                    <h3 class="text-center m-0 p-2"
                        style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                        {{$survey_form->survey_question}}</h3>
                    <div class="card-body">
                        <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}} :</b>
                                    {{$responses_5}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center !important;">
                                <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                    onclick="printChart('chart_container_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_5}}')">{{__('message.print')}}
                                    !</button>
                            </div>
                        </div>
                        <div class="append_filter"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    let star_rating_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                                    if (star_rating_chart_label_<?php echo $survey_form->id; ?>) {
                                        let star_rating_Pie = echarts.init(star_rating_chart_label_<?php echo $survey_form->id; ?>);
                                        star_rating_Pie.setOption({
                                            color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                            tooltip: {
                                                show: true,
                                                backgroundColor: 'rgba(0, 0, 0, .8)'
                                            },

                                            series: [{
                                                    name: '{{$survey_form->survey_question}}',
                                                    type: 'pie',
                                                    radius: '60%',
                                                    center: ['50%', '50%'],
                                                    data: <?php echo $star_rating_chart_label; ?> ,
                                                    itemStyle: {
                                                        emphasis: {
                                                            shadowBlur: 10,
                                                            shadowOffsetX: 0,
                                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                        }
                                                    }
                                                }

                                            ]
                                        });
                                        $(window).on('resize', function() {
                                            setTimeout(() => {
                                                star_rating_Pie.resize();
                                            }, 500);
                                        });
                                    }
                </script>
            </div>
            <?php
                    }
                    if ($survey_form->question_type == 6) {
                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                        $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

                        // $responses_5 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();

                        $i = 0;
                        $allRecord = [];
                        $responses_6 = [];
                        foreach ($answer_array as $key => $ans_value) {

                            $start_number = 0;
                            $tp = 'm';
                            $inc_dec  = '-';
                        if($time_period == 'last_14_day'){
                            $start_number = 0;
                            $year_month_value = 13;
                            $m=date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = '-';
                            if(count($year) == 0 ){
                                for($i = 0; $i <= 13; $i++){
                                    $year[] = date('m/d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'this_week') {
                            for($i = 0; $i <= 6; $i++){
                            $x = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($x)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m=$x;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_week') {
                            for($i = 0; $i <= 6; $i++){
                            $first_of_week = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($first_of_week)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m= date('Y-m-d',strtotime($first_of_week."-7"."day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }

                        }elseif ($time_period == 'this_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')));
                            
                            $start_number = 0;
                            $year_month_value = date('t');
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')."-1 month"));
                            $days = cal_days_in_month(CAL_GREGORIAN, date('m',strtotime("-1 month")), date('Y'));
                            
                            $start_number = 0;
                            $year_month_value = $days;
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_year') {
                            $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                            
                            $start_number = 0;
                            $year_month_value = 11;
                            $m = date("Y/01/01",strtotime("-1 year"));
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'today') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'yesterday') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d',strtotime("-1 day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "-";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'specific_date') {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 1;
                            $year_month_value = 12;
                            $m = 'm';
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }else {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 0;
                            $year_month_value = 11;
                            $m = $first_month_year;
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }
                            $total_chart_value = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }

                                $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, $key, $participant_id = "",$created_from,$created_to,$time_period);                            
                                //echo $answer_count. '<br/>';
                                $chart_ans_count = 0;
                                if (!empty($answer_count)) {
                                    $chart_ans_count = $answer_count->ans_count;
                                }

                                $total_chart_value[] = $chart_ans_count;
                                $responses_6[] = $chart_ans_count;

                            }
                                $chart_ans_percent = 0;

                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                                }
                            // $chart_pie[$i][0] = $ans_value;
                            // $chart_pie[$i][1] = $chart_ans_percent;
                            // $i++;
                            $chart_pie[0] = $chart_ans_percent;
                            $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                            $total_chart_value = [];
                        }

                        $ratingArray = [];
                        foreach ($allRecord as $key => $value) {
                            $ratingArray[$key]['value'] = $value[0];
                            $ratingArray[$key]['name'] = $value[1];
                        }   
                        $responses_6 = array_sum($responses_6);
                        $star_rating_chart_label = json_encode($ratingArray);
                        ?>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <div class="card mb-4">
                    <h3 class="text-center m-0 p-2"
                        style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                        {{$survey_form->survey_question}}</h3>
                    <div class="card-body">
                        <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}} :</b>
                                    {{$responses_6}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center !important;">
                                <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                    onclick="printChart('chart_container_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_6}}')">{{__('message.print')}}
                                    !</button>
                            </div>
                        </div>
                        <div class="append_filter"></div>
                    </div>
                </div>
                <script type="text/javascript">
                    let star_rating_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                            if (star_rating_chart_label_<?php echo $survey_form->id; ?>) {
                                let star_rating_Pie = echarts.init(star_rating_chart_label_<?php echo $survey_form->id; ?>);
                                star_rating_Pie.setOption({
                                    color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },

                                    series: [{
                                            name: '{{$survey_form->survey_question}}',
                                            type: 'pie',
                                            radius: '60%',
                                            center: ['50%', '50%'],
                                            data: <?php echo $star_rating_chart_label; ?> ,
                                            itemStyle: {
                                                emphasis: {
                                                    shadowBlur: 10,
                                                    shadowOffsetX: 0,
                                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                }
                                            }
                                        }

                                    ]
                                });
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        star_rating_Pie.resize();
                                    }, 500);
                                });
                            }
                </script>
            </div>
            <?php
                    }
                }
            }
            ?>

        </div>

        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.question_type_text_answer_list')}}</a>
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">{{__('message.s.no')}}</th>
                                <th class="text-center">{{__('message.question')}}</th>
                                <th class="text-center">{{__('message.participant_name')}}</th>
                                <th class="text-center">{{__('message.mobile_number')}}</th>
                                <th class="text-center">{{__('message.answer')}}</th>
                                <th class="text-center">{{__('message.created_date')}}</th>
                                <th class="text-center">{{__('message.updated_date')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<style>
    .modal-title {
        text-align: center;
        line-height: 54px;
    }

    .option_val {
        margin-left: 40px;
    }
</style>
<script type="text/javascript">
    var dataTable;
    var lastQuestion='';
    var columns = [
        {data: 'rownum', name: 'rownum'},
        {data: 'question', name: 'question'},
        {data: 'participant_name', name: 'participant_name'},
        {data: 'mobile', name: 'mobile'},
        {data: 'answer', name: 'answer'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
    ];
    var ajaxUrl = "{!! route('get_question_answer', $form_survey_id) !!}" //Url of ajax datatable where you fetch data


    //It may be empty array
        var columnDefs = [
            {
                "targets": 0,
                "orderable": true,
                "class": "text-center",
            },
            {
                "targets": 1,
                "orderable": true,
                "class": "text-left",
                "render": function (data, type, full, meta) {
                    if(lastQuestion!=full['survey_question']){
                        lastQuestion = full['survey_question'];
                        return full['survey_question'];
                    }
                    lastQuestion = full['survey_question'];
                    return '';
                },
            },
            {
                "targets": 2,
                "orderable": true,
                "class": "text-center"
            },
            {
                "targets": 3,
                "orderable": true,
                "class": "text-center"
            },
            {
                "targets": 4,
                "orderable": false,
                "class": "text-center"
            },
            {
                "targets": 5,
                "orderable": false,
                "class": "text-center"
            },
        ];
    //var columnDefs = [];
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id').change(function () {
            //debugger;
            var me = this;
            var url = '{{route("get_sub_category_by_category_id")}}';
            var categoryId = $(this).find(':selected').val();
            $.ajax({
                url: url,
                type: 'GET',
                data: {category_id: categoryId},
                dataType: 'json',
                success: function (resp) {
                    if (resp.data.length == 0) {
                        return false;
                    }
                    //debugger;
                    $('#sub_category_id').html('<option value="0">Select sub category</option>');
                    selectedSubCategory = '<?php echo!empty(Input::old('sub_category_id')) ? Input::old('sub_category_id') : ((!empty($repairman_data->sub_category_id) ? $repairman_data->sub_category_id : 0)) ?>';
                    $.each(resp.data, function (index, value) {
                        //debugger;
                        var obj = {
                            value: value.id,
                            text: value.category_name,
                        };

                        if (selectedSubCategory == value.id) {
                            obj.selected = 'selected';
                        }

                        $('#sub_category_id').append($('<option/>', obj));
                    });
                },
                error: function (resp) {

                }
            });
        });
    });
</script>
@include('datatable.dt_js')
<script>
    $(document).ready(function(){
        if($('#time_period').val() == 'specific_date'){
            $('#created_from').show();
            $('#created_to').show();
        }
        $('#time_period').change(function(){
            const value = $(this).val()
            if(value == 'specific_date'){
                $('#created_from').show();
                $('#created_to').show();
            }else {
                $('#created_from').hide();
                $('#created_to').hide();
            }
        })
    })
</script>
<script>
    $(document).ready(function(){
        var type_id = $('#type_id').val() != 0 ? $('#type_id').val() : '{{__('message.all')}}' ;
        var group_id = $('#group_id').val() != 0 ? $('#group_id').val() : '{{__('message.all')}}' ;
        var category_id = $('#category_id').val() != 0 ? $('#category_id').val() : '{{__('message.all')}}' ;
        var sub_category_id = $('#sub_category_id').val() != 0 ? $('#sub_category_id').val() : '{{__('message.all')}}' ;
        
        var time_period = $('#time_period').val() != 0 ? $('#time_period').val() : '{{__('message.all')}}' ;
        var created_from = $('#single_cal5').val();
        var created_to = $('#single_cal4').val();
        var select_chart_type = $('#select_chart_type').val()
        // var all_user = {!!$user_name!!}
        // var user_name = '';
        // all_user.map(value => {
        //     if(user_data == value.id)
        //         user_name = value.name
        // })
        var all_type = {!!$type!!}
        var type = '';
        all_type.map(value => {

            if(type_id == value.id)
            type = value.type_name
            if(type_id == '{{__('message.all')}}'){
                type = '{{__('message.all')}}'
            }
        })
        var all_group = {!!$group!!}
        var group = '';
        all_group.map(value => {
            if(group_id == value.id)
                group = value.group_name
             if(group_id == '{{__('message.all')}}'){
                group = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$category!!}
        var category = '';
        all_category.map(value => {
            if(category_id == value.id)
                category = value.category_name
             if(category_id == '{{__('message.all')}}'){
                category = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$subCategory!!}
        var sub_category = '';
        all_category.map(value => {
            if(sub_category_id == value.id)
            sub_category = value.category_name
            if(sub_category_id == '{{__('message.all')}}'){
                    sub_category = '{{__('message.all')}}'
                }
        })
        if(select_chart_type == 1){
            select_chart_type = '{{__('message.pie_chart')}}'
        }else{
            select_chart_type = '{{__('message.bar_chart')}}'
        }

        $('.append_filter').empty()
            if(time_period == 'specific_date'){
            $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.type')}} :</b> '+type+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.group')}} :</b> '+group+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.category')}} :</b> '+category+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.sub_category')}} :</b> '+sub_category+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}} :</b> '+time_period+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.chart_type')}}:</b> '+select_chart_type+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_from')}}:</b> '+created_from+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_to')}}:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.type')}} :</b> '+type+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.group')}} :</b> '+group+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.category')}} :</b> '+category+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.sub_category')}} :</b> '+sub_category+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}} :</b> '+time_period+'</p></div><div class="col-md-4 col-4 "> <p class="text-14 mt-1 mb-1"><b>{{__('message.chart_type')}}:</b> '+select_chart_type+'</p></div></div>');
            }
    })
</script>
<script type="text/javascript">
    function printChart(id,title,response){
        $("#"+id).find('canvas').attr('id','canvas');

        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var imgData = canvas.toDataURL("image/png");
        var type_id = $('#type_id').val() != 0 ? $('#type_id').val() : '{{__('message.all')}}' ;
        var group_id = $('#group_id').val() != 0 ? $('#group_id').val() : '{{__('message.all')}}' ;
        var category_id = $('#category_id').val() != 0 ? $('#category_id').val() : '{{__('message.all')}}' ;
        var sub_category_id = $('#sub_category_id').val() != 0 ? $('#sub_category_id').val() : '{{__('message.all')}}' ;
        
        var time_period = $('#time_period').val() != 0 ? $('#time_period').val() : '{{__('message.all')}}' ;
        var created_from = (time_period == 'specific_date') ? $('#single_cal5').val() : null;
        var created_to = (time_period == 'specific_date') ? $('#single_cal4').val() : null;
        var select_chart_type = $('#select_chart_type').val()
        // var all_user = {!!$user_name!!}
        // var user_name = '';
        // all_user.map(value => {
        //     if(user_data == value.id)
        //         user_name = value.name
        // })
        var all_type = {!!$type!!}
        var type = '';
        all_type.map(value => {

            if(type_id == value.id)
            type = value.type_name
            if(type_id == '{{__('message.all')}}'){
                type = '{{__('message.all')}}'
            }
        })
        var all_group = {!!$group!!}
        var group = '';
        all_group.map(value => {
            if(group_id == value.id)
                group = value.group_name
             if(group_id == '{{__('message.all')}}'){
                group = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$category!!}
        var category = '';
        all_category.map(value => {
            if(category_id == value.id)
                category = value.category_name
             if(category_id == '{{__('message.all')}}'){
                category = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$subCategory!!}
        var sub_category = '';
        all_category.map(value => {
            if(sub_category_id == value.id)
            sub_category = value.category_name
            if(sub_category_id == '{{__('message.all')}}'){
                    sub_category = '{{__('message.all')}}'
                }
        })
        if(select_chart_type == 1){
            select_chart_type = '{{__('message.pie_chart')}}'
        }else{
            select_chart_type = '{{__('message.bar_chart')}}'
        }
        var _token = '{{csrf_field()}}'

        $.ajax({
            url: '{{route("generate_pdf")}}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                imgData,type,group,category,sub_category,select_chart_type,time_period,created_from,created_to,response,title
            },
            success: function(resp){
                $("#"+id).find('canvas').removeAttr('id');
                window.open(resp.url, '_blank');
                console.log(resp)
            }
        })
    }
</script>
@stop