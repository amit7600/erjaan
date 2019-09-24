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

    .form-group {
        float: left;
        width: 100%;
    }

    #choose_question .modal-body {
        float: left;
        width: 100%;
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
    <h1>{{__('message.create_kpi_survey_report')}}</h1>
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

        <!-- @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->
        <!--begin::form 2-->
        <form class="form-horizontal form-label-left" method="post" action="{{route('report.store')}}">
            <input type="hidden"
                value="<?php echo!empty($form_data['schedule_id']) ? $form_data['schedule_id'] : ''; ?>"
                id="schedule_id" name="schedule_id">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                {{-- <div class="card-header bg-transparent"> --}}
                {{-- <h3 class="card-title">{{__('message.create_kpi_survey_report')}}</h3> --}}
                {{-- </div> --}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.kpis_name')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" name="kpi_name" class="form-control" value=""
                                placeholder="{{__('message.kpis_name')}}" value="{{ Input::old('kpi_name') }}">
                            <input type="hidden" name="selected_questions" id="selected_questions" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum_value"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.maximum_value')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" name="maximum_value" id="maximum_value" class="form-control" value="0"
                                placeholder="{{__('message.maximum_value')}}" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_survey_form')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="survey_form" name="survey_form">
                                    <option value="">{{__('message.select_survey_form')}}</option>
                                    @foreach ($survey_form as $form)
                                    <option value="{{ $form->id }}"><?php 
                                    echo $form->survey_form_title;
                                    ?></option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_user')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="user_data" name="user_data">
                                    <option value="">{{__('message.select_user')}}</option>
                                    @foreach ($user as $row)
                                    <option value="{{ $row->id }}"><?php 
                                    echo $row->name;
                                    ?></option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_type')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="type_id" name="type_id">
                                    <option value="">{{__('message.select_type')}}</option>
                                    @foreach ($type as $row)
                                    <option value="{{ $row->id }} "> {{$row->type_name}} </option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="business_name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_group')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="group_id" name="group_id">
                                    <option value="0">{{__('message.select_group')}}</option>
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
                    <div class="form-group row">
                        <label for="retail_email"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_category')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="category_id" name="category_id">
                                    <option value="0">{{__('message.select_category')}}</option>
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
                    <div class="form-group row">
                        <label for="password"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_sub_category')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                                    <option value="0">{{__('message.select_sub_category')}}</option>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="choose_question"></div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success"
                                    id="btn-search">{{__('message.create_kpis')}}</button>
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

<style>
    #choose_question {
        color: black;
    }
</style>


@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    var myarray = new Array();
        
    $(document).ready(function () {
        $('#survey_form').change(function () {
            myarray = new Array();
            
            var me = this;
            var url = '{{route("get_survery_form_detials")}}';
            var form_id = $(this).find(':selected').val();
            $.ajax({
                url: url,
                type: 'GET',
                data: {form_id: form_id},
                dataType: 'json',
                success: function (resp) {
                    if (resp) {
                        $('#choose_question').html(resp);
                    } else {
                        $('#choose_question').html("");
                        $('#survey_question_list').html();
                    }

                },

                error: function (resp) {

                }
            });
        });
    });
    
    
    function getSelectedQuestionMaxValue(id, checkbox) {

        if (checkbox.checked)
        {
            //to store selected question in database.
            myarray.push(id);
            
            var url = '{{route("get_survey_question_option_highest_value")}}';
            $.ajax({
                url: url,
                type: 'GET',
                data: {question_id: id},
                dataType: 'json',
                success: function (resp) {
                    if (resp) {
                        var oldValue = $('#maximum_value').val();
                        var total = parseFloat(oldValue) + parseFloat(resp);
                        $('#maximum_value').val(total);
                    }
                },
                error: function (resp) {

                }
            });
        } else {
            //to remove selected question from array
            var index = myarray.indexOf(id);
            if(index != -1){
                myarray.splice(index,1);
            }
            
            var url = '{{route("get_survey_question_option_highest_value")}}';
            $.ajax({
                url: url,
                type: 'GET',
                data: {question_id: id},
                dataType: 'json',
                success: function (resp) {
                    if (resp) {
                        var oldValue = $('#maximum_value').val();
                        var total = parseFloat(oldValue) - parseFloat(resp);
                        $('#maximum_value').val(total);
                    }
                },
                error: function (resp) {

                }
            });
        }
        
        $('#selected_questions').val(myarray);
         
    }

</script>
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
@include('datatable.alert_js')
@stop