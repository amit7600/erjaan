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

<input type="hidden" id="schedule_id" value="<?php echo !empty($schedule_id)?$schedule_id:''; ?>">
<div class="breadcrumb">
    <h1>{{__('message.participants_list')}}</h1>
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

        <form class="form-horizontal form-label-left" action="{{route('participant_export')}}" method="GET">
            <input type="hidden"
                value="<?php echo!empty($form_data['schedule_id']) ? $form_data['schedule_id'] : ''; ?>"
                id="schedule_id" name="schedule_id">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.step_1_search_participants')}}</h3>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_type')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="type_id" name="type_id">
                                            <option value="">{{__('message.select_type')}}</option>
                                            <?php $selected = ''; ?>
                                            @foreach ($type as $row)
                                            <?php if (!empty($form_data)) {
                                                if ($form_data['type_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            } ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->type_name}}
                                            </option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_group')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="group_id" name="group_id">
                                            <?php $selected = ''; ?>
                                            <option value="">{{__('message.select_group')}}</option>
                                            @foreach ($group as $row)
                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['group_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->group_name}}
                                            </option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_category')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="category_id_participant"
                                            name="category_id">
                                            <?php $selected = ''; ?>
                                            <option value="">{{__('message.select_category')}}
                                            </option>
                                            @foreach ($category as $row)
                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['category_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">
                                                {{$row->category_name}}</option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_sub_category')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="sub_category_id"
                                            name="sub_category_id">
                                            <option value="">{{__('message.select_sub_category')}}
                                            </option>
                                            <?php if (!empty($form_data)) {
                                                if ($form_data['sub_category_name']) {?>
                                            <option selected="selected"
                                                value="<?php echo $form_data['sub_category_id']; ?>">
                                                <?php echo $form_data['sub_category_name']; ?></option>;
                                            <?php }
                                            } ?>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_location')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="location_id" name="location_id">
                                            <option value="">{{__('message.select_location')}}
                                            </option>

                                            @foreach ($country as $row)
                                            <?php
                                            $selected = '';
                                            if (!empty($form_data)) {
                                                if ($form_data['location_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->name}}
                                            </option>
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_gender')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="gender" name="gender">

                                            <?php
                                            $selected1 = '';
                                            $selected2 = '';

                                            if (!empty($form_data)) {
                                                if ($form_data['gender'] == '1') {
                                                    $selected1 = 'selected';
                                                }

                                                if ($form_data['gender'] == '2') {
                                                    $selected2 = 'selected';
                                                }
                                            }
                                            ?>


                                            <option value="">{{__('message.select_gender')}}</option>
                                            <option <?php echo $selected1; ?> value="1">{{__('message.male')}}</option>
                                            <option <?php echo $selected1; ?> value="2">{{__('message.female')}}
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.mobile_email_name')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <input type="text" id="search_filter_value" name="search_filter_value"
                                        class="form-control"
                                        placeholder="{{__('message.enter_mobile_number_email_name_to_search')}}"
                                        value="<?php echo!empty($form_data['search_filter_value']) ? $form_data['search_filter_value'] : ''; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn btn-success"
                                    id="btn-search">{{__('message.search')}}</button>
                                <button type="submit" class="btn btn-primary ">{{__('message.export')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>

        <!-- start survey question option form -->
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.participants_list')}}</h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">{{__('message.no')}}</th>
                                <th class="text-center">{{__('message.first_name')}}</th>
                                <th class="text-center">{{__('message.last_name')}}</th>
                                <th class="text-center">{{__('message.email')}}</th>
                                <th class="text-center">{{__('message.mobile')}}</th>
                                <th class="text-center">{{__('message.created_date')}}</th>
                                <th style="width:30%" class="text-center">{{__('message.action')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end survey question option form -->
        <!-- end::form 2-->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('message.participant_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="mySurveyFormModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="surveyFormDetails"> </div>
        </div>
    </div>
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@include('admin.participant.more_detail')
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>

<script type="text/javascript">
    var dataTable;
var extraData={};

var scheduleID = $('#schedule_id').val();
extraData.schedule_id = scheduleID;
extraData.segment = '{{Request::segment(2)}}';


var template = Handlebars.compile($("#details-template").html());
Handlebars.registerHelper('ifCond', function(v1, v2, options) {
  if(v1 === v2) {
    return options.fn(this);
  }
  return options.inverse(this);
});

var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'first_name', name: 'first_name'},
    {data: 'last_name', name: 'last_name'},
    {data: 'email', name: 'email'},
    {data: 'mobile', name: 'mobile'},
    {data: 'created_at', name: 'created_at'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('participant.index') !!}'; //Url of ajax datatable where you fetch data

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
        "class": "text-left"
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
            /*{
             "targets": 5,
             "orderable": false,
             "class":"text-center"
             },*/
];
//var columnDefs = [];
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.more-details', function () {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $.ajax({
                url: '{{route("more_details_participant")}}',
                type: 'GET',
                dataType: 'json',
                data: {participant_id:row.id},
                success:function(resp){
                    $('#myModalHorizontal .modal-body').html(template(resp.data));
                    $('#myModalHorizontal ').modal('show');
                },
                error: function(resp){

                }
            });
        });
    });    
    $(document).ready(function () {
        $(document).on('click', '.survey_form_details', function () {
           var survey_form_url = $(this).attr('rel');
            $.ajax({
                url: survey_form_url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                dataType: 'JSON',
                success: function (response) { 
                    $('#mySurveyFormModal .surveyFormDetails').html(response);
                    $('#mySurveyFormModal').modal('show');
                }
            });

        });

 		$('#btn-search').click(function () {
            var category_id = $('#category_id_participant').find('option:selected').val();
            var sub_category_id = $('#sub_category_id').find('option:selected').val();
            var type_id = $('#type_id').find('option:selected').val();
            var location_id = $('#location_id').find('option:selected').val();
            var gender = $('#gender').find('option:selected').val();
            var group_id = $('#group_id').find('option:selected').val();

            extraData = {};
            extraData.category_id = category_id;
            extraData.sub_category_id = sub_category_id;
            extraData.type_id = type_id;
            extraData.location_id = location_id;
            extraData.gender = gender;
            extraData.group_id = group_id;
            extraData.segment = '{{Request::segment(2)}}';
            extraData.search_filter_value = $('#search_filter_value').val();
            dataTable.ajax.reload();
        });
        
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id_participant').change(function(){
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
                    $('#sub_category_id').html('<option value="0"{{__('message.select_sub_category')}}</option>');
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
@include('datatable.dt_js')
@stop