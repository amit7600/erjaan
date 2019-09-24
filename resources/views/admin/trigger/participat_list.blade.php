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
        margin-left: 30px;
        margin-bottom: 20px;
    }

    .star_rating {
        color: #FDD003;
        font-size: 30px;
        margin-right: 8px;
        margin-left: 10px;
    }

    .modal-title {
        text-align: center;
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

        @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}">
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Participants Survey Form <small>List</small></h4>
                <div class="table-responsive ">
                    <table id="zero_configuration_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">Survey Form</th>
                                <th class="text-center">Trigger Type</th>
                                <th class="text-center">Send Method</th>
                                <th class="text-center">Trigger Name</th>
                                <th class="text-center">Created Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendSurveyFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Send Survey Link To Participant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form name="sendSurveyForm" action="javascript:void(0)" method="post">
                    <div class="form-group">
                        <input type="hidden" name="participant_id" id="participant_id">
                        <input type="hidden" name="form_id" id="form_id">
                        <select class="select2_group form-control" id="on-behalf" name="on-behalf">
                            <option value="0">Select Send To</option>
                            <option value="1">OnBehalf Email</option>
                            <option value="2">Participant Email</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="email_type" id="email_type">
                        <select class="select2_group form-control" id="sending-method" name="sending-method">
                            <option value="0">Please Select Sending Method</option>
                            <option value="1">Via SMS</option>
                            <option value="2">Via Email</option>
                        </select>
                    </div>

                    <div id="template_dropdown"></div>
                    <div class="form-group">
                        <button type="button" id="btn-send-survey" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Participant Details</h5>
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
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<!--<script src="{{asset('../admin_css/assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../admin_css/assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    
</script>-->
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
    {data: 'survey_form_title', name: 'survey_form_title'},
    {data: 'trigger_type', name: 'trigger_type'},
    {data: 'sending_method', name: 'sending_method'},
    {data: 'trigger_name', name: 'trigger_name'},
    
    {data: 'created_at', name: 'created_at'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('trigger.show',Request::segment(3)) !!}'; //Url of ajax datatable where you fetch data

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

@stop