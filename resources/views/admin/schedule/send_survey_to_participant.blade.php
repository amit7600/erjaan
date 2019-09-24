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
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }

    .dataTables_filter {
        display: none !important;
    }

    /* .selected_parti_count {
        float: left;
        text-align: right !important;
        margin-left: 75px;
        border-right: 1px solid #999;
        padding-right: 30px;
    } */
    .balence_margin {
        float: right;
    }
</style>
@include('datatable.dt_css')
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
        <!--begin::form 2-->
        <form class="form-horizontal form-label-left">
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
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_type')}}
                                    <span class="required">*</span></label>
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
                                            <option value="0">{{__('message.select_group')}}</option>
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
                                        <select class="select2_group form-control" id="category_id_survay"
                                            name="category_id">
                                            <?php $selected = ''; ?>
                                            <option value="0">{{__('message.select_category')}}</option>
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
                                            <option value="0">{{__('message.select_sub_category')}}</option>
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
                                            <option value="">{{__('message.select_location')}}</option>
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


                                            <option value="0">{{__('message.select_gender')}}</option>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey Form Layout-->
        </form>
        <!-- end survey Form Layout-->


        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.step_2_select_participants')}}</small></h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">{{__('message.no')}}</th>
                                <th style="width:5%" class="text-center"><label class="checkbox checkbox-primary">
                                        <input type='checkbox' id="select-all-participant" />
                                        <span class='checkmark'></span>
                                    </label>
                                </th>
                                <th class="text-center">{{__('message.first_name')}}</th>
                                <th class="text-center">{{__('message.last_name')}}</th>
                                <th class="text-center">{{__('message.email')}}</th>
                                <th class="text-center">{{__('message.on_behalf_email')}})</th>
                                <th class="text-center">{{__('message.mobile')}}</th>
                                <th class="text-center">{{__('message.created_date')}}</th>
                                <th class="text-center">{{__('message.updated_date')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">
                    {{__('message.step_3_select_and_configure_sending_method')}}
                    <p class="balence_margin float-right text-16" id="get_balence_info"></p>
                    <p class="selected_parti_count float-right text-16 pr-3 mr-3"></p>
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"> </label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="on-behalf" name="on-behalf">

                                <?php
                                $selected1 = '';
                                $selected2 = '';

                                if (!empty($form_data)) {
                                    if ($form_data['survey_sendto_method'] == '1') {
                                        $selected1 = 'selected';
                                    }

                                    if ($form_data['survey_sendto_method'] == '2') {
                                        $selected2 = 'selected';
                                    }
                                }
                                ?>


                                <option value="0">{{__('message.select_send_to')}}
                                </option>
                                @if($on_behalf->setting_value == 1)
                                <option <?php echo $selected1; ?> value="1">{{__('message.on_behalf')}}</option>
                                @endif

                                <option <?php echo $selected2; ?> value="2" selected="selected">
                                    {{__('message.participant')}}</option>

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
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="hidden" name="email_type" id="email_type">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="sending-method" name="sending-method">
                                <?php
                                $selected1 = '';
                                $selected2 = '';

                                if (!empty($form_data)) {
                                    if ($form_data['survey_email_sms_sending_method'] == '1') {
                                        $selected1 = 'selected';
                                    }

                                    if ($form_data['survey_email_sms_sending_method'] == '2') {
                                        $selected2 = 'selected';
                                    }
                                }
                                ?>
                                <option value="0">{{__('message.please_select_sending_method')}}</option>
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
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2" id="template_dropdown">
                        <div class="input-right-icon">
                            <?php if (!empty($form_data)) { ?>
                            <select class="select2_group form-control" id="template_type" name="template_dropdown">
                                <?php
                                    $selected = '';

                                    if ($form_data['survey_template_title']) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                <option <?php echo $selected; ?>
                                    value="<?php echo $form_data['survey_template_type']; ?>">
                                    <?php echo $form_data['survey_template_title']; ?></option>
                            </select>

                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.step_4_set_schedule_type')}} </h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.schedule_title')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input class="select2_group form-control" type="text" name="schedule_title" id="schedule_title"
                            placeholder="{{__('message.schedule_title')}}"
                            value="<?php echo!empty($form_data['schedule_title']) ? $form_data['schedule_title'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_schedule_type')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="hidden" name="email_type" id="email_type">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="schedule_type" name="schedule_type">
                                <?php
                                $selected1 = '';
                                $selected2 = '';
                                $selected3 = '';
                                $selected4 = '';
                                $selected5 = '';
                                $selected6 = '';


                                if (!empty($form_data)) {
                                    if ($form_data['schedule_type'] == 'one_time') {
                                        $selected1 = 'selected';
                                    }

                                    if ($form_data['schedule_type'] == 'monthly') {
                                        $selected2 = 'selected';
                                    }

                                    if ($form_data['schedule_type'] == 'quarterly') {
                                        $selected3 = 'selected';
                                    }

                                    if ($form_data['schedule_type'] == 'halfyearly') {
                                        $selected4 = 'selected';
                                    }

                                    if ($form_data['schedule_type'] == 'annually') {
                                        $selected5 = 'selected';
                                    }

                                    if ($form_data['schedule_type'] == 'hourly') {
                                        $selected6 = 'selected';
                                    }
                                }
                                ?>

                                <option value="0">{{__('message.select_schedule_type')}}</option>
                                <option <?php echo $selected1; ?> value="one_time">{{__('message.one_time')}}</option>
                                <option <?php echo $selected6; ?> value="hourly">{{__('message.hourly')}}</option>
                                <option <?php echo $selected2; ?> value="monthly">{{__('message.monthly')}}</option>
                                <option <?php echo $selected3; ?> value="quarterly">{{__('message.quarterly')}}</option>
                                <option <?php echo $selected4; ?> value="halfyearly">{{__('message.half_yearly')}}
                                </option>
                                <option <?php echo $selected5; ?> value="annually">{{__('message.annually')}}</option>
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.choose_date')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <input class="select2_group form-control" type="text" name="schedule_date"
                                id="schedule_date" placeholder="Date"
                                value="<?php echo!empty($form_data['schedule_date']) ? $form_data['schedule_date'] : ''; ?>">
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Calendar-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.enter_number_of_time_to_trigger')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="text" class="form-control" id="number_of_times" name="number_of_times"
                            value="<?php echo!empty($form_data['number_of_times']) ? $form_data['number_of_times'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.choose_end_date')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <input type="text" class="form-control" id="end_date" name="end_date"
                                value="<?php echo!empty($form_data['end_date']) ? $form_data['end_date'] : ''; ?>"
                                placeholder="{{__('message.end_date')}}">
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Calendar-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.choose_time')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-2 col-md-2 col-sm-2 mb-2">
                        <div class="input-right-icon">
                            <?php
                            // created by kandarp pandya - 29-01-2019
                            $period = date('A');
                            $hour = date('h');
                            $minut = date('i');
                                if (isset($form_data['schedule_time'])) {
                                    $time = $form_data['schedule_time'];
                                    $getPeriod = explode(' ', $time);
                                    $period = $getPeriod[1];
                                    $getHM = explode(':', $getPeriod[0]);
                                    $hour = $getHM[0];
                                    $minut = $getHM[1];
                                    // dd($hour, $minut);
                                    // dd( $period == 'PM' ? 'selected = "selected"' : '');
                                }
                            ?>
                            <select name="hour" id="hour" class="select2_group form-control">
                                <?php for ($k=1; $k <= 12; $k++) {
                                    $k = $k < 10 ? '0'.$k : $k;
                                    ?>
                                <option value="{{$k}}" <?php echo $hour == $k ? 'selected = "selected"' : '' ?>> {{$k}}
                                </option>
                                <?php } ?>
                                <select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Clock"></i>
                                    </span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 mb-2">
                        <div class="input-right-icon">
                            <select name="minuts" id="minuts" class="select2_group form-control">
                                <?php for ($j=0; $j < 60; $j++) {
                                    $j = $j < 10 ? '0'.$j : $j;
                                ?>
                                <option value="{{$j}}" <?php echo $minut == $j ? 'selected = "selected"' : '' ?>> {{$j}}
                                </option>
                                <?php } ?>
                                <select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Clock"></i>
                                    </span>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 mb-2">
                        <input type="hidden" name="email_type" id="email_type">
                        <div class="input-right-icon">
                            <select name="periods" id="periods" class="select2_group form-control">
                                <option value="AM" <?php echo $period == 'AM' ? 'selected = "selected"' : '' ?>> AM
                                </option>
                                <option value="PM" <?php echo $period == 'PM' ? 'selected = "selected"' : '' ?>> PM
                                </option>
                                <select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Clock"></i>
                                    </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="button" id="btn-add-schedule"
                                    class="btn btn-success">{{__('message.save')}}</button>
                            </div>
                        </div>
                    </div>
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
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{{__('message.close')}}</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    {{__('message.participants_details')}}
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@stop
@include('admin.participant.more_detail')
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script type="text/javascript">
    var dataTable;
var extraData;
var survey = [];
var sendAll = 0;

var template = Handlebars.compile($("#details-template").html());
Handlebars.registerHelper('ifCond', function (v1, v2, options) {
    if (v1 === v2) {
        return options.fn(this);
    }
    return options.inverse(this);
});

var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'checkbox', name: 'checkbox'},
    {data: 'first_name', name: 'first_name'},
    {data: 'last_name', name: 'last_name'},
    {data: 'email', name: 'email'},
    {data: 'on_behalf_email', name: 'on_behalf_email'},
    {data: 'mobile', name: 'mobile'},
    {data: 'created_at', name: 'created_at'},
    {data: 'updated_at', name: 'updated_at'},
];

