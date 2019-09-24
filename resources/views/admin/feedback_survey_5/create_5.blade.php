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
        {!! Form::open(['route' => 'feedback_survey_5.store', 'files' => true, 'class' => 'form-horizontal
        form-label-left' ]) !!}
        <input type="hidden" name="feedback_id" value="5">
        <!-- start REPORT Create KPI Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.create_question')}}</h3>
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
                                        for ($i=0; $i <= 100; $i++) { 
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
                </div>
                <div class="form-group row">
                    <label for="maximum_value"
                        class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.font_color')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <input class="form-control" type="text" name="question_title_color" id="title_color"
                            autocomplete="off" placeholder="Enter color code">
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
                                        <th style="width:15%;" class="text-center" scope="col">{{__('message.rating')}}
                                        </th>
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
                                                <input type="hidden" class="emoji" name="emoji_rating_5">
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="text" name="emoji_name_5" class="form-control"
                                                placeholder="{{__('message.enter_emoji_name')}}" style="width:50%;">
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
                                                <input type="hidden" class="emoji" name="emoji_rating_4">
                                            </div>
                                        </td>

                                        <td style="text-align: center;">
                                            <input type="text" name="emoji_name_4" class="form-control"
                                                placeholder="{{__('message.enter_emoji_name')}}" style="width:50%;">
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
                                                <input type="hidden" class="emoji" name="emoji_rating_3">
                                            </div>
                                        </td>

                                        <td style="text-align: center;">
                                            <input type="text" name="emoji_name_3" class="form-control"
                                                placeholder="{{__('message.enter_emoji_name')}}" style="width:50%;">
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
                                                <input type="hidden" class="emoji" name="emoji_rating_2">
                                            </div>
                                        </td>

                                        <td style="text-align: center;">
                                            <input type="text" name="emoji_name_2" class="form-control"
                                                placeholder="{{__('message.enter_emoji_name')}}" style="width:50%;">
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
                                                <input type="hidden" class="emoji" name="emoji_rating_1">
                                            </div>
                                        </td>

                                        <td style="text-align: center;">
                                            <input type="text" name="emoji_name_1" class="form-control"
                                                placeholder="{{__('message.enter_emoji_name')}}" style="width:50%;">
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
<!-- <script type="text/javascript">
   $(document).ready(function() {
     $("#standalone_1").emojioneArea({
       standalone: true,
       autocomplete: false,
       events: {
        change: function (editor, event) {
            $('#emoji_rating_1').val(editor[0].innerHTML)
        }
       }
     });

     $("#standalone_2").emojioneArea({
       standalone: true,
       autocomplete: false,
       events: {
        change: function (editor, event) {
            $('#emoji_rating_2').val(editor[0].innerHTML)
        }
       }
     });

     $("#standalone_3").emojioneArea({
       standalone: true,
       autocomplete: false,
       events: {
        change: function (editor, event) {
            $('#emoji_rating_3').val(editor[0].innerHTML)
        }
       }
     });

     $("#standalone_4").emojioneArea({
       standalone: true,
       autocomplete: false,
       events: {
        change: function (editor, event) {
            $('#emoji_rating_4').val(editor[0].innerHTML)
        }
       }
     });

     $("#standalone_5").emojioneArea({
       standalone: true,
       autocomplete: false,
       events: {
        change: function (editor, event) {
            $('#emoji_rating_5').val(editor[0].innerHTML)
        }
       }
     });
   });
 </script> -->

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