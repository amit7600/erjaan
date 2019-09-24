<style type="text/css">
    .myoption {
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
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

<?php
$title = __('message.create_auto_trigger');
$action = route('trigger.store');
$method = "";
$image = "";
$button = __('message.save');
$edit = false;
$update_action = "";
if (!empty($repairman_data->id)) {
    $edit = true;
    $title = __('message.edit_auto_trigger');
    $action = route('trigger.update', $repairman_data->id);
    $method = '<input type="hidden" name="_method" value="PUT" />';
    $update_action = "update_form";
}
?>

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
        <!--begin::form 2-->
        <form method="post" action="{{$action}}" id="demo-form2" class="form-horizontal form-label-left">

            {!! $method !!}

            <input type="hidden" name="form_action" value="{{$update_action}}">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title"><?php echo $title; ?></h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.trigger_name')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="trigger_name" name="trigger_name"
                                value="{{!empty($repairman_data->trigger_name)?$repairman_data->trigger_name:Input::old('trigger_name')}}"
                                class="form-control" placeholder="{{__('message.trigger_name')}}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.send_survey_immediately')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                @if(isset($repairman_data))
                                <?php 
                                        $checked = '';
                                        if ($repairman_data->immediately == 1) {
                                            $checked = 'checked';
                                    }
                                ?>
                                <input type="checkbox" id="immediately" <?php echo $checked; ?> name="immediately"
                                    onchange="showHide()" />
                                @else
                                <input type="checkbox" id="immediately" name="immediately" onchange="showHide()" />
                                @endif
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row answer">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.waiting_time')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-2 col-md-2 col-sm-2 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="waiting_time" name="waiting_time"
                                    value="{{!empty($repairman_data->waiting_hours)?$repairman_data->waiting_hours:Input::old('waiting_time')}}"
                                    class="form-control" placeholder="{{__('message.enter_number')}}" />
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Clock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="waiting_time_formate"
                                    name="waiting_time_formate">
                                    <option value="0">{{__('message.select_type')}}</option>
                                    <?php
                                        $selected1 = '';
                                        $selected2 = '';
                                        $selected3 = '';
                                        $selected4 = '';
                                        $selected5 = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->waiting_time_formate == 'minute'){
                                                $selected5 = 'selected';
                                            }
                                            if ($repairman_data->waiting_time_formate == 'hour'){
                                                $selected1 = 'selected';
                                            }

                                            if ($repairman_data->waiting_time_formate == 'day'){
                                                $selected2 = 'selected';
                                            }

                                            if ($repairman_data->waiting_time_formate == 'month'){
                                                $selected3 = 'selected';
                                            }

                                            if ($repairman_data->waiting_time_formate == 'year'){
                                                $selected4 = 'selected';
                                            }
                                        }
                                        ?>
                                    <option <?php echo $selected5; ?> value="minute">{{__('message.minutes')}}</option>
                                    <option <?php echo $selected1; ?> value="hour">{{__('message.hours')}}</option>
                                    <option <?php echo $selected2; ?> value="day">{{__('message.days')}}</option>
                                    <option <?php echo $selected3; ?> value="month">{{__('message.months')}}</option>
                                    <option <?php echo $selected4; ?> value="year">{{__('message.years')}}</option>

                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12"
                            style="<?php echo !empty($repairman_data->trigger_time) ? 'display: block' : 'display: none'; ?>"
                            id="timeDiv">
                            <input type="text" class="select2_group form-control" name="selecTime" id="selecTime"
                                value="<?php echo !empty($repairman_data->trigger_time) ? $repairman_data->trigger_time : ''; ?>"
                                placeholder="{{__('message.select_time')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="sending_id">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_trigger_event')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="trigger_event" name="trigger_event">
                                    <?php
                                        $selected1 = '';
                                        $selected2 = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->trigger_event == 1){
                                                $selected1 = 'selected';
                                            }

                                            if ($repairman_data->trigger_event == 2){
                                                $selected2 = 'selected';
                                            }
                                        }
                                        ?>
                                    <option value="">{{__('message.event_type')}}</option>
                                    <option <?php echo $selected1; ?> value="1">{{__('message.new_participant')}}
                                    </option>
                                    <option <?php echo $selected2; ?> value="2">{{__('message.updated_participant')}}
                                    </option>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_sending_method')}}
                            <span class="required">*</span></label>
                        <input type="hidden" name="email_type" id="email_type">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="sending-method" name="sending_method">
                                    <option value="0">{{__('message.please_select_sending_method')}}</option>
                                    <?php
                                        $selected1 = '';
                                        $selected2 = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->sending_method == 1){
                                                $selected1 = 'selected';
                                            }

                                            if ($repairman_data->sending_method == 2){
                                                $selected2 = 'selected';
                                            }
                                        }
                                        ?>

                                    <option <?php echo $selected1; ?> value="1">{{__('message.via_sms')}}</option>
                                    <option <?php echo $selected2; ?> value="2">{{__('message.via_email')}}</option>

                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div id="template_dropdown"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_type')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="type" name="type_id[]"
                                    multiple="multiple">
                                    <?php $selected = ''; ?>
                                    @foreach ($type as $row)

                                    <?php
                                    if (!empty($repairman_data)) {
                                        $type = explode(',',$repairman_data['type']);
                                        $value = array_search($row->id,$type);

                                        if ($type[$value] == $row->id) {
                                            $selected = 'selected';
                                        }else{
                                            $selected = '';
                                        }
                                    }
                                    ?>

                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_group')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="group" name="group_id[]"
                                    multiple="multiple">
                                    <?php $selected = ''; ?>
                                    @foreach ($group as $row)
                                    <?php
                                        if (!empty($repairman_data)) {
                                                $group = explode(',',$repairman_data['group']);
                                                $value = array_search($row->id,$group);

                                            if ($group[$value] == $row->id) {
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->group_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_category')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="category_id" name="category_id[]"
                                    multiple="multiple">
                                    <?php $selected = ''; ?>
                                    @foreach ($category as $row)
                                    <?php
                                        if (!empty($repairman_data)) {
                                            
                                            $cat = explode(',',$repairman_data['category']);
                                            $value = array_search($row->id,$cat);

                                                if ($cat[$value] == $row->id) {
                                                        $selected = 'selected';
                                                }else{
                                                    $selected = '';
                                                }
                                            
                                        }
                                            
                                        ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->category_name}}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- <div class="ln_solid"></div> -->
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
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

