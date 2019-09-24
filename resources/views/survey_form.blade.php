<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('admin_css/assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/front/css/responsive.css')}}" rel="stylesheet">
    <script src="{{asset('admin_css/assets/front/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/front/js/bootstrap.min.js')}}"></script>

    <style type="text/css">
        .participantDetails {
            background: #4ea7a2;
            padding-left: 14%;
            font-size: 17px;
            color: white;
            font-weight: bold;
            padding-top: 1%;
            height: 53px;
        }
    </style>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' type='text/css'>

    <link href="{{asset('admin_css/assets/star-rating/star-rating.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/front/css/font-awesome.css')}}" rel="stylesheet">
</head>

<body class="<?php echo ($survey_form_data[0]->form_language_type==2)? 'arabic_lang':''; ?>" style="background: <?php if($survey_form_data[0]->survey_background_image && file_exists(public_path($survey_form_data[0]->survey_background_image))){?>url(/{{$survey_form_data[0]->survey_background_image}}) <?php } else {?> {{$survey_form_data[0]->survey_background_color}}<?php } ?>; background-size: cover; background-repeat: no-repeat;background-attachment: fixed !important;">
    <header>
        <div class="container">
            <div class="logo-img">
                <!-- <img src="{{$base_path}}<?php //echo ($survey_form_data[0]->survey_form_logo)? $survey_form_data[0]->survey_form_logo:'public/uploads/nophoto.png';    ?>"> -->
                @if(file_exists($survey_form_data[0]->survey_form_logo) && $survey_form_data[0]->survey_form_logo)
                <img src="{{$base_path.$survey_form_data[0]->survey_form_logo}}" style="height: 100px;margin-top: 10px;"
                    alt="logo">
                @else
                {{-- <img src="{{asset('admin_css/assets/front/img/logo.jpg')}}" alt="logo"> --}}
                @endif
            </div>
        </div>
    </header>

    <div class="content">
        @if(session()->has('message.level'))
        <div class="horizontal-center alert alert-{{ session('message.level') }}">
            <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! session('message.content') !!}
        </div>
        @endif

        <div class="main_heading">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <h2
                            style="font-size: {{$survey_form_data[0]->survey_header_font_size}}; color: {{ $survey_form_data[0]->survey_header_color}};">
                            <?php echo ($survey_form_data[0]->survey_form_header) ? $survey_form_data[0]->survey_form_header : ""; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <?php if ($onbhalf_id == 1) { ?>
            <p class="participantDetails">
                <?php
                        echo 'Survey Form For : ' . $first_name . ' ' . $last_name;
                    }
                    ?></p>
        </div>
        <div class="green-head" style="background-color: {{ $survey_form_data[0]->survey_title_background_color}}">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3
                            style="font-size: {{$survey_form_data[0]->survey_title_font_size}}; color: {{ $survey_form_data[0]->survey_title_color}};">
                            <?php echo ($survey_form_data[0]->survey_form_title) ? $survey_form_data[0]->survey_form_title : ""; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-section">
            <div class="container">
                <form name="survey_form" id="surveyForm" method="post" action="{{route('submit_survey_form')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="submitted_by" value="{{ $submitted_by }}">
                    <input type="hidden" name="surveyFormId" value="<?php echo Request::segment(2); ?>">
                    <!--                        <input type="hidden" name="participantId" value="<?php //echo Request::segment(3); ?>">
                        <input type="hidden" name="survey_token" value="<?php //echo Request::segment(4); ?>">-->
                    <input type="hidden" name="participantId" value="<?php echo $participant_id; ?>">
                    <input type="hidden" name="survey_token" value="<?php echo $token; ?>">
                    <?php
                        $question = 1;
                        foreach ($survey_form_data as $s) {
                            foreach ($s->survey_questions as $survey_form) {
                                
                                ?>

                    <div class="sep-row">
                        <input type="hidden" name="survey_question_id[]" value="<?php echo $survey_form->id; ?>">
                        <input type="hidden" name="survey_question[]"
                            value="<?php echo $survey_form->survey_question; ?>">
                        <input type="hidden" name="question_type[]" value="<?php echo $survey_form->question_type; ?>">
                        <h4 style="font-size:{{$survey_form->size}}; color:{{$survey_form->color}};">
                            <?php echo "<strong>" . $question . ".</strong> "; ?>
                            <?php echo ($survey_form->survey_question) ? $survey_form->survey_question : ""; ?></h4>

                        <?php if ($survey_form->question_type == 1) { ?>
                        <div class="radio-box">
                            <?php foreach ($survey_form->question_options as $survey_option) { ?>
                            <div class="margin_top">
                                <input type="radio" id="q_option_<?php echo $survey_option->id; ?>"
                                    name="q_option_<?php echo $survey_form->id; ?>"
                                    value="<?php echo ($survey_option->survey_option_title) ? $survey_option->survey_option_title : ""; ?>">
                                <label for="q_option_<?php echo $survey_option->id; ?>"
                                    class="radio_heading"><?php echo ($survey_option->survey_option_title) ? $survey_option->survey_option_title : ""; ?></label>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                                    }

                                    if ($survey_form->question_type == 2) {
                                        ?>
                        <div class="check-box">
                            <?php foreach ($survey_form->question_options as $survey_option) { ?>
                            <div class="margin_top">
                                <input type="hidden" name="option_id[]"
                                    value="<?php echo ($survey_option->id) ? $survey_option->id : ""; ?>">
                                <input type="checkbox" id="check_<?php echo $survey_option->id; ?>"
                                    name="q_option_<?php echo $survey_form->id; ?>[]"
                                    value="<?php echo ($survey_option->survey_option_title) ? $survey_option->survey_option_title : ""; ?>">
                                <label for="check_<?php echo $survey_option->id; ?>"
                                    class="check_heading"><?php echo ($survey_option->survey_option_title) ? $survey_option->survey_option_title : ""; ?></label>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                                    }

                                    if ($survey_form->question_type == 3) {
                                        ?>
                        <div class="margin_top">
                            <input type="hidden" name="option_id[]"
                                value="<?php echo ($survey_form->id) ? $survey_form->id : ""; ?>">
                            <input type="text" class="form-control text-small"
                                name="q_option_<?php echo $survey_form->id; ?>[]">
                        </div>
                        <?php
                                    }

                                    if ($survey_form->question_type == 4) {
                                        ?>
                        <div class="margin_top">
                            <input type="hidden" name="option_id[]"
                                value="<?php echo ($survey_form->id) ? $survey_form->id : ""; ?>">
                            <textarea class="form-control text-big"
                                name="q_option_<?php echo $survey_form->id; ?>[]"> </textarea>
                        </div>
                        <?php
                                    }

                                    if ($survey_form->question_type == 5) {
                                        ?>
                        <input type="hidden" name="option_id[]"
                            value="<?php echo ($survey_form->id) ? $survey_form->id : ""; ?>">
                        <div class="form-field margin_top">
                            <select id="glsr-ltr" class="star-rating rating-list"
                                name="q_option_<?php echo $survey_form->id; ?>[]">
                                <option value="">Select a rating</option>
                                <option value="5">Fantastic</option>
                                <option value="4">Great</option>
                                <option value="3">Good</option>
                                <option value="2">Poor</option>
                                <option value="1">Terrible</option>
                            </select>
                        </div>
                        <?php } 
                                    if ($survey_form->question_type == 6) {
                                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="images radio_rating_imogi">
                                    <ul>
                                        <li>
                                            <label class="radio-inline">
                                                <img src="{{$base_path.$survey_form->emoji_rating_1}}" alt="" title=""
                                                    id="emoji_<?php echo $survey_form->id; ?>_1" class="emoji_msm">
                                                <input type="radio" value="1"
                                                    id="emoji_<?php echo $survey_form->id; ?>_1"
                                                    name="q_option_<?php echo $survey_form->id; ?>[]"
                                                    onclick="fun_getvalue(this.id,<?php echo $survey_form->id; ?>)">
                                            </label>
                                            <span style="color: #000000">{{$survey_form->emoji_name_1}}</span>
                                        </li>
                                        <li>
                                            <label class="radio-inline">
                                                <img src="{{$base_path.$survey_form->emoji_rating_2}}" alt="" title=""
                                                    id="emoji_<?php echo $survey_form->id; ?>_2" class="emoji_msm">
                                                <input type="radio" value="2"
                                                    id="emoji_<?php echo $survey_form->id; ?>_2"
                                                    name="q_option_<?php echo $survey_form->id; ?>[]"
                                                    onclick="fun_getvalue(this.id,<?php echo $survey_form->id; ?>)">
                                            </label>
                                            <span style="color: #000000">{{$survey_form->emoji_name_2}}</span>
                                        </li>
                                        <li>
                                            <label class="radio-inline">
                                                <img src="{{$base_path.$survey_form->emoji_rating_3}}" alt="" title=""
                                                    id="emoji_<?php echo $survey_form->id; ?>_3" class="emoji_msm">
                                                <input type="radio" value="3"
                                                    id="emoji_<?php echo $survey_form->id; ?>_3"
                                                    name="q_option_<?php echo $survey_form->id; ?>[]"
                                                    onclick="fun_getvalue(this.id,<?php echo $survey_form->id; ?>)">
                                            </label>
                                            <span style="color: #000000">{{$survey_form->emoji_name_3}}</span>
                                        </li>

                                        <li>
                                            <label class="radio-inline">
                                                <img src="{{$base_path.$survey_form->emoji_rating_4}}" alt="" title=""
                                                    id="emoji_<?php echo $survey_form->id; ?>_4" class="emoji_msm">
                                                <input type="radio" value="4"
                                                    id="emoji_<?php echo $survey_form->id; ?>_4"
                                                    name="q_option_<?php echo $survey_form->id; ?>[]"
                                                    onclick="fun_getvalue(this.id,<?php echo $survey_form->id; ?>)">
                                            </label>
                                            <span style="color: #000000">{{$survey_form->emoji_name_4}}</span>
                                        </li>
                                        <li>
                                            <label class="radio-inline">
                                                <img src="{{$base_path.$survey_form->emoji_rating_5}}" alt="" title=""
                                                    id="emoji_<?php echo $survey_form->id; ?>_5" class="emoji_msm">
                                                <input type="radio" id="emoji_<?php echo $survey_form->id; ?>_5"
                                                    onclick="fun_getvalue(this.id,<?php echo $survey_form->id; ?>)"
                                                    value="5" name="q_option_<?php echo $survey_form->id; ?>[]">
                                            </label>
                                            <span style="color: #000000">{{$survey_form->emoji_name_5}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function fun_getvalue(id,emoji_id){
                                                
                                                for (var i = 1; i <= 5; i++) {
                                                    document.getElementById("emoji_"+emoji_id+"_"+i).style.animation = "";
                                                }
                                                document.getElementById(id).style.animation = "zoom-in-out 1s linear 0s infinite normal";
                                                
                                            }
                        </script>
                        <?php } ?>

                    </div>
                    <!--End sep-row div-->

                    <?php
                                $question++;
                            }
                        }
                        ?>
                    <?php if ($partici_id) { ?>
                    <input class="submit-btn" type="submit" name="surveyform" value="Submit">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p
                style="font-size: {{$survey_form_data[0]->survey_footer_font_size}}; color: {{ $survey_form_data[0]->survey_footer_color}};">
                <?php echo ($survey_form_data[0]->survey_form_footer) ? $survey_form_data[0]->survey_form_footer : ""; ?>
            </p>
            <p>Copyright <?php echo date('Y'); ?>. All Rights Reserved </p>
        </div>
    </footer>

    <script type="text/javascript" src="{{asset('admin_css/assets/star-rating/star-rating.min.js')}}"></script>
    <script type="text/javascript">
        var destroyed = false;
var starratings = new StarRating('.star-rating', {
    onClick: function (el) {
        console.log('Selected: ' + el[el.selectedIndex].value);
    },
});

    </script>
    <style type="text/css">
    header, .sep-row {border-bottom: none;} 
    .form-section {background-color:transparent;box-shadow: none;}
    .main_heading, .content{background-color:transparent;}
        .radio_rating_imogi ul li {
            position: relative;
            display: inline-block;
            width: 18%;
            text-align: center;
            margin: 0 7px;
        }

        .radio_rating_imogi input[type=radio] {
            width: 150px;
            height: 133px;
            position: absolute;
            top: 10px;
            left: 1px;
        }

        @media (max-width: 980px) {
            .container {
                max-width: 100%;
                width: 100%;
            }

            .radio_rating_imogi ul li {
                width: 17%;
            }
        }

        @media (max-width:800px) {
            .gl-star-rating-stars {
                width: 100%;
            }

            .gl-star-rating-stars span {
                width: 15% !important;
                height: 137px !important;
                background-size: 100% !important;
            }
        }

        @media (max-width:600px) {
            .gl-star-rating-stars span {
                height: 100px !important;
            }
        }


        @media (max-width: 568px) {
            .radio_rating_imogi ul li {
                width: 16%;
            }

            .gl-star-rating-stars span {
                height: 82px !important;
            }
        }

        @media (max-width: 414px) {
            .radio_rating_imogi ul li {
                width: 15%;
            }

            body.arabic_lang .gl-star-rating-stars span {
                margin-left: 0px !important;
                margin-right: 15px !important;
            }
        }

        @media (max-width: 360px) {
            .radio_rating_imogi ul li {
                width: 14%;
            }

            .gl-star-rating-stars span {
                width: 14% !important;
                height: 60px !important;
            }
        }
    </style>
</body>

</html>