@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<style type="text/css">
    #image_on_popup img{
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
        <!--begin::form 2-->
        
        @if(($status_notification != null))
        {!! Form::open(['route' => 'save_reason_status_template']) !!}
        @else
        {!! Form::model($status_notification,['route' => 'save_reason_status_template','method' => 'PUT']) !!}
        @endif
        {{ Form::hidden('status_notification',$status_template,['id' => 'status_notification'])}}
        {{ Form::hidden('id',$id)}}
            
                <!-- start REPORT Create KPI Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.notification')}} {{__('message.template')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select')}} {{__('message.template')}}<span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            {!! Form::select('status_template',['email' => __('message.e-mail'),'sms' => __('message.sms_c'),'both' => __('message.both')], $status_template, ['class' => 'form-control','id' => 'template','placeholder' => __('message.select').' '.__('message.template').' '.__('message.type')]) !!}
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="maximum_value" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.survey')}} {{__('message.list')}}<span class="required">*</span></label>
                        <div class="col-lg-12 col-md-5 col-sm-5 mb-2">
                            <ul class="list_type_survey" >
                                @foreach($parameter_list as $key => $value)
                                <li>{{ $value->survey_form_title }} = (survey_{{$value->id}})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card mb-4 text-left">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tbody>
                                            <tr>
                                                <th colspan="3" style="text-align:center;">{{__('message.list')}} {{__('message.of')}} {{__('message.variable')}}</th>
                                            </tr>
                                            <tr>
                                                <th>{{__('message.name')}}</th>
                                                <th>{{__('message.customer')}} {{__('message.variable')}}</th>
                                                <th>{{__('message.user')}} {{__('message.variable')}}</th>
                                            </tr>
                                            <tr>
                                                <td>{{__('message.name')}}</td>
                                                <td>{var_customer_name}</td>
                                                <td>{var_user_name}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>{{__('message.e-mail')}}</td>
                                                <td>{var_customer_email}</td>
                                                <td>{var_user_email}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('message.mobile')}}</td>
                                                <td>{var_customer_phone}</td>
                                                <td>{var_user_phone}</td>                                    
                                            </tr>
                                            <tr>
                                                <td>{{__('message.location')}}</td>
                                                <td><center>-</center></td>
                                                <td>{var_user_location}</td>                                    
                                            </tr>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 row sms_template">
                                    <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.sms_c')}} {{__('message.template')}} ({{__('message.for')}} {{__('message.user')}})<span class="required">*</span></label>
                                    <div class="col-lg-9 col-md-5 col-sm-5 mb-2">
                                        {!! Form::textarea('sms_template', $sms_template, ['class' => 'form-control','id' => 'sms_template','placeholder' => __('message.enter').' ' .__('message.sms').' '.__('message.for') .' '.__('message.user')]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 row customer_sms_template">
                                    <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.sms_c')}} {{__('message.template')}} ({{__('message.for')}} {{__('message.customer')}})<span class="required">*</span></label>
                                    <div class="col-lg-9 col-md-5 col-sm-5 mb-2">
                                        {!! Form::textarea('customer_sms_template', $customer_sms_template, ['class' => 'form-control','id' => 'customer_sms_template','placeholder' => 'Enter message for customer']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 row email_template">
                                    <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.e-mail')}} {{__('message.template')}} ({{__('message.for')}} {{__('message.user')}})<span class="required">*</span></label>
                                    <div class="col-lg-9 col-md-5 col-sm-5 mb-2">
                                        {!! Form::textarea('email_template', $email_template, ['class' => 'form-control','id' => 'email_template','placeholder' => 'Enter email message for user']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 row customer_email_template">
                                    <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.e-mail')}} {{__('message.template')}} ({{__('message.for')}} {{__('message.customer')}})<span class="required">*</span></label>
                                    <div class="col-lg-9 col-md-5 col-sm-5 mb-2">
                                        {!! Form::textarea('customer_email_template', $customer_email_template, ['class' => 'form-control','id' => 'customer_email_template','placeholder' => 'Enter email message for customer']) !!}
                                    </div>
                                </div> 
                            </div>    
                            <div class="form-group row">
                                <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.select')}} {{__('message.user')}}<span class="required">*</span></label>
                                <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                    {{Form::select('users[]',$usersDetails,$users,['id' => 'second','class' => 'chosen-select', 'style' => 'width:100%;','tabindex' => '4','data-placeholder' => 'Choose a User...','multiple' => 'multiple'])}}
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label  for="name" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.send')}} {{__('message.copy')}} {{__('message.to')}} {{__('message.customer')}}<span class="required">*</span></label>
                                <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                                    <div class="row">
                                        <label class="radio radio-primary ml-4 mt-2">
                                            {{Form::radio('send_to_customer','yes',$send_to_customer == 'yes' ? 'true' : '',['onclick' => 'radioButton(this.value)','class' => 'send_to_customer','checked' => 'true'])}} 
                                            <span>{{__('message.yes')}}</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary ml-4 mt-2">
                                            {{Form::radio('send_to_customer','no',$send_to_customer == 'no' ? 'true' : '',['onclick' => 'radioButton(this.value)','class' => 'send_to_customer'])}}
                                            <span> {{__('message.no')}}</span>
                                            <span class="checkmark"></span>
                                        </label>
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
    $(document).ready(function(){
        $('.sms_template').hide();
        $('.email_template').hide();
        $('.customer_sms_template').hide();
        $('.customer_email_template').hide();
        var radios = $("input[name='send_to_customer']:checked").val();
        if($('#status_notification').val() == 'sms'){
            $('.sms_template').show();
            if(radios == 'yes'){
                $('.customer_sms_template').show();
            }
        }
        if($('#status_notification').val() == 'email'){
            $('.email_template').show();
            if(radios == 'yes'){
                $('.customer_email_template').show();
            }
        }
        if($('#status_notification').val() == 'both'){
            $('.sms_template').show();
            $('.email_template').show();

            if(radios == 'yes'){
                $('.customer_sms_template').show();
                $('.customer_email_template').show();
            }
        }

        $('#template').change(function(){
            var radios = $("input[name='send_to_customer']:checked").val();
            if($(this).val() == 'sms'){
                  $('.email_template').hide();
                  $('.sms_template').show();   

                  if(radios == 'yes'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').hide();
                }

            }
            if($(this).val() == 'email') {
                $('.sms_template').hide();
                $('.email_template').show(); 

            if(radios == 'yes'){
                $('.customer_sms_template').hide();
                $('.customer_email_template').show();
            }

            }
            if($(this).val() == 'both') {
                $('.sms_template').show();
                $('.email_template').show(); 

                if(radios == 'yes'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').show();
                 }
            }
        })
        $('#send_to_customer').on('click',function(){
            if($('#send_to_customer').val() == 'yes'){
                if($('#template').val() == 'sms'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').hide();
                }
                if($('#template').val() == 'email'){
                    $('.customer_sms_template').hide();
                    $('.customer_email_template').show();
                }
                if($('#template').val() == 'both'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').show();
                }
            }else{
                $('.customer_sms_template').hide();
                $('.customer_email_template').hide();
            }
        })
    });
        function radioButton(value){
            if(value == 'yes'){
                if($('#template').val() == 'sms'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').hide();
                }
                if($('#template').val() == 'email'){
                    $('.customer_sms_template').hide();
                    $('.customer_email_template').show();
                }
                if($('#template').val() == 'both'){
                    $('.customer_sms_template').show();
                    $('.customer_email_template').show();
                }
            }else{
                $('.customer_sms_template').hide();
                $('.customer_email_template').hide();
            }
        }
</script>
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
CKEDITOR.replace('sms_template'); 
CKEDITOR.config.allowedContent = true;  
});
</script>

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
CKEDITOR.replace('customer_sms_template'); 
CKEDITOR.config.allowedContent = true;  
});
</script>

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
CKEDITOR.replace('customer_email_template'); 
CKEDITOR.config.allowedContent = true;  
});
</script>
<style type="text/css">
    .tt-menu .tt-suggestion.tt-selectable {padding: 8px 16px;}
    .tt-menu  { background: #ececec; cursor: pointer;}
    .twitter-typeahead {display: block !important;}
    .list_type_survey { float: left; width: 100%; border-top: 1px solid black;border-bottom: 1px solid black;}
    .list_type_survey li { float: left; width: 30%; margin-top: 10px; }
</style>
@stop

