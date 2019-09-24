@extends('layout.admin',['image'=>$image])
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
{{-- <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/> --}}
@stop
{{-- Page content --}}
@section('inner_body')

<?php
$image = $user_data->user_image;
$image = !empty($image) ? $image : "";
if (!file_exists($image)) {
    $image = "uploads/user_image.jpg";
}
$image = url('/') . '/' . $image;

$image_logo = $user_data->user_logo;

$image_logo = !empty($image_logo) ? $image_logo : "";
if (!file_exists($image_logo)) {
    $image_logo = "uploads/logo.png";
}
$image_logo = url('/') . '/' . $image_logo;
?>



<div class="breadcrumb">
    <h1>Profile</h1>
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
        <form method="post" action="{{route('update_admin_profile')}}" id="demo-form2"
            class="form-horizontal form-label-left" enctype="multipart/form-data">
            <!-- start PROFILE Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.edit_profile')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.full_name')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{!empty(Input::old('name'))?Input::old('name'):$user_data->name}}"
                                placeholder="{{__('message.full_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="business_name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.business_name')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="business_name" name="business_name" class="form-control"
                                value="{{!empty(Input::old('business_name'))?Input::old('business_name'):$user_data->business_name}}"
                                placeholder="{{__('message.business_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile_number"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.mobile_number')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="business_name" name="mobile_number" class="form-control"
                                value="{{!empty($user_data->mobile_number)?$user_data->mobile_number:Input::old('mobile_number')}}"
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
                                    <option value="0">{{__('message.select_location')}}</option>
                                    @foreach ($city as $row)
                                    <?php
                                    $selected = '';
                                    if (!empty($user_data)) {
                                        if ($user_data->city == $row->id)
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
                                    if (!empty($user_data)) {
                                        if ($user_data->country == $row->id)
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
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.profile_image')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <img width="" height="150" src="{{$image}}" id="profile_image" name="profile_image"
                                alt="" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_role"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_profile_image')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="file" name="user_image" id="user_image" class=" form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_role"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.logo_image')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <img width="" height="150" src="{{$image_logo}}" id="logo_image" name="logo_image" alt="" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_role"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_logo_image')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="file" name="user_logo_image" id="user_logo_image" class=" form-control" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success">{{__('message.update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end PROFILE Form Layout-->
        </form>
        <!-- end::form 2-->
    </div>
</div>


@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#user_image").change(function () {
            readURL(this);
        });
        $("#user_logo_image").change(function () {
            readURLogo(this);
        });
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

    function readURLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop