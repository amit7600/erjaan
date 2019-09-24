@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
{{-- this script is for charts --}}
<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echarts.script.min.js')}}"></script>
{{-- end chart script --}}
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
        {!! Form::open(['route' => 'reason_chart_filter_5']) !!}
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.reason_report_chart')}}</h3>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 col-md-3">
                        <div class="form-group">
                            <label for="name"
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_user')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    @php
                                    $user_name = Session::get('user');
                                    @endphp
                                    {!! Form::select('user', $user, $user_name, ['class' => 'form-control','id' =>
                                    'user','placeholder' => __('message.select_user') ,'data-name' =>
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_location')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                <div class="input-right-icon">
                                    @php
                                    $city_name = Session::get('city');
                                    @endphp
                                    {!! Form::select('city', $location, $city_name, ['class' => 'form-control','id' =>
                                    'city','placeholder' => __('message.select_location')]) !!}
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
                                class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_chart_type')}}<span
                                    class="required">*</span></label>
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
        {!! Form::close() !!}
        <!-- end::form 2-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">

                    <h3 class="text-center m-0 mb-3 p-2">{{__('message.feedback_reason')}}</h3>
                    <div class="text-center">
                        <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;">
                        </div>
                        <div id="printableArea">
                            <div id="showList"></div>
                            <?php
                            $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
                            $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
                            
                            $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
                                        
                            if (count($feedback_reason_data) > 0) {
                                $chart_bar = array();
                                $response_value = array();
                                    foreach ($feedback_reason_data as $key1 => $reason1) 
                                    {
                                        $feedback_reason = $reason1->feedback_reason;
                                        $reason_id = $reason1->id;
                                        $answer_array = array();
                                        $answer_array[] = array($month,$reason1->feedback_reason);
                                        $i = 1;
                                        for ($y = $year_month_value; $y >= 0; $y--) {
                                            $year_data = date($m, strtotime("-" . $y . $month));
                                            $tarrible_count = FeedbackHelper::getStarRatingReasonCount($reason_id, $year_data, $feedback_reason, $user_id,$city,$created_from,$created_to);
                                            
                                            // echo "<pre/>";print_r($tarrible_count);
                                            $tarrible_ans_percent = 0;
                                            
                                            //dd($tarrible_count);
                                            if ($total_reason > 0) {
                                                $total_ans_count = $total_reason;
                                                $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                            
                                            }
                                            $response_value[] = $tarrible_count->ans_count;
                                            $answer_array[] = array($year_data,$tarrible_ans_percent);
                                        }
                                        
                                        $arary =[$reason1->feedback_reason,$tarrible_ans_percent]; 
                                        $final[] = $arary;
                                        $bar_chart = json_encode($answer_array);
                                        $reasonData = json_decode($monthValueData);
                                        $yearValue =  $monthValues;
                                    }
                                    // this section for pie chart
                                    // dd($final,$reasonData);
                                    $reasonArray = [];
                                    foreach ($reasonData as $key => $value) {
                                        $reasonArray[$key]['value'] = array_sum($value->values);
                                        $reasonArray[$key]['name'] = $value->text;
                                    }
                                    $ar = [['question', 'question rating']];
                                    $final = array_merge($ar,$final);
                                    $arary = json_encode($reasonArray);
                                    // dd($response_array[$key1]);
                                    $allResponses = [];
                                    foreach($feedback_reason_data as $key=>$value){
                                        $feedback_reason = $value->feedback_reason;
                                        $allResponses[] = $response_array[$key][$feedback_reason];
                                    }
                                    $star_rating_bar_chart_label = json_encode($arary);
                                    ?>
                            @if(Session::get('select_chart_type') == 1)
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div id="reasonchart_material_<?php echo $reason_id; ?>"
                                            style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                        <div class="append_filter"></div>
                                        <hr />
                                        {{-- this section is only for response count --}}
                                        <div class="row">
                                            @php
                                            $allResponses = [];
                                            @endphp
                                            @foreach ($feedback_reason_data as $key=>$value)
                                            @php
                                            $feedback_reason = $value->feedback_reason;
                                            @endphp
                                            <div class="col-md-4">
                                                <p class="text-16 mb-3 text-center"><b> {{$feedback_reason}}: </b>
                                                    {{$response_array[$key][$feedback_reason]}}</p>
                                            </div>
                                            @php
                                            $allResponses[] = $response_array[$key][$feedback_reason];
                                            @endphp
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                            onclick="printChart('reasonchart_material_<?php echo $reason_id; ?>','{{__('message.reason_report_chart')}}','{{array_sum($allResponses)}}')">Print
                                            !</button>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    let reasonchart_material_<?php echo $reason_id; ?> = document.getElementById('reasonchart_material_<?php echo $reason_id; ?>');
                                                if (reasonchart_material_<?php echo $reason_id; ?>) {
                                                    let reason_pie = echarts.init(reasonchart_material_<?php echo $reason_id; ?>);
                                                    reason_pie.setOption({
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
                                                                data: <?php echo $arary; ?> ,
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
                                                            reason_pie.resize();
                                                        }, 500);
                                                    });
                                                }
                                </script>
                            </div>
                            @endif
                            @if(Session::get('select_chart_type') == 2)
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                            // Chart in Dashboard version 1
                                            var echartElemBar = document.getElementById('reasonchart_material_<?php echo $reason_id; ?>');
                                            if (echartElemBar) {
                                                var echartBar = echarts.init(echartElemBar);
                                                echartBar.setOption({
                                                    legend: {
                                                        borderRadius: 0,
                                                        orient: 'horizontal',
                                                        x: 'right',
                                                        data:[
                                                        //this loop for getting value dynamic option name
                                                        <?php foreach ($reasonData as $key => $value1) { ?>
                                                            
                                                        '<?php echo $value1->text ?>' ,
                                                        <?php } ?>
                                                        ]
                                                    },
                                                    grid: {
                                                        left: '8px',
                                                        right: '8px',
                                                        bottom: '0PX',
                                                        containLabel: true
                                                    },
                                                    tooltip: {
                                                        show: true,
                                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                                    },
                                                    xAxis: [{
                                                        type: 'category',
                                                        data: <?php echo $yearValue; ?> ,
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
                                                        max: <?php echo array_sum($allResponses); ?>,
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
                                                    <?php foreach ($reasonData as $key => $value) { 
                                                        $answer_count = json_encode($value->values)
                                                        ?>
                                                    {
                                                        name: '<?php echo $value->text . ' Response' ; ?>',
                                                        data: <?php  echo $answer_count; ?> ,
                                                        label: { show: false, color: '#0168c1' },
                                                        type: 'bar',
                                                        barGap: 0.1,
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
                                <div id="reasonchart_material_<?php echo $reason_id; ?>" class="p-3"
                                    style="height: 400px;"></div>
                                <hr />
                                <div class="append_filter"></div>
                                <hr>
                                {{-- this section is only for response count --}}
                                <div class="row">
                                    @php
                                    $allResponses = [];
                                    @endphp
                                    @foreach ($feedback_reason_data as $key=>$value)
                                    @php
                                    $feedback_reason = $value->feedback_reason;
                                    @endphp
                                    <div class="col-md-4">
                                        <p class="text-16 mb-3 text-center"><b> {{$feedback_reason}} : </b>
                                            {{$response_array[$key][$feedback_reason]}}</p>
                                        @php
                                        $allResponses[] = $response_array[$key][$feedback_reason];
                                        @endphp
                                    </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                                    onclick="printChart('reasonchart_material_<?php echo $reason_id; ?>','{{__('message.reason_report_chart')}}','{{array_sum($allResponses)}}')">Print
                                    !</button>
                            </div>
                            @endif

                            <?php 
                                    
                                } else {
                                    ?>
                            <div style="text-align:center;color:#f00;font-size:22px;">{{__('message.no_record_found')}}
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row div-->
    </div>
</div>



@stop
{{-- page level scripts --}}
@section('footer_scripts')


<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
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
    // For Bar chart for month and yearly --- 13-06-2019
    var myChart123 = {
    "type": "bar",
    "title": {
        "text": "Reason reply"
    },
    "plot": {
        "value-box": {
        "text": "%v"
        },
        "tooltip": {
        "text": "%v"
        }
    },
    "legend": {
        "toggle-action": "hide",
        "header": {
        "text": "Reason"
        },
        "item": {
        "cursor": "pointer"
        },
        "draggable": true,
        "drag-handler": "icon"
    },
    "scale-x": {
        "values": <?php echo Session::get('select_chart_by') == 1 ? $monthValues :  $yearValues ; ?>
    },
        "series": <?php echo Session::get('select_chart_by') == 1 ? $monthValueData :  $yearValueData ; ?>
    };
    zingchart.render({
    id: "myChart123",
    data: myChart123,
    height: "480",
    width: "100%"
    });
</script>
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
{{--this script for filter section--}}
<script>
    $(document).ready(function(){
            var user = $('#user').attr('data-name') != '' ? $('#user').attr('data-name') : '{{__('message.all')}}';
            var city = $('#city').val() != '' ? $('#city').val() : '{{__('message.all')}}';
            var time_period = $('#time_period').val() != '' ? $('#time_period').val() : '{{__('message.all')}}';
            var select_chart_type = $('#select_chart_type').val()
            var created_from = $('#single_cal5').val()
            var created_to = $('#single_cal4').val()
            
            if(select_chart_type == 1){
                select_chart_type = '{{__('message.pie_chart')}}'
            }else{
                select_chart_type = '{{__('message.bar_chart')}}'
            }
            if(time_period == 'specific_date'){
                $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}}:</b> '+user+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_period+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.location')}}:</b> '+city+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.chart_type')}}:</b> '+select_chart_type+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_from')}}:</b> '+created_from+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_to')}}:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"> <div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}}:</b> '+user+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_period+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.location')}}:</b> '+city+'</p></div><div class="col-md-3 col-3 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.chart_type')}}:</b> '+select_chart_type+'</p></div></div>');
            }
    })
</script>
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
                console.log(resp)
            }
        })
    }
</script>
@stop