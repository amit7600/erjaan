<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    <style>
        .login_page_card.auth-layout-wrap .auth-content {
            min-width: 300px;
            /* max-width: 400px;*/
        }

        .login_page_card .auth-logo img {
            width: 100px;
            height: auto;
        }

        .login_page_card .title_login {
            text-align: center
        }

        .login_page_card .checkbox_area {
            padding-top: 32px;
        }

        .button_register {
            width: 100%;
            text-align: -moz-center;
            text-align: -webkit-center;
        }

        .button_register button,
        .button_register a {
            width: 50%;
        }
    </style>
</head>

<body class="text-left">
    <div class="auth-layout-wrap login_page_card" style="background-image: url(./assets/images/photo-wide-4.jpg)">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div class="auth-content" id="wrapper">
            <div class="card o-hidden" id="login">
                <div class="row">
                    <form method="post" action="{{route('repairmen_register')}}">

                        <div class="col-md-12">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="{{asset('admin_css/assets/logo/logo.png')}}" alt="">
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
                                <h1 class="mb-3 text-18 title_login">{{__('message.register')}} </h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">{{__('message.email_address')}}</label>
                                            <input type="text" name="email" class="form-control form-control-rounded"
                                                placeholder="{{__('message.email')}}" required=""
                                                value="{{ Input::old('email') }}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">{{__('message.password')}}</label>
                                            <input type="password" name="password"
                                                class="form-control form-control-rounded"
                                                placeholder="{{__('message.password')}}" required="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">{{__('message.full_name')}}</label>
                                            <input type="text" name="name" class="form-control form-control-rounded"
                                                placeholder="{{__('message.full_name')}}" required=""
                                                value="{{ Input::old('name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">{{__('message.business_name')}}</label>
                                            <input type="text" name="business_name"
                                                class="form-control form-control-rounded"
                                                placeholder="{{__('message.business_name')}}" required=""
                                                value="{{ Input::old('business_name') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">{{__('message.mobile_number')}}</label>
                                            <input type="text" name="mobile_number"
                                                class="form-control form-control-rounded"
                                                placeholder="{{__('message.mobile_number')}}" required=""
                                                value="{{ Input::old('mobile_number') }}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">{{__('message.city')}}</label>
                                            <input type="text" name="city" class="form-control form-control-rounded"
                                                placeholder="{{__('message.city')}}" required=""
                                                value="{{ Input::old('city') }}" />
                                        </div>
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="device_type" value="Web">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="password">{{__('message.select_country')}}</label>
                                        <select class="select2_group form-control" id="country" name="country">
                                            <option value="0">{{__('message.select_country')}}
                                            </option>
                                            @foreach ($country as $row)
                                            <option value="{{ $row->id }}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-sm-6"> 
                                        <label for="password">Select Country</label>       
                                            <input type="checkbox" id="select-all-participant">
                                            <span class="checkmark"></span>
                                    </div> -->
                                    <div class="col-sm-6 checkbox_area">
                                        <label class="checkbox checkbox-primary">
                                            <input type="checkbox" name="terms_condition"
                                                required="">{{__('message.agree_term_condition')}}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="button_register">
                                    <button
                                        class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text">{{__('message.register')}}</button>
                                    <a href="{{ route('admin') }} "
                                        class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook mb-4">{{__('message.login')}}</a>
                                </div>
                                <div style="text-align: center;">
                                    <span> ©{{ date('Y')}} All rights reserved
                                        {{__('message.privacy_term')}}</span>
                                </div>
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