var ajaxUrl = '{{ url()->current() }}'; //Url of ajax datatable where you fetch data

//It may be empty array
var columnDefs = [
    {
        "targets": 0,
        "orderable": true,
        "class": "text-center",
    },
    {
        "targets": 1,
        "orderable": false,
        "class": "text-center",
        "render": function (data, type, row) {
//            debugger;
            if (data.includes('checked')) {
                if (survey.indexOf(row.id) == -1) {
                    survey.push(row.id);
                }
            }
            return data;
        }
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
    }

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
        function check_sms_balence(template_id) {
            $.ajax({
                url: '{{route("check_balence")}}',
                type: 'POST',
                data: {template_id: template_id, _token: $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function (resp) {
                    if (resp) {
                        $('#get_balence_info').html("<span>{{__('message.available_balance_charged_balance')}}: " + resp + "</span>")
                    } else {
                        $('#get_balence_info').html("");
                    }
                },
                error: function (resp) {

                }
            });
        }

        var sending_val = $("#sending-method").val();
        if (sending_val == 1) {
            var template_id = 1;
            $("#email_type").val(1);
            var url = '{{route("get_sms_template")}}';
            check_sms_balence(template_id);

        } else if (sending_val == 2) {
            $('#get_balence_info').html("");
            var template_id = 2;
            $("#email_type").val(2);
            var url = '{{route("get_email_template")}}';
        }

//            $.ajax({
//                url: url,
//                type: 'GET',
//                data: {template_id: template_id, _token: $('meta[name="csrf-token"]').attr('content')},
//                dataType: 'json',
//                success: function (resp) {
//                    if (resp) {
//                        $('#template_dropdown').html(resp)
//                    }
//                },
//                error: function (resp) {
//
//                }
//            });



        $(document).on('change', '#sending-method', function () {
            if ($(this).val() == 1) {
                var template_id = 1;
                $("#email_type").val(1);
                var url = '{{route("get_sms_template")}}';
                check_sms_balence(template_id);
            } else if ($(this).val() == 2) {
                $('#get_balence_info').html("");
                var template_id = 2;
                $("#email_type").val(2);
                var url = '{{route("get_email_template")}}';
            }



            $.ajax({
                url: url,
                type: 'GET',
                data: {template_id: template_id, _token: $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function (resp) {
                    if (resp) {
                        $('#template_dropdown').html(resp)
                    }
                },
                error: function (resp) {

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
                data: {participant_id: row.id},
                success: function (resp) {
                    //debugger;
                    $('#myModalHorizontal .modal-body').html(template(resp.data));
                    $('#myModalHorizontal ').modal('show');
                },
                error: function (resp) {

                }
            });
        });

        $(document).on('change', '.select-participant', function (e) {
            //debugger;
            $("#btn-add-schedule").attr('disabled', true);
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();

            var countCheckedCheckboxes = $('.select-participant:checked').length;
            if (countCheckedCheckboxes > 0) {
                $('.selected_parti_count').html("<span>{{__('message.selected_participants')}}: " + countCheckedCheckboxes + "</span>");
            } else {
                $('.selected_parti_count').html("");
            }

            if ($(this).is(":checked")) {
                console.log(row.id, 'push');
                survey.push(row.id);
            } else {
                console.log(row.id, 'pop');
                var index = survey.indexOf(row.id);
                if(index!==-1){
                    survey.splice(index,1);
                }
                //survey.pop(row.id);
            }


            $("#btn-add-schedule").attr('disabled', false);
        });

        $(document).on('change', '#select-all-participant', function (e) {
            $("#btn-add-schedule").attr('disabled', true);
            if ($(this).is(":checked")) {
                sendAll = 1;
                var data = dataTable.rows().data();
                data.each(function (value, index) {
                    survey.push(value.id);
                });
                $('.select-participant').prop('checked', true);
            } else {
                sendAll = 0;
                survey = [];
                $('.select-participant').prop('checked', false);
            }

            var countCheckedCheckboxes = $('.select-participant:checked').length;

            if (countCheckedCheckboxes > 0) {
                $('.selected_parti_count').html("<span>{{__('message.selected_participants')}}: " + countCheckedCheckboxes + "</span>");
            } else {
                $('.selected_parti_count').html("");
            }

            $("#btn-add-schedule").attr('disabled', false);
        });

        
    });

    $('#category_id_survay').change(function () {
        //debugger;
        var me = this;
        var url = '{{route("get_sub_category_by_category_id")}}';
        var categoryId = $(this).find(':selected').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: {category_id: categoryId},
            dataType: 'json',
            success: function (resp) {
                if (resp.data.length == 0) {
                    return false;
                }
                //debugger;
                $('#sub_category_id').html('<option value="0">{{__('message.select_sub_category')}}</option>');
                selectedSubCategory = '<?php echo!empty(Input::old('sub_category_id')) ? Input::old('sub_category_id') : ((!empty($repairman_data->sub_category_id) ? $repairman_data->sub_category_id : 0)) ?>';
                $.each(resp.data, function (index, value) {
                    //debugger;
                    var obj = {
                        value: value.id,
                        text: value.category_name,
                    };

                    if (selectedSubCategory == value.id) {
                        obj.selected = 'selected';
                    }

                    $('#sub_category_id').append($('<option/>', obj));
                });
            },
            error: function (resp) {

            }
        });
    });

    $('#btn-search').click(function () {
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

    $('#btn-add-schedule').click(function () {
//        debugger;
        //return false;
        var me = this;
        var email_type = $('#email_type').val();
        var select_template = $('#template_type').find('option:selected').val();
        var onBehalf = $('#on-behalf').find('option:selected').val();
        var surveyId = $('#survey-form-id').find('option:selected').val();
        var sendingMethod = $('#sending-method').find('option:selected').val();
        var totalRecords = dataTable.page.info().recordsTotal;
        var number_of_times = $('#number_of_times').val();
        var end_date = $('#end_date').val();

        //filter option
        var category_id = $('#category_id').find('option:selected').val();
        var sub_category_id = $('#sub_category_id').find('option:selected').val();
        var type_id = $('#type_id').find('option:selected').val();
        var location_id = $('#location_id').find('option:selected').val();
        var gender = $('#gender').find('option:selected').val();
        var group_id = $('#group_id').find('option:selected').val();
        var schedule_id = $('#schedule_id').val();


        extraData = {};
        extraData.category_id = category_id;
        extraData.sub_category_id = sub_category_id;
        extraData.type_id = type_id;
        extraData.location_id = location_id;
        extraData.gender = gender;
        extraData.group_id = group_id;
        extraData.schedule_id = schedule_id;
        extraData.search_filter_value = $('#search_filter_value').val();
        //end filter data


        //set schedule types data
        var scheduleTitle = $('#schedule_title').val();
        var scheduleType = $('#schedule_type').find('option:selected').val();
        var scheduleDate = $('#schedule_date').val();
        var scheduleTime = $('#hour').val() + ':' + $('#minuts').val() + ' ' + $('#periods')
        
        .val();

        extraData.scheduleTitle = scheduleTitle;
        extraData.scheduleType = scheduleType;
        extraData.scheduleDate = scheduleDate;
        extraData.scheduleTime = scheduleTime;
        extraData.number_of_times = number_of_times;
        extraData.end_date = end_date;
        
        
        if (scheduleTitle == "" || scheduleTitle == undefined) {
            alert("{{__('message.please_enter_schedule_title')}}.");
            return false;
        }

        if (scheduleType == "0" || scheduleType == undefined) {
            alert("{{__('message.please_select_schedule_type')}}.");
            return false;
        }

        if (scheduleDate == "" || scheduleDate == undefined) {
            alert("{{__('message.please_select_schedule_date')}}.");
            return false;
        }

        if (scheduleTime == "" || scheduleTime == undefined) {
            alert("{{__('message.please_select_schedule_time')}}.");
            return false;
        }

        // if (end_date == "" || end_date == undefined || number_of_times == "" || number_of_times == undefined) {
        //     alert("Please enter number of times Or enter end date.");
        //     return false;
        // }

        //end of set schedule type

        if (select_template == "0" || select_template == undefined) {
            alert("{{__('message.please_select_template')}}.");
            return false;
        }

        if (totalRecords <= 0) {
            alert('{{__('message.no_data_available_for_sending_survey')}}.');
            return false;
        }

        if (survey.length == 0 && sendAll == 0) {
            alert("{{__('message.please_select_participant')}}.");
            return false;
        }

        /*if (surveyId == "0" || surveyId == undefined) {
            alert("Please select survey form.");
            return false;
        }
*/
        if (onBehalf == "0" || onBehalf == undefined) {
            alert("{{__('message.please_select_send_to_option')}}.");
            return false;
        }

        if (sendingMethod == "0" || sendingMethod == undefined) {
            alert("{{__('message.please_select_sending_method')}}.");
            return false;
        }


        if (typeof extraData == 'undefined') {
            extraData = {};
        }


        extraData.email_type = email_type;
        extraData.template = select_template;
        extraData.on_behalf = onBehalf;
        extraData.survey = survey;
        extraData.survey_id = surveyId;
        extraData.send_all = sendAll;
        extraData.auth_id = <?php echo Auth::user()->id; ?>;
        extraData.number_of_times = number_of_times;
        extraData.end_date = end_date;
        if (end_date != ''  || end_date != undefined) {
            if (end_date <= scheduleDate) {
                alert('End date must be greate than or equal to Schedule date')
                return false;
            }
        }

        if (totalRecords > 0 && select_template != "0" && surveyId != "0" && onBehalf != "0" && sendingMethod != "0") {
            $("#btn-add-schedule").text('Processing..');
            $("#btn-add-schedule").attr('disabled', true);
            $.ajax({
                url: '{{route("schedule.add_schedule_data")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    params: extraData,
                    _token: "{{csrf_token()}}",
                },
                success: function (resp) {
                    window.location.href = '{{route("schedule.list_schedule_data")}}';
                },
                error: function (resp) {
                }
            });
        } else {
            alert("{{__('message.something_wrong')}}");
            $("#btn-add-schedule").text('Save');
            $("#btn-add-schedule").removeAttr('disabled');
            return false;
        }

    });

    function resetBtnText(me) {
        $(me).prop('value', 'Send');
        $(me).prop('disabled', false);

    }


    

</script>

<script>
    $(document).ready(function () {
    $('#schedule_time').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        startTime: '10:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true
    });

    $(function () {
        $('input[name="schedule_date"]').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    $('#schedule_date').datepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        changeMonth: true,
        changeYear: true,
        singleDatePicker: true,
        singleClasses: "picker_4"
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });

    $('#end_date').datepicker({
        locale: {
            format: 'MM-DD-YYYY'
        },
        changeMonth: true,
        changeYear: true,
        singleDatePicker: true,
        singleClasses: "picker_4"
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
});
</script>
@include('datatable.alert_js')
@include('datatable.dt_js')
@stop