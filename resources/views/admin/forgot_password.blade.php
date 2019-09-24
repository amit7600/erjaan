<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <style>
        .main_forgot .bg_forgot {
            background-size: 50%;
            background-repeat: no-repeat;
            background-image: url(./assets/images/photo-long-3.jpg);
            background-position: 96% 2%;

        }

        .login_page_card .auth-logo img {
            width: 100px;
            height: auto;
        }

        .forgot_footer {
            padding-left: 32px;
            font-size: 15px;
            padding-bottom: 10px;
        }

        .login_page_card .title_login {
            text-align: center
        }
    </style>
</head>

<body class="text-left">
    <div class="auth-layout-wrap login_page_card main_forgot"
        style="background-image: url(./assets/images/photo-wide-4.jpg)">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div class="auth-content" id="wrapper">
            <div class="card o-hidden" id="login">
                <form method="post" action="{{route('forgotPasswordRequest')}}">
                    <div class="row">
                        <div class="col-md-12 bg_forgot">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="p-4">
                                        <div class="auth-logo text-center mb-4">
                                            <img src="{{asset('admin_css/assets/logo/logo.png')}}" alt="">
                                        </div>
                                        @if(count($errors) > 0)
                                        @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            {{$error}}
                                        </div>
                                        @break
                                        @endforeach
                                        @elseif (Session::has('error_msg'))
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            {{Session::get('error_msg')}}
                                        </div>
                                        @endif

                                        @if(session()->has('message.level'))
                                        <div class="horizontal-center alert alert-{{ session('message.level') }}">
                                            <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            {!! session('message.content') !!}
                                        </div>
                                        @endif
                                        <h1 class="mb-3 text-18 title_login">{{__('message.recover')}}
                                            {{__('message.password')}} </h1>
                                        <div class="form-group">
                                            <label for="email">{{__('message.email_c')}} {{__('message.address')}}</label>

                                            <input type="text" name="email" class="form-control form-control-rounded"
                                                placeholder="{{__('message.email_c')}}" required="" />
                                        </div>
                                        <div class="mb-4">
                                            <button
                                                class="btn btn-rounded btn-primary btn-block mt-2 submit">{{__('message.submit')}}</button>

                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="device_type" value="Web">

                                    </div>
                                </div>
                                <div class="col-md-6 text-center ">
                                    <div class="pr-3 auth-right">
                                        <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
                                            href="{{route('admin')}}">
                                            {{__('message.login')}}
                                        </a>
                                        <a class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook"
                                            href="{{route('getRegister')}}">
                                            {{__('message.register')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="forgot_footer">
                                    <span> ©{{ date('Y')}} {{__('message.all_right_reserved')}}.
                                        {{__('message.privacy_term')}}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
</body>

</html>