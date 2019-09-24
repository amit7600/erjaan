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
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
    integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>




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
        {!! Form::model($feedback,['route' => ['feedback_survey_5.update',$feedback->id],'method' => 'PUT', 'class' =>
        'form-horizontal form-label-left' ]) !!}
        <!-- start REPORT Create KPI Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.edit_question')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.question')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::text('question',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="maximum_value"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.font_size')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select name="question_font_size" id="question_font_size" class="form-control">
                                <option value="">{{__('message.font_size')}}</option>
                                <?php
                                        // for loop start
                                            for ($i=0; $i <= 50; $i++) { 
                                                if($feedback->question_font_size == $i."px"){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = '';
                                                }
                                        ?>
                                <option value="{{$i}}px" <?php echo $selected; ?>>{{$i}} px</option>
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
                </div>
                <div class="form-group row">
                    <label for="maximum_value"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.font_color')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        {!! Form::text('question_title_color',null,['class' => 'form-control','id' => 'title_color'])
                        !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="maximum_value"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select_rating_or_emoji')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="row">
                            <label class="radio radio-primary ml-4 mt-2">
                                {!!Form::radio('emoji_rating','emoji',true,array('class' => 'emoji_rating','id' =>
                                'emoji_rating'))!!}
                                <span>{{__('message.emoji')}}</span>
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio radio-primary ml-4 mt-2">
                                {!!Form::radio('emoji_rating','rating',false,array('class' => 'emoji_rating','id' =>
                                'emoji_rating'))!!}
                                <span>{{__('message.rating')}}</span>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end survey Form Layout-->
            <div class="col-sm-12">
                <div class="card mb-4 text-left">
                    <div class="card-body">
                        <div class=" ">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:15%; text-align: center;" class="text-center">
                                            {{__('message.rating')}}</th>
                                        <th class="text-center">{{__('message.emoji')}}</th>
                                        <th class="text-center">{{__('message.name')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:15%; text-align: center;">5</td>
                                        <td style="width:25%; text-align: center;">
                                            @php
                                            $emoji5 = $feedback->emoji_rating_5 ? $feedback->emoji_rating_5 : '';
                                            @endphp

                                            {!! Form::hidden('emoji_rating_5', $feedback->emoji_rating_5,['id' =>
                                            'emoji_rating_5']) !!}
                                            <div id="standalone_5" data-emoji-placeholder=":smiley:"></div>
                                            <div class="emotion">
                                                <div class="input" contenteditable="false">
                                                    <img src="{{$base_path}}{!! $emoji5 !!}" alt="" title=""
                                                        style="width: 35px;">
                                                </div>
                                                <span class="emotion-Icon">
                                                    <i class="i-Smile" aria-hidden="true"></i>
                                                    <div class="emotion-area"></div>
                                                </span>
                                                <input type="hidden" class="emoji" name="emoji_rating_5"
                                                    value="{{$emoji5}}">
                                                <!-- <span id="emoji5">{!! $emoji5 !!}</span> -->
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            {!! Form::text('emoji_name_5',null,['class' => 'form-control', 'style' =>
                                            'width:50%;']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%; text-align: center;">4</td>
                                        <td style="width:25%; text-align: center;">
                                            @php
                                            $emoji4 = $feedback->emoji_rating_4 ? $feedback->emoji_rating_4 : '';
                                            @endphp

                                            {{ Form::hidden('emoji_rating_4', $feedback->emoji_rating_4,['id' => 'emoji_rating_4']) }}
                                            <div id="standalone_4" data-emoji-placeholder=":smiley:"></div>
                                            <div class="emotion">
                                                <div class="input" contenteditable="false">
                                                    <img src="{{$base_path}}{!! $emoji4 !!}" alt="" title=""
                                                        style="width: 35px;">
                                                </div>
                                                <span class="emotion-Icon">
                                                    <i class="i-Smile" aria-hidden="true"></i>
                                                    <div class="emotion-area"></div>
                                                </span>
                                                <input type="hidden" class="emoji" name="emoji_rating_4"
                                                    value="{{$emoji4}}">
                                                <!-- <span id="emoji4">{!! $emoji4 !!}</span> -->
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <!-- <input type="text" name="emoji_name_4" class="form-control"> -->
                                            {!! Form::text('emoji_name_4',null,['class' => 'form-control', 'style' =>
                                            'width:50%;']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%; text-align: center;">3</td>
                                        <td style="width:25%; text-align: center;">
                                            @php
                                            $emoji3 = $feedback->emoji_rating_3 ? $feedback->emoji_rating_3 : '';
                                            @endphp

                                            {{ Form::hidden('emoji_rating_3', $feedback->emoji_rating_3,['id' => 'emoji_rating_3']) }}
                                            <div id="standalone_3" data-emoji-placeholder=":smiley:"></div>
                                            <div class="emotion">
                                                <div class="input" contenteditable="false">
                                                    <img src="{{$base_path}}{!! $emoji3 !!}" alt="" title=""
                                                        style="width: 35px;">
                                                </div>
                                                <span class="emotion-Icon">
                                                    <i class="i-Smile" aria-hidden="true"></i>
                                                    <div class="emotion-area"></div>
                                                </span>
                                                <input type="hidden" class="emoji" name="emoji_rating_3"
                                                    value="{{$emoji3}}">
                                                <!-- <span id="emoji3">{!! $emoji3 !!}</span> -->
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <!-- <input type="text" name="emoji_name_3" class="form-control"> -->
                                            {!! Form::text('emoji_name_3',null,['class' => 'form-control', 'style' =>
                                            'width:50%;']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%; text-align: center;">2</td>
                                        <td style="width:25%; text-align: center;">
                                            @php
                                            $emoji2 = $feedback->emoji_rating_2 ? $feedback->emoji_rating_2 : '';
                                            @endphp

                                            {{ Form::hidden('emoji_rating_2', $feedback->emoji_rating_2,['id' => 'emoji_rating_2']) }}
                                            <div id="standalone_2" data-emoji-placeholder=":smiley:"></div>
                                            <div class="emotion">
                                                <div class="input" contenteditable="false">
                                                    <img src="{{$base_path}}{!! $emoji2 !!}" alt="" title=""
                                                        style="width: 35px;">
                                                </div>
                                                <span class="emotion-Icon">
                                                    <i class="i-Smile" aria-hidden="true"></i>
                                                    <div class="emotion-area"></div>
                                                </span>
                                                <input type="hidden" class="emoji" name="emoji_rating_2"
                                                    value="{{$emoji2}}">
                                                <!-- <span id="emoji2">{!! $emoji2 !!}</span> -->
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <!-- <input type="text" name="emoji_name_2" class="form-control"> -->
                                            {!! Form::text('emoji_name_2',null,['class' => 'form-control', 'style' =>
                                            'width:50%;']) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%; text-align: center;">1</td>
                                        <td style="width:25%; text-align: center;">
                                            @php
                                            $emoji1 = $feedback->emoji_rating_1 ? $feedback->emoji_rating_1 : '';
                                            @endphp

                                            {{ Form::hidden('emoji_rating_1', $feedback->emoji_rating_1,['id' => 'emoji_rating_1']) }}
                                            <div id="standalone_1" data-emoji-placeholder=":smiley:"></div>
                                            <div class="emotion">
                                                <div class="input" contenteditable="false">
                                                    <img src="{{$base_path}}{!! $emoji1 !!}" alt="" title=""
                                                        style="width: 35px;">
                                                </div>
                                                <span class="emotion-Icon">
                                                    <i class="i-Smile" aria-hidden="true"></i>
                                                    <div class="emotion-area"></div>
                                                </span>
                                                <input type="hidden" class="emoji" name="emoji_rating_1"
                                                    value="{{$emoji1}}">
                                                <!-- <span id="emoji1">{!! $emoji1 !!}</span> -->
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <!-- <input type="text" name="emoji_name_1" class="form-control"> -->
                                            {!! Form::text('emoji_name_1',null,['class' => 'form-control', 'style' =>
                                            'width:50%;', 'placeholder' => 'Enter Emoji Name']) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="mc-footer">
                            <div class="row text-right">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-6 text-left">
                                    <input type="submit" class="btn btn-primary pull-right"
                                        value="{{__('message.save')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!-- end::form 2-->
    </div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('message.select_emoji')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body emoji_model">
                <input type="hidden" name="emoji" value="" id="emoji_id">
                <button type="button" class="btn btn-sm " value="<i class='fa fa-grin-beam' ></i>" id="emoji"
                    onclick="seleted_emoji(this.value)"><i class='fa fa-grin-beam'></i>
                </button>
                <button type="button" class="btn btn-sm " value="<i class='fa fa-angry'></i>" id="emoji"
                    onclick="seleted_emoji(this.value)"><i class='fa fa-angry'></i></button>
                <button type="button" class="btn btn-sm " value="<i class='fa fa-frown' ></i>" id="emoji"
                    onclick="seleted_emoji(this.value)"><i class='fa fa-frown'></i></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('message.close')}}</button>
                <button type="submit" id="submit" class="btn btn-primary">{{__('message.send_survey')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script type="text/javascript">
    $('#title_color').colorpicker({});
    $('#question_bg_color').colorpicker({});
</script>
<script type="text/javascript">
    function mymodal(val){
        $('#myModal').modal('show');
        $('#emoji_id').val(val);
    }
function seleted_emoji(value){
    var id = $('#emoji_id').val();
    var str = value;
    $('#emoji'+id).html(str);
    $('#emoji_rating_'+id).val(str)
    $('#myModal').modal('hide');
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
    if($('input[name=emoji_rating]:checked').val() == 'rating'){
        $('#datatable').hide();
    }
    $('.emoji_rating').click(function(){
        if($(this).val() == 'emoji'){
        $('#datatable').show();
        }else{
        $('#datatable').hide();
        }
    })
    })
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
////      $('.emotion-area').append('<img scr="../../public/emoji/img/1f60${letter}.png"');
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