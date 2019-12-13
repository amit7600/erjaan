<!DOCTYPE html>
<html lang="ar" style="background: #fff;">

<head>
  <title>Feedback Survey</title>
  <!-- <meta charset="utf-8"> -->
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=iso-8859-6">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('admin_css/assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin_css/assets/front/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('admin_css/assets/front/css/responsive.css')}}" rel="stylesheet">
  <script src="{{asset('admin_css/assets/front/js/jquery.min.js')}}"></script>
  <script src="{{asset('admin_css/assets/front/js/bootstrap.min.js')}}"></script>

  <style type="text/css">

  </style>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">

  <link href="{{asset('admin_css/assets/star-rating/star-rating.css')}}" rel="stylesheet">
  <link href="{{asset('admin_css/assets/front/css/font-awesome.css')}}" rel="stylesheet">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
    integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <!-- this is for star rating -->
  <link href="{{asset('admin_css/assets/star-rating/star-rating.css')}}" rel="stylesheet">
  <link href="{{asset('admin_css/assets/front/css/font-awesome.css')}}" rel="stylesheet">
</head>

<body id="myFullscreen" class="only_question_1" onload="sequence()">
  <?php 
  //$user_ag = $_SERVER['HTTP_USER_AGENT'];
  //if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){  ?>
  {{--<div class="overlay_img" style="background-image: url('{{$base_path}}{{$selected_feedback_question ?     $selected_feedback_question->question_form_background_mobile : ''}}');
  background-color: {{$selected_feedback_question ? $selected_feedback_question->question_background_color : ''}} ;
  background-size:cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center; " >
  </div>--}}
  <?php     //}else{ ?>
  <div class="overlay_img"
    style="background-image: url('{{$base_path}}{{$selected_feedback_question ?     $selected_feedback_question->question_form_background : ''}}'); background-color: {{$selected_feedback_question ? $selected_feedback_question->question_background_color : ''}} ; background-size:cover;   background-repeat: no-repeat; background-attachment: fixed;  background-position: center; ">
  </div>
  <?php     // }

  ?>
  <div class="inner_body">
    <div class="inner_bg">
      <div class="logo-img">
        <!-- <img src="{{$base_path}}<?php //echo ($survey_form_data[0]->survey_form_logo)? $survey_form_data[0]->survey_form_logo:'public/uploads/nophoto.png';    ?>"> -->
        @if(isset($selected_feedback_question) && file_exists($selected_feedback_question->question_form_logo) &&
        $selected_feedback_question->question_form_logo)
        <!-- this is for logo height -->
        @php
        $logo_size = $selected_feedback_question->logo_size != null ? $selected_feedback_question->logo_size : 70 ;

        @endphp
        {{-- <img src="{{$base_path}}{{$selected_feedback_question->question_form_logo}}"
        style="height: {{$logo_size}}px;margin-top: 10px;" alt="logo"> --}}
        <img src="{{$base_path}}{{$selected_feedback_question->question_form_logo}}"
          style="height:150px;margin-top: 10px;" alt="logo">
        @else
        <!--<img src="{{asset('admin_css/assets/front/img/logo.jpg')}}" alt="logo">-->
        @endif
        @if( isset($selected_feedback_question) && $selected_feedback_question->fullscreen_button == 1)
        <div class="" style="position: fixed; top: 20px; right: 10px;">
          <button onclick="openFullscreen();" id="fullsrc"
            style="background: #fff;border: none;border-radius: 5px;padding: 6px; cursor: pointer;"><img
              src="{{asset('/admin_css/assets/front/img/full-screen.png')}}" alt="Full Screen"
              style="width: 30px;"></button>
          <button onclick="closeFullscreen();" id="exitsrc"
            style="background: #fff;border: none;border-radius: 5px;padding: 6px; cursor: pointer;"><img
              src="{{asset('/admin_css/assets/front/img/FullscreenExit.png')}}" alt="Zoom Out"
              style="width: 30px;"></button>
        </div>
        @endif
      </div>
      <div class="main_heading ">
        <div class="innner_question_ans ">
          @php
          $rating_pop_up = $selected_feedback_question ? $selected_feedback_question->rating_pop_up : '';
          $question_sequence = $selected_feedback_question ? $selected_feedback_question->question_sequence : '';
          @endphp
          {!! Form::hidden('question_count',count($question),['id' => 'question_count']) !!}
          {!! Form::hidden('feedback_id',1,['id' => 'feedback_id']) !!}
          {!! Form::hidden('rating_pop_up',$rating_pop_up,['id' => 'rating_pop_up']) !!}
          {!! Form::hidden('question_sequence_value',$question_sequence,['id' => 'question_sequence_value']) !!}
          <!-- check question is on sequence or not -->
          @if(isset($selected_feedback_question) && $selected_feedback_question->question_sequence == 0)
          <?php
                        $divKey = 2;
                        ?>
          @foreach ($question as $key => $value)
          <div id="div_{{$value->id}}" class="panel div_{{$key+1}}">
            <div class="panel-heading">

              <h4
                style="font-size:{{$value->question_font_size != null ? $value->question_font_size : '35px'}};color:{{$value->question_title_color}}">
                {{ $value->question }}</h4>

            </div>
            <div class="panel-body">
              <div class="images {{$emoji_and_rating_size}}">
                @if($value->emoji_rating == 'rating')
                <div class="form-field margin_top">
                  {!! Form::hidden('star_question_id',$value->emoji_rating,['id' => 'star_question_id']) !!}
                  <select id="glsr-ltr" class="star-rating rating-list star_option">
                    <option value="">Select a rating</option>
                    <option value="5" id="<?php echo $value->id .'_'. $divKey; ?>">Fantastic</option>
                    <option value="4" id="<?php echo $value->id .'_'. $divKey; ?>">Great</option>
                    <option value="3" id="<?php echo $value->id .'_'. $divKey; ?>">Good</option>
                    <option value="2" id="<?php echo $value->id .'_'. $divKey; ?>">Poor</option>
                    <option value="1" id="<?php echo $value->id .'_'. $divKey; ?>">Terrible</option>
                  </select>
                </div>
                @else
                <ul>

                  <li>
                    <a style="color:red;" id="smile1" value="1"
                      onclick="sendSurvey('1', <?php echo $value->id; ?>, <?php echo $divKey; ?>)">
                      <img src="{{$value->emoji_rating_1}}" alt="" title="" id="5" class="grey 5">
                      <span>{{$value->emoji_name_1}}</span>
                    </a>
                  </li>
                  <li>
                    <a style="color:blue;" id="smile2" value="2"
                      onclick="sendSurvey('2', <?php echo $value->id; ?>, <?php echo $divKey; ?>)">
                      <img src="{{$value->emoji_rating_2}}" alt="" title="" id="4" class="grey 4">
                      <span>{{$value->emoji_name_2}}</span>
                    </a>
                  </li>
                  <li>
                    <a style="color:blue;" id="smile3" value="3"
                      onclick="sendSurvey('3', <?php echo $value->id; ?>, <?php echo $divKey; ?>)">
                      <img src="{{$value->emoji_rating_3}}" alt="" title="" id="3" class="grey 3">
                      <span>{{$value->emoji_name_3}}</span>
                    </a>
                  </li>
                  <li>
                    <a style="color:green;" id="smile4" value="4"
                      onclick="sendSurvey('4', <?php echo $value->id; ?>, <?php echo $divKey; ?>)">
                      <img src="{{$value->emoji_rating_4}}" alt="" title="" id="2" class="grey 2">
                      <span>{{$value->emoji_name_4}}</span>
                    </a>
                  </li>
                  <li>
                    <a style="color:green;" id="smile5" value="5"
                      onclick="sendSurvey('5', <?php echo $value->id; ?>, <?php echo $divKey; ?>)">
                      <img src="{{$value->emoji_rating_5}}" alt="" title="" id="1" class="grey 1">
                      <span>{{$value->emoji_name_5}}</span>
                    </a>
                  </li>
                </ul>
                @endif
              </div>
            </div>

          </div>
          <?php
                      $divKey = $divKey + 1;
                      ?>
          @endforeach

          @elseif(isset($selected_feedback_question) && $selected_feedback_question->question_sequence == 1)
          {!! Form::hidden('question_count',$question,['id' => 'question']) !!}
          @for($i=0; $i< count($question); $i++) <div id="div_{{$i}}" class="panel">
            <div class="panel-heading">
              <h4 dir="rtl" lang="ar"
                style="font-size:{{$question[$i]->question_font_size != null ? $question[$i]->question_font_size : '40px'}};color:{{$question[$i]->question_title_color}}">
                {{ $question[$i]->question }}</h4>
            </div>
            <!-- this section is for show emoji or star -->
            @if($question[$i]->emoji_rating == 'emoji')
            <div class="panel-body">

              @if($selected_feedback_question->display_option == 1 && $selected_feedback_question->question_sequence ==
              1)
              <div class="images single_line_curve  {{$emoji_and_rating_size}}">
                @elseif($selected_feedback_question->display_option == 2 &&
                $selected_feedback_question->question_sequence == 1)
                <div class="images zig_zag {{$emoji_and_rating_size}}">
                  @else
                  <div class="images without_curve {{$emoji_and_rating_size}}">
                    @endif
                    <ul>
                      <li>
                        <a class=" sequence_{{$i}}" style="color:red;" id="smile1" value="1"
                          onclick="send_survey('1', <?php echo $question[$i]->id; ?>,<?php echo $i; ?>)"><img
                            src="{{$question[$i]->emoji_rating_1}}" alt="" title="">
                          <span>{{$question[$i]->emoji_name_1}}</span>
                        </a>
                      </li>
                      <li>
                        <a class=" sequence_{{$i}}" style="color:blue;" id="smile2" value="2"
                          onclick="send_survey('2', <?php echo $question[$i]->id; ?>,<?php echo $i; ?>)"><img
                            src="{{$question[$i]->emoji_rating_2}}" alt="" title="">
                          <span>{{$question[$i]->emoji_name_2}}</span>
                        </a>
                      </li>
                      <li>
                        <a class=" sequence_{{$i}}" style="color:blue;" id="smile3" value="3"
                          onclick="send_survey('3', <?php echo $question[$i]->id; ?>,<?php echo $i; ?>)"><img
                            src="{{$question[$i]->emoji_rating_3}}" alt="" title="">
                          <span>{{$question[$i]->emoji_name_3}}</span>
                        </a>
                      </li>
                      <li>
                        <a class=" sequence_{{$i}}" style="color:green;" id="smile4" value="4"
                          onclick="send_survey('4', <?php echo $question[$i]->id; ?>,<?php echo $i; ?>)"><img
                            src="{{$question[$i]->emoji_rating_4}}" alt="" title="">
                          <span>{{$question[$i]->emoji_name_4}}</span>
                        </a>
                      </li>
                      <li>
                        <a class=" sequence_{{$i}}" style="color:green;" id="smile5" value="5"
                          onclick="send_survey('5', <?php echo $question[$i]->id; ?>,<?php echo $i; ?>)"><img
                            src="{{$question[$i]->emoji_rating_5}}" alt="" title="">
                          <span>{{$question[$i]->emoji_name_5}}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                @else
                <div class="form-field margin_top {{$emoji_and_rating_size}}">
                  {!! Form::hidden('star_question_id',$question[$i]->emoji_rating,['id' => 'star_question_id']) !!}
                  <select id="glsr-ltr" class="star-rating rating-list star_option">
                    <option value="">{{__('message.select')}} {{__('message.rating')}}</option>
                    <option value="1" id="<?php echo $question[$i]->id .'_'. $i; ?>">{{__('message.terrible')}}</option>
                    <option value="2" id="<?php echo $question[$i]->id .'_'. $i; ?>">{{__('message.poor')}}</option>
                    <option value="3" id="<?php echo $question[$i]->id .'_'. $i; ?>">{{__('message.good')}}</option>
                    <option value="4" id="<?php echo $question[$i]->id .'_'. $i; ?>">{{__('message.great')}}</option>
                    <option value="5" id="<?php echo $question[$i]->id .'_'. $i; ?>">{{__('message.fantastic')}}
                    </option>
                  </select>
                </div>
                @endif

              </div>
              @endfor
              @endif

              @if(isset($selected_feedback_question) && $selected_feedback_question->complain_button == 1 )
              {{ Form::button($selected_feedback_question->complain_button_name, array('class' => 'btn btn-success', 'type' => 'submit','onclick' => 'complain_button()','style' => 'color:'.$complain_button_text_color.';'.'font-size:'.$complain_button_text_size.';'.'background-color:'.$complain_button_color.';'.'border-color:'.$complain_button_color.';')) }}
              @endif
            </div>
        </div>
      </div>
      <div class="modal fade model_question complain_form" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: {{$complain_header_color}};">
              <h4 class="modal-title">
                {{$selected_feedback_question ? $selected_feedback_question->reason_title : 'Reason'}}
              </h4>
              <button type="button" class="close" data-dismiss="modal" onclick="closeModel()" id="close_btn"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="col-sm-12">
                @foreach($feedback_reason as $key => $value)
                <div class="radio">
                  <label id="label_commentRadio_{{$value->id}}"
                    style="text-align: {{$align}}; color: {{$reason_color}}; font-weight: {{$reason_style}}; font-style: {{$reason_style}}; font-size: {{$text_size}}">
                    {!! Form::radio('comment',$value->feedback_reason,false,['id' => 'commentRadio_'.$value->id ,
                    'onclick'
                    => 'comment_radio(this)']) !!} {{$value->feedback_reason}}
                    {!! Form::hidden('comment_id',null,['id' => 'comment_id']) !!}
                  </label>
                </div>
                @endforeach
              </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModel()" data-dismiss="modal">Close</button>
                <button type="button" onclick="sendSurveyPopup()" id="submito" class="btn btn-success">Send Survey</button>
              </div> -->
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      <!-- thank you pop up -->
      <div class="modal fade model_question" id="thank_you" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{__('message.thank_you_message')}}</h4>
              <button type="button" class="close" data-dismiss="modal" id="close_btn" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
              {!! $selected_feedback_question ? $selected_feedback_question->thank_you_message : 'Thanks for feedback!'
              !!}
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>

    <div class="modal fade model_question complain_form" id="complainModel" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: {{$complain_header_color}};">
            <h4 class="modal-title">
              {{$selected_feedback_question ? $selected_feedback_question->complain_title : 'Complain'}}</h4>
            <button type="button" class="close" data-dismiss="modal" onclick="closeModel()" id="close_btn"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group">
                <div class="col-sm-6">
                  <label>{{$name_label}}</label>
                  {!! Form::text('name',null,['class' => 'form-control','id' => 'name', 'placeholder' => $name_label])
                  !!}
                </div>
                <div class="col-sm-6">
                  <label>{{$email_label}}</label>
                  <p id="email_p" style="margin-bottom: 0px;"></p>
                  {!! Form::email('email',null,['class' => 'form-control','id' => 'email', 'placeholder' =>
                  $email_label])
                  !!}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>{{$number_label}}</label>
              {!! Form::text('number',null,['class' => 'form-control','id' => 'number', 'placeholder' => $number_label])
              !!}
            </div>
            <div class="form-group">
              <label>{{$comment_label}}</label>
              <p id="comment_label" style="margin-bottom: 0px;"></p>
              {!! Form::textarea('comment',null,['class' => 'form-control','id' => 'commentd', 'rows' => '5',
              'placeholder' => $comment_label]) !!}
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick="closeModel()" id="close_btn" data-dismiss="modal"><i
                class="fa fa-times" aria-hidden="true" style="font-size: 30px;"></i></button>
            <button type="button"
              style="background-color: {{$complain_header_color}}; border-color: {{$complain_header_color}};"
              onclick="sendSurveyPopup2()" id="submito" class="btn btn-success"><i class="fa fa-paper-plane"
                aria-hidden="true" style="font-size: 30px;"></i></button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="{{asset('admin_css/assets/star-rating/star-rating.min.js')}}"></script>
    <script type="text/javascript">
      var destroyed = false;
          var starratings = new StarRating('.star-rating', {
              onClick: function (el) {
                var sequence = $("#question_sequence_value").val();

                var data = el[el.selectedIndex].id.split('_');
                var id = data[0]
                var is = data[1]
                var value = el[el.selectedIndex].value
                if(sequence != 0){
                  send_survey(value,id,is)
                }else{
                  sendSurvey(value,id,is)
                }
              },
          });

    </script>
    <script type="text/javascript">
      //this function use for show hide question

    function comment_radio(e){
            // $("label").removeClass('active');
            jQuery(".radio").find("label").removeClass('active');
            $("#label_"+e.id).addClass('active');
            $('#comment_id').val(e.id);
            var url = "{{ route('feedBackRatings') }}"
            var feedback_id = $('#feedback_id').val()
            var comment = e.value;
        $.ajax({
          type: "POST",
          url: url,
          data: {
            "_token": "{{ csrf_token() }}",
            'comment' : comment,
            'feedback_id' : feedback_id
            },
          success: function(resp){
            $('#thank_you').modal('toggle');
            setTimeout(function() {
              window.scrollTo(0,0)
              location.reload();
            }, 2000);
          },
        });

        $('#myModal').modal('hide');
           }
