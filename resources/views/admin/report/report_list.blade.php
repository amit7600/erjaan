@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
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
{{dd('report_list')}}
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
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Submitted survey form report<small>List</small></a>
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">Survey form</th>
                                <th class="text-center">Logo</th>
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
</div>


@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
@include('admin.participant.more_detail')

<script type="text/javascript">
    var dataTable;
// var template = Handlebars.compile($("#details-template").html());
// Handlebars.registerHelper('ifCond', function(v1, v2, options) {
//   if(v1 === v2) {
//     return options.fn(this);
//   }
//   return options.inverse(this);
// });

var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'first_name', name: 'first_name'},
    {data: 'last_name', name: 'last_name'},
    {data: 'survey_form_title', name: 'survey_form_title'},
    {data: 'survey_form_logo', name: 'survey_form_logo'},
    {data: 'created_at', name: 'created_at'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('report.index') !!}'; //Url of ajax datatable where you fetch data

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
    });
</script>

@stop