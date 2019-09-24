<style type="text/css">
    .myoption {
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }

    .highcharts-credits {
        display: none;
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
        <form name="survey_report_form" method="post" action="{{route('report.store')}}"
            class="form-horizontal form-label-left">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.submitted_survey_form_report')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_survey_form')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="survey_form" name="survey_form"
                                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="">{{__('message.select_survey_form')}}</option>
                                    @foreach ($survey_form as $form)
                                    <option value="<?php echo 'report/'.$form->id; ?> ">{{$form->survey_form_title}}
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
            </div>
        </form>
        <!-- end::form 2-->
    </div>
</div>

<style>
    #choose_question {
        color: black
    }
</style>


@stop
{{-- page level scripts --}}
@section('footer_scripts')

@stop