//when page is load this function is called
  function  sequence(){
    var  sequence = $('#question_sequence_value').val()
    if(sequence != 0){
        var i = 0;
        var divTwo = document.getElementById("#div_"+i);
        var question_count = $('#question_count').val();
            for (var j = 0; j <=question_count ; j++) {
            $("#div_"+(j+1)).hide()
            }
        }
    }


     var input_rating = [];
//this call when question sequence is false
    function sendSurvey (value, id, divKey) {
        var divId = "#div_"+id
        var dataType = 'json'
        var feedback_id = $('#feedback_id').val();
        var question_count = $('#question_count').val();
        var rating_pop = $('#rating_pop_up').val();
        var url = "{{ route('store_survey') }}"
        input_rating.push(value)
            // jQuery("#div_"+id).find("a").addClass("disabled");
            jQuery("#div_"+id).find("a").css('filter','grayscale(100%)');
            jQuery("#div_"+id).find("#smile"+value).css('filter','grayscale(0%)');

        if(input_rating.length == question_count){
            var found = input_rating.find(function(element) {
                if (element <= rating_pop) {
                    return true;
                }
            });
            $.ajax({
              type: "POST",
              url: url,
              data: {
                "_token": "{{ csrf_token() }}",
                'rating' : value,
                'question_id' : id,
                'feedback_id' : feedback_id
                },
              dataType: dataType
            });
            if (found !== undefined && found != null) {
                $('#myModal').modal('show');

                setTimeout(function() {
                  window.scrollTo(0,0)
                  location.reload();
                }, 30000);
            } else {
              $('#thank_you').modal('toggle');
                setTimeout(function() {
                  window.scrollTo(0,0)
                  location.reload();
                }, 2000);

            }

        }else{
            $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                    'rating' : value,
                    'question_id' : id,
                    'feedback_id' : feedback_id
                    },
                  success: function(resp){
                  },
                  dataType: dataType
                });
        }
        jQuery("#div_"+id).css('pointer-events','none');
    }
