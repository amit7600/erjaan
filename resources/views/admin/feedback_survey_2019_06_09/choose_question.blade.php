@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<style type="text/css">
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }

    .dataTables_filter {
        display: none !important;
    }

    .selected_parti_count {
        float: left;
        text-align: right !important;
        margin-left: 75px;
        border-right: 1px solid #999;
        padding-right: 30px;
    }

    .balence_margin {
        float: right;
    }

    #img {
        width: 21px;
        border: none;
        margin-left: -20px;
        margin-bottom: 91px;
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 76px;
    }
</style>
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

        <!-- @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->
        <!--begin::form 2-->
        @if($question == null)
        {!! Form::open(['route' => 'store_question', 'files' => 'true', 'method' => 'post', 'class' => 'form-horizontal
        form-label-left' ]) !!}
        @else
        {!! Form::model($question,['route' => 'store_question', 'files' => 'true','method' => 'put', 'class' =>
        'form-horizontal form-label-left' ]) !!}
        @endif
        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.feedback')}} {{__('message.setting')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.background')}}
                        ({{__('message.color_or_image')}}) <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="file" id="question_form_background" name="question_form_background"
                            class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <?php   
                        $src = $base_path."assets/images/user-placeholder.jpg";
                           $src =  ($question != null && $question->question_form_background != null) ? $base_path.$question->question_form_background : $src;
                        
                        ?>
                        <img src="<?php echo $src; ?>" id="question_bg" width="70px">
                        @if (isset($question) && $question->question_form_background)
                        <img id="img" class="question_bg" src="{{asset('assets/images/stop.png')}}" alt="delete"
                            onclick="removeImage('question_form_background')">
                        @endif
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="input-right-icon">
                            @php
                            $question_background_color = $question ? $question->question_background_color : '';
                            @endphp
                            {!! Form::text('question_background_color', $question_background_color,['class' =>
                            'form-control','id' => 'question_bg_color']) !!}
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.background')}} {{__('message.mobile')}}
                        ({{__('message.image')}}) <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="file" id="question_form_background_mobile" name="question_form_background_mobile"
                            class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <?php   
                        $src = $base_path."assets/images/user-placeholder.jpg";
                           $src =  ($question != null && $question->question_form_background_mobile != null) ? $base_path.$question->question_form_background_mobile : $src;
                        
                        ?>
                        <img src="<?php echo $src; ?>" id="question_bg" width="70px">
                        @if (isset($question) && $question->question_form_background_mobile)
                        <img id="img" class="question_bg" src="{{asset('assets/images/stop.png')}}" alt="delete"
                            onclick="removeImage('question_form_background_mobile')">
                        @endif
                    </div>
                    
                </div> -->
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.question')}}
                        {{__('message.form')}} {{__('message.logo')}} <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input type="file" id="question_form_logo" name="question_form_logo" class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <?php   $src = $base_path."assets/images/user-placeholder.jpg";
                            $src =  ($question != null && $question->question_form_logo != null) ? $base_path.$question->question_form_logo : $src;
                            ?>
                        <img src="<?php echo $src; ?>" id="question_logo" width="70px">
                        @if (isset($question) && $question->question_form_logo)
                        <img id="img" class="question_logo" src="{{asset('assets/images/stop.png')}}" alt="delete"
                            onclick="removeImage('question_form_logo')">
                        <!-- <i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true" onclick="removeImage('question_form_logo')" ></i> -->
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.logo')}}
                        {{__('message.size')}} <span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::number('logo_size', null,['class' => 'form-control','max' => '150']) !!}
                    </div>
                </div>
                
            </div>
        </div>
        <!-- end survey Form Layout-->


        <!-- start SURVEY Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.choose')}} {{__('message.for')}} {{__('message.pop_up')}}
                    {{__('message.label')}}</h3>
            </div>
            <div class="card-body reason_field">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.thank')}} {{__('message.you')}} {{__('message.message')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('thank_you_message'))
                        <div style="color: red;">{{ $errors->first('thank_you_message') }}</div>
                        @endif
                        {!! Form::text('thank_you_message', null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.high')}} {{__('message.rating')}} {{__('message.name')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('high_rating_name'))
                        <div style="color: red;">{{ $errors->first('high_rating_name') }}</div>
                        @endif
                        {!! Form::text('high_rating_name', null,['class' => 'form-control','placeholder'=> 'High rating name']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.low')}} {{__('message.rating')}} {{__('message.name')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        @if ($errors->has('low_rating_name'))
                        <div style="color: red;">{{ $errors->first('low_rating_name') }}</div>
                        @endif
                        {!! Form::text('low_rating_name', null,['class' => 'form-control','placeholder'=> 'Low rating name']) !!}
                    </div>
                </div>

                

                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.do_you_want')}} {{__('message.full')}} {{__('message.screen')}}
                        {{__('message.button')}}?<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('fullscreen_button', '1' , true) }} {{__('message.yes')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('fullscreen_button', '0' , false) }} {{__('message.no')}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.do_you_want')}} {{__('message.question')}} {{__('message.in_sequence')}}?<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('question_sequence', '1' , false) }} {{__('message.yes')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('question_sequence', '0' , true) }} {{__('message.no')}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                        {{__('message.select')}} {{__('message.emoji')}} {{__('message.and')}} {{__('message.rating')}}
                        {{__('message.size')}}?<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('emoji_and_rating_size', 'large' , true) }} {{__('message.large')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('emoji_and_rating_size', 'medium' , false) }} {{__('message.medium')}}
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-primary mr-2">
                            {{ Form::radio('emoji_and_rating_size', 'small' , false) }} {{__('message.small')}}
                            <span class="checkmark"></span>
                        </label>
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
    var dataTable;
var extraData;
var selected_question = [];
var sendAll = 0;

// var template = Handlebars.compile($("#details-template").html());
// Handlebars.registerHelper('ifCond', function(v1, v2, options) {
//   if(v1 === v2) {
//     return options.fn(this);
//   }
//   return options.inverse(this);
// });

var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'checkbox', name: 'checkbox'},
    {data: 'question', name: 'question'},
];

