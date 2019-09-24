@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
@include('datatable.dt_css')
@stop
{{-- Page content --}}
@section('inner_body')

<?php 
$id = '';
?>



<div class="row">
    <div class="col-lg-12 mb-3">
        {!! Form::open(['route' => 'city.store', 'files' => true]) !!}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!--begin::form 2-->
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.create_city')}}</small></h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.city_name')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::text('cityName',null,['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-6 text-left">
                            <button type="submit" class="btn btn-success">{{__('message.save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        {!! Form::close() !!}
    </div>
</div>


@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop