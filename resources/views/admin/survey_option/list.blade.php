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
    #image_on_popup img{
        max-width: 100%;
        max-height: 100%;
    }
</style>
@include('datatable.dt_css')
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
                        <h2>Survey Option <small>List</small></h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">

                        </p>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="text-center">S.No</th>
                                    <th class="text-center">Survey Form</th>
                                    <th class="text-center">Survey Question</th>
                                    <th class="text-center">Survey Option</th>
                                    <th class="text-center">Survey Points</th>
                                    <th class="text-center">Created Date</th>
                                    <th class="text-center">Updated Date</th>
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
<script src="{{asset('resources/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('resources/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<!--<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    
</script>-->
<script src="{{asset('resources/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
var dataTable;
var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'survey_form_title', name: 'survey_form_title'},
    {data: 'survey_question', name: 'survey_question'},
    {data: 'survey_option_title', name: 'survey_option_title'},
    {data: 'option_point', name: 'option_point'},
    {data: 'created_at', name: 'created_at'},
    {data: 'updated_at', name: 'updated_at'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('survey_option.index') !!}'; //Url of ajax datatable where you fetch data

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

@include('datatable.dt_js')  
@stop

