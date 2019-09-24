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

    .noRecord {
        background-color: #73879C;
        color: #fff;
        font-weight: bolder;
        margin-left: 1%;
        text-align: center;
        width: 100%;
        position: absolute;
        z-index: 999;
        padding: 1%;
        margin-top: 0%;
        font-size: 17px;
        border: 1px solid #cccccc;
    }

    .ami {
        background-color: #73879C;
        color: #fff;
        font-weight: bolder;
        margin-left: 1%;
        text-align: center;
        width: 96%;
        position: absolute;
        z-index: 999;
        padding-top: 1%;
        margin-top: 0%;
        font-size: 15px;
        border: 1px solid #cccccc;
    }

    .amis {
        color: black;
        font-weight: bolder;
        margin-left: 0;
        text-align: center;
        width: 100%;
        margin-top: 5%;
        font-size: 20px;
    }

    .noRecord.inner_norecord {
        position: relative;
        width: 100%;
        float: left;
        position: relative;
        margin: 10px 0px;
        background-color: #d62727;
    }
    /*.pie_chart_width div { width: 100% !important; }*/
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




<div class="breadcrumb">
    <h1>{{__('message.reason')}} {{__('message.guage')}} {{__('message.report')}}</h1>
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
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.guage')}} {{__('message.view')}}</h3>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="name"
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select')}}
                                {{__('message.user')}} <span class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    {!! Form::select('user', $user, null, ['class' => 'form-control','id' =>
                                    'user','placeholder' => __('message.select').' '.__('message.user')]) !!}
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
                                    'location','placeholder' => __('message.select').' '.__('message.city')]) !!}
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
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success" onclick="submitForm()">{{__('message.view')}} {{__('message.report')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        <!-- end::form 2-->
        <div class="row">
            <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
            <div class="col-sm-12" style="padding: 0px;">
                <div id="choose_question_above" class="col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="choose_question" class="table-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    #choose_question {
        color: black;
    }
</style>


@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!--<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>-->

<script type="text/javascript">
    $(document).ready(function () {
        
        drawChart();
        function drawChart() {
            
            $('#gifImage').css('display', 'block');
            zingchart.THEME = "";
            var url = '{{route("get_kpi_report")}}';
            var form_id = $('#survey_form').find(":selected").val();
            $('#survey_form_id').val(form_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (resp) {
                     console.log(resp);
                     
                $('#gifImage').css('display', 'none');
                if (resp) 
                {
                    $('#choose_question_above').html('');
                    $('#choose_question').html('');

                    if (resp['reason_count'].length == 0) {
                        
                        var sum = 0;
                        $('#choose_question').html('<div class="col-md-12 col-sm-12 col-xs-12"><span class="noRecord inner_norecord">{{__('message.no_record_found')}}</span></div>');
                    }else
                    {
                        var sum = 0;
                        for (var i = 0; i < resp['reason_count'].length; i++) {

                            //remove zingchar powered by
                            setTimeout(function () {
                                for (var i = 0; i < resp['reason_count'].length; i++) {
                                    $('#chart_div_' + i + '-license-text').css('display', 'none');
                                }
                        }, 3000);


                        zingchart.exec('chart_div_' + i, 'destroy');

                        var min = resp['reason_count'].minimum_value;
                        var max = resp['reason_count'].maximum_value;
                            // sum = resp['survey_form'].totle_kpi_count;

                            // $('#choose_question').append(' <table class="table" style="width: 50%; float: left;" ><tr><td><div class="col-md-12 col-sm-12 col-xs-12" id="chart_div_' + i + '"><span class="ami"> Reason : '+ resp['reason_count'][i].feedback_reason +'</span></div></td></tr></table>');

                            $('#choose_question').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2"> <div style="height: 400px;"> <h3 class="p-2 text-16">{{__('message.reason')}}: '+ resp['reason_count'][i].feedback_reason +' </h3> <div class="col-md-12 col-sm-12 col-xs-12 pie_chart_width" id="reason_div_' + i + '" style="height: 400px;"></div></div><div class="row"> <div class="col-md-12 col-12 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}:</b> '+ resp.reason_value[i][0] +'</p></div></div><div class="row"> <div class="col-md-12" style="text-align: center !important;"> <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;" data-name="'+ resp['reason_count'][i].feedback_reason +'" data-id="reason_div_'+ i +'" data-value="'+ resp.reason_value[i][0] +'" onclick="printChart(this)">Print !</button> </div></div></div></td></tr></table>');

                            let gaugeChartElem = document.getElementById('reason_div_' + i);
                            if (gaugeChartElem) {
                                let gaugeChart = echarts.init(gaugeChartElem);


                                var option = {
                                    grid: {
                                        left: '%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    tooltip: {
                                        formatter: "{a} <br/>{b} : {c}%"
                                    },
                                    toolbox: {
                                        // feature: {
                                        //     restore: {},
                                        //     saveAsImage: {}
                                        // }
                                    },
                                    series: [{
                                        name: status,
                                        type: 'gauge',
                                        min: 0,
                                        max: resp['reason_count'].maximum_value,
                                        splitNumber: 5,
                                        axisLine: {            
                                                lineStyle: {       
                                                    color: [[0.2, '#c23531'],[0.8, '#63869e'],[1, '#91c7ae']], 
                                                    width: 25
                                                }
                                            },
                                        detail: {
                                            formatter: '{value}%'
                                        },
                                        data: [{
                                            value: resp.reason_value[i][0],
                                            name: ''
                                        }]
                                    }]
                                };
                                
                                gaugeChart.setOption(option, true);
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        gaugeChart.resize();
                                    }, 500);
                                });
                            }
                        }
                    }
                    var kpiSum = '{{__('message.kpi')}} {{__('message.total')}} : ';

                        // $('#choose_question_above').append('<span class="amis">' + kpiSum);
                    }
                }
            });
        }
    });
