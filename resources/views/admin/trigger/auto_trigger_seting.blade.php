@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--     <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>-->
<style type="text/css">
    #image_on_popup img{
        max-width: 100%;
        max-height: 100%;
    }
    .dataTables_filter{
        display:none !important;
    }
</style>
@include('datatable.dt_css')
@stop
{{-- Page content --}}
@section('inner_body')

<div class="right_col" role="main" style="min-height: 1214px;">
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

    <div class="">
        <form name="auto_trigger_stting" action="{{route('save_auto_trigger_setting')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="page-title">
            <div class="title_left">
                <h3><span>Select Participants Auto Trigger</span></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div>
            <div class="clearfix"></div>
        <br>

        <div class="row">
             <div class="form-group col-md-4 col-sm-12">
                   
                <input type="hidden" name="sending_id" value="<?php echo ($auto_trigger_data->id)?$auto_trigger_data->id:""; ?>">
                <select class="select2_group form-control" id="type_id" name="type_id">
                    <option value="">Select Type</option>
                    @foreach ($type as $row)
                        <option <?php echo ($auto_trigger_data->type_id==$row->id)? "selected='selected'": ""; ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <select class="select2_group form-control" id="category_id" name="category_id">
                    <option value="0">Select Category</option>
                    @foreach ($category as $row)
                        <option <?php echo ($auto_trigger_data->category_id==$row->id)? "selected='selected'": ""; ?> value="{{ $row->id }}">{{$row->category_name}}</option>
                    @endforeach
                </select>
            </div>
           <div class="form-group col-md-4 col-sm-12">
                <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                    <option value="0">Select Sub Category</option>
                </select>
            </div>
        </div>
            
        <div class="row">
             <div class="form-group col-md-4 col-sm-12">
                   <select class="select2_group form-control" id="location_id" name="location_id">
                        <option value="">Select Location</option>
                        @foreach ($country as $row)
                            <option <?php echo ($auto_trigger_data->location_id==$row->id)? "selected='selected'": ""; ?> value="{{ $row->id }}">{{$row->name}}</option>
                        @endforeach
                    </select>
            </div>
            
            <div class="form-group col-md-4 col-sm-12">
                <select class="select2_group form-control" id="group_id" name="group_id">
                    <option value="0">Select Group</option>
                    @foreach ($group as $row)
                        <option <?php echo ($auto_trigger_data->group_id==$row->id)? "selected='selected'": ""; ?> value="{{ $row->id }}">{{$row->group_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 col-sm-12">
                <input type="text" id="waiting_time" name="waiting_time" value="<?php echo ($auto_trigger_data->waiting_hours)? $auto_trigger_data->waiting_hours: ""; ?>" class="form-control" placeholder="1 Hrs" />
            </div>
        </div>
            
        <hr>
        <div class="clearfix"></div>
        
        <div class="selected_parti_count"></div>
        <h2>Select Sending methods</h2>   
        <div class="row">
            <div class="form-group col-md-4 col-sm-12">
                <select class="select2_group form-control" id="survey-form-id" name="survey_form_id">
                    <option value="0">Select Survey Form</option>
                    @foreach ($survey_form_data as $row)
                        <option <?php echo ($auto_trigger_data->form_id==$row->id)? "selected='selected'": ""; ?> value="{{ $row->id }}">{{$row->survey_form_title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 col-lg-2 col-sm-12">
               <select class="select2_group form-control" id="on-behalf" name="on_behalf">
                   <option value="0">Select Send To</option>
                   <option <?php echo ($auto_trigger_data->send_to==1)? "selected='selected'": ""; ?> value="1">OnBehalf Email</option>
                   <option <?php echo ($auto_trigger_data->send_to==2)? "selected='selected'": ""; ?> value="2">Participant Email</option>
                   
               </select>
            </div>
            <div class="form-group col-md-4 col-lg-2 col-sm-12">
                <input type="hidden" name="email_type" id="email_type">
               <select class="select2_group form-control" id="sending-method" name="sending_method">
                   <option value="0">Please Select Sending Method</option>
                   <option <?php echo ($auto_trigger_data->sending_method==1)? "selected='selected'": ""; ?> value="1">Via SMS</option>
                   <option <?php echo ($auto_trigger_data->sending_method==2)? "selected='selected'": ""; ?> value="2">Via Email</option>
                   
               </select>
            </div>

            <div class="col-md-4 col-sm-12" id="template_dropdown"></div>
            <div class="clearfix"></div>
            <div class="form-group col-md-12">
                <button type="submit" id="save_auto_trigger_setting" class="btn btn-success">Save</button>
            </div>
        </div>
        </form>
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
            <!-- Modal Footer -->
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="button" class="btn btn-primary" id="forget-pass-button">
                    Submit
                </button>
            </div> -->
        </div>
    </div>
</div> 
  
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../resources/assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    
</script>-->
<script src="{{asset('resources/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>

@include('admin.participant.more_detail') 

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
            //debugger;
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $.ajax({
                url: '{{route("more_details_participant")}}',
                type: 'GET',
                dataType: 'json',
                data: {participant_id:row.id},
                success:function(resp){
                    //debugger;
                    $('#myModalHorizontal .modal-body').html(template(resp.data));
                    $('#myModalHorizontal ').modal('show');
                },
                error: function(resp){

                }
            });
        });

        $(document).on('change','.select-participant',function(e){
            //debugger;
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();

            var countCheckedCheckboxes = $('.select-participant:checked').length;
            if(countCheckedCheckboxes>0){
                $('.selected_parti_count').html("<h2>Selected Participant: "+ countCheckedCheckboxes+ "</h2>");
            }else{
                $('.selected_parti_count').html("");
            }

            if($(this).is(":checked")) {
                survey.push(row.id);
            }else{
                survey.pop(row.id);
            }
        });

        $(document).on('change','#select-all-participant',function(e){
            
            if($(this).is(":checked")) {
                sendAll = 1;
                $('.select-participant').prop('checked',true);
            }else{
                sendAll = 0;
                $('.select-participant').prop('checked',false);
            }

            var countCheckedCheckboxes = $('.select-participant:checked').length;
            
            if(countCheckedCheckboxes>0){
                $('.selected_parti_count').html("<h2>Selected Participant: "+ countCheckedCheckboxes+ "</h2>");
            }else{
                $('.selected_parti_count').html("");
            }
            

        });
        
    });
    

