<style type="text/css">
    /* .myoption{ 
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    } */
</style>

@extends('layout.admin',['image'=>$image])
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
@stop
{{-- Page content --}}
@section('inner_body')


<?php
$title = __('message.create_participant');
$action = route('participant.store');
$method = "";
$image = "";
$button = __('message.save');
$edit = false;
$update_action = "";
if (!empty($repairman_data->id)) {
    $edit = true;
    $title = __('message.edit_participant');
    $action = route('participant.update', $repairman_data->id);
    $method = '<input type="hidden" name="_method" value="PUT" />';
    $update_action = "update_form";
}
?>


<div class="breadcrumb">
    <h1>{{$title}}</h1>
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
        <form method="post" action="{{$action}}" id="demo-form2" class="form-horizontal form-label-left">
            {!! $method !!}
            {{ csrf_field()}}
            <input type="hidden" name="user_id" value="{{!empty($repairman_data->id)?$repairman_data->id:''}}">
            <input type="hidden" name="form_action" value="{{$update_action}}">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title"><?php echo $title; ?></h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.first_name')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="first_name" maxlength="30" name="first_name" class="form-control"
                                    value="{{!empty($repairman_data->first_name)?$repairman_data->first_name:Input::old('first_name')}}"
                                    placeholder="{{__('message.first_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.last_name')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="last_name" maxlength="30" name="last_name" class="form-control"
                                value="{{!empty($repairman_data->last_name)?$repairman_data->last_name:Input::old('last_name')}}"
                                placeholder="{{__('message.last_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.email')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="email" maxlength="70" name="email" class="form-control"
                                    value="{{!empty($repairman_data->email)?$repairman_data->email:Input::old('email')}}"
                                    placeholder="{{__('message.email')}}">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.location')}}
                            <span class="required">*</span></label>                        
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="location_id" name="location_id">
                                    <option value="">{{__('message.select_location')}}</option>
                                    @foreach ($country as $row)
                                    <?php
                                    $selected = '';
                                    if (!empty($repairman_data)) {
                                        if ($repairman_data->location_id == $row->id)
                                            $selected = 'selected';
                                    }
                                    ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.mobile')}}<span
                                class="required">*</span></label>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <input type="text" readonly="readonly" class="form-control" name="dialing_code"
                                id="dialing_code"
                                value="<?php echo (!empty($repairman_data))?$repairman_data->dial_code:""; ?>">
                        </div>        
                        <div class="col-lg-4 col-md-4 col-sm-4 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="mobile" maxlength="15" name="mobile" class="form-control"
                                    value="{{!empty($repairman_data->mobile)?$repairman_data->mobile:Input::old('mobile')}}"
                                    placeholder="{{__('message.mobile')}}">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Telephone"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.date_of_birth')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="datepicker" readonly="readonly" name="dob" class="form-control"
                                    value="{{!empty($repairman_data->dob)?$repairman_data->dob:Input::old('date_of_birth')}}"
                                    placeholder="YYYY-mm-dd">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Calendar-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.gender')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="form-control" name="gender">
                                    <?php
                                    $selected1 = '';
                                    $selected2 = '';
                                    if (!empty($repairman_data)) {
                                        if ($repairman_data->gender == 1){
                                            $selected1 = 'selected';
                                        }
                                    }

                                    if (!empty($repairman_data)) {
                                        if ($repairman_data->gender == 2){
                                            $selected2 = 'selected';
                                        }
                                    }
                                    ?>
                                    <option <?php echo $selected1; ?> value="1">{{__('message.male')}}</option>
                                    <option <?php echo $selected2; ?> value="2">{{__('message.female')}}</option>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.category')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="category_id_participant"
                                    name="category_id">
                                    <option value="0">{{__('message.select_category')}}</option>
                                    @foreach ($category as $row)
                                    <?php
                                    $selected = '';
                                    $selected_category_id = !empty(Input::old('category_id'))?Input::old('category_id'):((!empty($repairman_data->category_id)?$repairman_data->category_id:0));
                                    
                                    if ($selected_category_id == $row->id){
                                        $selected = 'selected';
                                    }
                                    ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->category_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.sub_category')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                                    <option value="0">{{__('message.select_sub_category')}}</option>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.group')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="group_id" name="group_id">
                                    <option value="0">{{__('message.select_group')}}</option>
                                    @foreach ($group as $row)
                                    <?php
                                    $selected = '';
                                    if (!empty($repairman_data)) {
                                        if ($repairman_data->group_id == $row->id)
                                            $selected = 'selected';
                                    }
                                    ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->group_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.type')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="type_id" name="type_id">
                                    <option value="">{{__('message.select_type')}}</option>
                                    @foreach ($type as $row)
                                    <?php
                                    $selected = '';
                                    if (!empty($repairman_data)) {
                                        if ($repairman_data->type_id == $row->id){
                                            $selected = 'selected';
                                        }
                                    }
                                    ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.comments')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <textarea name="comment" class="form-control"
                                placeholder="{{__('message.comments')}}"> {{!empty($repairman_data->comment)?$repairman_data->comment:Input::old('comment')}}  </textarea>
                        </div>
                    </div>
                </div>
                @if($on_behalf->setting_value == 0)
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- end survey Form Layout-->

            <!-- start survey question option form -->
            @if($on_behalf->setting_value == 1)
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.on_behalf_of')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.first_name')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="on_behalf_first_name" maxlength="30" name="on_behalf_first_name"
                                class="form-control"
                                value="{{!empty($repairman_data->on_behalf_first_name)?$repairman_data->on_behalf_first_name:Input::old('on_behalf_first_name')}}"
                                placeholder="{{__('message.first_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.last_name')}}<span
                                class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <input type="text" id="on_behalf_last_name" maxlength="30" name="on_behalf_last_name"
                                class="form-control"
                                value="{{!empty($repairman_data->on_behalf_last_name)?$repairman_data->on_behalf_last_name:Input::old('on_behalf_last_name')}}"
                                placeholder="{{__('message.last_name')}}">
                        </div>
                    </div>
                    <div class="form-group row survey_options">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.Email')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="on_behalf_email" maxlength="70" name="on_behalf_email"
                                    class="form-control"
                                    value="{{!empty($repairman_data->on_behalf_email)?$repairman_data->on_behalf_email:Input::old('on_behalf_email')}}"
                                    placeholder="{{__('message.Email')}}">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Email"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row survey_options">
                        <label for="staticEmail"
                            class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">{{__('message.mobile')}}
                            <span class="required">*</span></label>
                        <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                            <div class="input-right-icon">
                                <input type="text" id="on_behalf_mobile" maxlength="15" name="on_behalf_mobile"
                                    class="form-control"
                                    value="{{!empty($repairman_data->on_behalf_mobile)?$repairman_data->on_behalf_mobile:Input::old('on_behalf_mobile')}}"
                                    placeholder="{{__('message.mobile')}}">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Telephone"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-6 text-left">
                                <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- end survey question option form -->
        </form>
        <!-- end::form 2-->
    </div>
