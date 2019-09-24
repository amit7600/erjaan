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
<input type="hidden" id="schedule_id" value="<?php echo !empty($schedule_id)?$schedule_id:''; ?>">
<div class="breadcrumb">
    <h1>{{__('message.participants')}}</h1>
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
        {!! Form::open(['url' => 'admin/participant/import', 'files' => true, 'class' => 'form-horizontal
        form-label-left']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.participants_import_excel')}}</small></h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.import_excel')}}</label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::file('excel_file',['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-6 text-left">
                            <button type="submit" class="btn btn-success">{{__('message.import')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        {!! Form::close() !!}
    </div>
</div>
<!-- Modal -->

@stop