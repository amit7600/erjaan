@extends('layout.admin')
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
$id = '';
?>


<div class="row">
    <div class="col-lg-12 mb-3">
        {!! Form::model($role, ['route' => ['user_roles.update', $role->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
        <!--begin::form 2-->
        
        <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">{{__('message.edit')}} {{__('message.role')}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="ul-form__label col-lg-2  col-md-2 col-sm-2 col-form-label text-right ">{{__('message.role')}}<span class="required">*</span></label>
                        <div class="col-lg-3  col-md-3 col-sm-3 ">
                            {!! Form::text('role',null,['class' => 'form-control']) !!}
                        </div>
                        <label for="staticEmail" class="ul-form__label col-lg-1  col-md-1 col-sm-1 col-form-label text-right">{{__('message.level')}}<span class="required">*</span></label>
                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                            {!! Form::text('level',null,['class' => 'form-control']) !!}
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{__('message.save')}}</button>
                    </div>
                </div>
                <!----------------second card--------------->
                <div class="col-lg-12">
                    <div class ="row">
                        <div class="col-sm-6 col-md-6 col-xs-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">{{__('message.menu')}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.dashboard')}}</b></label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_dashboard',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b> {{__('message.manage')}} {{__('message.survey')}} {{__('message.form')}}</b></label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_survey_form',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"> - {{__('message.add')}} {{__('message.survey')}} {{__('message.form')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_survey_form',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.survey')}} {{__('message.form')}} {{__('message.list')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('survey_form_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.manage')}} {{__('message.participant')}}</b> </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_participant',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.add')}} {{__('message.participant')}}  </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_participant',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.participant')}} {{__('message.list')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('participant_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.manage')}} {{__('message.send')}} {{__('message.survey')}}</b> </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_send_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.manual')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manual_send_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-{{__('message.auto')}} {{__('message.send')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('auto_send_survey_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.trigger_list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('trigger_list_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}} {{__('message.new')}} {{__('message.trigger')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_trigger_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.schedule')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('schedule_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.schedule')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('schedule_list_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div> <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--  {{__('message.add')}} {{__('message.new')}} {{__('message.schedule')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_schedule_survey',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.report')}}</b></label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_report',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.survey')}} {{__('message.report')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_survey_report',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-{{__('message.manage')}} {{__('message.kpi')}} {{__('message.campaign')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_kpi_campaign',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.create')}} {{__('message.kpi')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_create_kpi',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.kpi')}} {{__('message.report')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_kpi_report',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.reason')}} {{__('message.kpi')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('reason_kpi',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.question')}} {{__('message.kpi')}} {{__('message.report')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('question_kpi_report',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.complain')}} {{__('message.kpi')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('complain_kpi',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.view')}} {{__('message.setting')}}</b></label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_setting',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.common')}} {{__('message.setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_common_setting',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.reset_setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('reset_setting',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.city')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('city',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.participant')}} {{__('message.setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_category',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.add')}} {{__('message.category')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_participant_category',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.category')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_category_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.manage')}} {{__('message.group')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_group',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.group')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('group_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.add')}} {{__('message.group')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_group',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.manage')}} {{__('message.type')}}  </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_type',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.type')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('type_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.add')}} {{__('message.type')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('add_type',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.manage')}} {{__('message.template')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_template',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.manage')}} {{__('message.Email')}} {{__('message.campaign')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_email_campaign',1) }}   
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_email_list',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_add_email',1) }}   
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.manage')}} {{__('message.sms_c')}} {{__('message.campaign')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_sms_campaign',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_sms_list',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_add_sms',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.manage')}} {{__('message.users')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('view_manage_user',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-- {{__('message.users')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_user_list',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}} {{__('message.users')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('manage_add_user',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.quick_participant_setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('quick_participant_setting',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.user')}} {{__('message.role')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('user_role',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback')}} {{__('message.terminal')}}</b></label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('feedback_terminals',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.question')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('question_list',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.feedback')}} {{__('message.setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('feedback_setting',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.reason')}} {{__('message.setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('get_reason_setting',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.reason')}} {{__('message.chart')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('reason_chart',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.feedback')}} {{__('message.rating')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('feedback_ratings',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.feedback_reply')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('feedback_reply',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.question')}} {{__('message.chart')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('question_chart',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.question')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('question_list',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>                                    
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.live_link')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('live_link',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complain')}} {{__('message.menu')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complainMenu',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.complaints')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complaints',1) }} 
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.complain')}} {{__('message.chart')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('complain_chart',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.notification')}}
                                            {{__('message.template')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('notification_template',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.complain')}}
                                            {{__('message.setting')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('get_complain_setting',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">- {{__('message.complain')}}
                                            {{__('message.pop_up')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('complain_pop_up',1) }}  
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                        <!------------------third card------------------>
                        <div class="col-sm-6 col-md-6 col-xs-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">{{__('message.dashboard')}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.report')}} {{__('message.and')}} {{__('message.kpis')}} ({{__('message.for')}} {{__('message.sms_c')}} {{__('message.and')}} {{__('message.feedback')}} {{__('message.terminal')}}) {{__('message.along')}} {{__('message.with')}} {{__('message.text')}} {{__('message.feedback')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('report_kpi_sms_feedback',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.report')}} {{__('message.and')}} {{__('message.kpis')}} ( {{__('message.for')}} {{__('message.reason')}} {{__('message.and')}} {{__('message.complain')}}) </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('report_kpi_reasons_complains',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complain')}} {{__('message.list')}} {{__('message.and')}} {{__('message.their')}} {{__('message.status')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('complains_status',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.participant')}} {{__('message.list')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('participants_list',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.quick_add_participant')}} {{__('message.button')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('quick_add_participants_button',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"> {{__('message.sms_c')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('sms',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.Email')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('email',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.sms_c')}} {{__('message.balance')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('sms_balance',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complaints')}} {{__('message.box')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('complaints_box',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"> {{__('message.feedback')}} {{__('message.terminal')}} {{__('message.responses')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('feedback_terminal_response',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.new')}} {{__('message.participant')}} </label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('new_participant',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"> {{__('message.updated')}} {{__('message.participant')}}</label>
                                        <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                            <label class="checkbox checkbox-primary">
                                                {{ Form::checkbox('updated_participant',1) }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
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


<style type="text/css">
    .form-group { float: left; width: 100%; }
      .form-horizontal .form-group.inner_menu_label .control-label , .form-horizontal .form-group .control-label , .form-horizontal .form-group.inner_sub_menulabel .control-label { text-align: left; padding-left: 0px;padding-right: 0px;}
    .form-horizontal .form-group.inner_menu_label .control-label  {font-weight: normal; padding-left: 25px; font-style: italic; }
    .form-horizontal .form-group.inner_sub_menulabel .control-label  {font-size: 12px;font-weight: normal;padding-left: 50px;font-style: italic; }
</style>





@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop