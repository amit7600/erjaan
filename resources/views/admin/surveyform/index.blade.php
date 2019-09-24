@extends('layout.admin',['image'=>$image])
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


@php
$title = __('message.create_survey_form') ;
$action = route('surveyform.store');
$method = "";
$image = "";
$button = __('message.save');

if (!empty($repairman_data->id)) {
$title = __('message.edit_survey_form');
$action = route('surveyform.update', $repairman_data->id);
$method = '<input type="hidden" name="_method" value="PUT" />';
}
@endphp
<div class="breadcrumb">
    <h1>{{$title}}</h1>
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
        <form method="post" action="{{$action}}" id="demo-form2" class="form-horizontal form-label-left"
            enctype="multipart/form-data">
            {!! $method !!}
            <div id="q_1">
                <!-- start SURVEY Form Layout-->
                <div class="card mb-4">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title">{{__('message.form_title')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_form_language')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" name="form_language_type"
                                        id="form_language_type">
                                        <option value="1">English (LTR)</option>
                                        <option value="2">Arabic (RTL)</option>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_form_title')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                                <input type="text" id="survey_form_title" value="{{old('survey_form_title')}}"
                                    name="survey_form_title" class="form-control"
                                    placeholder="{{__('message.survey_form_title')}}">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="input-right-icon">
                                    <select name="survey_title_font_size" id="survey_title_font_size"
                                        class="form-control">
                                        <option value="">{{__('message.font_size')}}</option>
                                        <?php
                                        // for loop start
                                            for ($i=0; $i <= 50; $i++) { 
                                        ?>
                                        <option value="{{$i}}px">{{$i}} px</option>
                                        <?php 
                                            }
                                            // end for loop
                                            ?>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_title_color" id="title_color"
                                    autocomplete="off" placeholder="{{__('message.title_color')}}">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_title_background_color"
                                    id="survey_title_background_color" autocomplete="off"
                                    placeholder="{{__('message.survey_form_header_background_color')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_form_header')}}
                                <span class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="text" id="survey_form_header" value="{{old('survey_form_header')}}"
                                    name="survey_form_header" class="form-control"
                                    placeholder="{{__('message.survey_form_header')}}">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="input-right-icon">
                                    <select name="survey_header_font_size" id="survey_header_font_size"
                                        class="form-control">
                                        <option value="">{{__('message.font_size')}}</option>
                                        <?php
                                        // for loop start
                                            for ($i=0; $i <= 50; $i++) { 
                                        ?>
                                        <option value=" {{$i}}px">{{$i}} px</option>
                                        <?php 
                                            }
                                            // end for loop
                                            ?>

                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_header_color" id="header_color"
                                    autocomplete="off" placeholder="{{__('message.header_color')}}">
                            </div>


                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_form_footer')}}
                                <span class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="text" id="survey_form_footer" value="{{old('survey_form_footer')}}"
                                    name="survey_form_footer" class="form-control"
                                    placeholder="{{__('message.survey_form_footer')}}">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="input-right-icon">
                                    <select name="survey_footer_font_size" id="survey_footer_font_size"
                                        class="form-control">
                                        <option value="">{{__('message.font_size')}}</option>
                                        <?php
                                        // for loop start
                                            for ($i=0; $i <= 50; $i++) { 
                                        ?>
                                        <option value="{{$i}}px">{{$i}} px</option>
                                        <?php 
                                            }
                                            // end for loop
                                            ?>

                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_footer_color" id="footer_color"
                                    autocomplete="off" placeholder="{{__('message.footer_color')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.background_color_image')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="file" id="survey_form_background" name="survey_form_background"
                                    class="form-control">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <?php  $src = $base_path."assets/images/user-placeholder.jpg"; ?>
                                <img src="<?php echo $src; ?>" id="survey_bg" height="40">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_background_color"
                                    id="survey_bg_color" autocomplete="off"
                                    placeholder="{{__('message.background_color_image')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_form_logo')}}
                                <span class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="file" id="survey_form_logo" name="survey_form_logo" class="form-control">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <img src="{{asset('assets/images/user-placeholder.jpg')}}" id="survey_logo" height="40">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end survey Form Layout-->

                <!-- start survey question option form -->
                <div class="card mb-4">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title">{{__('message.option_type')}}
                            <!--  -->
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_question')}}<span
                                    class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="text" id="survey_question" maxlength="200" name="survey_question[]"
                                    value="{{old('survey_question.0')}}" class="form-control"
                                    placeholder="{{__('message.survey_question')}} ">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="input-right-icon">
                                    <select name="survey_question_font_size[]" id="survey_question_font_size[]"
                                        class="form-control">
                                        <option value="">{{__('message.font_size')}}</option>
                                        <?php
                                        // for loop start
                                            for ($i=0; $i <= 50; $i++) { 
                                        ?>
                                        <option value="{{$i}}px">{{$i}} px</option>
                                        <?php 
                                            }
                                            // end for loop
                                        ?>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input class="form-control" type="text" name="survey_question_color[]"
                                    id="question_color_1" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.option_type')}}
                                <span class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <div class="input-right-icon">
                                    <select class="select2_group form-control question_type" id="question_type"
                                        name="question_type[]">
                                        <option value="">{{__('message.question')}} {{__('message.type')}}</option>
                                        <option value="1">{{__('message.radio')}}</option>
                                        <option value="2">{{__('message.checkbox')}}</option>
                                        <option value="3">{{__('message.textbox')}}</option>
                                        <option value="4">{{__('message.textarea')}}</option>
                                        <option value="5">{{__('message.rating')}}</option>
                                        <option value="6">{{__('message.emoji')}}</option>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row survey_options">
                            <label for="staticEmail"
                                class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_option_point')}}
                                <span class="required">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                <input type="text" id="survey_option_title" maxlength="200"
                                    value="{{old('survey_option_title_1.0')}}" name="survey_option_title_1[]"
                                    class="form-control " placeholder="{{__('message.survey_option_point')}}    ">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input type="text" maxlength="5" id="option_point" name="option_point[]"
                                    value="{{old('option_point.0')}}" class="form-control"
                                    placeholder="{{__('message.point')}}">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="javascript:void(0)" class="add_options btn btn-outline-success" rel="1">
                                    <span class="ul-btn__icon"><i class="i-Add"></i></span>
                                    <span class="ul-btn__text"> {{__('message.add_option')}}</span>
                                </a>
                            </div>
                        </div>
                        <div id="optionTextBoxContainer_1" class="survey_options"></div>
                        <div class="col-sm-12 col-lg-12" id="emoji_tbl" style="display:none">
                            <div class="">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:15%;" class="text-center" scope="col">
                                                {{__('message.rating')}}</th>
                                            <th class="text-center" scope="col">{{__('message.emoji')}}</th>
                                            <th class="text-center" scope="col">{{__('message.name')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width:15%; text-align: center;">5</td>
                                            <td style="width:25%; text-align: center;">
                                                <div id="standalone_5" data-emoji-placeholder=":smiley:"></div>
                                                <div class="emotion">
                                                    <div class="input" contenteditable="true"></div>
                                                    <span class="emotion-Icon">
                                                        <i class="i-Smile" aria-hidden="true"></i>
                                                        <div class="emotion-area"></div>
                                                    </span>
                                                    <input type="hidden" class="emoji" name="emoji_rating_5[]">
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="text" name="emoji_name_5[]" class="form-control"
                                                    placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}"
                                                    style="width:50%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%; text-align: center;">4</td>
                                            <td style="width:25%; text-align: center;">
                                                <div id="standalone_4" data-emoji-placeholder=":smiley:"></div>
                                                <div class="emotion">
                                                    <div class="input" contenteditable="true"></div>
                                                    <span class="emotion-Icon">
                                                        <i class="i-Smile" aria-hidden="true"></i>
                                                        <div class="emotion-area"></div>
                                                    </span>
                                                    <input type="hidden" class="emoji" name="emoji_rating_4[]">
                                                </div>
                                            </td>

                                            <td style="text-align: center;">
                                                <input type="text" name="emoji_name_4[]" class="form-control"
                                                    placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}"
                                                    style="width:50%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%; text-align: center;">3</td>
                                            <td style="width:25%; text-align: center;">
                                                <div id="standalone_3" data-emoji-placeholder=":smiley:"></div>
                                                <div class="emotion">
                                                    <div class="input" contenteditable="true"></div>
                                                    <span class="emotion-Icon">
                                                        <i class="i-Smile" aria-hidden="true"></i>
                                                        <div class="emotion-area"></div>
                                                    </span>
                                                    <input type="hidden" class="emoji" name="emoji_rating_3[]">
                                                </div>
                                            </td>

                                            <td style="text-align: center;">
                                                <input type="text" name="emoji_name_3[]" class="form-control"
                                                    placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}"
                                                    style="width:50%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%; text-align: center;">2</td>
                                            <td style="width:25%; text-align: center;">
                                                <div id="standalone_2" data-emoji-placeholder=":smiley:"></div>
                                                <div class="emotion">
                                                    <div class="input" contenteditable="true"></div>
                                                    <span class="emotion-Icon">
                                                        <i class="i-Smile" aria-hidden="true"></i>
                                                        <div class="emotion-area"></div>
                                                    </span>
                                                    <input type="hidden" class="emoji" name="emoji_rating_2[]">
                                                </div>
                                            </td>

                                            <td style="text-align: center;">
                                                <input type="text" name="emoji_name_2[]" class="form-control"
                                                    placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}"
                                                    style="width:50%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%; text-align: center;">1</td>
                                            <td style="width:25%; text-align: center;">
                                                <div id="standalone_1" data-emoji-placeholder=":smiley:"></div>
                                                <div class="emotion">
                                                    <div class="input" contenteditable="true"></div>
                                                    <span class="emotion-Icon">
                                                        <i class="i-Smile" aria-hidden="true"></i>
                                                        <div class="emotion-area"></div>
                                                    </span>
                                                    <input type="hidden" class="emoji" name="emoji_rating_1[]">
                                                </div>
                                            </td>

                                            <td style="text-align: center;">
                                                <input type="text" name="emoji_name_1[]" class="form-control"
                                                    placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}"
                                                    style="width:50%;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="BovineTextBoxContainer"> </div>
                    </div>
                    <div class="card-footer">
                        <div class="mc-footer">
                            <div class="row text-right">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8 text-left">
                                    <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"
                                        onclick="showPreview()">{{__('message.preview')}}</button>
                                    <a href="javascript:void(0)" id="btnAddQuestion"
                                        class="btn btn-info  float-right add_options">
                                        <span class="ul-btn__icon"><i class="i-Add"></i></span>
                                        <span class="ul-btn__text">{{__('message.add_question')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end survey question option form -->
            </div>
        </form>
        <!-- end::form 2-->
    </div>
</div>

<!-- Modal -->
<div class="" id="modelLanguageId">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <?php   $src = $base_path."assets/images/user-placeholder.jpg"; ?>
                            <img src="<?php echo $src; ?>" id="model_survey_logo" width="50px" height="50"
                                style="width:60px;height:60px;float:left;">
                        </div>
                        <h2 style="margin: 0px;" id="model_survey_title">
                            <!-- <input type="text" name="" id="model_survey_title" readonly="true" class="input-fontsize"> -->
                        </h2>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="model_inner_body form">
                                <div class="form-body">
                                    <p style="text-align:center;font-size:25px;" id="model_survey_header"></p>
                                    <div class="form-group" id="div1">
                                        <!-- <label for="recipient-name" class="col-form-label"> <strong >1</strong> <p id="model_survey_option_title"></p>
                                            </label> 
                                            <div class="col-md-10 col-md-offset-1">

                                            </div> -->
                                    </div>
                                    <!-- <div class="form-group">
                                            <label for="recipient-name" class="col-form-label"><strong>2</strong> How many years old are you 
                                            </label> 
                                             <div class="col-md-10 col-md-offset-1">
                                                <textarea class="form-control" name="survey_option[]"> </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label"><strong>3</strong>  The Sangai Festival is celebrated in ? </label> 
                                             <div class="col-md-10 col-md-offset-1">
                                                <input type="text" class="form-control" name="textbox[]">
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bottom_footer">
                    <p style="text-align:center;font-size:25px;" id="model_survey_footer"></p>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('message.close')}}</button>
                    <button type="button" class="btn btn-primary">{{__('message.save')}}
                        {{__('message.changes')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- model end -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script>
    $('#title_color').colorpicker({});
    $('#survey_title_background_color').colorpicker({});
    
    $('#header_color').colorpicker({});
    $('#footer_color').colorpicker({});
    $('#question_color_1').colorpicker({});
    $('#survey_bg_color').colorpicker({});

    // $(".head h3").html("your new header");
    // myHeader.innerText = "public offers";    
    // $("h3").text("context")
    // document.getElementById("headertag").innerHTML = "Public Offers";
    // var headingDiv       = document.getElementById("head");
    // headingDiv.innerHTML = "<H3>Public Offers</H3>";


function showPreview() {
    $('#modelTitle').val('Survay')

    // Set RTL if langualge is arebic
    if ($('#form_language_type').val() == '2') {
        $('#modelLanguageId').addClass('adminArbln');
    }
    if(srcData != '') {
        $('#model_survey_logo').attr('src', srcData);
    }

// title
    $('#model_survey_title').html($('#survey_form_title').val());
    
    $('#model_survey_title').css('font-size', $('#survey_title_font_size').val());
    
    $('#model_survey_title').css('color', $('#title_color').val());

//  header
    $('#model_survey_header').html($('#survey_form_header').val());
    
    $('#model_survey_header').css('font-size', $('#survey_header_font_size').val());
    
    $('#model_survey_header').css('color', $('#header_color').val());

// footer
    $('#model_survey_footer').html($('#survey_form_footer').val());
    
    $('#model_survey_footer').css('font-size', $('#survey_footer_font_size').val());
    
    $('#model_survey_footer').css('color', $('#footer_color').val());

    $('#model_survey_option_title').html($('#survey_question').val());


    var inputType = '';
    var inputField = '<label for="recipient-name" class="col-form-label"> <strong >1</strong> <p id="model_survey_option_title"></p></label><div class="col-md-10 col-md-offset-1">';

    if ($('#question_type').val() == 1) { //radio
        // inputType = 'radio';
        inputField = inputField + '<input type="radio" class="form-control" value="' + $('#survey_option_title').val() + '">' + $('#survey_option_title').val() + ' </div></div>';
    }
    if ($('#question_type').val() == 2) { //checkbox
        inputField = inputField + '<input type="checkbox" class="form-control"';
    }
    if ($('#question_type').val() == 3) { //textbox
        inputField = inputField + '<input type="textbox" class="form-control"';
    }
    if ($('#question_type').val() == 4) { //textarea
        inputField = inputField + '<textarea class="form-control">';
    }
    if ($('#question_type').val() == 5) { //rating
        inputField = inputField + '<input type="radio" class="form-control"';
    }

    
    $('.div1').html(inputField);

    // var values = $("input[name='textbox[]']")
    //           .map(function(){return $(this).val();}).get();
    // console.log(values, $('#survey_option_title').val())
}
</script>
<script type="text/javascript">
    var srcData = '';
$(document).ready(function () {

    // $('#emoji_tbl').hide();
    $("#survey_form_logo").change(function () {
        readURL(this);
    });

    $("#survey_form_background").change(function () {
        readURLBG(this);
    });

//    $('#function_category').multiselect();

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#survey_logo').attr('src', e.target.result);
            srcData = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURLBG(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#survey_bg').attr('src', e.target.result);
            srcData = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    var i = 2;
    var j= 2;
    $(document).on("click", "#btnAddQuestion", function () {
        var div = $("<div />");
        div.html(GetQuestionDynamicTextBox(i));
        $("#BovineTextBoxContainer").append(div);
        $('#question_color_' + i).colorpicker({});
        $('#emoji_'+i).on('change',function(){
            if($(this).val() =='6'){
                $('#append_emoji_'+parseInt(i-1)).empty();
                var div = $("<div />");
                div.html(emoji_table());
                // $('.append_emoji').show();
                $('#append_emoji_'+parseInt(i-1)).append(div);
                $('#append_emoji_'+parseInt(i-1)).show();
            }else{
                // $('.append_emoji').empty();
                $('#append_emoji_'+parseInt(i-1)).hide();
            }
        })
        i++;
        /*var values = $("input[id='question_color']")
              .map(function(){return $(this).val();}).get();
              console.log(values)*/
    });

    $(document).on("click", ".add_options", function () {
        var elem_id = $(this).attr('rel');
        var div = $("<div />");
        div.html(GetOptionDynamicTextBox(j,elem_id));
        $("#optionTextBoxContainer_"+elem_id).append(div);
        j++;
    });
    
    $(document).on("click", ".remove_question", function () {
        var _id = $(this).attr('rel');
        $("#q_"+_id).remove();
    });

    $(document).on("click", ".remove_option", function () {
        var opt_id = $(this).attr('rel');
        $("#opt_"+opt_id).remove();
    });

    $(document).on('change','.question_type',function(event){
        var elem_id = $(this).find('option:selected').val();
             
        //Question type 3 Textbox, 4 Textarea and Question type 5 will not need option
        if(elem_id=='3' || elem_id=="4" || elem_id=="5"){
           $(this).parents('.form-group').siblings('.survey_options').hide();
           $(this).parents('.form-group').siblings('#emoji_tbl').hide();
        }else if(elem_id=='6'){
            $(this).parents('.form-group').siblings('#emoji_tbl').show();
            $(this).parents('.form-group').siblings('.survey_options').hide();
        }else{
            $(this).parents('.form-group').siblings('.survey_options').show();
            $(this).parents('.form-group').siblings('#emoji_tbl').hide();
        }
    });
});


function GetQuestionDynamicTextBox(value) {
    return '<div id="q_'+value+'"><div class="card-header bg-transparent"><h3 class="card-title">{{__('message.question_options')}}</h3></div><div class="card-body"><div class="form-group row"><label for="staticEmail" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_question')}}<span class="required">*</span></label><div class="col-lg-5 col-md-5 col-sm-5 mb-2"><input type="text" maxlength="200" name="survey_question[]" class="form-control" value="" placeholder="{{__('message.survey_question')}}"></div><div class="col-md-2 col-sm-2 col-xs-12"><div class="input-right-icon"><select name="survey_question_font_size[]" id="survey_question_font_size" class="form-control"><option value="">{{__('message.font_size')}}</option><?php for ($i=0; $i <= 50; $i++) { ?><option value="{{$i}}px">{{$i}} px</option><?php } ?></select><span class="span-right-input-icon"><i class="ul-form__icon i-Arrow-Down"></i></span></div></div><div class="col-md-2 col-sm-2 col-xs-12"><input class="form-control" type="text" name="survey_question_color[]" id="question_color_'+value+'" autocomplete="off" placeholder="Question color"></div></div><div class="form-group row"><label for="staticEmail" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.option_type')}} <span class="required">*</span></label><div class="col-lg-5 col-md-5 col-sm-5 mb-2"><div class="input-right-icon"><select class="select2_group form-control question_type" name="question_type[]" id="emoji_'+value+'"><option value="" >{{__('message.question')}} {{__('message.type')}}</option><option value="1">{{__('message.radio')}}</option><option value="2">{{__('message.checkbox')}}</option><option value="3">{{__('message.textbox')}}</option><option value="4">{{__('message.textarea')}}</option><option value="5">{{__('message.rating')}}</option><option value="6" >{{__('message.emoji')}}</option></select><span class="span-right-input-icon"><i class="ul-form__icon i-Arrow-Down"></i></span></div></div><div class="col-sm-4 col-md-4 col-lg-4"><a href="javascript:void(0)" class="btn btn-outline-success mr-1 add_options" rel="'+value+'"><span class="ul-btn__icon"><i class="i-Add"></i></span><span class="ul-btn__text"> {{__('message.add_option')}}</span></a> <a href="javascript:void(0)" class="btn btn-outline-danger remove_question" rel="'+value+'"><span class="ul-btn__icon"><i class="i-Remove"></i></span><span class="ul-btn__text"> {{__('message.remove')}} {{__('message.option')}}</span></a></div></div><div id="optionTextBoxContainer_'+value+'"><div id="append_emoji_'+value+'"></div></div>'
}

