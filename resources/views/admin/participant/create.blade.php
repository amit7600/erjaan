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
    .option_val {margin-left: 40px;}
</style>
@include('datatable.dt_css')
@stop
{{-- Page content --}}
@section('inner_body')

<div class="right_col" role="main" style="min-height: 1214px;">
    <input type="hidden" id="schedule_id" value="<?php echo !empty($schedule_id)?$schedule_id:''; ?>"> 
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Step 1. Search Participants</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" value="<?php echo!empty($form_data['schedule_id']) ? $form_data['schedule_id'] : ''; ?>" id="schedule_id" name="schedule_id">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Select Type</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control" id="type_id" name="type_id">
                                            <option value="">Select Type</option>
                                            <?php $selected = ''; ?>
                                            @foreach ($type as $row)
                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['type_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>

                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="business_name">Select Group</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control" id="group_id" name="group_id">
                                            <?php $selected = ''; ?>
                                            <option value="0">Select Group</option>
                                            @foreach ($group as $row)
                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['group_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->group_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="retail_email">Select Category</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control" id="category_id_participant" name="category_id">
                                            <?php $selected = ''; ?>
                                            <option value="0">Select Category</option>
                                            @foreach ($category as $row)
                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['category_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">Select Sub Category</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                                            <option value="0">Select Sub Category</option>

                                            <?php
                                            if (!empty($form_data)) {
                                                if ($form_data['sub_category_name']) {
                                                    ?>
                                                    <option selected="selected" value="<?php echo $form_data['sub_category_id']; ?>"><?php echo $form_data['sub_category_name']; ?></option>;
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="mobile_number">Select Location</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control" id="location_id" name="location_id">
                                            <option value="">Select Location</option>
                                            @foreach ($country as $row)
                                            <?php
                                            $selected = '';
                                            if (!empty($form_data)) {
                                                if ($form_data['location_id'] == $row->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">Select Gender</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
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


                                            <option value="0">Select Gender</option>
                                            <option <?php echo $selected1; ?> value="1">Male</option>
                                            <option <?php echo $selected1; ?> value="2">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">Mobile/Email/Name</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" id="search_filter_value" name="search_filter_value" class="form-control" placeholder="Enter mobile number/email/name to search" value="<?php echo!empty($form_data['search_filter_value']) ? $form_data['search_filter_value'] : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="city">&nbsp;</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <button type="button" class="btn btn-success" id="btn-search">Search</button>
                                    </div>
                                </div>
                            </div>

                        </div> <!--end x-content row--> 
                    </div> <!--end x-content-->

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Participants <small>List</small></h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">

                        </p>
                        <p class="text-muted font-13 m-b-30">
                            <a href="{{URL::to('admin/participant/export')}}" class="btn btn-primary pull-right">Export</a>
                        </p>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%" class="text-center">S.No</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Created Date</th>
                                    <th style="width:30%" class="text-center">Action</th>
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
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Participant Details
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
<script src="{{asset('resources/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('resources/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<!--<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    
</script>-->
<script src="{{asset('resources/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
@include('admin.participant.more_detail') 

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
        var category_id = $('#category_id').find('option:selected').val();
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

@include('datatable.dt_js')  
@stop

