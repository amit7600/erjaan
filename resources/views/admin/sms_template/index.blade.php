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

$title = __('message.create_sms_campaign');
$action = route('sms-template.store');
$method = "";
if (!empty($template_data->id)) {
    $edit = true;
    $title = __('message.edit_sms_campaign');
    $action = route('sms-template.update', $template_data->id);
    $method = '<input type="hidden" name="_method" value="PUT" />';
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

            <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.title')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="title" maxlength="30" name="title" class="form-control "
                                value="{{!empty($template_data->title)?$template_data->title:Input::old('title')}}"
                                placeholder="{{__('message.please_enter_title')}}">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum_value"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.parameters')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <textarea name="variables" class="form-control" disabled="true">{{__('message.participant_name')}} = ({{__('message.participant')}}_{{__('message.name')}})
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum_value"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.complain_pop_up')}}</label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <ul>
                                <li>{{__('message.complain_pop_up')}} = (complainPopUp)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum_value"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_list')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <ul>
                                @foreach($parameter_list as $key => $value)
                                <li>{{ $value->survey_form_title }} = (survey_{{$value->id}})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maximum_value"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.content')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            {!! Form::textarea('content',
                            !empty($template_data->content)?$template_data->content:old('content'), array('','class' =>
                            ' form-control','id' => 'content')) !!}
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-footer">
                        <div class="mc-footer">
                            <div class="row text-right">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-6 text-left">
                                    <button type="submit" class="btn btn-success">{{__('message.submit')}}</button>
                                </div>
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
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.editorConfig = function (config) {
            config.language = 'es';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;

        };
        CKEDITOR.replace('content'); 
        CKEDITOR.config.allowedContent = true;  
    });
</script>
@stop