</script>
<script type="text/javascript">
    function submitForm() {

        $('#gifImage').css('display', 'block');
        var user = $('#user').val();
        var location = $('#location').val() != '' ? $('#location').val() : 'All';
        var created_from = $('#single_cal5').val();
        var created_to = $('#single_cal4').val();
        var time_filter = $('#time_period').val() != '' ? $('#time_period').val() : 'All';
        var url = '{{route("get_reason_report_kpi")}}';
        
        var all_user = {!!$user_name!!}
        var user_name = 'All';
        all_user.map(value => {
            if(user == value.id)
                user_name = value.name
        })
        

        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            data: {
                user,
                location ,
                created_from,
                created_to,
                time_filter
            },
            dataType: 'json',
            success: function (resp) {
                $('#gifImage').css('display', 'none');
                if (resp) 
                {
                    $('#choose_question_above').html('');
                    $('#choose_question').html('');

                    if (resp['reason_count'].length == 0) {
                        
                        var sum = 0;
                        $('#choose_question').html('<div class="col-md-12 col-sm-12 col-xs-12"><span class="noRecord inner_norecord">{{__('message.no_record_found')}}</span></div>');
                    }else
                    {
                        var sum = 0;
                        for (var i = 0; i < resp['reason_count'].length; i++) {

                            //remove zingchar powered by
                            setTimeout(function () {
                                for (var i = 0; i < resp['reason_count'].length; i++) {
                                    $('#chart_div_' + i + '-license-text').css('display', 'none');
                                }
                        }, 3000);


                        zingchart.exec('chart_div_' + i, 'destroy');

                        var min = resp['reason_count'].minimum_value;
                        var max = resp['reason_count'].maximum_value;
                            // sum = resp['survey_form'].totle_kpi_count;

                            // $('#choose_question').append(' <table class="table" style="width: 50%; float: left;" ><tr><td><div class="col-md-12 col-sm-12 col-xs-12" id="chart_div_' + i + '"><span class="ami"> Reason : '+ resp['reason_count'][i].feedback_reason +'</span></div></td></tr></table>');

                            $('#choose_question').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2"> <div style="height: 400px;"> <h3 class="p-2 text-16">{{__('message.reason')}}: '+ resp['reason_count'][i].feedback_reason +' </h3> <div class="col-md-12 col-sm-12 col-xs-12" id="reason_div_' + i + '" style="height: 400px;"></div></div><div class="row"> <div class="col-md-12 col-12 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no')}} {{__('message.of')}} {{__('message.responses')}}:</b> '+ resp.reason_value[i][0] +'</p></div></div><div class="row"> <div class="col-md-12" style="text-align: center !important;"> <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;" data-name="'+ resp['reason_count'][i].feedback_reason +'" data-id="reason_div_'+ i +'" data-value="'+ resp.reason_value[i][0] +'" onclick="printChart(this)">Print !</button> </div></div> <div class="append_filter"></div></div></td></tr></table>');

                            let gaugeChartElem = document.getElementById('reason_div_' + i);
                            if (gaugeChartElem) {
                                let gaugeChart = echarts.init(gaugeChartElem);


                                var option = {
                                    grid: {
                                        left: '%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    tooltip: {
                                        formatter: "{a} <br/>{b} : {c}%"
                                    },
                                    toolbox: {
                                        // feature: {
                                        //     restore: {},
                                        //     saveAsImage: {}
                                        // }
                                    },
                                    series: [{
                                        name: status,
                                        type: 'gauge',
                                        min: 0,
                                        max: resp['reason_count'].maximum_value,
                                        splitNumber: 5,
                                        axisLine: {            
                                                lineStyle: {       
                                                    color: [[0.2, '#c23531'],[0.8, '#63869e'],[1, '#91c7ae']], 
                                                    width: 25
                                                }
                                            },
                                        detail: {
                                            formatter: '{value}%'
                                        },
                                        data: [{
                                            value: resp.reason_value[i][0],
                                            name: ''
                                        }]
                                    }]
                                };
                                // gaugeChart.setOption({

                                //     option

                                // });
                                    gaugeChart.setOption(option, true);
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        gaugeChart.resize();
                                    }, 50);
                                });
                            }
                        }
                    }
                    var kpiSum = '{{__('message.kpi')}} {{__('message.total')}} : ';

                    // $('#choose_question_above').append('<span class="amis">' + kpiSum);
                    $('.append_filter').empty()
                    if(time_filter == 'specific_date'){
                        $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}}:</b> '+user_name+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_filter+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.location')}}:</b> '+location+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created')}} {{__('message.from')}}:</b>' +created_from+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created')}} {{__('message.to')}}: </b>'+created_to+'</p></div></div>');
                    }else{
                        $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}}:</b> '+user_name+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_filter+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.location')}}:</b> '+location+'</p></div></div>');
                    }
                }
                }
            });
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
<script type="text/javascript">
    function printChart(e){
        var id = $(e).data('id');
        var title = $(e).data('name');
        var response = $(e).data('value');
        $("#"+id).find('canvas').attr('id','canvas');

        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var imgData = canvas.toDataURL("image/png");
        var user_name = $('#user').val() != '' ? $('#user').val() : '{{__('message.all')}}';
        var all_user = {!!$user_name!!}
        var user = '{{__('message.all')}}';
        all_user.map(value => {
            if(user_name == value.id)
                user = value.name
        })
        var city = $('#location').val() != '' ? $('#location').val() : '{{__('message.all')}}';
        var time_period = $('#time_period').val() != '' ? $('#time_period').val() : '{{__('message.all')}}';
        var created_from = (time_period == 'specific_date') ? $('#single_cal5').val() : null;
        var created_to = (time_period == 'specific_date') ? $('#single_cal4').val() : null;
        var _token = '{{csrf_field()}}'

        $.ajax({
            url: '{{route("generate_pdf")}}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                imgData,user,city,time_period,created_from,created_to,title,response
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