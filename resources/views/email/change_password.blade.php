<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Fitness App - Change Password Form</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="" />
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">

    <!-- CSS code from Bootply.com editor -->

    <style type="text/css">
    #password_error{
        color: red;
    }
    </style>
</head>

<!-- HTML code from Bootply.com editor -->

<body>
   <form method="post" action="{{route('change_new_password')}}">
   <input type="hidden" name="_token" value="{{csrf_token()}}" >
   <input type="hidden" name="pass_token" value="{{$pass_token}}" >

    <div class="modal" id="password_modal">
        <div class="modal-header">
            <h3>Change Password <span class="extra-title muted"></span></h3>
        </div>
        <div id="message">
              @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                {!! session('message.content') !!}
                </div>
            @endif
        </div>
        <div class="modal-body form-horizontal">
            <div class="control-group">
                <label for="new_password" class="control-label">New Password</label>

                <div class="controls">
                    <input name="new_password" type="password">
                    <br>
                    <span id="password_error" class="text-danger">{{ $errors->first('new_password') }}</span>
                </div>
                 
            </div>
            <div class="control-group">
                <label for="confirm_password" class="control-label">Confirm Password</label>
                <div class="controls">
                    <input name="confirm_password" type="password">
                    <br>
                    <span id="password_error" class="text-danger">{{ $errors->first('confirm_password') }}</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#" class="btn btn-primary" id="password_modal_save">Save changes</button>
        </div>
    </div>

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type='text/javascript' src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

    <!-- JavaScript jQuery code from Bootply.com editor  -->

    <script type='text/javascript'>
        $(document).ready(function() {


        });
    </script>

</body>

</html>