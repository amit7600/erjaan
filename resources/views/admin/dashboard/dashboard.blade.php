<?php
$user = Auth::user();
$role = $user->user_role;
$user_name = DB::table('users')
    ->join('tbl_kpi','users.id','=','tbl_kpi.user_data')
    ->select('users.name')
    ->first();
    $id = Auth::user()->id;

    $permission_data = CommonHelper::getUserPermissionData();
    // dd($permission_data);
?>
@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!-- <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/> -->
@stop
{{-- Page content --}}
@section('inner_body')

<style type="text/css">
    .survey_title {
        font-size: 29px;
        margin: 0 auto;
        margin-left: 0%;
        width: 100%;
        /*padding-left: 45%;*/
        font-weight: bold;
        background-color: #73879C;
        color: white;
        height: 50px;
        padding-top: 0%;
        text-align: center;
    }

    .myoption {
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }

    .highcharts-credits {
        display: none;
    }

    .noRecord {
        background-color: #73879C;
        color: #fff;
        font-weight: bolder;
        margin-left: 1%;
        text-align: center;
        width: 100%;
        position: absolute;
        z-index: 999;
        padding: 1%;
        margin-top: 0%;
        font-size: 17px;
        border: 1px solid #cccccc;
    }

    .ami {
        background-color: #6633986b;
        color: #000;
        font-weight: normal;
        margin-left: 1%;
        text-align: center;
        width: 96%;
        position: absolute;
        z-index: 999;
        padding-top: 1%;
        margin-top: 10%;
        font-size: 15px;
        padding: 13px 0;
        border: 1px solid #cccccc;
        display: inline-block;
        left: 3%;
    }

    .feedback {
        color: #639;
        margin-left: 0%;
        text-align: center;
        width: 100%;
        /*position: absolute;*/
        z-index: 999;
        padding-top: 1%;
        padding: 13px 0;
        border-bottom: 2px solid #663399;
        display: inline-block;
        left: 3%;
        font-size: 18px;
        font-weight: 600;
    }

    .sent {
        background-color: transparent;
        color: #000;
        font-weight: normal;
        margin-left: 0%;
        text-align: center;
        width: 95%;
        position: absolute;
        z-index: 999;
        padding-top: 1%;
        margin-top: 0%;
        font-size: 18px;
        border: 1px solid #f0f0f0;
        bottom: 4%;
        left: 11px;
    }

    .amis {
        color: black;
        font-weight: bolder;
        margin-left: 0;
        text-align: center;
        width: 100%;
        margin-top: 5%;
        font-size: 20px;
    }


    .inner_text_center {
        text-align: center;
    }

    .inner_text_center .col-md-3 {
        margin: 0 auto;
        float: none;
        display: inline-block;
    }

    .horizontal-center.alert.alert-success {
        width: 85%;
        float: left;
        padding: 7px 15px;
    }

    .noRecord.inner_norecord {
        position: relative;
        width: 100%;
        float: left;
        position: relative;
        margin: 10px 0px;
        background-color: #d62727;
    }

    .main_loader {
        text-align: center;
        position: fixed;
        top: 10%;
        width: 88%;
        height: 100vh;
        z-index: 3;
        background: #ffffffb5;
        padding-top: 19%;
    }

    .main_loader .spinner-bubble {
        font-size: 11px;
    }
</style>
{{-- <script src="{{asset('admin_css/assets/js/pie_chart/highcharts.js')}}"></script>
<script src="{{asset('admin_css/assets/js/pie_chart/highcharts-3d.js')}}"></script> --}}

<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
<script src="{{asset('assets/js/es5/echarts.script.min.js')}}"></script>

