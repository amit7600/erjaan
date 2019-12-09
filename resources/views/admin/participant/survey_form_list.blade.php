@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<style type="text/css">
    #image_on_popup img{
        max-width: 100%;
        max-height: 100%;
    }
    .option_val {margin-left: 30px;margin-bottom: 20px;}
    .star_rating{color: #FDD003;font-size: 30px;margin-right: 8px;margin-left: 10px;}
    .modal-title{text-align: center;}
</style>
@stop
{{-- Page content --}}
@section('inner_body')

<div class="right_col" role="main" style="min-height: 1214px;">
    <div class="">
        <!-- <div class="page-title">
            <div class="title_left">
                <h3><span>Activity </span><small></small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div> -->
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__('message.participants_survey_form_list')}}</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">

                        </p>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="text-center">S.No</th>
                                    <th class="text-center">{{__('message.first_name')}}</th>
                                    <th class="text-center">{{__('message.last_name')}}</th>
                                    <th class="text-center">{{__('message.on_behalf')}} {{__('message.first_name')}}</th>
                                    <th class="text-center">{{__('message.on_behalf')}} {{__('message.last_name')}}</th>
                                    <th class="text-center">{{__('message.survey_form')}}</th>
                                    <th class="text-center">{{__('message.created_date')}}</th>
                                    <th class="text-center">{{__('message.action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade" id="sendSurveyFormModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                        {{__('message.send_survey_link_to_participant')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{{__('message.close')}}</span>
                </button>
                
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form name="sendSurveyForm" action="javascript:void(0)" method="post">
                   <div class="form-group">
                        <input type="hidden" name="participant_id" id="participant_id">
                        <input type="hidden" name="form_id" id="form_id">
                       <select class="select2_group form-control" id="on-behalf" name="on-behalf">
                           <option value="0">{{__('message.select_send_to')}}</option>
                           <option value="1">{{__('message.on_behalf')}} {{__('message.email')}}</option>
                           <option value="2">{{__('message.participant_email')}}</option>
                           
                       </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="email_type" id="email_type">
                       <select class="select2_group form-control" id="sending-method" name="sending-method">
                           <option value="0">{{__('message.please_select_sending_method')}}</option>
                           <option value="1">{{__('message.via_sms')}}</option>
                           <option value="2">{{__('message.via_email')}}</option>
                       </select>
                    </div>

                    <div id="template_dropdown"></div>
                    <div class="form-group">
                        <button type="button" id="btn-send-survey" class="btn btn-success">{{__('message.send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">{{__('message.close')}}</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                        {{__('message.participant')}} {{__('message.details')}}
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
               
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="mySurveyFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    {data: 'on_behalf_first_name', name: 'on_behalf_first_name'},
    {data: 'on_behalf_last_name', name: 'on_behalf_last_name'},
    {data: 'survey_form_title', name: 'survey_form_title'},
    {data: 'created_at', name: 'created_at'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('display_survey_participant') !!}'; //Url of ajax datatable where you fetch data

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
        var sending_val = $("#sending-method").val();
        if(sending_val==1) {
            var template_id = 1;
            $("#email_type").val(1);
            var url = '{{route("get_sms_template")}}';
        }else if(sending_val==2){
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
                    $('#template_dropdown').html(resp)
                } 
            },
            error: function(resp){

            }
        });

        $(document).on('change','#sending-method',function(){ 
            if($(this).val()==1) {
                var template_id = 1;
                $("#email_type").val(1);
                var url = '{{route("get_sms_template")}}';
            }else if($(this).val()==2){
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
                        $('#template_dropdown').html(resp)
                    } 
                },
                error: function(resp){

                }
            });

        });


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


        $(document).on('click', '.send_survey_form_link', function () {
            $("#sendSurveyFormModal").modal("show");
            var parti_id = $(this).attr('rel');
            var form_id = $(this).attr('form-data');
            $("#participant_id").val(parti_id);
            $("#form_id").val(form_id);
            
        });


        
        $(document).on('click', '#btn-send-survey', function () {    
            var me = this;
            
            var form_id = $('#form_id').val();
            var parti_id = $('#participant_id').val();
            var email_type = $('#email_type').val();
            var select_template = $('#template_type').find('option:selected').val();
            var onBehalf = $('#on-behalf').find('option:selected').val();
            
            if(email_type=="0" || email_type==undefined){
                alert("Please select email type.");
                return false;
            }

            if(select_template==undefined || select_template==0){
                alert("Please select template.");
                return false;
            }

            
            if(onBehalf=="0" || onBehalf==undefined){
                alert("Please select send to option.");
                return false;
            }

            if(typeof extraData=='undefined'){
                extraData = {};
            }


            extraData.email_type = email_type;
            extraData.template = select_template;
            extraData.survey_id = form_id;
            extraData.on_behalf = onBehalf;
            extraData.participant_id = parti_id;
            

            if(select_template!="0" && onBehalf!="0" && email_type!="0"){
                $("#btn-send-survey").text('Processing..');
                $("#btn-send-survey").attr('disabled', true);
                $.ajax({
                    url : '{{route("resend_survey_to_participant")}}',
                    type: 'POST',
                    dataType : 'json',
                    data: {
                        params : extraData,
                        _token : "{{csrf_token()}}",
                    },
                    success: function(resp){
                       window.location.href = '{{route("display_survey_participant")}}';
                       window.location.reload();
                    },
                    error: function(resp){

                    }
                });
            }else{
                alert("Something went wrong pelase try again.");
                $("#btn-send-survey").text('Send');
                $("#btn-send-survey").removeAttr('disabled');
                return false;
            }
        
        });


        
    });
</script>
@include('datatable.dt_js')
@stop

