@extends('layout.admin',['image'=>$image])
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"
    type="text/css">

@stop
{{-- Page content --}}
@section('inner_body')

<?php


$title = __('message.create_user_details');
$action = route('user.store'); 
$method = "Post";
$image = "";
$button = "Create User";
$id = '';

if (!empty($repairman_data->id)) { 
    $id = $repairman_data->id;
    $title = __('message.edit_user_details');
    $action = route('user.update', $repairman_data->id);
    $method = 'PATCH';
    $button = "Update User";

    $image = $repairman_data->user_image;
    $image = !empty($image) ? $image : "";
    if (!file_exists($image)) {
        $image = "uploads/nophoto.png";
    }
    $image = url('/') . '/' . $image;
}

?>

<div class="breadcrumb">
    <h1>User</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
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
        @if(empty($repairman_data->id))
        {!! Form::open(['route' => 'user.store','id'=>'demo-form2','class' => 'form-horizontal
        form-label-left','enctype' => 'multipart/form-data']) !!}
        @else
        {!! Form::model($repairman_data,['route' => ['user.update',$repairman_data->id],'id'=>'demo-form2','class' =>
        'form-horizontal form-label-left','enctype' => 'multipart/form-data','method' => 'PUT']) !!}
        @endif
        {{ csrf_field() }}
        <!-- start PROFILE Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title"><?php echo $title; ?></h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.full_name')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="text" id="" name="name" class="form-control"
                            value="{{!empty($repairman_data->name)?$repairman_data->name:Input::old('name')}}"
                            placeholder="{{__('message.full_name')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="business_name"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.business_name')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="text" id="business_name" name="business_name" class="form-control"
                            value="{{!empty($repairman_data->business_name)?$repairman_data->business_name:Input::old('business_name')}}"
                            placeholder="{{__('message.business_name')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="retail_email"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.email')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="text" id="email" name="email" class="form-control"
                            value="{{!empty($repairman_data->email)?$repairman_data->email:Input::old('email')}}"
                            placeholder="{{__('message.email')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.password')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="password" id="password" name="password" class="form-control" value=""
                            placeholder="{{__('message.password')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile_number"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.mobile_number')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                            value="{{!empty($repairman_data->mobile_number)?$repairman_data->mobile_number:Input::old('mobile_number')}}"
                            placeholder="{{__('message.mobile_number')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.city')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="city" name="city">
                                <option value="0">{{__('message.select_city')}}</option>
                                @foreach ($city as $row)
                                <?php
                                        $selected = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->city == $row->id)
                                                $selected = 'selected';
                                        }
                                        ?>
                                <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->cityName}}</option>
                                @endforeach
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.country')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="country" name="country">
                                <option value="0">{{__('message.select_country')}}</option>
                                @foreach ($country as $row)
                                <?php
                                        $selected = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->country == $row->id)
                                                $selected = 'selected';
                                        }
                                        ?>
                                <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_role"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.user_role')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="user_role" name="user_role">
                                <option value="0">{{__('message.select_role')}}</option>
                                @foreach ($user_role as $row)
                                <?php
                                        $selected = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->user_role == $row->id)
                                                $selected = 'selected';
                                        }
                                        
                                        ?>
                                <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->role}}</option>
                                @endforeach
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="profile_image"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.profile_image')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <img height="150" src="{{ $image ? $image : '/assets/images/user-placeholder.jpg'}}"
                            id="profile_image" name="profile_image" alt="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_image"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_profile_image')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="file" name="user_image" id="user_image" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-6 text-left">
                            <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end PROFILE Form Layout-->
        {!! Form::close() !!}
        <!-- end::form 2-->
    </div>
</div>

@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    $("#user_image").change(function () {
        readURL(this);
    });

//    $('#function_category').multiselect();

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@stop