@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="//cdn.syncfusion.com/16.4.0.42/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
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
        {!! Form::open(['route' => 'chart_session']) !!}
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.filter')}} {{__('message.for')}} {{__('message.view')}}
                    {{__('message.question')}} {{__('message.chart')}}</h3>
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
                                    'city','placeholder' => __('message.select').' '. __('message.city')]) !!}
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
                                                if (Session::get('select_chart_type') == 2) {
                                                    echo "selected";
                                                }
                                                ?> value="2">{{__('message.pie_chart')}}</option>
                                        <option <?php
                                                if (Session::get('select_chart_type') == 1) {
                                                    echo "selected";
                                                }
                                                ?> value="1">{{__('message.bar_chart')}}</option>
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
                            {{-- <input type="button" class="btn btn-warning" onclick="printDiv('printableArea')"
                            value="{{__('message.print')}}!" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        {!! Form::close() !!}
        <!-- end::form 2-->
        
        <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
        <div class="row" id="printableArea" >
                <div id="showList"></div>
            <?php
            $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
            $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
            $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
            
            if (count($feedback_question[0]) > 0) {
                $chart_bar = array();
                foreach ($feedback_question as $key => $question) {
                    foreach ($total_question as $key1 => $question1) {
                    $question_id = $question1->id;

                            $total_result_count = FeedbackHelper::getTotalAnswer($question_id);
                            
                            $tarrible = array();
                            $poor = array();
                            $good = array();
                            $great = array();
                            $fantastic = array();
                            $year = array();
                            $answer_array = array();

                            //this section for response 
                            $tarrible_response = array();
                            $poor_response = array();
                            $good_response = array();
                            $great_response = array();
                            $fantastic_response = array();
                            $response_array = array();

                            $answer_array[] = array('0' => $month,'1' => $question1->emoji_name_1, '2' => $question1->emoji_name_2, '3' => $question1->emoji_name_3, '4' => $question1->emoji_name_4, '5' => $question1->emoji_name_5);
                            // $answer_array[] = array('0' => $month, '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                            //this section is for date filter
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
                                // $year_data = date($m, strtotime("-" . $y . $month));
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }
                                $tarrible_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '1', $user_id,$city,$created_from,$created_to,$time_period);
                                $poor_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '2', $user_id,$city,$created_from,$created_to,$time_period);
                                $good_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '3', $user_id,$city,$created_from,$created_to,$time_period);
                                $great_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '4', $user_id,$city,$created_from,$created_to,$time_period);
                                $fantastic_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '5', $user_id,$city,$created_from,$created_to,$time_period);

                                $tarrible_ans_percent = 0;
                                
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                }
                                $poor_ans_percent = 0;
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $poor_ans_percent = ($poor_count->ans_count * 100 / $total_ans_count);
                                }

                                $good_ans_percent = 0;
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $good_ans_percent = ($good_count->ans_count * 100 / $total_ans_count);
                                }


                                $great_ans_percent = 0;
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $great_ans_percent = ($great_count->ans_count * 100 / $total_ans_count);
                                }

                                $fantastic_ans_percent = 0;
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $fantastic_ans_percent = ($fantastic_count->ans_count * 100 / $total_ans_count);
                                }

                                $tarrible_response[] = $tarrible_count->ans_count;
                                $poor_response[] = $poor_count->ans_count;
                                $good_response[] = $good_count->ans_count;
                                $great_response[] = $great_count->ans_count;
                                $fantastic_response[] = $fantastic_count->ans_count;

                                $answer_array[] = array($year_data,$tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);

                                $tarrible[] = round($tarrible_ans_percent);
                                $poor[] = round($poor_ans_percent);
                                $good[] = round($good_ans_percent);
                                $great[] = round($great_ans_percent);
                                $fantastic[] = round($fantastic_ans_percent);
                                // $year[] = $year_data;
                            }
                            $response_array = array_merge($tarrible_response,$poor_response,$good_response,$great_response,$fantastic_response);
                            $rating1 = $question1->emoji_name_1 != null ? $question1->emoji_name_1:'Very poor';
                            $rating2 = $question1->emoji_name_2 != null ? $question1->emoji_name_2 : 'Poor';
                            $rating3 = $question1->emoji_name_3 != null ? $question1->emoji_name_3 : 'Average';
                            $rating4 = $question1->emoji_name_4 != null ? $question1->emoji_name_4 : 'Good';
                            $rating5 = $question1->emoji_name_5 != null ? $question1->emoji_name_5 : 'Excellent';
                            $array = [
                                        [array_sum($tarrible), $rating1],
                                        [array_sum($poor), $rating2],
                                        [array_sum($good), $rating3],
                                        [array_sum($great), $rating4],
                                        [array_sum($fantastic), $rating5]
                                    ];
                                    //print_r($array);
                            $emoji = "emoji_name_".($key1+1);
                            $tarrible = json_encode($tarrible);
                            $poor = json_encode($poor);
                            $good = json_encode($good);
                            $great = json_encode($great);
                            $fantastic = json_encode($fantastic);
                            $year = json_encode($year);


                                    $pieArray = [];
                                    foreach ($array as $key => $value) {
                                        $pieArray[$key]['value'] = round($value[0]);
                                        $pieArray[$key]['name'] = $value[1];
                                    }

                                    foreach ($array as $key => $value) {
                                        $pieArray1[$key]['x'] = $value[1];
                                        $pieArray1[$key]['y'] = $value[0];
                                        $pieArray1[$key]['text'] = $value[1];
                                    }
                                    //end
                                     
                                    $array = json_encode($pieArray);
                                    $array1 = json_encode($pieArray1);
                                    //dd($array);
                                    $star_rating_bar_chart_label = json_encode($answer_array);
                            ?>
            @if(Session::get('select_chart_type') == 2)
            <div class="col-sm-12 " style="display: none">
                <div id="printableArea_<?php echo $question_id; ?>" >
                    <h3 class="p-2">{{$question1->question}} <br>

                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" >
                <div class="x_panel">
                    <div class="x_content text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2">
                        <h3 class="p-2">{{$question1->question}} <br>
                        </h3>
                        <div id="columnchart_material_<?php echo $question_id; ?>" style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}:</b> {{array_sum($response_array)}}</p>
                            </div>
                        </div>
                        <div class="append_filter"></div>
                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;" onclick="chartPrint_<?php echo $question_id; ?>()">Print !</button>                        
                    </div>
                </div>
                <script type="text/javascript">
                    let FeedbackPieChart_<?php echo $question_id; ?> = document.getElementById('columnchart_material_<?php echo $question_id; ?>');
                    if (FeedbackPieChart_<?php echo $question_id; ?>) {
                        let feedback_Pie = echarts.init(FeedbackPieChart_<?php echo $question_id; ?>);
                        feedback_Pie.setOption({
                            color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                            tooltip: {
                                show: true,
                                backgroundColor: 'rgba(0, 0, 0, .8)'
                            },

                            series: [{
                                    name: '<?php echo $question1->question; ?>',
                                    type: 'pie',
                                    radius: '60%',
                                    center: ['50%', '50%'],
                                    data: <?php echo $array; ?> ,
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
                                feedback_Pie.resize();
                            }, 500);
                        });
                    }
                </script>
                
                <script type="text/javascript">
                    var chartObj;
                    $(function () 
                    {
                        $("#printableArea_<?php echo $question_id; ?>").ejChart(
                        {
                            
                            series: 
                            [
                                {
                                    points: <?php echo $array1?>,
                                    marker: 
                                    {
                                        dataLabel: 
                                        {
                                            visible:true,
                                            shape: 'none', 
                                            connectorLine: { type: 'line',color: 'black' },
                                            font: {size:'14px'},
                                            enableContrastColor:true
                                        }
                                    },
                                    border :{width:2, color:'white'}, 
                                    name: 'Expenses', 
                                    type: 'pie', 
                                    enableAnimation : true, 
                                    labelPosition:'outsideExtended', 
                                    enableSmartLabels:true, startAngle:145                         
                                }

                            ],          
                            border: {
                                opacity: 1
                            },
                            chartArea:
                            {
                                border: {
                                    opacity: 1
                                },
                            },
                            load: "loadTheme",
                            //seriesRendering:"seriesRender",
                            title:{text: '<?php echo $question1->question; ?>'},       
                            isResponsive: true,
                            size: { width: "800"},
                            legend: { visible: false}
                        });       
                    });
                    
                    //Setting background and chartArea background color to export the chart with correct background color
                    function chartPrint_<?php echo $question_id; ?>()
                    {
                        var chartObj = $("#printableArea_<?php echo $question_id; ?>").ejChart("instance");
                        chartObj.print("printableArea_<?php echo $question_id; ?>");
                        //var chart = $("#printableArea_<?php echo $question_id; ?>").ejChart("instance");
                        //chart.print("printableArea_<?php echo $question_id; ?>");
                    }
                    

                </script>
            </div>
            @else
            <div class="col-sm-12 ">
                <div id="printableArea_1<?php echo $question_id; ?>">
                    <h3 class="p-2">{{$question1->question}} <br>

                </div>
            </div>
            <?php //echo $tarrible; ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    var chartObj;
                    $(function () 
                    {

                        $("#printableArea_1<?php echo $question_id; ?>").ejChart(
                        {
                            //Initializing Series
                            series: 
                            [
                                {
                                    points: <?php echo $array1?>,
                                    name: 'Gold',fill:"rgba(135,206,235,1)"
                                },  
                                {
                                    points: [{ x: "USA", y: 70 }, { x: "China", y: 60 }, 
                                             { x: "Japan", y: 60 }, { x: "Australia", y: 56 },
                                             { x: "France", y: 45 }, { x: "Germany", y: 30 }, 
                                             { x: "Italy", y: 35 }, { x: "Sweden", y: 25 }],
                                    name: 'Silver',fill:"rgba(255,255,0,0.7)"
                                },
                                {
                                    points: [{ x: "USA", y: 45 }, { x: "China", y: 55 },
                                             { x: "Japan", y: 50 }, { x: "Australia", y: 40 },
                                             { x: "France", y: 35 }, { x: "Germany", y: 22 }, 
                                             { x: "Italy", y: 37 }, { x: "Sweden", y: 27 }],
                                    name: 'Bronze',fill:"rgba(255,204,153,1)"
                                }
                            ],
                            load:"loadTheme",
                            isResponsive: true,
                            title :{text: '<?php echo $question1->question; ?>'},
                            size: { height: "600" },
                            legend: { visible: true, position: 'top' }
                        });
                    });
                    
                    //Setting background and chartArea background color to export the chart with correct background color
                    function chartPrintThumb_<?php echo $question_id; ?>()
                    {
                        var chartObj = $("#printableArea_<?php echo $question_id; ?>").ejChart("instance");
                        chartObj.print("printableArea_<?php echo $question_id; ?>");
                        //var chart = $("#printableArea_<?php echo $question_id; ?>").ejChart("instance");
                        //chart.print("printableArea_<?php echo $question_id; ?>");
                    }
                    

                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        // Chart in Dashboard version 1
                            var echartElemBar = document.getElementById('columnchart_material_<?php echo $question_id; ?>');
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
                                        name: 'Terrible',
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
                                        name: 'Poor',
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
                                        name: 'Good',
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
                                        name: 'Great',
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
                                        name: 'Fantastic',
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
                    <h3 class="p-2">{{$question1->question}}</h3>
                    <div id="columnchart_material_<?php echo $question_id; ?>" class="p-3" style="height: 300px;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-16 mt-1 mb-1 text-center"><b> {{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}:</b> {{array_sum($response_array)}}</p>
                        </div>
                    </div>
                    <div class="append_filter"></div>  
                </div>
            </div>
            @endif

            <?php
        }
    }
} else {
    ?>
            <div style="text-align:center;color:#f00;font-size:22px;">{{__('message.no_record_found')}}</div>
            <?php } ?>
        </div>
    </div>
