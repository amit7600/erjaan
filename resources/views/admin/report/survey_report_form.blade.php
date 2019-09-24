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
{{dd(654)}}
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
            <!-- start SURVEY Form Layout-->
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">Select
                                    Type <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="type_id" name="type_id">
                                            <option value="0">Select Type</option>
                                            @foreach ($type as $row)
                                            <option value="{{ $row->id }}">{{$row->type_name}}</option>
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
                                            <option value="{{ $row->id }}">{{$row->group_name}}</option>
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
                                            <option value="{{ $row->id }}">{{$row->category_name}}</option>
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
                                        <input name="created_from" readonly type="text"
                                            class="form-control has-feedback-left" id="single_cal5"
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
                                    <input name="created_to" readonly type="text" class="form-control has-feedback-left"
                                        id="single_cal4" placeholder="To Date YYYY-MM-DD"
                                        aria-describedby="inputSuccess2Status4">
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
                                            <option value="1">Pie Chart</option>
                                            <option value="2">Bar Chart</option>
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
                                <button type="button" class="btn btn-success" id="btn-search">View Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>
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