var url = '{{route("get_sub_category_by_category_id")}}';    
var categoryId = $("#category_id").find(':selected').val();

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

    $('#btn-search').click(function(){
        var category_id = $('#category_id').find('option:selected').val();
        var sub_category_id = $('#sub_category_id').find('option:selected').val();
        var type_id = $('#type').find('option:selected').val();
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
        extraData.search_filter_value = $('#search_filter_value').val();
        dataTable.ajax.reload();
    });

    $('#btn-send-survey').click(function(){

        var me = this;
        var email_type = $('#email_type').val();
        var select_template = $('#template_type').find('option:selected').val();
        var onBehalf = $('#on-behalf').find('option:selected').val();
        var surveyId = $('#survey-form-id').find('option:selected').val();
        var sendingMethod = $('#sending-method').find('option:selected').val();
        var totalRecords =dataTable.page.info().recordsTotal;
        
        if(select_template=="0" || select_template==undefined){
            alert("Please select template.");
            return false;
        }

        if(totalRecords<=0){
            alert('No data available for sending survey.');
            return false;
        }

        if(survey.length==0 && sendAll==0){
            alert("Please select participant.");
            return false;
        }

        if(surveyId=="0" || surveyId==undefined){
            alert("Please select survey form.");
            return false;
        }

        if(onBehalf=="0" || onBehalf==undefined){
            alert("Please select send to option.");
            return false;
        }

        if(sendingMethod=="0" || sendingMethod==undefined){
            alert("Please select sending method.");
            return false;
        }


        if(typeof extraData=='undefined'){
            extraData = {};
        }

        
        extraData.email_type = email_type;
        extraData.template = select_template;
        extraData.on_behalf = onBehalf;
        extraData.survey = survey;
        extraData.survey_id = surveyId;
        extraData.send_all = sendAll;

        if(totalRecords>0 && select_template!="0" && surveyId!="0" && onBehalf!="0" && sendingMethod!="0"){
            $("#btn-send-survey").text('Processing..');
            $("#btn-send-survey").attr('disabled', true);
            $.ajax({
                url : '{{route("send_survey_to_participant")}}',
                type: 'POST',
                dataType : 'json',
                data: {
                    params : extraData,
                    _token : "{{csrf_token()}}",
                },
                success: function(resp){
                    window.location.href = '{{route("display_survey_participant")}}';
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

    function resetBtnText(me){
        $(me).prop('value', 'Send'); 
        $(me).prop('disabled', false);
        
    }

</script>

@include('datatable.dt_js')  
@stop

