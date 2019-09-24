@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--     <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>
-->
<style type="text/css">
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }

    .option_val {
        margin-left: 40px;
    }
</style>
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

        <!-- @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->


        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.schedule_list')}}</small>
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">{{__('message.no')}}</th>
                                <th class="text-center">{{__('message.title')}}</th>
                                <th class="text-center">{{__('message.schedule_date')}}</th>
                                <th class="text-center">{{__('message.schedule_time')}}</th>
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

<!--  Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <input type="hidden" value="" id="schedule_id" name="schedule_id" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
                    {{__('message.set_reminder')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="reminder_send_type">{{__('message.select_type')}} <span
                                class="required">*</span></label>
                        <input type="hidden" name="email_type" id="email_type">
                        <div class="">
                            <select class="form-control" id="reminder_send_type" name="reminder_send_type">
                                <option value="">{{__('message.select_type')}}</option>
                                <option value="1">{{__('message.via_sms')}}</option>
                                <option value="2">{{__('message.via_email')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="city">{{__('message.select_template')}}<span
                                class="required">*</span></label>
                        <div class="">
                            <select class="form-control" id="template_dropdown" name="template_dropdown">
                                <option value="">{{__('message.select_template')}}</option>
                                <?php foreach ($email_template as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label " for="city">{{__('message.enter_number')}}<span
                                class="required">*</span></label>
                        <div class="">
                            <input class="form-control" type="text" id="remider_count_number"
                                name="remider_count_number" placeholder="{{__('message.enter_number_of_rotation')}}" />
                        </div>
                    </div>
                    <div class="form-group  col-md-6">
                        <label class="control-label " for="rotation_type">{{__('message.select_rotation_type')}}<span
                                class="required">*</span></label>
                        <div class="">
                            <select class="form-control" id="rotation_type" name="rotation_type">
                                <option value="">{{__('message.select_rotation_type')}}</option>
                                <option value="1">{{__('message.daily')}}</option>
                                <option value="2">{{__('message.every_2_day')}}</option>
                                <option value="3">{{__('message.every_3_day')}}</option>
                                <option value="4">{{__('message.every_4_day')}}</option>
                                <option value="5">{{__('message.every_5_day')}}</option>
                                <option value="7">{{__('message.weekly')}}</option>
                                <option value="8">{{__('message.hourly')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">End Date<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" id="date-picker" >
                    </div>
                </div>
            </div> -->

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="button" class="btn btn-success"
                            id="btn-update-reminder">{{__('message.update')}}</button>
                    </div>
                </div>
            </div>

            <div class="modal-header">
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
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
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
@include('admin.participant.more_detail')

<script type="text/javascript">
    var dataTable;
var template = Handlebars.compile($("#details-template").html());
Handlebars.registerHelper('ifCond', function (v1, v2, options) {
    if (v1 === v2) {
        return options.fn(this);
    }
    return options.inverse(this);
});

var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'schedule_title', name: 'schedule_title'},
    {data: 'schedule_date', name: 'schedule_date'},
    {data: 'schedule_time', name: 'schedule_time'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('schedule.list_schedule_data') !!}'; //Url of ajax datatable where you fetch data

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
    var reminder_template_id = 0;
    $(document).ready(function () {
        $('#myModalHorizontal').on('shown',function(e){
           // debugger;
        })
        $(document).on('click', '.more-details', function () {

//            $('#template_dropdown').val('');
//            $('#reminder_send_type').val('');
//            $('#rotation_type').val('');
//            $('#remider_count_number').val('');

//            $('#form_id').trigger("reset");

            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $('#schedule_id').val(row.id);
            $.ajax({
                url: '{{route("schedule.get_schedule_reminder")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    schedule_id: row.id,
                    _token: $('meta[name="csrf-token"]').attr('content')},
                success: function (resp) {
                    
                    if (resp != '2') {
                       
                        //$('#template_dropdown option[value="' + resp.reminder_template_id + '"]').attr('selected', false)
                        //$('#reminder_send_type option[value="' + resp.reminder_type_id + '"]').attr('selected', false)
                        //$('#rotation_type option[value="' + resp.rotation_type + '"]').attr('selected', false)
                        
                        //$('#template_dropdown option[value="' + resp.reminder_template_id + '"]').attr('selected', true)
                        $('#myModalHorizontal ').modal('show');
                        $('#reminder_send_type option[value="' + resp.reminder_type_id + '"]').attr('selected', true).change();
                        $('#rotation_type option[value="' + resp.rotation_type + '"]').attr('selected', true)
                        $('#remider_count_number').val(resp.rotation_number);
                        reminder_template_id = resp.reminder_template_id;
                       
                    } else {
                        $('#myModalHorizontal ').modal('show');
                    }

                },
                error: function (resp) {

                }
            });
        });


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

        $(document).on('click', '#btn-update-reminder', function () {
            var extraData = {};

            var schedule_id = $('#schedule_id').val();
            var reminder_send_type = $('#reminder_send_type').val();
            if (reminder_send_type == '') {
                alert('{{__('message.please_select_type')}}!');
                return false;
            }
            var template_dropdown = $('#template_dropdown').val();
            if (template_dropdown == '') {
                alert('{{__('message.please_select_template')}}!');
                return false;
            }
            var remider_count_number = $('#remider_count_number').val();
            if (remider_count_number == '') {
                alert('{{__('message.please_enter_number')}}!');
                return false;
            }
            var rotation_type = $('#rotation_type').val();
            if (rotation_type == '') {
                alert('{{__('message.please_select_rotation_type')}}!');
                return false;
            }


            extraData.schedule_id = schedule_id;
            extraData.reminder_send_type = reminder_send_type;
            extraData.template_dropdown = template_dropdown;
            extraData.remider_count_number = remider_count_number;
            extraData.rotation_type = rotation_type;
            extraData.end_date = $('#date-picker').val();

            $.ajax({
                url: '{{route("schedule.add_schedule_reminder")}}',
                data: {
                    params: extraData,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    window.location.href = '{{route("schedule.list_schedule_data")}}';
                }
            });

        });

    });
        
    
        $(document).on('change','#reminder_send_type',function(){ 
            url = '';
            if($(this).val()==1) {
                var template_id = 1;
                $("#email_type").val(1);
                var url = '{{route("get_sms_template")}}';
            }else if($(this).val()==2){
                $('#get_balence_info').html("");
                var template_id = 2;
                $("#email_type").val(2);
                var url = '{{route("get_email_template")}}';
            }
            
            $.ajax({
                url  : url,
                type : 'GET',
                data : {template_id:template_id,_token: $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function(resp){
                    if(resp){
                        $('#template_dropdown').html(resp);
                        if(reminder_template_id!=0){
                            $('#template_dropdown option[value="' +reminder_template_id + '"]').attr('selected', true);
                            reminder_template_id = 0;
                        }
                    } 
                },
                error: function(resp){

                }
            });

        });
        $( function() {
    $( "#date-picker" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
  } );
</script>
@include('datatable.alert_js')
@include('datatable.dt_js')
@stop