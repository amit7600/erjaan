<style type="text/css">
    .myoption{ 
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }
    .highcharts-credits{
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



<div class="right_col" role="main" style="min-height: 1214px;">
    <div class="">
        <div class="page-title">
            <div class="title_left"> 
                <h2>KPI Guage Report</h2> 
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>

        @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
        <div class="horizontal-center alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$error}}
        </div>
        @break
        @endforeach
        @endif

        @if(session()->has('message.level'))
        <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! session('message.content') !!}
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Guage View</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <form name="survey_report_form" method="post" action="{{route('report.store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Select Survey Form</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="survey_form" name="survey_form">
                                                <option value="">Select Form</option>
                                                @foreach ($survey_form as $form)
                                                <option value="{{ $form->id }}">{{$form->survey_form_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                            </form>
                        </div> <!--end x-content row--> 

                    </div> <!--end x-content-->

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Search Filter</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <form name="survey_report_form" id="survey_report_form" method="post" action="#">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Select Type</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="type_id" name="type_id">
                                                @foreach ($type as $row)
                                                <option <?php
                                                if (Session::get('type_id') == $row->id) {
                                                    echo "selected";
                                                }
                                                ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="business_name">Select Group</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="group_id" name="group_id">
                                                <option value="0">Select Group</option>
                                                @foreach ($group as $row)
                                                <option <?php
                                                if (Session::get('group_id') == $row->id) {
                                                    echo "selected";
                                                }
                                                ?> value="{{ $row->id }}">{{$row->group_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="retail_email">Select Category</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="category_id" name="category_id">
                                                <option value="0">Select Category</option>
                                                @foreach ($category as $row)
                                                <option <?php
                                                if (Session::get('category_id') == $row->id) {
                                                    echo "selected";
                                                }
                                                ?> value="{{ $row->id }}">{{$row->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">Select Sub Category</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                                                <option value="0">Select Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="mobile_number">Select From</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12 xdisplay_inputx form-group has-feedback">
                                            <input name="created_from" value="<?php
                                            if (Session::get('created_from')) {
                                                echo Session::get('created_from');
                                            }
                                            ?>" readonly type="text" class="form-control has-feedback-left" id="single_cal5" placeholder="From Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="survey_form_id" id="survey_form_id" value="0"/>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">Select To</label>

                                        <div class="col-md-4 col-sm-4 col-xs-12 xdisplay_inputx form-group has-feedback">
                                            <input name="created_to" value="<?php
                                            if (Session::get('created_to')) {
                                                echo Session::get('created_to');
                                            }
                                            ?>" readonly type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="To Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">&nbsp;</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <button type="button" onclick="submitForm()" class="btn btn-success" id="btn-search">View Report</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!--end x-content row--> 

                    </div> <!--end x-content-->

                </div>
            </div>
        </div>

        <div id="choose_question" class="col-md-12 col-sm-12 col-xs-12"></div>


    </div>
</div> 

<style>
    #choose_question{color:black;}
</style>


@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script type="text/javascript">
    $(document).ready(function () {

        $('#survey_form').change(function () {
            google.charts.load('current', {'packages': ['gauge']});
            google.charts.setOnLoadCallback(drawChart);
        });

        function drawChart() {
            var url = '{{route("get_kpi_report_detials")}}';
            var form_id = $('#survey_form').find(":selected").val();
            $('#survey_form_id').val(form_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: {form_id: form_id},
                dataType: 'json',
                success: function (resp) {

                    if (resp) {
                        $('#choose_question').html('');
                        for (var i = 0; i <= resp['survey_form'].length; i++) {

                            var data = google.visualization.arrayToDataTable([
                                ['Label', 'Value'],
                                [resp['survey_form'][i].kpi_name, resp.final_value[i].avg]
                            ]);

                            //devide values for colour
                            var t = resp['survey_form'][i].maximum_value / 3;
                            var r1 = 0;
                            var r2 = r1 + t;
                            var y1 = r2;
                            var y2 = y1 + t;
                            var g1 = y2;
                            var g2 = g1 + t;

                            var options = {
                                width: 600, height: 220,
                                min: resp['survey_form'][i].minimum_value,
                                max: resp['survey_form'][i].maximum_value,
                                redFrom: r1, redTo: r2,
                                yellowFrom: y1, yellowTo: y2,
                                greenFrom: g1, greenTo: g2,
                                minorTicks: 20
                            };

                            $('#choose_question').append('<div class="col-md-4" id="chart_div_' + i + '"></div>');

                            var chart = new google.visualization.Gauge(document.getElementById('chart_div_' + i));
                            chart.draw(data, options);
                        }
                    }
                },
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



    function submitForm() {

        var form_id = $('#survey_form_id').val();
        if (form_id == 0) {
            alert('Select Survey Form first!');
            return false;
        }
        var url = '{{route("get_survey_report_kpi")}}';
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            data: $('#survey_report_form').serialize(),
            dataType: 'json',
            success: function (resp) {
                $('#choose_question').html('');
                for (var i = 0; i <= resp['survey_form'].length; i++) {

                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        [resp['survey_form'][i].kpi_name, resp.final_value[i].avg]
                    ]);

                    //devide values for colour
                    var t = resp['survey_form'][i].maximum_value / 3;
                    var r1 = 0;
                    var r2 = r1 + t;
                    var y1 = r2;
                    var y2 = y1 + t;
                    var g1 = y2;
                    var g2 = g1 + t;

                    var options = {
                        width: 600, height: 220,
                        min: resp['survey_form'][i].minimum_value,
                        max: resp['survey_form'][i].maximum_value,
                        redFrom: r1, redTo: r2,
                        yellowFrom: y1, yellowTo: y2,
                        greenFrom: g1, greenTo: g2,
                        minorTicks: 20
                    };

                    $('#choose_question').append('<div class="col-md-4" id="chart_div_' + i + '"></div>');

                    var chart = new google.visualization.Gauge(document.getElementById('chart_div_' + i));
                    chart.draw(data, options);
                }
            },
            error: function (resp) {
                
            }
        });
    }
    ;

</script>



@stop