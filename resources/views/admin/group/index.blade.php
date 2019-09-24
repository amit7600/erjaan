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

$title = __('message.group');
$action = route('group.store');
$method = "";
$image = "";
$button = __('message.save');
$edit = false;
$update_action = "";
if (!empty($repairman_data->id)) {
    $edit = true;
    $title = __('message.edit').' '.__('message.group');
    $action = route('group.update', $repairman_data->id);
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
                    <h3 class="card-title">{{$title}}</small></h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.group_name')}}</label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="group_name" maxlength="70" name="group_name" class="form-control"
                                value="{{!empty($repairman_data->group_name)?$repairman_data->group_name:Input::old('group_name')}}"
                                placeholder="Group Name">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="ln_solid"></div>
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
    </div>
</div>




@stop
{{-- page level scripts --}}
@section('footer_scripts')

@stop