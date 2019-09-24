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

{{-- <script src="{{asset('admin_css/assets/js/pie_chart/loader.js')}}"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script> --}}

<div class="breadcrumb">
    <h1>{{__('message.filter_participants_for_view_survey_report')}}</h1>
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
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{$survey_form_data[0]->survey_form_title}}</h3>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_group')}}
                                    <span class="required">*</span></label>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_category')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="category_id" name="category_id">
                                            <option value="0">{{__('message.select_category')}}
                                            </option>
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
                                            <option value="0">{{__('message.select_sub_category')}}
                                            </option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_chart_type')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="select_chart_type"
                                            name="select_chart_type">
                                            <option <?php
                                                    if (Session::get('select_chart_type') == 1) {
                                                        echo "selected";
                                                    }
                                                    ?> value="1">{{__('message.pie_chart')}}</option>
                                            <option <?php
                                                    if (Session::get('select_chart_type') == 2) {
                                                        echo "selected";
                                                    }
                                                    ?> value="2">{{__('message.bar_chart')}}</option>
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
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-success"
                                    id="btn-search">{{__('message.view_report')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>
        <!-- end::form 2-->
        <div class="card card-icon-bg card-icon-bg-primary o-hidden "></div>
        <div class="row">
            <?php
                    $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
                    $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
                    $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
                    
                    if (count($survey_form_data) > 0) {
                        
                        $chart_bar = array();
                        foreach ($survey_form_data as $question) {
                            $form_id = $survey_form_data[0]->id;
                            
                            foreach ($question->survey_questions as $survey_form) {
                                $responses_1 = '';
                                if ($survey_form->question_type == 1) {
                                    // barchart      
                                    // $responses_1 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();


                                    $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
                                    $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                            
                            $answer_array = array();
                            $responses_1 = [];
                            // $computed_arr = array();
                            // if (empty($computed_arr)) {
                                
                            //     for ($y = $year_month_value; $y >= 0; $y--) {
                            //         $year_data = date($m, strtotime("-" . $y . $month));
                            //         //store year data in to array
                            //         $computed_arr[] = $year_data;
                            //     }
                            // }
                            // this section is for date filter
                            $months = [];
                            $monthData = array();
                            if($time_period == 'last_14_day'){
                                if(count($months) == 0 ){
                                    for($i = 0; $i <= 13; $i++){
                                        $months[] = date('Y-m-d',strtotime(date('Y-m-d')."-".$i . "day"));
                                        $monthData[] = date('d/m',strtotime(date('Y-m-d')."-".$i . "day"));

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

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= 6; $i++){
                                        $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                        $monthData[] = date('d/m',strtotime($m.$inc_dec.$i . $month));
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

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= 6; $i++){
                                        $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                        $monthData[] = date('d/m',strtotime($m.$inc_dec.$i . $month));
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

                                if(count($months) == 0 ){
                                    for($i = 0; $i < $year_month_value; $i++){
                                        $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                        $monthData[] = date('d',strtotime($m.$inc_dec.$i . $month));
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

                                if(count($months) == 0 ){
                                    for($i = 0; $i < $year_month_value; $i++){
                                        $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                        $monthData[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                    }
                                }
                                // dd($monthData);
                            }elseif ($time_period == 'last_year') {
                                $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                                
                                $start_number = 0;
                                $year_month_value = 11;
                                $m = date("Y/01/01",strtotime("-1 year"));
                                $month = 'month';
                                $tp = 'm';
                                $inc_dec = "+";

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= $year_month_value; $i++){
                                        $months[] = date('m',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                        $monthData[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                    }
                                }
                            }elseif ($time_period == 'today') {
                                $start_number = 0;
                                $year_month_value = 0;
                                $m = date('Y-m-d');
                                $month = 'day';
                                $tp = 'Y-m-d';
                                $inc_dec = "+";

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= $year_month_value; $i++){
                                        $months[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                        $monthData[] = date('Y-m-d',strtotime('d'.$inc_dec.$i . $month));
                                    }
                                }
                            }elseif ($time_period == 'yesterday') {

                                $start_number = 0;
                                $year_month_value = 0;
                                $m = date('Y-m-d',strtotime("-1 day"));
                                $month = 'day';
                                $tp = 'Y-m-d';
                                $inc_dec = "-";

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= $year_month_value; $i++){
                                        $months[] = date('Y-m-d',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                        $monthData[] = date('Y-m-d',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                    }
                                }
                                // dd($months);
                            }elseif ($time_period == 'specific_date') {
                                $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                                $start_number = 0;
                                $year_month_value = 11;
                                $m = 'm';
                                $month = 'month';
                                $tp = 'm';
                                $inc_dec = "+";

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= $year_month_value; $i++){
                                        $months[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                        $monthData[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                    }
                                }
                                // dd($months);
                            }else {
                                $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                                $start_number = 0;
                                $year_month_value = 11;
                                $m = $first_month_year;
                                $month = 'month';
                                $tp = 'm';
                                $inc_dec = "+";

                                if(count($months) == 0 ){
                                    for($i = 0; $i <= $year_month_value; $i++){
                                        $months[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                        $monthData[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                    }
                                }
                            }
                            // create new array
                            $answer_array = [];
                            $option_name = [];
                            //for option value foreach
                            $computed_arr = [];
                            foreach ($quest_option as $key => $opt_value) {
                                //store option value in variable
                                $ans_value = $opt_value->survey_option_title;
                                //store option value in array
                                $option_name[] = $ans_value;
                                //create new array
                                $answer_count_data = [];
                                //this loop for year data loop and get answer count
                                foreach ($months as $key => $year_data) {
                                    //send value to common helper function
                                    $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                                    $radiobutton_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $radiobutton_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                                $radiobutton_ans_percent = $answer_count->ans_count;
                                            }
                                    //store data into the array
                                    $answer_count_data[] = $radiobutton_ans_percent;
                                    $responses_1[] = $radiobutton_ans_percent;
                                }
                                //year data array and answer count array store in to one single array
                                $answer_array[] = [$answer_count_data,$option_name];
                            }
                            //encode year data array to string for bar chart
                            $yearData = json_encode($monthData);
                            $responses_1 = array_sum($responses_1);
                                    ?>
            {{-- this section for bar chart  --}}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    $(document).ready(function () {
                    // Chart in Dashboard version 1
                    var echartElemBar = document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>');
                    if (echartElemBar) {
                        var echartBar = echarts.init(echartElemBar);
                        echartBar.setOption({
                            legend: {
                                borderRadius: 0,
                                orient: 'horizontal',
                                x: 'right',
                                data:[
                                //this loop for getting value dynamic option name
                                <?php foreach ($option_name as $key => $value1) { ?>
                                 '<?php echo $value1; ?>',
                                <?php } ?>
                                ]
                            },
                            grid: {
                                left: '8px',
                                right: '8px',
                                bottom: '0',
                                containLabel: true
                            },
                            tooltip: {
                                show: true,
                                backgroundColor: 'rgba(0, 0, 0, .8)'
                            },
                            xAxis: [{
                                type: 'category',
                                data: <?php echo $yearData ?>,
                                axisTick: {
                                    alignWithLabel: true
                                },
                                splitLine: {
                                    show: false
                                },
                                axisLine: {
                                    show: true
                                }
                            }],
                            yAxis: [{
                                type: 'value',
                                axisLabel: {
                                    formatter: '{value}'
                                },
                                min: 0,
                                max: <?php echo $responses_1 ?> ,
                                interval: 5,
                                axisLine: {
                                    show: false
                                },
                                splitLine: {
                                    show: true,
                                    interval: 'auto'
                                }
                            }],

                            series:[
                            <?php foreach ($answer_array as $key => $value) { 
                                $answer_count = json_encode($value[0])
                                ?>
                            {
                                name: '<?php echo $value[1][$key].' '. __('message.responses') ; ?>',
                                data: <?php  echo $answer_count; ?> ,
                                label: { show: false, color: '#0168c1' },
                                type: 'bar',
                                barGap: 0,
                                // color: '#bcbbdd',
                                smooth: true,
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowOffsetY: -2,
                                        // shadowColor: 'rgba(0, 0, 0, 0.3)'
                                    }
                                }
                            },
                        <?php } ?>
                            ]
                        });
                        $(window).on('resize', function () {
                            setTimeout(function () {
                                echartBar.resize();
                            }, 500);
                        });
                    }
                    });
                </script>
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                    <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                    <div class="col-sm-12">
                        <div id="columnchart_material_<?php echo $survey_form->id; ?>" class="p-3"
                            style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}}:</b>
                                    {{$responses_1}}</p>
                            </div>
                        </div>
                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                            onclick="printChart('columnchart_material_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_1}}')">{{__('message.print')}}
                            !</button>
                        <div class="append_filter"></div>
                    </div>
                </div>
            </div>
            <?php
                                }
        
                                //==========Here End question type 1 radiobox answer===============
        
                                if ($survey_form->question_type == 2) {
        
                                    $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
        
                                    $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id="");
                                    
                                    // $responses_2 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();
                                    $answer_array = array();
                                    // $answer_array[] = array('0' => 'Month ', '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
        
                                    $push_answer_array = array(ucfirst($month));
                                    
                                    $quest_option_name = [];
                                    foreach ($quest_option as $key => $opt_value) {
                                        array_push($push_answer_array, $opt_value->survey_option_title);
                                        $quest_option_name[] = $opt_value->survey_option_title;
                                    }
                                    
                                    // $answer_array[] = $push_answer_array;
        
                                    // for ($y =$year_month_value; $y >=0; $y--) {
        
                                    //     $year_data = date($m, strtotime("-" . $y . $month));
                                    //     $computed_arr = array($year_data);
                                    //     foreach ($push_answer_array as $ans_value) {
                                    //         if ($ans_value != ucfirst($month)) {
                                                
                                    //             $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id="");
        
                                    //             $checkbox_ans_percent = 0;
                                    //             if (count($total_result_count) > 0) {
                                    //                 $total_ans_count = count($total_result_count);
                                    //                 $checkbox_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                    //             }
                                    //             array_push($computed_arr, $checkbox_ans_percent);
                                    //         }
                                    //     }
                                    //     $answer_array[] = $computed_arr;
                                    // }
                                    // $yearValue = [];
                                    // //this loop for prevent mutiple year data
                                    // if(empty($yearValue)) {
                                    //     for ($y = $year_month_value; $y >= 0; $y--) {
                                    //         $year_data = date($m, strtotime("-" . $y . $month));
                                    //         //store year data in to array
                                    //         $yearValue[] = $year_data;
                                    //     }
                                    // }
                                    
                                    $months = [];
                                    $monthData = array();
                                    if($time_period == 'last_14_day'){
                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= 13; $i++){
                                                $months[] = date('Y-m-d',strtotime(date('Y-m-d')."-".$i . "day"));
                                                $monthData[] = date('d/m',strtotime(date('Y-m-d')."-".$i . "day"));

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

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= 6; $i++){
                                                $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                                $monthData[] = date('d/m',strtotime($m.$inc_dec.$i . $month));
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

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= 6; $i++){
                                                $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                                $monthData[] = date('d/m',strtotime($m.$inc_dec.$i . $month));
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

                                        if(count($months) == 0 ){
                                            for($i = 0; $i < $year_month_value; $i++){
                                                $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                                $monthData[] = date('d',strtotime($m.$inc_dec.$i . $month));
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

                                        if(count($months) == 0 ){
                                            for($i = 0; $i < $year_month_value; $i++){
                                                $months[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                                $monthData[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                            }
                                        }
                                        // dd($monthData);
                                    }elseif ($time_period == 'last_year') {
                                        $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                                        
                                        $start_number = 0;
                                        $year_month_value = 11;
                                        $m = date("Y/01/01",strtotime("-1 year"));
                                        $month = 'month';
                                        $tp = 'm';
                                        $inc_dec = "+";

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= $year_month_value; $i++){
                                                $months[] = date('m',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                                $monthData[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                            }
                                        }
                                    }elseif ($time_period == 'today') {
                                        $start_number = 0;
                                        $year_month_value = 0;
                                        $m = date('Y-m-d');
                                        $month = 'day';
                                        $tp = 'Y-m-d';
                                        $inc_dec = "+";

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= $year_month_value; $i++){
                                                $months[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                                $monthData[] = date('Y-m-d',strtotime('d'.$inc_dec.$i . $month));
                                            }
                                        }
                                    }elseif ($time_period == 'yesterday') {

                                        $start_number = 0;
                                        $year_month_value = 0;
                                        $m = date('Y-m-d',strtotime("-1 day"));
                                        $month = 'day';
                                        $tp = 'Y-m-d';
                                        $inc_dec = "-";

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= $year_month_value; $i++){
                                                $months[] = date('Y-m-d',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                                $monthData[] = date('Y-m-d',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                            }
                                        }
                                        // dd($months);
                                    }elseif ($time_period == 'specific_date') {
                                        $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                                        $start_number = 0;
                                        $year_month_value = 11;
                                        $m = 'm';
                                        $month = 'month';
                                        $tp = 'm';
                                        $inc_dec = "+";

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= $year_month_value; $i++){
                                                $months[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                                $monthData[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                            }
                                        }
                                        // dd($months);
                                    }else {
                                        $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                                        $start_number = 0;
                                        $year_month_value = 11;
                                        $m = $first_month_year;
                                        $month = 'month';
                                        $tp = 'm';
                                        $inc_dec = "+";

                                        if(count($months) == 0 ){
                                            for($i = 0; $i <= $year_month_value; $i++){
                                                $months[] = date('m',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                                $monthData[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                            }
                                        }
                                    }

                                    // create new array
                                    $answer_array = [];
                                    $option_name = [];
                                    $responses_2 = [];
                                    //for option value foreach
                                    foreach ($quest_option as $key => $opt_value) {
                                        //store option value in variable
                                        $ans_value = $opt_value->survey_option_title;
                                        //store option value in array
                                        $option_name[] = $ans_value;
                                        //create new array
                                        $answer_count_data = [];
                                        //this loop for year data loop and get answer count

                                        foreach ($months as $key => $year_data) {
                                            //send value to common helper function
                                            $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                                            $checkbox_ans_percent = 0;
                                                    if (count($total_result_count) > 0) {
                                                        $total_ans_count = count($total_result_count);
                                                        // $checkbox_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                                        $checkbox_ans_percent = $answer_count->ans_count;
                                                    }
                                            //store data into the array
                                            $answer_count_data[] = $checkbox_ans_percent;
                                            $responses_2[] = $checkbox_ans_percent;
                                        }
                                        $answer_array[] = [$answer_count_data,$ans_value];
                                        //year data array and answer count array store in to one single array
                                    }
                                    $responses_2 = array_sum($responses_2);
                                    $checkbox_chart_label = json_encode($answer_array);
                                    $yearData = json_encode($monthData);

                                    ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    $(document).ready(function () {

                                    // Chart in Dashboard version 1
                                    var checkbox_<?php echo $survey_form->id; ?> = document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>');
                                    if (checkbox_<?php echo $survey_form->id; ?>) {
                                        var checkbox_bar = echarts.init(checkbox_<?php echo $survey_form->id; ?>);
                                        checkbox_bar.setOption({
                                            legend: {
                                                borderRadius: 0,
                                                orient: 'horizontal',
                                                x: 'right',
                                                data:[
                                                //this loop for getting value dynamic option name
                                                <?php foreach ($quest_option_name as $key => $value1) { ?>
                                                 '<?php echo $value1; ?>',
                                                <?php } ?>
                                                ]
                                            },
                                            grid: {
                                                left: '8px',
                                                right: '8px',
                                                bottom: '0',
                                                containLabel: true
                                            },
                                            tooltip: {
                                                show: true,
                                                backgroundColor: 'rgba(0, 0, 0, .8)'
                                            },
                                            xAxis: [{
                                                type: 'category',
                                                data: <?php echo $yearData ?>,
                                                axisTick: {
                                                    alignWithLabel: true
                                                },
                                                splitLine: {
                                                    show: false
                                                },
                                                axisLine: {
                                                    show: true
                                                }
                                            }],
                                            yAxis: [{
                                                type: 'value',
                                                axisLabel: {
                                                    formatter: '{value}'
                                                },
                                                min: 0,
                                                max: <?php echo $responses_2 ?>,
                                                interval: 5,
                                                axisLine: {
                                                    show: false
                                                },
                                                splitLine: {
                                                    show: true,
                                                    interval: 'auto'
                                                }
                                            }],

                                            series:[
                                            <?php foreach ($answer_array as $key => $value) { 
                                                $answer_count = json_encode($value[0])
                                                ?>
                                            {
                                                name: '<?php echo $value[1] . ' '.__('message.responses') ; ?>',
                                                data: <?php  echo $answer_count; ?> ,
                                                label: { show: false, color: '#0168c1' },
                                                type: 'bar',
                                                barGap: 0,
                                                // color: '#bcbbdd',
                                                smooth: true,
                                                itemStyle: {
                                                    emphasis: {
                                                        shadowBlur: 10,
                                                        shadowOffsetX: 0,
                                                        shadowOffsetY: -2,
                                                        // shadowColor: 'rgba(0, 0, 0, 0.3)'
                                                    }
                                                }
                                            },
                                        <?php } ?>
                                            ]
                                        });
                                        $(window).on('resize', function () {
                                            setTimeout(function () {
                                                checkbox_bar.resize();
                                            }, 500);
                                        });
                                    }
                                    });
                </script>
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                    <h3 class="p-2">{{$survey_form->survey_question}}</h3>

                    <div class="col-sm-12">
                        <div id="columnchart_material_<?php echo $survey_form->id; ?>" class="p-3"
                            style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}}:</b>
                                    {{$responses_2}}</p>
                            </div>
                        </div>

                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                            onclick="printChart('columnchart_material_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_2}}')">{{__('message.print')}}
                            !</button>
                        <div class="append_filter"></div>
                    </div>
                </div>
            </div>
            <?php
                                }
        
                                //==========Here End question type 2 checkbox answer===============
                                
                                if ($survey_form->question_type == 5) {
                                    

                                    // $responses_5 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();

                                    $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id="");
                                    
                                    $answer_array = array();
                                    $tarrible = array();
                                    $poor = array();
                                    $good = array();
                                    $great = array();
                                    $fantastic = array();
                                    $year = array();
                                    $responses_5 = [];

                                    $answer_array[] = array('0' => $month, '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
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
                                    $i = 1;
                                    // for ($y = $year_month_value; $y >= 0; $y--) {
                                    //     $year_data = date($m, strtotime("-" . $y . $month));
                                    for ($y = $start_number; $y <= $year_month_value; $y++) {
                                        if($time_period == 'specific_date'){
                                            // $year_data = date($m, strtotime("-" . $y . $month));
                                            $year_data = $y;
                                        }else{
                                            $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                        }
        
                                        $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id="",$created_from,$created_to,$time_period);
                                        $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id="",$created_from,$created_to,$time_period);
                                        $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id="",$created_from,$created_to,$time_period);
                                        $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id="",$created_from,$created_to,$time_period);
                                        $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id="",$created_from,$created_to,$time_period);
        
        
                                        $tarrible_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                            $tarrible_ans_percent = $tarrible_count->ans_count;
                                        }
        
                                        $poor_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $poor_ans_percent = ($poor_count->ans_count * 100 / $total_ans_count);
                                            $poor_ans_percent = $poor_count->ans_count ;
                                        }
        
                                        $good_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $good_ans_percent = ($good_count->ans_count * 100 / $total_ans_count);
                                            $good_ans_percent = $good_count->ans_count;
                                        }
        
        
                                        $great_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $great_ans_percent = ($great_count->ans_count * 100 / $total_ans_count);
                                            $great_ans_percent = $great_count->ans_count ;
                                        }
        
                                        $fantastic_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $fantastic_ans_percent = ($fantastic_count->ans_count * 100 / $total_ans_count);
                                            $fantastic_ans_percent = $fantastic_count->ans_count;
                                        }
        
        
                                        $answer_array[] = array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);

                                        $tarrible[] = $tarrible_ans_percent;
                                        $poor[] = $poor_ans_percent;
                                        $good[] = $good_ans_percent;
                                        $great[] = $great_ans_percent;
                                        $fantastic[] = $fantastic_ans_percent;
                                        // $year[] = $year_data;
                                    }
                                    $responses_5 = array_merge($tarrible,$poor,$good,$great,$fantastic
                                    );
                                    //store all data separately
                                    $tarrible = json_encode($tarrible);
                                    $poor = json_encode($poor);
                                    $good = json_encode($good);
                                    $great = json_encode($great);
                                    $fantastic = json_encode($fantastic);
                                    $year = json_encode($year);
                                    $star_rating_bar_chart_label = json_encode($answer_array);
                                    $responses_5 = array_sum($responses_5);
                                    ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    $(document).ready(function () {
                    // Chart in Dashboard version 1
                        var echartElemBar = document.getElementById('echartBar_<?php echo $survey_form->id; ?>');
                        if (echartElemBar) {
                            var echartBar = echarts.init(echartElemBar);
                            echartBar.setOption({
                                legend: {
                                    borderRadius: 0,
                                    orient: 'horizontal',
                                    x: 'right',
                                    data: ['Terrible', 'Poor', 'Good','Great', 'Fantastic']
                                },
                                grid: {
                                    left: '8px',
                                    right: '8px',
                                    bottom: '0',
                                    containLabel: true
                                },
                                tooltip: {
                                    show: true,
                                    backgroundColor: 'rgba(0, 0, 0, .8)'
                                },
                                xAxis: [{
                                    type: 'category',
                                    data: <?php echo $year; ?>,
                                    axisTick: {
                                        alignWithLabel: true
                                    },
                                    splitLine: {
                                        show: false
                                    },
                                    axisLine: {
                                        show: true
                                    }
                                }],
                                yAxis: [{
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value}'
                                    },
                                    min: 0,
                                    max: <?php echo ($responses_5) ?>,
                                    interval: 5,
                                    axisLine: {
                                        show: false
                                    },
                                    splitLine: {
                                        show: true,
                                        interval: 'auto'
                                    }
                                }],
                                series: [{
                                    name: '{{__('message.terrible')}} {{__('message.responses')}}',
                                    data: <?php echo $tarrible; ?>,
                                    label: { show: false, color: '#0168c1' },
                                    type: 'bar',
                                    barGap: 0,
                                    color: 'rgb(66, 133, 244)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.poor')}} {{__('message.responses')}}',
                                    data: <?php echo $poor; ?> , 
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(219, 68, 55)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.good')}} {{__('message.responses')}}',
                                    data: <?php echo $good; ?> ,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(244, 180, 0)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.great')}} {{__('message.responses')}}',
                                    data: <?php echo $great; ?> ,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(15, 157, 88)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.fantastic')}} {{__('message.responses')}}',
                                    data: <?php echo $fantastic; ?>,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(171, 71, 188)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }
                                ]
                            });
                            $(window).on('resize', function () {
                                setTimeout(function () {
                                    echartBar.resize();
                                }, 500);
                            });
                        }
                    });
                </script>
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                    <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                    <div class="col-sm-12">
                        <div id="echartBar_<?php echo $survey_form->id; ?>" class="p-3" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}}:</b>
                                    {{$responses_5}}</p>
                            </div>
                        </div>
                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                            onclick="printChart('echartBar_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_5}}')">{{__('message.print')}}
                            !</button>
                        <div class="append_filter"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php
                if ($survey_form->question_type == 6) {
                                    // $responses_6 = DB::table('tbl_survey_form_info')->where('form_id',$survey_form->survey_form_id)->where('question_id',$survey_form->id)->count();
                                    $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id="");
                                    
                                    $answer_array = array();
                                    $tarrible = array();
                                    $poor = array();
                                    $good = array();
                                    $great = array();
                                    $fantastic = array();
                                    $year = array();
                                    $responses_6 = [];
                                    $answer_array[] = array('0' => $month, '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
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
                                    $i = 1;
                                    // for ($y = $year_month_value; $y >= 0; $y--) {
                                    //     $year_data = date($m, strtotime("-" . $y . $month));
                                    for ($y = $start_number; $y <= $year_month_value; $y++) {
                                        if($time_period == 'specific_date'){
                                            // $year_data = date($m, strtotime("-" . $y . $month));
                                            $year_data = $y;
                                        }else{
                                            $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                        }
                                    
        
                                        $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id="",$created_from,$created_to,$time_period);
                                        $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id="",$created_from,$created_to,$time_period);
                                        $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id="",$created_from,$created_to,$time_period);
                                        $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id="",$created_from,$created_to,$time_period);
                                        $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id="",$created_from,$created_to,$time_period);
        
        
                                        $tarrible_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                            $tarrible_ans_percent = $tarrible_count->ans_count;
                                        }
        
                                        $poor_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $poor_ans_percent = ($poor_count->ans_count * 100 / $total_ans_count);
                                            $poor_ans_percent = $poor_count->ans_count;
                                        }
        
                                        $good_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $good_ans_percent = ($good_count->ans_count * 100 / $total_ans_count);
                                            $good_ans_percent = $good_count->ans_count; 
                                        }
        
        
                                        $great_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $great_ans_percent = ($great_count->ans_count * 100 / $total_ans_count);
                                            $great_ans_percent = $great_count->ans_count;
                                        }
        
                                        $fantastic_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            // $fantastic_ans_percent = ($fantastic_count->ans_count * 100 / $total_ans_count);
                                            $fantastic_ans_percent = $fantastic_count->ans_count;
                                        }
        
        
                                        $answer_array[] = array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);

                                        $tarrible[] = $tarrible_ans_percent;
                                        $poor[] = $poor_ans_percent;
                                        $good[] = $good_ans_percent;
                                        $great[] = $great_ans_percent;
                                        $fantastic[] = $fantastic_ans_percent;
                                        // $year[] = $year_data;
                                        // $responses_6[] = $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);
                                    }
                                    $responses_6 = array_merge($tarrible,$poor,$good,$great,$fantastic);                                    
                                    //store all data separately
                                    $tarrible = json_encode($tarrible);
                                    $poor = json_encode($poor);
                                    $good = json_encode($good);
                                    $great = json_encode($great);
                                    $fantastic = json_encode($fantastic);
                                    $year = json_encode($year);
                                    $star_rating_bar_chart_label = json_encode($answer_array);
                                    $responses_6 = array_sum($responses_6);
                                    ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    $(document).ready(function () {
                    // Chart in Dashboard version 1
                        var echartElemBar = document.getElementById('echartBar_<?php echo $survey_form->id; ?>');
                        if (echartElemBar) {
                            var echartBar = echarts.init(echartElemBar);
                            echartBar.setOption({
                                legend: {
                                    borderRadius: 0,
                                    orient: 'horizontal',
                                    x: 'right',
                                    data: ['Terrible', 'Poor', 'Good','Great', 'Fantastic']
                                },
                                grid: {
                                    left: '8px',
                                    right: '8px',
                                    bottom: '0',
                                    containLabel: true
                                },
                                tooltip: {
                                    show: true,
                                    backgroundColor: 'rgba(0, 0, 0, .8)'
                                },
                                xAxis: [{
                                    type: 'category',
                                    data: <?php echo $year; ?>,
                                    axisTick: {
                                        alignWithLabel: true
                                    },
                                    splitLine: {
                                        show: false
                                    },
                                    axisLine: {
                                        show: true
                                    }
                                }],
                                yAxis: [{
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value}'
                                    },
                                    min: 0,
                                    max: <?php echo $responses_6 ?>,
                                    interval: 5,
                                    axisLine: {
                                        show: false
                                    },
                                    splitLine: {
                                        show: true,
                                        interval: 'auto'
                                    }
                                }],
                                series: [{
                                    name: '{{__('message.terrible')}} {{__('message.responses')}}',
                                    data: <?php echo $tarrible; ?>,
                                    label: { show: false, color: '#0168c1' },
                                    type: 'bar',
                                    barGap: 0,
                                    color: 'rgb(66, 133, 244)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.poor')}} {{__('message.responses')}}',
                                    data: <?php echo $poor; ?> , 
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(219, 68, 55)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.good')}} {{__('message.responses')}}',
                                    data: <?php echo $good; ?> ,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(244, 180, 0)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.great')}} {{__('message.responses')}}',
                                    data: <?php echo $great; ?> ,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(15, 157, 88)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }, {
                                    name: '{{__('message.fantastic')}} {{__('message.responses')}}',
                                    data: <?php echo $fantastic; ?>,
                                    label: { show: false, color: '#639' },
                                    type: 'bar',
                                    color: 'rgb(171, 71, 188)',
                                    smooth: true,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowOffsetY: -2,
                                            shadowColor: 'rgba(0, 0, 0, 0.3)'
                                        }
                                    }
                                }
                                ]
                            });
                            $(window).on('resize', function () {
                                setTimeout(function () {
                                    echartBar.resize();
                                }, 500);
                            });
                        }
                    });
                </script>
                <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                    <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                    <div class="col-sm-12">
                        <div id="echartBar_<?php echo $survey_form->id; ?>" class="p-3" style="height: 300px;"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no_of_responses')}}:</b>
                                    {{$responses_6}}</p>
                            </div>
                        </div>
                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                            onclick="printChart('echartBar_<?php echo $survey_form->id; ?>','<?php echo $survey_form->survey_question ?>','{{$responses_6}}')">{{__('message.print')}}
                            !</button>
                        <div class="append_filter"></div>
                    </div>
                </div>
            </div>
            <?php } 
                }
            }
        } else {
            ?>
            <div style="text-align:center;color:#f00;font-size:22px;">{{__('message.no_record_found')}} </div>
            <?php } ?>

        </div>
        <!--end row div-->

        <div>
            <div class="card text-left" id="question_answer">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{__('message.question_type_text_answer_list')}}</a>
                    </h4>
                    <div class="table-responsive ">
                        <table id="datatable" class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="text-center">S.No</th>
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
                    $('#sub_category_id').html('<option value="0">{{__('message.select_sub_category')}} </option>');
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
{{-- date picker section --}}
<script>
    $(document).ready(function(){
                        $('#single_cal4').datepicker({
                            locale: {
                                format: 'YYYY-MM-DD'
                            },
                            changeMonth: true,
                            changeYear: true,
                            singleDatePicker: true,
                            singleClasses: "picker_4"
                        }, function (start, end, label) {
                            console.log(start.toISOString(), end.toISOString(), label);
                        });
                        $('#single_cal5').datepicker({
                            locale: {
                                format: 'YYYY-MM-DD'
                            },
                            changeMonth: true,
                            changeYear: true,
                            singleDatePicker: true,
                            singleClasses: "picker_4"
                        }, function (start, end, label) {
                            console.log(start.toISOString(), end.toISOString(), label);
                        });
                    })
</script>
{{-- end date picker section --}}
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
        
        var time_period = $('#time_period').val()!= 0 ? $('#time_period').val() : '{{__('message.all')}}' ;
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
                
            }
        })
    }
</script>
@include('datatable.dt_js')
@stop