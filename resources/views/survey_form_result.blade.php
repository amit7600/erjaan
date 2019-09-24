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

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' type='text/css'>

    <link href="{{asset('admin_css/assets/star-rating/star-rating.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/front/css/font-awesome.css')}}" rel="stylesheet">
</head>
<body>
<header>
   <div class="container">
      <div class="logo-img">
        <img src="{{$base_path}}<?php echo ($survey_form_data[0]->survey_form_logo)? $survey_form_data[0]->survey_form_logo:'admin_css/assets/front/img/logo.jpg'; ?>" style="height: 100px;">
        <!-- <img src="{{asset('admin_css/assets/front/img/logo.jpg')}}" alt="logo"> -->
      </div>
   </div>
</header>

<div class="content"> 
    

    <div class="main_heading">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
                <h2><?php echo ($survey_form_data[0]->survey_form_header)?$survey_form_data[0]->survey_form_header:""; ?></h2>
            </div>
          </div>
        </div>
    </div>
    <div class="green-head">
        <div class="container">
            <div class="row">
               <div class="col-sm-12">
                <h3><?php echo ($survey_form_data[0]->survey_form_title)?$survey_form_data[0]->survey_form_title:""; ?></h3>
               </div>
            </div>
        </div>
    </div>
    <div class="form-section">  
        <div class="container"> 
            @if(session()->has('message.level'))
            <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                {!! session('message.content') !!}
            </div>
            @endif
            <div style="text-align:center;height:122px;font-size:25px;"> {{ $setting_data->setting_value }} </div>
        </div>          
    </div>  
</div>

<footer>
    <div class="container"> 
       <p><?php echo ($survey_form_data[0]->survey_form_footer)?$survey_form_data[0]->survey_form_footer:""; ?></p>
       <p>Copyright <?php echo date('Y'); ?>. All Rights Reserved </p>
    </div>
</footer>

</body>
</html>
