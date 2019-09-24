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
        {!! Form::open(['route' => 'reason_setting', 'files' => 'true', 'method' => 'post', 'class' =>
        'form-horizontal
        form-label-left' ]) !!}
        @else
        {!! Form::model($question,['route' => 'reason_setting', 'files' => 'true','method' => 'put', 'class' =>
        'form-horizontal form-label-left' ]) !!}
        @endif
        <input type="hidden" name="feedback_id" value="1">
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.reason_settings')}}</h3>
            </div>
            <div class="card-body reason_field">
                <div class="form-group row">
                    @php
                    $pop_up_rating = $question ? $question->rating_pop_up : '';
                    @endphp
                    {!! Form::label('Minimum rating for pop-up',__('message.minimum_rating_for_pop_up'), ['class'
                    =>'ul-form__label col-lg-3 col-md-3 col-sm-3
                    col-form-label text-right']) !!}
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::select('rating_pop_up',array('1' => '1','2'=> '2','3' => '3','4' => '4' , '5' =>
                        '5'),$pop_up_rating,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.reason_pop_up_title')}}<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('reason_title'))
                        <div style="color: red;">{{ $errors->first('reason_title') }}</div>
                        @endif
                        {!! Form::text('reason_title', null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.choose_reason_apperance')}}.<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('reason_appear', 'right' , true) }} {{__('message.right')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('reason_appear', 'left' , false) }} {{__('message.left')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('reason_appear', 'center' , false) }} {{__('message.center')}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('reason_font_size',__('message.select_font_size_for_reason').':*', ['class'
                    =>'ul-form__label col-lg-3 col-md-3
                    col-sm-3 col-form-label text-right']) !!}
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @php
                        $complain_button_text_size = $question ? $question->complain_button_text_size : ''
                        @endphp
                        <div class="input-right-icon">
                            <select name="reason_font_size" class="form-control">
                                <option value="">{{__('message.select_font_size_for_reason')}}</option>
                                @for($i = 1; $i <= 30; $i++) <?php 
                                            $selected = ''; 
                                            if(isset($question) && $question->reason_font_size == $i.'px'){
    
                                                $selected = 'selected';
                                            }
                                            
                                        ?> <option value="{{$i}}px" <?php echo $selected ?>>{{$i}}px</option>
                                    @endfor
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('reason_text_color',__('message.select_text_color_for_reason').':*', ['class'
                    =>'ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right']) !!}

                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @php
                        $complain_button_text_size = $question ? $question->complain_button_text_size : ''
                        @endphp
                        <div class="input-right-icon">
                            {!! Form::text('reason_text_color', null,['class' => 'form-control','id' =>
                            'reason_text_color']) !!}
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                @if(count($feedback_reason) == 0)
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.add_reason_for_feedback')}}.
                        <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::hidden('feedback_reason',$feedback_reason,['id' => 'feedback_reason']) !!}
                        {!! Form::text('reason[]', null,['class' => 'form-control','placeholder' =>
                        __('message.enter').' '. __('message.reason'),'id' => 'reason_1']) !!}
                        {!! Form::button(__('message.add').' '. __('message.more'),['class' => 'btn btn-success btn-sm',
                        'id' => 'add']) !!}
                    </div>
                </div>
                @endif
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
    $('#reason_text_color').colorpicker({});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var feedback_reason = <?php echo $feedback_reason ?>;
        
        if(feedback_reason.length > 0){
            $.each(feedback_reason, function(i,elem){

                if(i == 0){
                    
                    // $('#reason_1').val(elem.feedback_reason)
                    $('.reason_field').append('<div class="form-group row"><label class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.add_reason_for_feedback')}}.</label><div id="reason_'+i+'" class="form-group col-lg-5 col-md-5 col-sm-5 mb-2"><input type="text" name="reason[]" value="'+elem.feedback_reason+'" class="form-control " placeholder="{{__('message.enter_reason')}}"></div><div class="col-sm-2 col-md-2 col-lg-2 mb-2"><button type="button" class="btn btn-success btn-sm" id="add">{{__('message.add_more')}}</button></div></div>')
                }else{
                    $('.reason_field').append('<div class="form-group row" id="reason_'+i+'"><label class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"></label><div  class="col-lg-5 col-md-5 col-sm-5 mb-2"><input type="text" name="reason[]" class="form-control " value="'+elem.feedback_reason+'" placeholder="{{__('message.enter_reason')}}"></div><div class="col-sm-2 col-md-2 col-lg-2 mb-2"><button type="button" id="'+i+'" class="btn btn-danger btn-sm remove_btn">{{__('message.remove')}}</button></div></div>')
                }
            })
        }

        var i = 1;
        $('#add').click(function(){
            
            i++;
        $('.reason_field').append('<div class="form-group row"  id="reason_'+i+'"><label class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right"></label><div class="col-lg-5 col-md-5 col-sm-5 mb-2" ><input type="text" name="reason[]" class="form-control " placeholder="{{__('message.enter_reason')}}"></div><div class="col-sm-2 col-md-2 col-lg-2 mb-2"><button type="button" id="'+i+'" class="btn btn-danger btn-sm remove_btn">{{__('message.remove')}}</button></div></div>')
        })
        $(document).on('click','.remove_btn' , function(){

            var button_id = $(this).attr("id");
            $('#reason_'+button_id).remove();

        })
    })
</script>
@include('datatable.alert_js')
@stop