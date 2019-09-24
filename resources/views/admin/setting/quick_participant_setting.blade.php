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
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }

    .dataTables_filter {
        display: none !important;
    }

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

        <!-- @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->
        <!--begin::form 2-->
        <form action=" {{ url('admin/quick_participant_setting') }} " method="get">
            {{csrf_field()}}
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.select_menu_for_quick_add_participant')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="first_name"
                                    <?php echo isset($quick_setting) && $quick_setting->first_name == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.first_name')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="last_name"
                                    <?php echo isset($quick_setting) &&  $quick_setting->last_name == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.last_name')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="email"
                                    <?php echo isset($quick_setting) && $quick_setting->email == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.e-mail')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="location"
                                    <?php echo isset($quick_setting) && $quick_setting->location == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.location')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="mobile"
                                    <?php echo isset($quick_setting) && $quick_setting->mobile == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.mobile')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="dob"
                                    <?php echo isset($quick_setting) && $quick_setting->dob == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.date_of_birth')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="gender"
                                    <?php echo isset($quick_setting) && $quick_setting->gender == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.gender')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="category"
                                    <?php echo isset($quick_setting) && $quick_setting->category == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.category')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="sub_category"
                                    <?php echo isset($quick_setting) && $quick_setting->sub_category == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.sub_category')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="group"
                                    <?php echo isset($quick_setting) && $quick_setting->group == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.group')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="type"
                                    <?php echo isset($quick_setting) && $quick_setting->type == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.type')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <label class="checkbox checkbox-primary">
                                <input type="checkbox" name="comment"
                                    <?php echo isset($quick_setting) && $quick_setting->comment == 1 ? 'checked':'' ?>
                                    value="1">{{__('message.comment')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                            {{__('message.do_you_want_to_show_quick_add_button')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2 d-inline-flex">
                            <label class="radio radio-primary mr-2">
                                <?php 
                                $check =  $quick_setting->quick_add_button ;
                                ?>
                                {{ Form::radio('quick_add_button', '1' , $check == 1 ? true : false ) }}
                                {{__('message.yes')}}
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio radio-primary mr-2">
                                {{ Form::radio('quick_add_button', '0' , $check == 0 ? true : false ) }}
                                {{__('message.no')}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-primary">{{__('message.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end survey question option form -->
        </form>
        <!-- end::form 2-->
    </div>
</div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
@include('datatable.alert_js')
@stop