var ajaxUrl = '{!! route('show_feedback_survey') !!}'; //Url of ajax datatable where you fetch data

//It may be empty array
var columnDefs = [
    {
        "targets": 0,
        "orderable": true,
        "class": "text-center",
    },
    {
        "targets": 1,
        "orderable": false,
        "class": "text-center"
    },
    {
        "targets": 2,
        "orderable": true,
        "class": "text-center"
    },
    
];
</script>
<script type="text/javascript">
    $('#title_color').colorpicker({});
    $('#question_bg_color').colorpicker({});    
</script>
<!-- for image uploading -->
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#question_form_logo").change(function () {
        
            readURL(this);
        });

        $("#question_form_background").change(function () {
            readURLBG(this);
        });
    })
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#question_logo').attr('src', e.target.result);
            srcData = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURLBG(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#question_bg').attr('src', e.target.result);
            srcData = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
    function removeImage (field) {
    if (field == 'question_form_background') {
        $('.question_bg').hide()
        $('#question_bg').hide()
    } else {
        $('.question_logo').hide()
        $('#question_logo').hide()
    }
    var removeField = field;
    var url = "{{route('removeImage')}}";
    $.ajax({
            type: "POST",
            url: url,
            data: {
            "_token": "{{ csrf_token() }}",
            'field' : removeField,
            },
            success: function(resp){
            if (field == 'question_form_background') {
                $('#question_bg').attr('src',"{{asset('assets/images/user-placeholder.jpg')}}")
                $('#question_bg').show()
               
            } else {
                $('#question_logo').attr('src',"{{asset('assets/images/user-placeholder.jpg')}}")
                $('#question_logo').show()
            }
            },
});
}
</script>

@include('datatable.alert_js')
@stop