</div>

@stop
{{-- page level scripts --}}
@section('footer_scripts')
{{-- <link href="{{asset('resources/assets/gentelella/build/css/jquery-ui.css')}}" rel="stylesheet">
<script src="{{asset('resources/assets/gentelella/build/js/jquery-ui.js')}}"></script> --}}

<script type="text/javascript">
    $(function() {    
        var location_id = $("#location_id").val();

        <?php if (empty($repairman_data->id)) { ?>
            if(location_id == null || location_id == ''){
                location_id = 191;
            }else{
                location_id = location_id;
            }
        <?php } ?>
            $.ajax({
                url  : '{{route('get_country_code')}}',
                type : 'GET',
                data : {location_id:location_id,_token: $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function(resp){
                    if(resp){
                        $('#dialing_code').val(resp)
                        <?php if (empty($repairman_data->id)) { ?>
                        $('#location_id').val(191)
                        <?php } ?>
                    } 
                },
                error: function(resp){
    
                }
            });
            
            $(document).on('change','#location_id',function(){ 
               var location_id = $(this).val();
                $.ajax({
                    url  : '{{route('get_country_code')}}',
                    type : 'GET',
                    data : {location_id:location_id,_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function(resp){
                        if(resp){
                            $('#dialing_code').val(resp)
                        } 
                    },
                    error: function(resp){
    
                    }
                });
    
            });
    
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        $( "#datepicker" ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1857:'+year
        });
    });
    
    
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id_participant').change(function(){
            //debugger;
            var me = this;
            var url = '{{route("get_sub_category_by_category_id")}}';
            var categoryId = $(this).find(':selected').val();
            $.ajax({
                url  : url,
                type : 'GET',
                data : {category_id:categoryId},
                dataType: 'json',
                success: function(resp){
                    if(resp.data.length==0){
                        return false;
                    }
                    //debugger;
                    $('#sub_category_id').html('');
                    selectedSubCategory = '3';
                    $.each(resp.data, function (index, value) {
                        //debugger;
                        var obj = { 
                            value: value.id,
                            text : value.category_name,
                        };

                        if(selectedSubCategory==value.id){
                            obj.selected = 'selected';
                        }

                        $('#sub_category_id').append($('<option/>',obj));
                    });  
                },
                error: function(resp){

                }
            });
        });
        var categoryId = '<?php echo isset($selected_category_id) ? $selected_category_id : '' ?>';
        if(categoryId!=0){
            $('#category_id_participant').trigger('change');
        }   
    });    
</script>
@stop