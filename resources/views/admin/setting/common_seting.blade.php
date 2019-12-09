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

<style type="text/css">
    .goog-te-banner-frame {
        display: none !important;
    }

    .skiptranslate {
        float: right;
        margin-right: 2px;
    }

    .translated-ltr body {
        padding: 0;
        position: relative !important;
        top: 0 !important;
    }

    .nav-md {
        top: 0 !important;
    }

    #google_translate_element {
        float: left;
        position: relative;
        right: 0;
        top: 0px;
        left: 0px !important;
    }

    .goog-te-gadget-icon {
        margin-left: -16px !important;
        background: none !important;
    }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            includedLanguages: 'ar,en',
            autoDisplay: true
        }, 'google_translate_element');
    }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript">
</script>

<div class="breadcrumb">
    <h1>{{__('message.common_setting')}}</h1>
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
        <form name="auto_trigger_stting" action="{{route('save_common_setting')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.for_sms_creadential_setting')}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($setting_data as $value)
                    <?php if ($value->for_setting_type == 1) { ?>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"><?php  $string = str_replace("_", " ", $value->setting_key);  echo ucfirst($string) ?>
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" name="<?php echo $value->setting_key; ?>" class="form-control"
                                value="<?php echo $value->setting_value; ?>">
                        </div>
                    </div>
                    <?php } ?>
                    @if($value->for_setting_type == 3)
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.do_you_want_to_show_on_behalf_of_participant')}}</label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                            <label class="radio radio-primary mr-2 mt-2">
                                {!! Form::radio('on_behalf_of',1, $value->setting_value == 1 ? true : false ) !!}
                                <span>{{__('message.yes')}} </span>
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio radio-primary mr-2 mt-2">
                                {!! Form::radio('on_behalf_of',0, $value->setting_value == 0 ? true : false ) !!}
                                <span>{{__('message.no')}} </span>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    @endif
                    @if($value->for_setting_type == 4)
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"><?php  $string = str_replace("_", " ", $value->setting_key);  echo ucfirst($string) ?>
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                            <label class="radio radio-primary mr-2 mt-2">
                                {!! Form::radio('default_language','en', $value->setting_value == 'en' ? true : false ) !!}
                                <span>{{__('message.english')}} </span>
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio radio-primary mr-2 mt-2">
                                {!! Form::radio('default_language','ar', $value->setting_value == 'ar' ? true : false ) !!}
                                <span>{{__('message.arabic')}} </span>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">Choose logo
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                            <input type="file" id="" name="choose_logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">Choose background 
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                            <input type="file" id="" name="choose_background" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">Common Setting</h3>
                </div>

            </div>
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.for_send_email_contact_us_setting')}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($setting_data as $value)
                    <?php if ($value->for_setting_type == 2) { ?>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"><?php $string = str_replace("_", " ", $value->setting_key); echo ucfirst($string); ?>
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" name="<?php echo $value->setting_key; ?>" class="form-control"
                                value="<?php echo $value->setting_value; ?>">
                        </div>
                    </div>
                    <?php } ?>
                    @endforeach
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.choose_survey_form_to_show_on_dashboard')}}
                    </h3>
                </div>
                <div class="card-body">
                    @foreach ($survey_form as $value)
                    <div class="col-md-6 col-sm-6 col-xs-12 float-left">
                        <div class="form-group row">
                            <?php 
                                $selected = '';
                                //dd($value->id);
                                if($setting_data[4]->setting_value == $value->id){
                                    $selected = 'checked';
                                    $id = $value->id;
                                    $survey_question_chart = explode(',', $setting_data[4]->survey_question_chart);
                                }
                                ?>
                            <div class="col-md-12">
                                <label class="radio radio-primary">
                                    <input <?php echo $selected; ?> type="radio" name="survey_form_id"
                                        class="form-control" onClick="changeSurveyForm(<?php echo $value->id; ?>)"
                                        value="<?php echo $value->id; ?>" />
                                    <span><?php echo $value->survey_form_title; ?></span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.choose_chart_type_show_on_dashboard')}}</h3>
                </div>
                <div class="card-body" id="showQuestion">
                    @if(count($survey_details) > 0 && $survey_question_chart[0])
                    @foreach($survey_details as $key => $value)
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{$value->survey_question}}</label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select name="selectChart[]" class="form-control" placeholder="Select Chart">
                                    <option
                                        <?php if($value->id.'_1' == $survey_question_chart[$key]) echo 'selected="selected"'; else echo'';?>
                                        value="{{$value->id}}_1">{{__('message.bar_chart')}}</option>

                                    <option
                                        <?php if($value->id.'_2' == $survey_question_chart[$key]) echo 'selected="selected"'; else echo'';?>
                                        value="{{$value->id}}_2">{{__('message.pie_chart')}}</option>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="save_common_setting"
                                    class="btn btn-success">{{__('message.save')}}</button>
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


@include('admin.participant.more_detail')

<script type="text/javascript">
    $(document).ready(function () {
    var id = <?php echo isset($id) ? $id : ''; ?>;
    // changeSurveyForm (id)
});
    function changeSurveyForm (value) {
        $("#showQuestion").empty();
        var url = '{{route("get_form_question")}}';
        $.ajax({
                url: url,
                type: 'GET',
                data: {form_id: value},
                dataType: 'json',
                success: function (resp) {
                    console.log(resp)
                    if (resp.length == 0) {
                        return false;
                    }
                    //debugger;
                    // $('#showQuestion').html('<h1>Kandarp Pandya</h1>')
                    $('#showQuestion').html('<div class="col-md-12">');
                    $.each(resp, function (index, value) {
                        //debugger;
                         $('#showQuestion').append('<div class="form-group"><div class="row"><div class="col-md-3"><label>' + value.survey_question + '</label></div><div class="col-md-3"><select name="selectChart[]" class="form-control" placeholder="{{__('message.select')}} {{__('message.chart')}}"><option value="' + value.id + '_1">{{__('message.bar_chart')}}</option><option value="' + value.id + '_2">{{__('message.pie_chart')}}</option></select></div></div></div>');
                        /*if (selectedSubCategory == value.id) {
                            obj.selected = 'selected';
                        }*/

                        $('#showQuestion').append($('</div>'));
                    });
                },
                error: function (resp) {

                }
        });
        
    }
</script>
@include('datatable.alert_js')
@stop