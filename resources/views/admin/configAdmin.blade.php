<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__('message.digital_survey')}}</title>
    <!-- Bootstrap core CSS -->

    <link href="{{asset('admin_css/assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin_css/assets/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}"
        rel="stylesheet">
    <link href="{{asset('admin_css/assets/gentelella/vendors/animate.css')}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{asset('admin_css/assets/gentelella/vendors/custom.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <script src="{{asset('admin_css/assets/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>

    <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->


</head>

<body style="background:#ffffff;">

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <!-- <form method="post" action="{{route('admin_config')}}"> -->
                    {!!Form::open(['route' => 'admin_config'])!!}
                    @if(isset($errors) && count($errors) > 0)
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="user_name" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.username')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.email')}} {{__('message.for')}} {{__('message.login')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @if ($errors->has('password'))
                        <div style="color: red;">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.database')}} {{__('message.password')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success ">
                            <input type="reset" class="btn btn-danger ">
                        </div>
                    </div>
                    <!-- <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <p>©{{ date('Y')}} All Rights Reserved. Privacy and Terms</p>
                                </div>
                            </div> -->
                    {!! Form::close() !!}
                    <!-- form -->
                </section>
                <!-- content -->
            </div>

        </div>
    </div>
</body>

<style>
    .login_content {
        margin: 0 auto;
        padding: 0px 10px 10px 10px;
        position: relative;
        text-align: center;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
        min-width: 280px;
        border: 1px solid #e6e6e6;
        background: #efefef;
    }

    .btn,
    .login_content form input[type="submit"] {
        width: 100%;
        margin: 0px;
        margin-bottom: 10px;
    }

    .login_content form {
        margin: 20px 0 0px;
    }

    .login_content form input[type="text"] {
        box-shadow: none;
        height: 40px;
    }
</style>

</html>