function GetOptionDynamicTextBox(value,question_id) {
    return '<div class="form-group row survey_options" id="opt_'+value+'"><label for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey_option_point')}} <span class="required">*</span></label><div class="col-lg-5 col-md-5 col-sm-5 mb-2"> <input placeholder="{{__('message.survey_option_point')}} " id="survey_option_title" maxlength="200" name="survey_option_title_'+question_id+'[]" class="form-control" type="text"/>' + ' </div><div class="col-md-2 col-sm-2 col-xs-12"><input placeholder="{{__('message.point')}}" maxlength="5" name="option_point[]" class="form-control" type="text"/></div><div class="col-md-2 col-sm-2 col-xs-12"><a href="javascript:void(0)" class="remove_option btn btn-outline-danger" rel="'+value+'"><span class="ul-btn__icon"><i class="i-Remove"></i></span><span class="ul-btn__text"> {{__('message.remove')}} {{__('message.option')}}</span></a></div></div>'
}

function emoji_table(){
    return ' <table id="" class="table table-striped table-bordered">  '  + 
'              <thead>  '  + 
'                 <tr>  '  + 
'                     <th style="width:15% " class="text-center">{{__('message.rating')}}</th>  '  + 
'                     <th class="text-center" scope="col">{{__('message.emoji')}}</th>  '  + 
'                     <th class="text-center" scope="col">{{__('message.name')}}</th>  '  + 
'                 </tr>  '  + 
'              </thead>  '  + 
'              <tbody>  '  + 
'                 <tr>  '  + 
'                     <td style="width:15%;" class="text-center" >5</td>  '  + 
'                     <td style="width:25%;" class="text-center" >  '  + 
'                       <div id="standalone_5" data-emoji-placeholder=":smiley:"></div>  '  + 
'                       <div class="emotion">  '  + 
'                       <div class="input" contenteditable="true"></div>  '  + 
'                           <span class="emotion-Icon">  '  + 
'                               <i class="i-Smile" aria-hidden="true"></i>  '  + 
'                               <div class="emotion-area"></div>  '  + 
'                           </span>  '  + 
'                           <input type="hidden" class="emoji" name="emoji_rating_5[]">  '  + 
'                       </div>  '  + 
'                    </td>  '  + 
'                    <td class="text-center" >  '  + 
'                       <input type="text" name="emoji_name_5[]" class="form-control" placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}" style="width:50%;">  '  + 
'                    </td>  '  + 
'                </tr>  '  + 
'                <tr>  '  + 
'                    <td style="width:15%;" class="text-center" >4</td>  '  + 
'                    <td style="width:25%;" class="text-center" >  '  + 
'                        <div id="standalone_4" data-emoji-placeholder=":smiley:"></div>  '  + 
'                        <div class="emotion">  '  + 
'                            <div class="input" contenteditable="true"></div>  '  + 
'                            <span class="emotion-Icon">  '  + 
'                               <i class="i-Smile" aria-hidden="true"></i>  '  + 
'                               <div class="emotion-area"></div>  '  + 
'                           </span>  '  + 
'                        <input type="hidden" class="emoji" name="emoji_rating_4[]">  '  + 
'                        </div>  '  + 
'                    </td>  '  + 
'     '  + 
'                     <td class="text-center" >  '  + 
'                         <input type="text" name="emoji_name_4[]" class="form-control" placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}" style="width:50%;">  '  + 
'                     </td>  '  + 
'                 </tr>  '  + 
'                 <tr>  '  + 
'                     <td style="width:15%;" class="text-center" >3</td>  '  + 
'                     <td style="width:25%;" class="text-center" >  '  + 
'                         <div id="standalone_3" data-emoji-placeholder=":smiley:"></div>  '  + 
'                         <div class="emotion">  '  + 
'                             <div class="input" contenteditable="true"></div>  '  + 
'                             <span class="emotion-Icon">  '  + 
'                                <i class="i-Smile" aria-hidden="true"></i>  '  + 
'                                <div class="emotion-area"></div>  '  + 
'                            </span>  '  + 
'                         <input type="hidden" class="emoji" name="emoji_rating_3[]">  '  + 
'                         </div>  '  + 
'                     </td>  '  + 
'     '  + 
'                     <td class="text-center" >  '  + 
'                         <input type="text" name="emoji_name_3[]" class="form-control" placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}" style="width:50%;">  '  + 
'                     </td>  '  + 
'                 </tr>  '  + 
'                 <tr>  '  + 
'                     <td style="width:15%;" class="text-center" >2</td>  '  + 
'                     <td style="width:25%;" class="text-center" >  '  + 
'                         <div id="standalone_2" data-emoji-placeholder=":smiley:"></div>  '  + 
'                         <div class="emotion">  '  + 
'                             <div class="input" contenteditable="true"></div>  '  + 
'                             <span class="emotion-Icon">  '  + 
'                                <i class="i-Smile" aria-hidden="true"></i>  '  + 
'                                <div class="emotion-area"></div>  '  + 
'                            </span>  '  + 
'                            <input type="hidden" class="emoji" name="emoji_rating_2[]">  '  + 
'                         </div>  '  + 
'                     </td>  '  + 
'     '  + 
'                     <td class="text-center" >  '  + 
'                         <input type="text" name="emoji_name_2[]" class="form-control" placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}" style="width:50%;">  '  + 
'                     </td>  '  + 
'                 </tr>  '  + 
'                 <tr>  '  + 
'                     <td style="width:15%;" class="text-center" >1</td>  '  + 
'                     <td style="width:25%;" class="text-center" >  '  + 
'                         <div id="standalone_1" data-emoji-placeholder=":smiley:"></div>  '  + 
'                         <div class="emotion">  '  + 
'                             <div class="input" contenteditable="true"></div>  '  + 
'                             <span class="emotion-Icon">  '  + 
'                                <i class="i-Smile" aria-hidden="true"></i>  '  + 
'                                <div class="emotion-area"></div>  '  + 
'                            </span>  '  + 
'                            <input type="hidden" class="emoji" name="emoji_rating_1[]">  '  + 
'                         </div>  '  + 
'                     </td>  '  + 
'     '  + 
'                     <td class="text-center" >  '  + 
'                         <input type="text" name="emoji_name_1[]" class="form-control" placeholder="{{__('message.enter')}} {{__('message.emoji')}} {{__('message.name')}}" style="width:50%;">  '  + 
'                     </td>  '  + 
'                 </tr>  '  + 
'             </tbody>  '  + 
'        </table>  ' ; 
}