@if($role == 0 || isset($permission_data->view_dashboard) && $permission_data->view_dashboard == 1 )
<!-- @if(session()->has('message.level'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif -->
{{-- <div class="row">
    <div class="col-lg-12 main_loader loaderShow">
        <div class="spinner-bubble spinner-bubble-primary m-5"></div>
    </div>
</div> --}}
<div class="breadcrumb">
    <h1>{{__('message.dashboard')}}</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <!-- ICON BG -->
    @if($role == 0 || isset($permission_data) && $permission_data->sms == 1)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 p-2">{{__('message.sms_c')}}</h3>
            <div class="card-body text-center">
                <i class="i-Speach-Bubble-4"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">{{__('message.sent')}}</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $sms_count }}</p>
                </div>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">{{__('message.responses')}}</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $sms_response_count }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($role == 0 || isset($permission_data->email) && $permission_data->email == 1)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 p-2">{{__('message.email_c')}}</h3>
            <div class="card-body text-center">
                <i class="i-Email"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">{{__('message.sent')}}</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $email_count }}</p>
                </div>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">{{__('message.responses')}}</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $email_response_count }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($role == 0 || isset($permission_data->sms_balance) && $permission_data->sms_balance == 1)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 p-2">{{__('message.sms_balance')}}</h3>
            <div class="card-body text-center">
                <i class="i-Speach-Bubble-Dialog"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">{{__('message.balance')}}</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $sms_balance }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- complain feedcack start here-->
<div class="row">
    @if($role == 0 || isset($permission_data->complaints_box) && $permission_data->complaints_box == 1)
    <div class="col-md-12">
        <div class="breadcrumb">
            <h1>{{__('message.complain')}}</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card border card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <h3 class="text-center m-0 p-2">{{__('message.inProgress')}}</h3>
                    <div class="card-body text-center">
                        <i class="i-Repeat-21"></i>
                        <div class="content">
                            <p class="text-primary text-40 line-height-1 mb-2">{{ $in_progress }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card border card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <h3 class="text-center m-0 p-2">{{__('message.new')}}</h3>
                    <div class="card-body text-center">
                        <i class="i-Add-File"></i>
                        <div class="content">
                            <p class="text-primary text-40 line-height-1 mb-2">{{ $new }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card border card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <h3 class="text-center m-0 p-2">{{__('message.resolved')}}</h3>
                    <div class="card-body text-center">
                        <i class="i-Arrow-Refresh"></i>
                        <div class="content">
                            <p class="text-primary text-40 line-height-1 mb-2">{{ $resolved }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card border card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <h3 class="text-center m-0 p-2">{{__('message.late')}}</h3>
                    <div class="card-body text-center">
                        <i class="i-Over-Time"></i>
                        <div class="content">
                            <p class="text-primary text-40 line-height-1 mb-2">{{ $late }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @include('dashboard_blade.feedback_responses')
</div>
<!-- complain feedcack  end here-->

<!-- start participant here -->
<div class="row">
    @if($role == 0 || isset($permission_data->new_participant) && $permission_data->new_participant == 1)
    <div class="col-sm-6 col-xs-12 col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title m-0">{{__('message.new_participants')}}</div>
                <p class="text-small text-muted"></p>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Administrator text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.today_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_new_today }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Business-ManWoman text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.weekly_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_new_weekly }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Business-Mens text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.month_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_new_month }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Mens text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.year_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_new_year }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($role == 0 || isset($permission_data->updated_participant) && $permission_data->updated_participant == 1)
    <div class="col-sm-6 col-xs-12 col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title m-0">{{__('message.updated_participants')}}</div>
                <p class="text-small text-muted"></p>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Administrator text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.today_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_update_today }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Business-ManWoman text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.weekly_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_update_weekly }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Business-Mens text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.month_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_update_month }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="p-4 border border-light rounded d-flex align-items-center">
                            <i class="i-Mens text-32 mr-3"></i>
                            <div>
                                <h4 class="text-15 mb-1">{{__('message.year_participant')}}
                                </h4>
                                <span class="text-20">{{ $participant_update_year }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-sm-12">
                
            <div id="echartBar" style="height: 300px;"></div>
            </div> -->
    @endif
</div>
<!-- end participant here -->

@if($role == 0 || isset($permission_data) && $permission_data->kpi_sms_feedback == 1)
<div class="">
    <!-- pie chart begin -->
    @include('dashboard_blade.survey_kpi')
    <!-- pie chart end here -->
</div>
<!--end row div-->
@endif

@if($role == 0 || isset($permission_data) && $permission_data->report_sms_feedback == 1)
<div class="">
    <!-- pie chart begin -->
    @include('dashboard_blade.bar_chart')
    <!-- pie chart end here -->
</div>
<!--end row div-->
@endif

@if($role == 0 || isset($permission_data->participants_list) && $permission_data->participants_list == 1)
<!--Participants List Start-->
@include('dashboard_blade.participant_list')
<!--Participants List End-->
@endif

@if($role == 0 || isset($permission_data) && $permission_data->dashboard_feedback_terminals_2 == 1)
<!-- Feedback terminal chart and kpi here -->
@include('dashboard_blade.feedback')
<!-- Feedback terminal chart end here -->
@endif

@if($role == 0 || $permission_data->dashboard_feedback_terminals_2 == 1)
<!-- Feedback terminal chart and kpi here -->
@include('dashboard_blade.feedback_2')
<!-- Feedback terminal chart end here -->
@endif

@if($role == 0 || $permission_data->dashboard_feedback_terminals_3 == 1)
<!-- Feedback terminal chart and kpi here -->
@include('dashboard_blade.feedback_3')
<!-- Feedback terminal chart end here -->
@endif

@if($role == 0 || $permission_data->dashboard_feedback_terminals_4 == 1)
<!-- Feedback terminal chart and kpi here -->
@include('dashboard_blade.feedback_4')
<!-- Feedback terminal chart end here -->
@endif

@if($role == 0 || $permission_data->dashboard_feedback_terminals_5 == 1)
<!-- Feedback terminal chart and kpi here -->
@include('dashboard_blade.feedback_5')
<!-- Feedback terminal chart end here -->
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_complain_kpi == 1)
<!-- complain chart and kpi is start here -->
@include('dashboard_blade.complain_kpi')
<!-- complain chart and kpi is end here -->
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->complain_status_chart == 1)
<!-- complain chart and kpi is start here -->
@include('dashboard_blade.complain')
<!-- complain chart and kpi is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->reason_kpi_dashboard == 1)
<!-- Reason kpi report is Start here -->
@include('dashboard_blade.reason_kpi')
<!-- Reason kpi report is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_feedback_reason_1 == 1)
<!-- Reason report is Start here -->
@include('dashboard_blade.reason')
<!-- Reason report is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_feedback_reason_2 == 1)
<!-- Reason kpi report is Start here -->
@include('dashboard_blade.reason_2')
<!-- Reason kpi report is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_feedback_reason_3 == 1)
<!-- Reason kpi report is Start here -->
@include('dashboard_blade.reason_3')
<!-- Reason kpi report is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_feedback_reason_4 == 1)
<!-- Reason kpi report is Start here -->
@include('dashboard_blade.reason_4')
<!-- Reason kpi report is end here -->
@endif

@if($role == 0 || isset($permission_data) &&
$permission_data->dashboard_feedback_reason_5 == 1)
<!-- Reason kpi report is Start here -->
@include('dashboard_blade.reason_5')
<!-- Reason kpi report is end here -->
@endif





<!-- reason chart close here -->
@if($role == 0 || isset($permission_data) && $permission_data->complain_list == 1)
@include('dashboard_blade.complain_status')
@endif
@endif
<style>
    #choose_question {
        color: black;
    }
</style>
@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script>
{{-- @include('datatable.dt_js')   --}}
@include('datatable.alert_js')
@stop