@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script type="text/javascript">
    var template_dropdown = "<?php echo !empty(old('template_dropdown'))?old('template_dropdown'):(!empty($repairman_data->email_templ_id)?$repairman_data->email_templ_id:0);?>";
    $(document).ready(function () {
        var checkImm = <?php if (isset($repairman_data) && $repairman_data->immediately) {
            echo 1;
        } else {
            echo 0;
        } ?>;
        if (checkImm == 1) {
            showHide()
        }
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
                    $('#template_dropdown').html(resp);
                    $('#template_dropdown option[value="'+template_dropdown+'"]').attr("selected", "selected");
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
                    //debugger;
                    if(resp){
                        $('#template_dropdown').html(resp);
                        $('#template_dropdown option[value="'+template_dropdown+'"]').attr("selected", "selected");
                    } 
                },
                error: function(resp){

                }
            });
        });
});
    
     //open time picker
//        $('#selecTime').timepicker();
        $('#selecTime').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
//    minTime: '10',
//    maxTime: '12:00pm',
//    defaultTime: '11',
    startTime: '10:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});

//to select type to show the time
$('#waiting_time_formate').change(function(){
    if(this.value == 'hours'){
       $('#timeDiv').css('display','none');
       $('#selecTime').val('');
    }else{
        $('#timeDiv').css('display','block');
    }
});


function showHide()
{
    alert
    if($('#immediately').is(":checked")) {
        $(".answer").hide();
    } else {
        $(".answer").show();
    }
}

$(document).ready(function() {
        $('#category_id,#type,#group').multiselect();
 
    });

</script>
<style>
    .btn-group {
        width: 100%;
        text-align: left;
    }

    .btn-group .multiselect {
        width: 100%;
        text-align: left;
    }
</style>
@stop