<!DOCTYPE html>
@php
    $dir = $language == 'en' ? 'ltr' : 'rtl';
@endphp
<html lang="en" dir="{{$dir}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
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
    <div class="auth-layout-wrap login_page_card" style="background-image: url({{$background}})">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div class="auth-content" id="wrapper">
            <div class="card o-hidden" id="login">
                <div class="row">
                    <form method="post" action="{{route('admin_login')}}">
                        <div class="col-md-12">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="{{asset($logo)}}" alt="">
                                </div>
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
                                <h1 class="mb-3 text-18 title_login">{{__('message.login')}} </h1>

                                <div class="form-group">
                                    <label for="email">{{__('message.email')}} {{__('message.address')}}</label>
                                    <input type="text" name="email" class="form-control form-control-rounded"
                                        placeholder="{{__('message.email')}}" required="" />
                                </div>
                                <div class="form-group">
                                    <label for="password">{{__('message.password')}}</label>
                                    <input type="password" name="password" class="form-control form-control-rounded"
                                        placeholder="{{__('message.password')}}" required="" />
                                </div>
                                <button
                                    class="btn btn-rounded btn-primary btn-block mt-2 submit">{{__('message.login')}}</button>
                                <div class="mt-3 mb-3 text-center">
                                    <a href="{{route('forgotPassword')}}" class="text-muted"><u>{{__('message.forgot')}}
                                            {{__('message.password')}}?</u></a>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="device_type" value="Web">
                                <span> ©{{ date('Y')}} {{__('message.all_right_reserved')}}
                                    {{__('message.privacy_term')}}</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
</body>

</html>