</div>









@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="//cdn.syncfusion.com/16.4.0.42/js/web/ej.web.all.min.js" type="text/javascript"></script>

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
    
</script>

<!--  -->


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
<script type="text/javascript">
    var dataTable;
    // var lastQuestion='';
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
        // {
        //     "targets": 1,
        //     "orderable": true,
        //     "class": "text-left",
        //     "render": function (data, type, full, meta) {
        //         if(lastQuestion!=full['survey_question']){
        //             lastQuestion = full['survey_question'];
        //             return full['survey_question'];
        //         }
        //        lastQuestion = full['survey_question'];
        //        return '';
        //     },
        // },
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
        // {
        //     "targets": 5,
        //     "orderable": false,
        //     "class": "text-center"
        // },
    ];
    //var columnDefs = [];
</script>
@include('datatable.dt_js')
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

        // var chartBy = document.getElementById ("select_chart_by");
        // var valChartBy = chartBy.options[chartBy.selectedIndex].value;
        // var strChartBy = chartBy.options[chartBy.selectedIndex].text;

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
        // if(valChartBy != 0) {
        //     htmlShow = htmlShow + '<li> Sub Category:- ' + strChartBy + '</li>';
        // }

        htmlShow = htmlShow + '</ul>';
        document.getElementById("showList").style.display = 'block';
        document.getElementById("showList").innerHTML = htmlShow
        
        
        var printContents = document.getElementById(divName).innerHTML;
        console.log(printContents)
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
        document.getElementById("showList").style.display = 'none';
    }
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
            var time_period = $('#time_period').val() != '' ? $('#time_period').val() : 'All';
            var select_chart_type = $('#select_chart_type').val()
            var created_from = $('#single_cal5').val()
            var created_to = $('#single_cal4').val()
            
            if(select_chart_type == 2){
                select_chart_type = 'Pie Chart'
            }else{
                select_chart_type = 'Bar Chart'
            }
            if(time_period == 'specific_date'){
                $('.append_filter').append('<div class="row"> <div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>User:</b> '+user+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Time Period:</b> '+time_period+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Location:</b> '+city+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Chart type:</b> '+select_chart_type+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Created From:</b> '+created_from+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Created To:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"> <div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>User:</b> '+user+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Time Period:</b> '+time_period+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Location:</b> '+city+'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>Chart type:</b> '+select_chart_type+'</p></div></div>');
            }
    })
</script>
@stop