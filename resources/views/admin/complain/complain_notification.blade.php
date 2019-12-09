@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<style type="text/css">
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
@stop

{{-- Page content --}}
@section('inner_body')


<div class="breadcrumb">
    <h1></h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-lg-12 mb-3">
        @if(Session::has('error'))
        <div class="alert alert-card alert-danger">
            <strong class="text-capitalize">{{Session::get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}">
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!--begin::form 2-->

        @if(($complain_notification == null))
        {!! Form::open(['route' => 'save_complain_notification']) !!}
        @else
        {!! Form::model($complain_notification,['route' => 'save_complain_notification','method' => 'PUT']) !!}
        @endif

        <!-- start REPORT Create KPI Form Layout-->
        <div class="card mb-4">
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.complain_notification')}}</h3>
            </div>
            <div class="card-body">
            </div>
            <div class="col-sm-12">
                <div class="card mb-4 text-left">
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tbody>
                                    <tr>
                                        <th colspan="3" style="text-align:center;">{{__('message.list_of_variable')}}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>{{__('message.name')}}</th>
                                        <th>{{__('message.user_variable')}}</th>
                                    </tr>
                                    <tr>
                                        <td>{{__('message.name')}}</td>
                                        <td>{var_user_name}</td>

                                    </tr>
                                    <tr>
                                        <td>{{__('message.e-mail')}}</td>
                                        <td>{var_user_email}</td>
                                    </tr>
                                </tbody>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 row sms_template">
                                <label for="name"
                                    class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.notification_template')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-9 col-md-5 col-sm-5 mb-2">
                                    {!! Form::textarea('email_template', $email_template, ['class' =>
                                    'form-control','id' =>
                                    'email_template']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="mc-footer">
                            <div class="row text-right">
                                <div class="col-sm-4"></div>
                                <div class="ol-lg-6 text-left">
                                    {{Form::submit(__('message.submit'),['class' => 'btn btn-primary'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end survey Form Layout-->
        </form>
        <!-- end::form 2-->
    </div>
</div>




@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(".chosen-select").chosen();
    $('button').click(function(){
        $(".chosen-select").val('').trigger("chosen:updated");
});
</script>
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(function() {
    //debugger;
   // Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('email_template'); 
CKEDITOR.config.allowedContent = true;  
});
</script>

<style type="text/css">
    .tt-menu .tt-suggestion.tt-selectable {
        padding: 8px 16px;
    }

    .tt-menu {
        background: #ececec;
        cursor: pointer;
    }

    .twitter-typeahead {
        display: block !important;
    }

    .list_type_survey {
        float: left;
        width: 100%;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    .list_type_survey li {
        float: left;
        width: 30%;
        margin-top: 10px;
    }
</style>
@stop