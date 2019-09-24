@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--     <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>-->
<style type="text/css">
    .goog-te-banner-frame {
        display: none !important;
    }

    .skiptranslate {
        float: right;
        margin-right: 2px;
    }

    .translated-ltr body {
        padding: 0;
        position: relative !important;
        top: 0 !important;
    }

    .nav-md {
        top: 0 !important;
    }

    #google_translate_element {
        float: left;
        position: relative;
        right: 0;
        top: 0px;
        left: 0px !important;
    }

    .goog-te-gadget-icon {
        margin-left: -16px !important;
        background: none !important;
    }
</style>


@stop
{{-- Page content --}}
@section('inner_body')
<div class="breadcrumb">
    <h1>{{__('message.reset_options')}}</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    @if(count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-card alert-danger">
        <strong class="text-capitalize">{{$error}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @break
    @endforeach
    @endif

    @if(session()->has('message.level'))
    <div class="alert alert-card alert-{{ session('message.level') }}">
        <strong class="text-capitalize">{!! session('message.content') !!}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- ICON BG -->
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 p-2">{{__('message.reset_sms')}}</h3>
            <div class="card-body text-center">
                <i class="i-Speach-Bubble-4"></i>
                <div class="content">
                    <form action=" {{ url('admin/sms_reset') }} " method="get">
                        <button type="submit" name="reset_sms" value="sms"
                            class="btn btn-success">{{__('message.reset_sms')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 p-2">{{__('message.reset_email')}}</h3>
            <div class="card-body text-center">
                <i class="i-Email"></i>
                <div class="content">
                    <form action=" {{ url('admin/email_reset') }} " method="get">
                        <button type="submit" name="reset_email" value="email"
                            class="btn btn-success">{{__('message.reset')}}
                            {{__('message.email')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--<script src="{{asset('../admin_css/assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../admin_css/assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    
</script>-->
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>


<!-- @include('datatable.dt_js')   -->
@stop