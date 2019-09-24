@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
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
        <!--begin::form 2-->
        @if($question == null)
        {!! Form::open(['route' => 'complain_setting', 'files' => 'true', 'method' => 'post', 'class' =>
        'form-horizontal
        form-label-left' ]) !!}
        @else
        {!! Form::model($question,['route' => 'complain_setting', 'files' => 'true','method' => 'put', 'class' =>
        'form-horizontal form-label-left' ]) !!}
        @endif
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.choose_for_pop_up_label')}}</h3>
            </div>
            <div class="card-body reason_field">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.enter_days_for_change_complain_status')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('complain_status_day'))
                        <div style="color: red;">{{ $errors->first('complain_status_day') }}</div>
                        @endif
                        {!! Form::number('complain_status_day', null,['class' => 'form-control','min' => '1']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.complain_button_name')}}
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('complain_button_name'))
                        <div style="color: red;">{{ $errors->first('complain_button_name') }}</div>
                        @endif
                        {!! Form::text('complain_button_name', null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.choose_pop_up_label_language')}}<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary  mr-2">
                            {{ Form::radio('label_language', 'english' , true) }} {{__('message.english')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary  mr-2">
                            {{ Form::radio('label_language', 'arabic' , false) }} {{__('message.arabic')}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('complain_button_text_size','Complain button text size:*', ['class'
                    =>'ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right']) !!}
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @php
                        $complain_button_text_size = $question ? $question->complain_button_text_size : ''
                        @endphp
                        <div class="input-right-icon">
                            <select name="complain_button_text_size" class="form-control">
                                <option value="">{{__('message.select_font_size')}}</option>
                                @for($i = 1; $i <= 30; $i++) <?php 
                                    $selected = ''; 
                                    if(isset($question) && $complain_button_text_size == $i.'px'){

                                        $selected = 'selected';
                                    }
                                    
                                ?> <option value="{{$i}}px" <?php echo $selected ?>> {{$i}}px</option>
                                    @endfor
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    {!!
                    Form::label('complain_button_text_color',__('message.select_text_color_for_complain_button').':*',
                    ['class' =>'ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label
                    text-right']) !!}
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::text('complain_button_text_color', null,['class' => 'form-control','id' =>
                        'complain_button_text_color']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.complain_pop_up_title')}}<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('complain_title'))
                        <div style="color: red;">{{ $errors->first('complain_title') }}</div>
                        @endif
                        {!! Form::text('complain_title', null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.do_you_want_to_show_complain_button')}}<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('complain_button', '1' , true) }} {{__('message.yes')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('complain_button', '0' , false) }} {{__('message.no')}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.select_color_for_complain_button')}} :
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            {{Form::text('complain_button_color',null,['class' => 'form-control','id' => 'complain_button_color'])}}
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.select_color_for_complain_and_reason_header')}} :
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            {{Form::text('complain_header_color',null,['class' => 'form-control','id' => 'complain_header_color'])}}
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <div class="col-sm-4"></div>
                        <div class="ol-lg-6 text-left">
                            <input type="submit" class="btn btn-primary float-right" value="{{__('message.save')}}">
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

@include('admin.participant.more_detail')

<script type="text/javascript">
    $('#complain_button_text_color').colorpicker({});
    $('#complain_header_color').colorpicker({});
    $('#complain_button_color').colorpicker({});
    
</script>

@include('datatable.alert_js')
@stop