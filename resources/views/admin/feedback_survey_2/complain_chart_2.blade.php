@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echarts.script.min.js')}}"></script>
@stop
{{-- Page content --}}
@section('inner_body')
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
        {!! Form::open(['route' => 'complain_chart_filter']) !!}
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.filter')}} {{__('message.for')}} {{__('message.view')}}
                    {{__('message.complain')}} {{__('message.chart')}}</h3>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="name"
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.user')}}<span class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    @php
                                    $user_name = Session::get('user');
                                    @endphp
                                    {!! Form::select('user', $user, $user_name, ['class' => 'form-control','id' =>
                                    'user','placeholder' => __('message.select').' '.__('message.user') ,'data-name' =>
                                    ($user_name != null && $user_name != 0) ? $user[$user_name] : '']) !!}
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.location')}}<span class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    @php
                                    $city_name = Session::get('city');
                                    @endphp
                                    {!! Form::select('city', $location, $city_name, ['class' => 'form-control','id' =>
                                    'city','placeholder' => __('message.select').' '.__('message.city')]) !!}
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.time_period')}}<span class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    @php
                                    $time_period_selected = Session::get('time_period') ;
                                    @endphp
                                    {!!
                                    Form::select('time_period',$time_filter,$time_period_selected,['class'=>'form-control','id'=>'time_period','placeholder'=>__('message.select').'
                                    '.__('message.time_period')]) !!}
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.from')}}<span class="required">*</span></label>
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.to')}}<span class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    <input name="created_to" value="<?php echo Session::get('created_to') ?>" readonly
                                        type="text" class="form-control has-feedback-left" id="single_cal4"
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
                            <label for="business_name"
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.chart')}} {{__('message.type')}}<span class="required">*</span></label>
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
                            <button type="submit" class="btn btn-success" id="btn-search">{{__('message.view')}}
                                {{__('message.report')}}</button>
                            {{-- <input type="button" class="btn btn-warning" id="printarea"
                                value="{{__('message.print')}}!" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        {!! Form::close() !!}
        <!-- end::form 2-->
        <div class="row">
            <div id="showList"></div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">

                    {{-- <h3 class="text-center m-0 mb-3 p-2">{{__('message.complain')}} {{__('message.status')}}
                    {{__('message.chart')}}</h3> --}}
                    <div class="text-center">
                        <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;">
                        </div>
                        <div id="printableArea">
                            <?php
                                $month = Session::get('select_chart_by') == 2 ? 'month' : 'year';
                                $m = Session::get('select_chart_by') == 2 ? 'm' : 'Y';
                                
                                $year_month_value = Session::get('select_chart_by') == 2 ? 11 : 5;
                                $answer_array = [];
                                $new = [];
                                $in_progress  = [];
                                $resolved  = [];
                                $late  = [];
                                $year  = array();
                                $complain1   = [];
                                if (count($feedback_complain) > 0) {
                                    $chart_bar = array();

                                    $new_ans_count = 0;
                                    $in_progress_ans_percent = 0;
                                    $resolved_ans_percent = 0;
                                    $late_ans_percent = 0;
                                    foreach ($data as $key => $value) {
                                        
                                        foreach ($feedback_complain as $key => $complain) {
                                            foreach ($complain as $key1 => $complain1) {
                                                $total_compain_count = FeedbackHelper::getTotalComplain($user_id,$city,$created_from,$created_to);

                                                $answer_array = array();
                                                $tarrible = array();
                                                $poor = array();
                                                $good = array();
                                                $great = array();
                                                $fantastic = array();
                                                $response_array = array();
                                                $new_response = array();
                                                $inProgress_response = array();
                                                $resolved_response = array();
                                                $late_response = array();
                                                //$year = array();
                                                
                                                $answer_array[] = array('0' => $month,'1' => 'new', '2' => 'in progress', '3' => 'resolved', '4' => 'late');
                                                $i = 1;
                                                //this section for only save year data
                                                // if(count($year) == 0){
                                                //     for ($y = $year_month_value; $y >= 0; $y--) {
                                                //         // dd(date('d',strtotime("-13 day")),$time_period);
                                                //     // $year_data = date($m, strtotime("-" . $y . $month));
                                                //         //this section is for display static year data
                                                //             // if($m == 'm'){
                                                //             //     $year = ['01','02','03','04','05','06','07','08','09','10','11','12'];
                                                //             // }else{
                                                //             //     $year = [date('Y'),date('Y',strtotime("-1 year")),date('Y',strtotime("-2 year")),date('Y',strtotime("-3 year")),date('Y',strtotime("-4 year")),date('Y',strtotime("-5 year"))];
                                                //             // }
                                                //             if($time_period == 'last_14_day'){
                                                //                 $year = [date('d'),date('d',strtotime("-1 day")),date('d',strtotime("-2 day")),date('d',strtotime("-3 day")),date('d',strtotime("-4 day")),date('d',strtotime("-5 day")),date('d',strtotime("-6 day")),date('d',strtotime("-7 day")),date('d',strtotime("-8 day")),date('d',strtotime("-9 day")),date('d',strtotime("-10 day")),date('d',strtotime("-11 day")),date('d',strtotime("-12 day")),date('d',strtotime("-13 day"))];
                                                //             }
                                                //         }
                                                // }
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

                                                for ($y = $start_number; $y <= $year_month_value; $y++) {
                                                    if($time_period == 'specific_date'){
                                                        // $year_data = date($m, strtotime("-" . $y . $month));
                                                        $year_data = $y;
                                                    }else{
                                                        $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                                    }
                                                    $new_count = FeedbackHelper::getComplainStatusCount($year_data, 'new', $user_id,$city,$created_from,$created_to,$time_period);
                                                    $in_progress_count = FeedbackHelper::getComplainStatusCount($year_data, 'in_progress', $user_id,$city,$created_from,$created_to,$time_period);
                                                    $resolved_count = FeedbackHelper::getComplainStatusCount($year_data, 'resolved', $user_id,$city,$created_from,$created_to,$time_period);
                                                    $late_count = FeedbackHelper::getComplainStatusCount($year_data, 'late', $user_id,$city,$created_from,$created_to,$time_period);
                                                    
                                                    $new_ans_count = 0;
                                                    if (count($total_compain_count) > 0) {
                                                        $total_ans_count = count($total_compain_count);
                                                        $new_ans_count = ($new_count->status_count * 100 / $total_ans_count);
                                                    }
                                                    // dd($new_ans_count);
                                                    $in_progress_ans_percent = 0;
                                                    if (count($total_compain_count) > 0) {
                                                        $total_ans_count = count($total_compain_count);
                                                        $in_progress_ans_percent = ($in_progress_count->status_count * 100 / $total_ans_count);
                                                    }

                                                    $resolved_ans_percent = 0;
                                                    if (count($total_compain_count) > 0) {
                                                        $total_ans_count = count($total_compain_count);
                                                        $resolved_ans_percent = ($resolved_count->status_count * 100 / $total_ans_count);
                                                    }


                                                    $late_ans_percent = 0;
                                                    if (count($total_compain_count) > 0) {
                                                        $total_ans_count = count($total_compain_count);
                                                        $late_ans_percent = ($late_count->status_count * 100 / $total_ans_count);
                                                    }

                                                    $answer_array[] = array(round($year_data),round($new_ans_count), round($in_progress_ans_percent), round($resolved_ans_percent), round($late_ans_percent));
                                                    //this response is for show response data
                                                    $new_response[] = $new_count->status_count;

                                                    $inProgress_response[] = $in_progress_count->status_count;

                                                    $resolved_response[] = $resolved_count->status_count;

                                                    $late_response[] = $late_count->status_count;
                                                   
                                                    //this section is for sum value for pie chart
                                                    $new_value = array_sum($new)/$total_ans_count;
                                                    $in_progress_value = array_sum($in_progress)/ $total_ans_count;
                                                    $resolved_value = array_sum($resolved)/ $total_ans_count;  
                                                    $late_value = array_sum($late)/ $total_ans_count;

                                                    //this section for  store complain status value in array
                                                    $new[] = round($new_ans_count);
                                                    $in_progress[] = round($in_progress_ans_percent);
                                                    $resolved[] = round($resolved_ans_percent);
                                                    $late[] = round($late_ans_percent);
                                                }
                                            }
                                        }
                                        // $response_array = array(); 
                                        $new = json_encode($new);
                                        $in_progress = json_encode($in_progress);
                                        $resolved = json_encode($resolved);
                                        $late = json_encode($late);
                                        $year = json_encode($year);
                                        $arary = [
                                            // ['question', 'question rating'],
                                            ['new' ,      $new_value],
                                            ['in_progress' ,        $in_progress_value ],
                                            ['resolved' ,    $resolved_value ],
                                            ['late' ,   $late_value ]
                                        ];
                                        $complainPieArray = [];
                                            foreach ($arary as $key => $value) {
                                                $pieArray[$key]['value'] = round($value[1]);
                                                $pieArray[$key]['name'] = $value[0];
                                            }
                                            $pie_chart = json_encode($pieArray);
                                            $bar_chart = json_encode($answer_array);
                                        ?>
                            @if(isset($complain1) && $complain1 != null)
                            @if(Session::get('select_chart_type') == 1)
                            <div class="">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <h3 class="text-center m-0 p-2">{{__('message.complain')}}
                                            {{__('message.status')}} {{__('message.chart')}}</h3>
                                        <div class="col-sm-12">
                                            <div id="compalinchart_material_<?php echo $complain1->id; ?>"
                                                style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}</b></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-3 col-3 text-center">
                                                    <p class="text-14 mt-1 mb-3"><b>{{__('message.new')}}:</b> {{array_sum($new_response)}}</p>
                                                </div>
                                                <div class="col-md-3 col-3 text-center">
                                                    <p class="text-14 mt-1 mb-3"><b>{{__('message.inProgress')}}:</b> {{array_sum($inProgress_response)}}</p>
                                                </div>
                                                <div class="col-md-3 col-3 text-center">
                                                    <p class="text-14 mt-1 mb-3"><b>{{__('message.resolved')}}:</b> {{array_sum($resolved_response)}}</p>
                                                </div>
                                                <div class="col-md-3 col-3 text-center">
                                                    <p class="text-14 mt-1 mb-3"><b>{{__('message.late')}}:</b> {{array_sum($late_response)}}</p>
                                                </div>
                                            </div>
                                            <div class="append_filter"></div>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    let complain_pie_<?php echo $complain1->id; ?> = document.getElementById('compalinchart_material_<?php echo $complain1->id; ?>');
                                    if (complain_pie_<?php echo $complain1->id; ?>) {
                                        let complain_pie = echarts.init(complain_pie_<?php echo $complain1->id; ?>);
                                        complain_pie.setOption({
                                            color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                            tooltip: {
                                                show: true,
                                                backgroundColor: 'rgba(0, 0, 0, .8)'
                                            },

                                            series: [{
                                                    name: 'Complain Chart',
                                                    type: 'pie',
                                                    radius: '60%',
                                                    center: ['50%', '50%'],
                                                    data: <?php echo $pie_chart; ?> ,
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
                                                complain_pie.resize();
                                            }, 500);
                                        });
                                    }
                                </script>
                            </div>
                            @else
                            <div class="">
                                <!-- bar chart start here -->
                                <script type="text/javascript">
                                    $(document).ready(function () {

                                    // Chart in Dashboard version 1
                                        var echartElemBar = document.getElementById('compalinchart_material_<?php echo $complain1->id;; ?>');
                                        if (echartElemBar) {
                                            var echartBar = echarts.init(echartElemBar);
                                            echartBar.setOption({
                                                legend: {
                                                    borderRadius: 0,
                                                    orient: 'horizontal',
                                                    x: 'right',
                                                    data: ['new', 'in_progress', 'resolved','late']
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
                                                    max: 100,
                                                    interval: 20,
                                                    axisLine: {
                                                        show: false
                                                    },
                                                    splitLine: {
                                                        show: true,
                                                        interval: 'auto'
                                                    }
                                                }],
                                                series: [{
                                                    name: 'new',
                                                    data: <?php echo $new; ?>,
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
                                                    name: 'in_progress',
                                                    data: <?php echo $in_progress; ?> , 
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
                                                    name: 'resolved',
                                                    data: <?php echo $resolved; ?> ,
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
                                                    name: 'late',
                                                    data: <?php echo $late; ?> ,
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
                                <div class="text-center o-hidden mb-3 pb-2 ">
                                    <h3 class="text-center m-0 p-2">{{__('message.complain')}} {{__('message.status')}}
                                        {{__('message.chart')}}</h3>
                                    <div class="col-sm-12">
                                        <div id="compalinchart_material_<?php echo $complain1->id; ?>" class="p-3"
                                            style="height: 300px;"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}</b></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-3 text-center">
                                                <p class="text-14 mt-1 mb-1"><b>{{__('message.new')}}:</b> {{array_sum($new_response)}}</p>
                                            </div>
                                            <div class="col-md-3 col-3 text-center">
                                                <p class="text-14 mt-1 mb-1"><b>{{__('message.inProgress')}}:</b> {{array_sum($inProgress_response)}}</p>
                                            </div>
                                            <div class="col-md-3 col-3 text-center">
                                                <p class="text-14 mt-1 mb-1"><b>{{__('message.resolved')}}:</b> {{array_sum($resolved_response)}}</p>
                                            </div>
                                            <div class="col-md-3 col-3 text-center">
                                                <p class="text-14 mt-1 mb-1"><b>{{__('message.late')}}:</b> {{array_sum($late_response)}}</p>
                                            </div>
                                        </div>
                                        <div class="append_filter"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="col-sm-12" style="text-align:center;color:#f00;font-size:22px;">
                                {{__('message.no_record_found')}}</div>
                            @endif

                            <?php
                                    }
                                } else {
                                    ?>
                            <div class="col-sm-12" style="text-align:center;color:#f00;font-size:22px;">
                                {{__('message.no_record_found')}}</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

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
    $(document).ready(function () {
        $('#category_id').change(function () {
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
                    $('#sub_category_id').html('<option value="0">Select sub category</option>');
                    selectedSubCategory = '<?php echo!empty(Input::old('sub_category_id')) ? Input::old('sub_category_id') : ((!empty($repairman_data->sub_category_id) ? $repairman_data->sub_category_id : 0)) ?>';
                    $.each(resp.data, function (index, value) {
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
<script type="text/javascript">
    var dataTable;
    var columns = [
        {data: 'rownum', name: 'rownum'},
        {data: 'question', name: 'question'},
        {data: 'rating', name: 'rating'},
        // {data: 'comments', name: 'comments'},
        // {data: 'name', name: 'name'},
        // {data: 'email', name: 'email'},
        // {data: 'mobile', name: 'mobile'},
        {data: 'created_at', name: 'created_at'},
    ];
    var ajaxUrl = "{!! route('show_question_answer') !!}" //Url of ajax datatable where you fetch data


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
            "class": "text-center"
        },
        {
            "targets": 2,
            "orderable": true,
            "class": "text-center"
        },
        {
            "targets": 3,
            "orderable": false,
            "class": "text-center"
        },
    ];
</script>
<script>
    function printDiv(divName) {

        var user = document.getElementById ("user");
        var valUser =  user.options[user.selectedIndex].value;
        var strUser = user.options[user.selectedIndex].text;

        var city = document.getElementById ("city");
        var valCity =  city.options[city.selectedIndex].value;
        var strCity = city.options[city.selectedIndex].text;

        var from = document.getElementById ("single_cal5");
        var valFrom = from.value;

        var to = document.getElementById ("single_cal4");
        var valTo = to.value;

        var htmlShow = '<label>Filters</label></br><ul>';
        if (valUser != 0)  {
            htmlShow = htmlShow + '<li> User:- ' +  strUser + '</li>';
        }
        if(valCity != 0) {
            htmlShow = htmlShow + '<li> City:- ' + strCity + '</li>';
        }
        
        if (valFrom)  {
            htmlShow = htmlShow + '<li> From:- ' +  valFrom + '</li>';
        }
        if(valTo != 0) {
            htmlShow = htmlShow + '<li> To:- ' + valTo + '</li>';
        }

        htmlShow = htmlShow + '</ul>';
        document.getElementById("showList").style.display = 'block';
        document.getElementById("showList").innerHTML = htmlShow
        
        
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
        document.getElementById("showList").style.display = 'none';
    }

    
        $("#printarea").click(function(){
            html2canvas(document.querySelector("#printableArea")).then(canvas => {  
                var dataURL = canvas.toDataURL('image',1.0);
                // console.log(dataURL);
                var width = canvas.width;
                // var height = canvas.height;
                // var style = canvas.style;
                var printWindow = window.open("");
                var user = document.getElementById ("user");
                var valUser =  user.options[user.selectedIndex].value;
                var strUser = user.options[user.selectedIndex].text;

                var city = document.getElementById ("city");
                var valCity =  city.options[city.selectedIndex].value;
                var strCity = city.options[city.selectedIndex].text;

                var from = document.getElementById ("single_cal5");
                var valFrom = from.value;

                var to = document.getElementById ("single_cal4");
                var valTo = to.value;

                var htmlShow = '<label>Filters</label></br><ul>';
                if (valUser != 0)  {
                    htmlShow = htmlShow + '<li> User:- ' +  strUser + '</li>';
                }
                if(valCity != 0) {
                    htmlShow = htmlShow + '<li> City:- ' + strCity + '</li>';
                }
                
                if (valFrom)  {
                    htmlShow = htmlShow + '<li> From:- ' +  valFrom + '</li>';
                }
                if(valTo != 0) {
                    htmlShow = htmlShow + '<li> To:- ' + valTo + '</li>';
                }

                htmlShow = htmlShow + '</ul>';
                $(printWindow.document.body)
                .html(htmlShow + "<img id='Image' src=" + dataURL + " style='"+canvas.height+";width:1200px'></img>")
                .ready(function() {
                // printWindow.focus();
                printWindow.print();
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
<script>
    $(document).ready(function(){
            var user = $('#user').attr('data-name') != '' ? $('#user').attr('data-name') : 'All';
            var city = $('#city').val() != '' ? $('#city').val() : 'All';
            var time_period = $('#time_period').val() != '' ? $('#city').val() : 'All';
            var select_chart_type = $('#select_chart_type').val()
            var created_from = $('#single_cal5').val()
            var created_to = $('#single_cal4').val()
            
            if(select_chart_type == 1){
                select_chart_type = 'Pie Chart'
            }else{
                select_chart_type = 'Bar Chart'
            }
            if(time_period == 'specific_date'){
                $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>User:</b> '+user+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>Time Period:</b> '+time_period+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>Location:</b> '+city+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>Chart type:</b> '+select_chart_type+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>Created From:</b> '+created_from+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>Created To:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"> <div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>User:</b> '+user+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>Time Period:</b> '+time_period+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>Location:</b> '+city+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>Chart type:</b> '+select_chart_type+'</p></div></div>');
            }
    })
</script>
@include('datatable.dt_js')
@stop