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
        {!! Form::open(['route' => 'get_location_report_filter_1']) !!}
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.filter_for_view_location_chart')}}</h3>
            </div>
            <div class="card-body ">
                <div class="row">
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
        {!! Form::close() !!}
        <!-- end::form 2-->
        <div class="row">
            <?php
            $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
            $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
            $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
            
            $locationBar = [];
            if (count($city) > 0) {
                $chart_bar = array();
                $tempBar = array();
                foreach ($tempArray as $key => $city) { 
                    $all_average = [];
                    foreach ($city as $key => $value) {
                        $city_id = $value->id;

                            $total_result_count = FeedbackHelper::getTotalcity($city_id,'1');
                            
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
                            $year = array();
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
                                $city_total_count = [];
                                $city_total_sum = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }
                                $city_count = FeedbackHelper::getLocationCount($year_data,'1', $city_id,$created_from,$created_to,$time_period);

                                $city_ans_percent = 0;
                                $city_rating_sum = 0;
                                
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    // $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                    $city_rating_sum = $city_count->rating_sum;
                                    $city_ans_percent = $city_count->ans_count;
                                }

                                $city_total_count[] = round($city_ans_percent);
                                $city_total_sum[] = round($city_rating_sum);
                                
                                // $year[] = $year_data;
                                
                            }
                            
                            $total_count = array_sum($city_total_count) != 0 ? array_sum($city_total_count) : 1;
                            $total_sum = array_sum($city_total_sum);
                            $average = array_sum($city_total_count) != 0 ? $total_sum/$total_count : 0 ;

                            $cityName[] = $value->cityName.'('.array_sum($city_total_count).')';
                            $all_average[] = array($value->cityName,round($average,1),array_sum($city_total_count));
                            $tempBar[] = 0;

                            $locationBar[] = round($average,1);
                        }
                        $year = json_encode($cityName);
                        $locationBar = json_encode($locationBar);
                        $barChart = [];
                        foreach ($all_average as $key => $value) {
                            for ($i=0; $i < count($tempBar); $i++) { 
                                $barChart[$key]['name'] = $value[0];
                                if($key == $i){
                                    $barChart[$i]['value'][] = $value[1];
                                    $barChart[$key]['response'] = $value[2];
                                }else{
                                    
                                    $barChart[$i]['value'][] = 0;
                                }
                            }
                        }
                        // dd($barChart);

                            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <script type="text/javascript">
                    $(document).ready(function () {
                        // Chart in Dashboard version 1
                            var echartElemBar = document.getElementById('columnchart_material_');
                            if (echartElemBar) {
                                var echartBar = echarts.init(echartElemBar);
                                echartBar.setOption({
                                    legend: {
                                        borderRadius: 0,
                                        orient: 'horizontal',
                                        x: 'right',
                                        data: ['Location']
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
                                    xAxis: [
                                        {
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
                                    }
                                    ],
                                    yAxis: [{
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value}'
                                        },
                                        min: 0,
                                        max: 5,
                                        interval:1,
                                        axisLine: {
                                            show: false
                                        },
                                        splitLine: {
                                            show: true,
                                            interval: 'auto'
                                        }
                                    }],
                                    series: [
                                        {
                                        name: 'Location',
                                        data: <?php echo $locationBar; ?>,
                                        label: { show: false, color: '#0168c1' },
                                        type: 'bar',
                                        barGap: 0,
                                        barWidth: '10%',
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
                                    },
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
                    <h3 class="p-2" id="title_columnchart_material_">{{__('message.location_chart')}}
                    </h3>
                    <div id="columnchart_material_" class="p-3" style="height: 300px;"></div>
                    <div class="append_filter"></div>
                    <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                        onclick="printChart('columnchart_material_','User Chart','none')">{{__('message.print')}}
                        !</button>
                </div>
            </div>

            <?php
    }
} else {
    ?>
            <div style="text-align:center;color:#f00;font-size:22px;">{{__('message.no_record_found')}}</div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript">
    function printChart(id,title,response){
        $("#"+id).find('canvas').attr('id','canvas');

        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var imgData = canvas.toDataURL("image/png");
        var user = $('#user').attr('data-name') != '' ? $('#user').attr('data-name') : '{{__('message.all')}}';
        var city = $('#city').val() != '' ? $('#city').val() : '{{__('message.all')}}';
        var time_period = $('#time_period').val() != '' ? $('#time_period').val() : '{{__('message.all')}}';
        var select_chart_type = $('#select_chart_type').val()
        var created_from = (time_period == 'specific_date') ? $('#single_cal5').val() : null;
        var created_to = (time_period == 'specific_date') ? $('#single_cal4').val() : null;
        var _token = '{{csrf_field()}}'

        $.ajax({
            url: '{{route("generate_pdf")}}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                imgData,user,city,time_period,select_chart_type,created_from,created_to,title,response
            },
            success: function(resp){
                $("#"+id).find('canvas').removeAttr('id');
                window.open(resp.url, '_blank');
            }
        })
    }
</script>
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
        
            var time_period = $('#time_period').val() != '' ? $('#time_period').val() : '{{__('message.all')}}';
            var created_from = $('#single_cal5').val()
            var created_to = $('#single_cal4').val()
            if(time_period == 'specific_date'){
                $('.append_filter').append('<div class="row"><div class="col-md-4 col-4 text-center"><p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_period+'</p></div><div class="col-md-4 col-4 text-center"><p class="text-14 mt-1 mb-1"><b>{{__('message.created_from')}}:</b> '+created_from+'</p></div><div class="col-md-4 col-4 text-center"><p class="text-14 mt-1 mb-1"><b>{{__('message.created_to')}}:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"><div class="col-md-12 col-12 text-center"><p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}} :</b> '+time_period+'</p></div></div>');
            }
    })
</script>
@stop