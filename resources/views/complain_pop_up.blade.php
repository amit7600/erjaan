<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('message.complain')}} {{__('message.pop_up')}}</title>
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <style>
        .login_page_card.auth-layout-wrap .auth-content {
            min-width: 300px;
        }

        .login_page_card .auth-logo img {
            width: 100px;
            height: auto;
        }

        .login_page_card .title_login {
            text-align: center
        }
    </style>
</head>

<body class="text-left">
    <div class="auth-layout-wrap login_page_card" style="background-image: url(../assets/images/photo-wide-4.jpg)">
        <div class="auth-content" id="wrapper">
            <div class="card o-hidden" id="login">
                <div class="row">
                    {!! Form::open(['route' => 'post_complain']) !!}
                    {!! csrf_field() !!}
                    <div class="col-md-12">
                        <h1 class="mb-0 p-3 text-18 title_login"
                            style="background-color: {{$complain_header_color}}; color:#fff;">
                            {{$selected_feedback_question ? $selected_feedback_question->complain_title : 'Complain'}}
                        </h1>
                        <div class="p-4">
                            @if(count($errors) > 0)
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{$error}}
                            </div>
                            @break
                            @endforeach
                            @elseif (Session::has('error_msg'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{Session::get('error_msg')}}
                            </div>
                            @endif

                            @if(session()->has('message.level'))
                            <div class="horizontal-center alert alert-{{ session('message.level') }}">
                                <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {!! session('message.content') !!}
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email">{{$name_label}}</label>
                                {!! Form::text('name',null,['class' => 'form-control form-control-rounded','id' =>
                                'name', 'placeholder' => $name_label]) !!}
                            </div>
                            <div class="form-group">
                                <label for="password">{{$email_label}}</label>
                                <p id="email_p" style="margin-bottom: 0px;"></p>
                                {!! Form::email('email',null,['class' => 'form-control form-control-rounded','id' =>
                                'email', 'placeholder' => $email_label]) !!}
                            </div>
                            <div class="form-group">
                                <label for="email">{{$number_label}}</label>
                                {!! Form::text('number',null,['class' => 'form-control form-control-rounded','id' =>
                                'number', 'placeholder' => $number_label]) !!}
                            </div>
                            <div class="form-group">
                                <label for="password">{{$comment_label}}</label>
                                <p id="comment_label" style="margin-bottom: 0px;"></p>
                                {!! Form::textarea('comment',null,['class' => 'form-control','id' => 'commentd',
                                'rows' => '5', 'placeholder' => $comment_label]) !!}
                            </div>

                            <button type="submit"
                                style="background-color: {{$complain_button_color}}; border-color: {{$complain_button_color}};font-size: 16px;color: #fff;line-height: initial;"
                                class="btn btn-rounded btn-block mt-2 submit"><i class="i-Paper-Plane"
                                    style="font-size: 20px; color:#fff;"></i>
                                {{__('message.send')}}</button>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
</body>

</html>