//this call when question sequence is true
    function send_survey (value, id,is) {

        var i = 0;

        // $("#sequence_"+i).hide();
        $("#div_"+is).hide();
        $("#div_"+ (parseInt(is) + 1)).show();


        var divId = "#div_"+id
        var dataType = 'json'
        var feedback_id = $('#feedback_id').val();
        var question_count = $('#question_count').val();
        var rating_pop = $('#rating_pop_up').val();
        var url = "{{ route('store_survey') }}"
        input_rating.push(value)
            jQuery("#div_"+id).find("a").css({'filter':'greyscale(100%)','user-select': 'none'});
            jQuery("#div_"+id).find("#smile"+value).css('filter','grayscale(0%)');
            jQuery("#smile"+value).attr("disabled", true);;
            if(input_rating.length == question_count){
                var found = input_rating.find(function(element) {
                    if (element <= rating_pop) {
                        return true;
                    }
                });
              $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                      "_token": "{{ csrf_token() }}",
                      'rating' : value,
                      'question_id' : id ? id : '',
                      'feedback_id' : feedback_id
                    },
                    success: function(resp){
                    },
                    dataType: dataType
                  });
                  $('#myModal').modal('hide');
            if (found !== undefined && found != null) {
                $('#myModal').modal('show');
                setTimeout(function() {
                  window.scrollTo(0,0)
                  location.reload();
                }, 30000);
                $("#div_"+0).show();

            } else{
              $("#div_"+0).show();
              $('#thank_you').modal('toggle');
                setTimeout(function() {
                  window.scrollTo(0,0)
                  location.reload();
                }, 2000);
            }
        }else{
            $.ajax({
              type: "POST",
              url: url,
              data: {
                "_token": "{{ csrf_token() }}",
                'rating' : value,
                'question_id' : id,
                'feedback_id' : feedback_id
                },
              success: function(resp){

              },
              dataType: dataType
            });
        }
    }

    function complain_button(){
        $('#complainModel').modal('show');
    }

    function sendSurveyPopup () {
      var url = "{{ route('feedBackRatings') }}"
        var comment_id = $('#comment_id').val()
        var comment = $('#'+comment_id).val()

        if(comment == ''){
            $('p').css('color', 'red').text('This field is required!');
            $('#comment').addClass('alert-danger');
            return false;
        }
        $.ajax({
          type: "POST",
          url: url,
          data: {
            "_token": "{{ csrf_token() }}",
            'comment' : comment
            },
          success: function(resp){
            $('#thank_you').modal('toggle');
            setTimeout(function() {
              window.scrollTo(0,0)
              location.reload();
            }, 2000);
          },
        });
        $('#myModal').modal('hide');
    }
    function sendSurveyPopup2 () {
      var url = "{{ route('feedBackComplaints') }}"
      var name = $('#name').val()
        var email = $('#email').val()
        var number = $('#number').val()
        var comment = $('#commentd').val()

        if(comment == ''){
            $('p').css('color', 'red').text('This field is required!');
            $('#commentd').addClass('alert-danger');
            return false;
        }
        if (email != '') {
          var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

          if (reg.test(email) == false)
          {
            $('#email_p').css('color', 'red').text('Invalid Email Address!');
            $('#email').addClass('alert-danger');
              return false;
          }

        }
        $.ajax({
          type: "POST",
          url: url,
          data: {
            "_token": "{{ csrf_token() }}",
            'name' : name,
            'email' : email,
            'number' : number,
            'comment' : comment
            },
          success: function(resp){
            $('#thank_you').modal('toggle');
            setTimeout(function() {
              window.scrollTo(0,0)
              location.reload();
            }, 2000);
          },
        });
        $('#complainModel').modal('hide');
    }

    function closeModel () {
      location.reload()
    }
    </script>
    <!-- this section for full-screen button and auto reload -->
    <script>
      $(document).ready(function(){
  var idleTime = 0;
  //Increment the idle time counter every minute.
  var idleInterval = setInterval(timerIncrement, 1000); // 1 minute

  //Zero the idle timer on mouse movement.
  $(this).mousemove(function (e) {
      idleTime = 0;
  });
  $(this).keypress(function (e) {
      idleTime = 0;
  });

  function timerIncrement() {                    
      idleTime = idleTime + 1;
      if (idleTime > 30) { // 20 minutes
          window.location.reload();
      }
  }

    $('#exitsrc').hide();
})
var elem = document.getElementById("myFullscreen");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
  $('#fullsrc').hide();
  $('#exitsrc').show();
  document.body.style.backgroundImage   = "url('{{$base_path}}/{{$selected_feedback_question ? $selected_feedback_question->question_form_background : ''}}')"
  document.body.style.backgroundColor  = "<?php echo $selected_feedback_question ? $selected_feedback_question->question_background_color : ''; ?>"
}
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
  $('#fullsrc').show();
  $('#exitsrc').hide();
}
    </script>
    <style type="text/css" media="screen">
      .inner_body {
        height: auto;
        display: block;
        width: 100%;
      }

      .only_question_1 .logo-img {
        padding: 10px 0;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve ul li {
        width: 19%;
        position: relative;
        margin: 0px;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve ul li:first-child a,
      .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(5) a {
        position: relative;
        top: -50px;
        left: 0;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(2) a,
      .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(4) a {
        position: relative;
        top: 100px;
        left: 0;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
        position: relative;
        top: 220px;
        left: 0;
      }

      /* .only_question_1 .innner_question_ans .images.single_line_curve {height: 400px;} */
      .only_question_1 .innner_question_ans .images.single_line_curve.large ul li img {
        width: 100%;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve.medium ul li img {
        width: 75%;
      }

      .only_question_1 .innner_question_ans .images.single_line_curve.small ul li img {
        width: 60%;
      }

      .innner_question_ans button {
        position: fixed;
        top: 20px;
        right: 70px;
      }

      .only_question_1 .innner_question_ans .images.zig_zag ul li {
        width: 19%;
        position: relative;
        margin: 0px;
      }

      .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
      .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
        position: relative;
        top: 200px;
        left: 0;
      }

      .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(2) a,
      .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(4) a {
        position: relative;
        top: 0px;
        left: 0;
      }

      .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a {
        position: relative;
        top: 200px;
        left: 0;
      }

      .only_question_1 .innner_question_ans .images.zig_zag .large ul li img {
        width: 100%;
      }

      .only_question_1 .innner_question_ans .images.zig_zag .medium ul li img {
        width: 75%;
      }

      .only_question_1 .innner_question_ans .images.zig_zag .small ul li img {
        width: 60%;
      }

      .innner_question_ans button {
        position: fixed;
        top: 20px;
        right: 70px;
      }

      .only_question_1 .innner_question_ans .images.without_curve ul li {
        width: 18%;
        position: relative;
      }

      .only_question_1 .innner_question_ans .images.without_curve.large ul li img {
        width: 90%;
      }

      .only_question_1 .innner_question_ans .images.without_curve.medium ul li img {
        width: 80%;
      }

      .only_question_1 .innner_question_ans .images.without_curve.small ul li img {
        width: 70%;
      }

      .only_question_1 .innner_question_ans .images ul li span {
        font-size: 30px;
      }

      .overlay_img {
        position: fixed;
        height: 100vh;
        top: 0;
        z-index: 1;
        width: 100%;
      }

      .overlay_img+.inner_body {
        position: relative;
        top: 0;
        z-index: 1050;
      }

      .model_question.complain_form input[type=radio] {}

      .model_question.complain_form .radio label {
        background: #e5efe7;
        padding: 20px;
        cursor: pointer;
        border-radius: 6px;
        border: 1px solid #4d928a;
        box-shadow: 4px 4px 3px rgba(0, 0, 0, 0.23);
        font-size: 18px;
        width: 100%;
        margin-bottom: 20px;
        color: #000;
        text-align: right;
      }

      .model_question.complain_form .radio label:hover,
      .model_question.complain_form .radio label:focus,
      .model_question.complain_form .radio label.active {
        background: #c2efea
      }

      .gl-star-rating.gl-star-rating-rtl {
        display: inline-block;
      }

      .gl-star-rating-stars {
        height: inherit;
        margin-bottom: 40px;
      }

      .gl-star-rating-stars span,
      .gl-star-rating-stars.s10 span,
      .gl-star-rating-stars.s20 span,
      .gl-star-rating-stars.s30 span,
      .gl-star-rating-stars.s40 span,
      .gl-star-rating-stars.s50 span {
        position: relative;
      }

      .gl-star-rating-stars.s0+.gl-star-rating-text {
        display: none
      }

      .gl-star-rating-rtl[data-star-rating] .gl-star-rating-text:before {
        left: unset;
        top: -25px;
        right: 10px;
        border-width: 11px 10px 14px 10px;
        border-color: transparent transparent #ffb900 transparent;
      }

      .gl-star-rating-stars.s10+.gl-star-rating-text {
        position: absolute;
        left: 76%;
        top: 100%;
        background: #ffb900;
        color: #000;
        font-size: 20px;
        padding: 5px 16px;
        height: auto;
      }

      .gl-star-rating-stars.s20+.gl-star-rating-text {
        position: absolute;
        left: 60%;
        top: 82%;
        background: #ffb900;
        color: #000;
        font-size: 20px;
        padding: 5px 16px;
        height: auto;
      }

      .gl-star-rating-stars.s30+.gl-star-rating-text {
        position: absolute;
        left: 37%;
        top: 82%;
        background: #ffb900;
        color: #000;
        font-size: 20px;
        padding: 5px 16px;
        height: auto;
      }

      .gl-star-rating-stars.s40+.gl-star-rating-text {
        position: absolute;
        left: 19%;
        top: 82%;
        background: #ffb900;
        color: #000;
        font-size: 20px;
        padding: 5px 16px;
        height: auto;
      }

      .gl-star-rating-stars.s50+.gl-star-rating-text {
        position: absolute;
        left: -4%;
        top: 100%;
        background: #ffb900;
        color: #000;
        font-size: 20px;
        padding: 5px 16px;
        height: auto;
      }

      .gl-star-rating-stars span:before {
        font-size: 20px;
        position: absolute;
        top: 100%;
        background: transparent;
        color: #fff;
        left: 20%;
        padding: 0 12px;
      }

      .gl-star-rating-stars span:first-child:before {
        content: 'Low';
      }

      .gl-star-rating-stars span:nth-child(5):before {
        content: 'High';
      }

      .large .gl-star-rating-stars span {
        width: 125px !important;
        height: 125px !important;
        background-size: 100% !important;
      }

      .medium .gl-star-rating-stars span {
        width: 100px !important;
        height: 100px !important;
        background-size: 100% !important;
      }

      .small .gl-star-rating-stars span {
        width: 75px !important;
        height: 75px !important;
        background-size: 100% !important;
      }

      @media (max-width: 1787px) {
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          top: 190px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
          top: 190px;
        }
      }

      @media (max-width: 1600px) {

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(2) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(4) a {
          top: 70px;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          top: 140px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
          top: 140px;
        }
      }

      @media (max-width: 1366px) {

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:first-child a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(5) a {
          top: -20px;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          top: 160px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
          top: 160px;
        }
      }

      @media (max-width: 1152px) {

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(2) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(4) a {
          top: 110px;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          top: 220px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
          top: 220px;
        }
      }

      @media (max-width: 1028px) {
        .inner_bg {
          width: 100%;
        }

        .only_question_1 .innner_question_ans .images.without_curve ul li {
          width: 17%;
        }
      }

      @media (max-width: 800px) {
        .large .gl-star-rating-stars span {
          width: 100px !important;
          height: 100px !important;
        }

        .medium .gl-star-rating-stars span {
          width: 75px !important;
          height: 75px !important;
        }

        .small .gl-star-rating-stars span {
          width: 50px !important;
          height: 50px !important;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(5) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:first-child a {
          position: relative;
          top: -70px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(2) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(4) a {
          position: relative;
          top: 20px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          position: relative;
          top: 85px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve.large ul li img {
          width: 100%;
        }

        .only_question_1 .innner_question_ans .images ul li span {
          font-size: 25px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag.large ul li img {
          width: 100%;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a {
          top: 200px;
        }
      }

      @media (max-width: 767px) {
        .only_question_1 .innner_question_ans .images.without_curve ul li {
          width: 16.5%;
        }

        .only_question_1 .innner_question_ans .images ul li {
          margin-left: 10px;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(5) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:first-child a {
          position: relative;
          top: -20px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(2) a,
        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(4) a {
          position: relative;
          top: 90px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li:nth-child(3) a {
          position: relative;
          top: 190px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(5) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:first-child a {
          position: relative;
          top: -20px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(2) a,
        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(4) a {
          position: relative;
          top: 90px;
          left: 0;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li:nth-child(3) a {
          position: relative;
          top: 190px;
          left: 0;
        }
      }

      @media (max-width: 640px) {
        /* .only_question_1 .innner_question_ans .images.single_line_curve { height: 200px; margin-top: 30px;} */
      }

      @media (max-width: 568px) {
        .large .gl-star-rating-stars span {
          width: 80px !important;
          height: 80px !important;
        }

        .medium .gl-star-rating-stars span {
          width: 55px !important;
          height: 55px !important;
        }

        .small .gl-star-rating-stars span {
          width: 30px !important;
          height: 30px !important;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li {
          margin: 0px 6px 38px;
          width: 30%;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li a {
          top: 0px !important;
        }

        .innner_question_ans button {
          position: relative;
          top: 20px;
          right: auto;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li {
          margin: 0px 6px 38px;
          width: 30%;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li a {
          top: 0px !important;
        }

        .innner_question_ans button {
          position: relative;
          top: 20px;
          right: auto;
        }
      }

      @media (max-width: 480px) {
        .large .gl-star-rating-stars span {
          width: 65px !important;
          height: 65px !important;
        }

        .medium .gl-star-rating-stars span {
          width: 45px !important;
          height: 45px !important;
        }

        .small .gl-star-rating-stars span {
          width: 45px !important;
          height: 45px !important;
        }

        .gl-star-rating-stars span:before {
          font-size: 14px;
          left: 10%;
        }

        .gl-star-rating-text {
          display: none;
        }

        .only_question_1 .innner_question_ans .images.without_curve ul li {
          width: 16%;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li {
          width: 29%;
        }

        .innner_question_ans h4 {
          font-size: 30px !important;
        }

        .only_question_1 .innner_question_ans .images ul li span {
          font-size: 20px;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li {
          width: 29%;
        }
      }

      @media (max-width: 360px) {
        .large .gl-star-rating-stars span {
          width: 45px !important;
          height: 45px !important;
        }

        .medium .gl-star-rating-stars span {
          width: 45px !important;
          height: 45px !important;
        }

        .small .gl-star-rating-stars span {
          width: 45px !important;
          height: 45px !important;
        }

        .only_question_1 .innner_question_ans .images ul li {
          width: 13%;
        }

        .only_question_1 .innner_question_ans .images.single_line_curve ul li {
          width: 28%;
        }

        .only_question_1 .innner_question_ans .images.without_curve ul li {
          width: 15.5%;
        }

        .only_question_1 .innner_question_ans .images.zig_zag ul li {
          width: 28%;
        }

      }
    </style>

</body>

</html>