<?php  
// if(empty($_SERVER['REDIRECT_SCRIPT_URI'])){
//     $_SERVER['REDIRECT_SCRIPT_URI'] = $_SERVER['REDIRECT_URL'];
// }
// dd($errors);
?>
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

    <link href="{{asset('assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/gentelella/vendors/animate.css/animate.css')}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{asset('assets/gentelella/vendors/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <script src="{{asset('assets/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>

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

        <div id="loader">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <!-- <form method="post" action="{{route('database_config')}}"> -->
                    {!!Form::open(['route' => 'database_config'])!!}
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
                            <input type="text" name="database" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.database')}} {{__('message.name')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.database')}} {{__('message.username')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" name="password" class="form-control"
                                placeholder="{{__('message.enter')}} {{__('message.your')}} {{__('message.database')}} {{__('message.password')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="submit" id="submit" value="{{__('message.submit')}}" class="btn btn-success ">
                            <input type="reset" value="{{__('message.reset')}}" class="btn btn-danger ">
                        </div>
                    </div>
                    <!-- <div class="clearfix"></div> -->
                    <!-- <div class="separator">
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
<script>
    $(document).ready(function(){
            $('#submit').on('click',function(){
                $(this).val('{{__('message.please')}} {{__('message.wait')}}....')
                $(this).addClass('disabled')
                $('#loader').addClass('gooey')
            })
        })
</script>
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

    .gooey {
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        margin: 0;
        background: rgba(247, 247, 247, 0.4);
        /* filter: contrast(20); */
        position: absolute;
        z-index: 30;
        text-align: center;
    }

    .gooey .dot {
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 46%;
        /* filter: blur(4px); */
        background: #000;
        border-radius: 50%;
        transform: translateX(0);
        animation: dot 2.8s infinite;
    }

    .gooey .dots {
        transform: translateX(0);
        animation: dots 2.8s infinite;
        position: absolute;
        top: 50%;
        left: 46%;
    }

    .gooey .dots span {
        display: block;
        float: left;
        width: 16px;
        height: 16px;
        margin-left: 16px;
        /* filter: blur(4px); */
        background: #000;
        border-radius: 50%;
    }

    @-moz-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @-webkit-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @-o-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }
</style>

</html>