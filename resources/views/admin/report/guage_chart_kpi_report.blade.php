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
        color: #000;
        text-align: center;
        width: 100%;
        padding: 10px;
        font-size: 20px;
        float: left;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .ami {
        background-color: #663399;
        color: #fff;
        font-size: 12px;
        padding: 10px;
        text-align: left;
        padding-left: 20px;
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
    <h1>{{__('message.kpi_guage_report')}} </h1>
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
        <form name="survey_report_form" method="post" action="{{route('report.store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.guage_view')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-sm-3 col-md-3 col-lg-3 col-form-label text-right">{{__('message.select_survey_form')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="survey_form" name="survey_form">
                                    <option value="">{{__('message.select_survey_form')}}</option>
                                    @foreach ($survey_form as $form)
                                    <option value="{{ $form->id }}">{{$form->survey_form_title}}</option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>


        <form name="survey_report_form" id="survey_report_form" method="post" action=" {{ route('kpi_report') }} ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.search_filter')}}
                    </h3>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="name"
                                    class="ul-form__label  col-form-label text-right">{{__('message.select_user')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        {!! Form::select('user_data', $user_data, Session::get('user_data'), ['class' =>
                                        'form-control','id' =>
                                        'user_data','placeholder' => __('message.select_user')]) !!}
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="maximum_value"
                                    class="ul-form__label  col-form-label text-right">{{__('message.select_type')}}<span
                                        class="required">*</span></label>
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
                                <label for="name"
                                    class="ul-form__label  col-form-label text-right">{{__('message.select_group')}}
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
                                <label for="name"
                                    class="ul-form__label  col-form-label text-right">{{__('message.select_category')}}<span
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
                                <label for="name"
                                    class="ul-form__label   col-form-label text-right">{{__('message.select_sub_category')}}
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
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="survey_form_id" id="survey_form_id" value="0" />
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="button" onclick="submitForm()" class="btn btn-success"
                                    id="btn-search">{{__('message.view_report')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div id="choose_question_above"></div>
                    <div id="choose_question" class="col-md-12 col-sm-12 col-xs-12 inner_text_center"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end::form 2-->
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

        $('#survey_form').change(function () {
            drawChart();
        });

        function drawChart() {
            $('#gifImage').css('display', 'block');
            zingchart.THEME = "";
            var url = '{{route("get_kpi_report_details")}}';
            var form_id = $('#survey_form').find(":selected").val();
            $('#survey_form_id').val(form_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: {form_id: form_id},
                dataType: 'json',
                success: function (resp) {
                    console.log(resp)
                    $('#gifImage').css('display', 'none');
                    if (resp) {
                        $('#choose_question_above').html('');
                        $('#choose_question').html('');

                        if (resp['survey_form'].length == 0) {
                            // console.log('trst');
                            $('#choose_question').html('<div class="col-md-12 col-sm-12 col-xs-12"><span class="noRecord">No record found!</span></div>');
                        }
                        var sum = 0;
                        for (var i = 0; i < resp['survey_form'].length; i++) {

                            //remove zingchar powered by
                            setTimeout(function () {
                                for (var i = 0; i < resp['survey_form'].length; i++) {
                                    $('#chart_div_' + i + '-license-text').css('display', 'none');
                                }
                            }, 3000);

                            var min = resp['survey_form'][i].minimum_value;
                            var max = resp['survey_form'][i].maximum_value;
                            var id = resp['survey_form'][i].id
                            
                            sum += resp['final_value'][i].totle_kpi_count;
                            $('#choose_question').append('<table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2 "> <div class="" style="height: 500px;"> <span class="ami" style="display:block;">{{__('message.kpi_name')}} : ' + resp['survey_form'][i].kpi_name + '<a class="btn btn-danger float-right delete_data1" data-id="'+id+'" data-href="{{route("delete_kpi_report_detials")}}"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true" style="font-size: 18px;margin-top: 0px;float: left;margin-right: 10px; color: #fff;"> </i>{{__('message.delete')}}</a><br>{{__('message.star_rating_sum')}} : ' + resp['final_value'][i].star_sum + '<br>{{__('message.radio_button_sum')}} : ' + resp['final_value'][i].radio_sum + '<br>{{__('message.checkbox_sum')}} : ' + resp['final_value'][i].check_sum + '</span> <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px;" id="chart_div_' + i + '"></div><div class="row"> <div class="col-md-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_sent')}}:</b> '+ resp['survey_form'][i].sent +'</p></div><div class="col-md-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_responses')}}:</b> '+ resp['survey_form'][i].response +'</p></div></div><div class="row"> <div class="col-md-12" style="text-align: center !important;"> <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;" data-name="'+ resp['survey_form'][i].kpi_name +'" data-id="chart_div_'+ i +'" data-value="'+ resp['survey_form'][i].response +'" onclick="printChart(this)">{{__('message.print')}} !</button> </div></div></div></div></td></tr></table>');

                            let gaugeChartElem = document.getElementById('chart_div_' + i);
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
                                        name: resp['survey_form'][i].kpi_name,
                                        type: 'gauge',
                                        min: 0,
                                        max: 5,
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
                                            value: resp.final_value[i].avg,
                                            name: ''
                                        }]
                                    }]
                                };
                                gaugeChart.setOption({

                                    option

                                });
                                    gaugeChart.setOption(option, true);
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        gaugeChart.resize();
                                    }, 500);
                                });
                            }
                        }
                        var kpiSum = '{{__('message.kpi_total')}} : ' + sum;

                        $('#choose_question_above').append('<h3 class="text-center m-0 p-2 amis">' + kpiSum);
                    }
                }
            });
        }



        //to change category
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
                    // console.log(resp)
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
        }
        );
    });
    
    $(document).on('click', 'a.delete_data1', function (e) {
        var url = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        swal({
            title: '{{__('message.are_you_sure')}}',
            text: "{{__('message.wont_be_revert')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{__('message.yes_delete_it')}}',
            cancelButtonText: '{{__('message.no_cancel')}}',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                    _method: 'post',
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id : id
                },
                success: function (resp) {
                    if(resp.success){
                        swal(
                            '{{__('message.deleted')}}',
                            resp.message,
                            'success'
                        )
                    location.reload();
                    }
                },
                error: function () {
                    swal(
                        '{{__('message.deleted')}}',
                        '{{__('message.something_wrong')}}',
                        'Error'
                    )
                }
            });
        }, function (dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    '{{__('message.cancelled')}}',
                    '{{__('message.is_safe')}}',
                    'error'
                )
            }
        })
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
    function submitForm() {
        $('#gifImage').css('display', 'block');
        var form_id = $('#survey_form_id').val();
        var user_data = $('#user_data').val();
        var url = '{{route("get_survey_report_kpi")}}';
        if (form_id == 0) {
            alert('Select Survey Form first!');
            return false;
        }
        // if ( user_data == 0 ) {
        //     return url;

        // }
        var type_id = $('#type_id').val() != 0 ? $('#type_id').val() : '{{__('message.all')}}' ;
        var group_id = $('#group_id').val() != 0 ? $('#group_id').val() : '{{__('message.all')}}' ;
        var category_id = $('#category_id').val() != 0 ? $('#category_id').val() : '{{__('message.all')}}' ;
        var sub_category_id = $('#sub_category_id').val() != 0 ? $('#sub_category_id').val() : '{{__('message.all')}}' ;
        var time_period = $('#time_period').val() != '' ? $('#time_period').val() : '{{__('message.all')}}';
        var created_from = $('#single_cal5').val();
        var created_to = $('#single_cal4').val();

        var all_user = {!!$user_name!!}
        var user_name = 'All';
        all_user.map(value => {
            if(user_data == value.id)
                user_name = value.name
            if(user_data == ''){
                user_name = '{{__('message.all')}}'
            }
        })
        var all_type = {!!$type!!}
        var type = 'All';
        all_type.map(value => {
            if(type_id == value.id)
            type = value.type_name
        if(type_id == '{{__('message.all')}}'){
                type = '{{__('message.all')}}'
            }
        })
        var all_group = {!!$group!!}
        var group = 'All';
        all_group.map(value => {
            if(group_id == value.id)
                group = value.group_name
            if(group_id == '{{__('message.all')}}'){
                group = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$category!!}
        var category = 'All';
        all_category.map(value => {
            if(category_id == value.id)
                category = value.category_name
            if(category_id == '{{__('message.all')}}'){
                category = '{{__('message.all')}}'
            }
        })
        var all_category = {!!$subCategory!!}
        var sub_category = 'All';
        all_category.map(value => {
            if(sub_category_id == value.id)
            sub_category = value.category_name
            if(sub_category_id == '{{__('message.all')}}'){
                    sub_category = '{{__('message.all')}}'
                }
        })

        
            

        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            data: $('#survey_report_form').serialize(),
            dataType: 'json',
            success: function (resp) {
                console.log(resp)
                $('#gifImage').css('display', 'none');
                $('#choose_question_above').html('');
                $('#choose_question').html('');

                if (resp['survey_form'].length == 0) {
                    $('#choose_question').html('<div class="col-md-12 col-sm-12 col-xs-12"><span class="noRecord">{{__('message.no_record_found')}}</span></div>');
                }

                var sum = 0;
                for (var i = 0; i < resp['survey_form'].length; i++) {

                    //remove zingchar powered by
                    setTimeout(function () {
                        for (var i = 0; i < resp['survey_form'].length; i++) {
                            $('#chart_div_' + i + '-license-text').css('display', 'none');
                        }
                    }, 3000);

                    zingchart.exec('chart_div_' + i, 'destroy');

                    var min = resp['survey_form'][i].minimum_value;
                    var max = resp['survey_form'][i].maximum_value;
                    var id = resp['survey_form'][i].id;

                    sum += resp['final_value'][i].totle_kpi_count;

                     $('#choose_question').append('<table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2 "> <div class="" style="height: 650px;"> <span class="ami" style="display:block;">{{__('message.kpi_name')}} : ' + resp['survey_form'][i].kpi_name + '<a class="btn btn-danger float-right delete_data1" data-id="'+id+'" data-href="{{route("delete_kpi_report_detials")}}"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true" style="font-size: 18px;margin-top: 0px;float: left;margin-right: 10px; color: #fff;"> </i>{{__('message.delete')}}</a><br>{{__('message.star_rating_sum')}} : ' + resp['final_value'][i].star_sum + '<br>{{__('message.radio_button_sum')}} : ' + resp['final_value'][i].radio_sum + '<br>{{__('message.checkbox_sum')}} : ' + resp['final_value'][i].check_sum + '</span> <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px;" id="chart_div_' + i + '"></div><div class="row"> <div class="col-md-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_sent')}}:</b> '+ resp['survey_form'][i].sent +'</p></div><div class="col-md-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_responses')}}:</b> '+ resp['survey_form'][i].response +'</p></div></div><div class="row"> <div class="col-md-12" style="text-align: center !important;"> <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;" data-name="'+ resp['survey_form'][i].kpi_name +'" data-id="chart_div_'+ i +'" data-value="'+ resp['survey_form'][i].response +'" onclick="printChart(this)">{{__('message.print')}} !</button> </div></div><hr style="margin:5px 0px;"/> <div class="append_filter"></div></div></div></td></tr></table>');
                     let gaugeChartElem = document.getElementById('chart_div_' + i);
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
                                        name: resp['survey_form'][i].kpi_name,
                                        type: 'gauge',
                                        min: 0,
                                        max: 5,
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
                                            value: resp.final_value[i].avg,
                                            name: ''
                                        }]
                                    }]
                                };
                                gaugeChart.setOption({

                                    option

                                });
                                    gaugeChart.setOption(option, true);
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        gaugeChart.resize();
                                    }, 500);
                                });
                            }
                }
                var kpiSum = '{{__('message.kpi_total')}} : ' + sum;
                $('#choose_question_above').append('<h3 class="text-center m-0 p-2 amis">' + kpiSum);
                        $('.append_filter').empty()
            if(time_period == 'specific_date'){
                $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}} : </b> '+user_name+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.type')}}:</b> '+type+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.group')}}:</b> '+group+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.category')}}:</b> '+category+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.sub_category')}}:</b> '+sub_category+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_period+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_from')}}:</b> '+created_from+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.created_to')}}:</b> '+created_to+'</p></div></div>');
            }else{
                $('.append_filter').append('<div class="row"> <div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.User')}}:</b> '+user_name+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.type')}}:</b> '+type+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.group')}}:</b> '+group+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.category')}}:</b> '+category+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.sub_category')}}:</b> '+sub_category+'</p></div><div class="col-md-4 col-4 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.time_period')}}:</b> '+time_period+'</p></div></div>');
            }
            }
        });
    }
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
        var user_data = $('#user_data').val();
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
        var all_user = {!!$user_name!!}
        var user_name = 'All';
        all_user.map(value => {
            if(user_data == value.id)
                user_name = value.name
            if(user_data == ''){
                user = '{{__('message.all')}}'
            }
        })
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
        if( select_chart_type != undefined)
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
                imgData,type,group,category,sub_category,select_chart_type,time_period,created_from,created_to,response,title,user
            },
            success: function(resp){
                $("#"+id).find('canvas').removeAttr('id');
                window.open(resp.url, '_blank');
            }
        })
    }
</script>
@stop