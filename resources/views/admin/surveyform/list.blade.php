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

    .checkbox-list>label {
        display: block;
    }

    .radio-list>label {
        display: block;
    }
</style>
@stop
{{-- Page content --}}
@section('inner_body')

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

@if(session()->has('message.error'))
<div class="alert alert-card alert-{{ session('message.error') }}">
    <strong class="text-capitalize">{!! session('message.content') !!}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.survey_form_list')}}</h4>
                <div id="show_filter"></div>
                <div class="table-responsive">
                    <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center" scope="col">{{__('message.survey_form_title')}}</th>
                                <th class="text-center" scope="col">{{__('message.survey_form_logo')}}</th>
                                <th class="text-center" scope="col">{{__('message.created_date')}}</th>
                                <th class="text-center" scope="col">{{__('message.updated_date')}}</th>
                                <th class="text-center" scope="col">{{__('message.action')}}</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModalHorizontal" tabindex="-1" role="dialog"
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
<style>
    .modal-title {
        text-align: center;
        line-height: 54px;
    }

    .option_val {
        margin-left: 40px;
    }
</style>
<script type="text/javascript">
    var dataTable;
var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'survey_form_title', name: 'survey_form_title'},
    {data: 'survey_form_logo', name: 'survey_form_logo'},
    {data: 'created_at', name: 'created_at'},
    {data: 'updated_at', name: 'updated_at'},
    {data: 'action', name: 'action'},
];

// var template = Handlebars.compile($("#details-template").html());

// Handlebars.registerHelper('ifCond', function(v1, v2, options) {
//   if(v1 == v2) {
//     return options.fn(this);
//   }
// });
var ajaxUrl = '{!! route('surveyform.index') !!}'; //Url of ajax datatable where you fetch data
var get_survey_form_url = "{!! route('survey_form_details') !!}"; //Url of ajax datatable where you fetch data

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
    var get_survey_form_url = "{!! route('survey_form_details') !!}";
    function copysurveyFormLink() {
      var copyText = document.getElementById("copyLink");
      copyText.select();
      document.execCommand("Copy");
    }

    $(document).ready(function () {
        $(document).on('click', '.more-details', function () {
            var form_id = $(this).attr('rel');
            $.ajax({
                url: get_survey_form_url,
                data: {
                    form_id:form_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: 'JSON',
                success: function (response) { 
                    $('#myModalHorizontal .surveyFormDetails').html(response);
                    $('#myModalHorizontal').modal('show');
                }
            }); 

            
        });
    });
</script>
<script type="text/javascript">

</script>
@include('datatable.alert_js')
@include('datatable.dt_js')
@stop