</script>

<style>
    .emoji_model button,
    .table span {
        background-color: #fff;
        font-size: 50px;
        color: #f6e901;
        border-radius: 50%;
        box-shadow: none !important;
    }

    .emoji_model button i,
    .table span i {
        color: #000000;
        float: right;
        background: #fff8b8;
        border-radius: 50%;
        font-size: 100px;
    }

    .table span i {
        font-size: 30px;
    }

    .table span {
        float: right
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
    
//  var alphabet = "abcdef".split("");
//  alphabet.each(function(letter) {
////      $('.emotion-area').append('<img scr="../../emoji/img/1f60${letter}.png"');
//      console.log(letter);
//  });
    
    function ApndImgEmotion() {
        for (var i = 65; i <= 70; i++) {
            var test = String.fromCharCode(i).toLowerCase()
            var baseUrl = '{{asset('')}}'
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f60' + test + '.png" name="emoji/img/1f60' + test + '.png">' + 
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f61' + test + '.png" name="emoji/img/1f61' + test + '.png">' + 
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f62' + test + '.png"  name="emoji/img/1f62' + test + '.png">' + 
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f47' + test + '.png" name="emoji/img/1f47' + test + '.png">' +
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f49' + test + '.png" name="emoji/img/1f49' + test + '.png">'
            );
        }
        
        for (var i = 4; i <= 8; i++) {
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f32' + i + '.png" name="emoji/img/1f32' + i + '.png">'
            );
        }
        
        for (var i = 3; i <= 8; i++) {
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f49' + i + '.png" name="emoji/img/1f49' + i + '.png">'
            );
        }
        
        for (var i = 0; i <= 9; i++) {
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f60' + i + '.png" name="emoji/img/1f60' + i + '.png">'
            );
        }
        
        for (var i = 10; i <= 44; i++) {
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f6' + i + '.png" name="emoji/img/1f6' + i + '.png">'
            );
        }
        
        for (var i = 10; i <= 17; i++) {
            $('.emotion-area').append(
                '<img width="30px" height="30px" src="'+baseUrl+'emoji/img/1f9' + i + '.png" name="emoji/img/1f9' + i + '.png">'
            );
        }
    }
    
//  $(document).one('click' , '.emotion-Icon', function(e){
//      ApndImgEmotion();
//  });
    
    $(document).on('click' , '.emotion-Icon', function(e){
        
        var top = $(this).offset().top ,
            top = Math.floor(top),
            emotionArea = $(this).find('.emotion-area');
        
        emotionArea.toggleClass('ShowImotion');
        
        if( top <= 160 ){
            emotionArea.toggleClass('top');
        }
        
        if(!emotionArea.hasClass('ShowImotion')){

            $('.emotion-area').empty();
            emotionArea.removeClass('top');
        }else{
            ApndImgEmotion();
        }
        
    });
    
    $(document).on('click', '.emotion-area' ,function(e){
        e.stopPropagation();
    });
    
    $(document).on('click' , '.emotion-area img', function(e){
        
        var emotionArea = $('.emotion-area');
        var imgIcon = $(this).clone();
        $(this).parents('.emotion').find('.input').empty();
        $(this).parents('.emotion').find('.input').append(imgIcon);
        // $('.emoji').val(e.target.name)
        $(this).parents('.emotion').find('.emoji').val(e.target.name);
        emotionArea.removeClass('ShowImotion');

    });
    
});

</script>
@stop