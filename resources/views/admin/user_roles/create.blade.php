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
        {!! Form::open(['route' => 'user_roles.store', 'files' => true]) !!}
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
                <h3 class="card-title">{{__('message.create_role')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="staticEmail"
                        class="ul-form__label col-lg-2  col-md-2 col-sm-2 col-form-label text-right ">{{__('message.role')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-3  col-md-3 col-sm-3 ">
                        {!! Form::text('role',null,['class' => 'form-control']) !!}
                    </div>
                    <label for="staticEmail"
                        class="ul-form__label col-lg-1  col-md-1 col-sm-1 col-form-label text-right">{{__('message.level')}}<span
                            class="required">*</span></label>
                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                        {!! Form::text('level',null,['class' => 'form-control']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary float-right">{{__('message.save')}}</button>
                </div>
            </div>
            <!----------------second card--------------->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title">{{__('message.menu')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.dashboard')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_dashboard',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>
                                            {{__('message.manage_survey_form')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_survey_form',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                        - {{__('message.add_survey_form')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_survey_form',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.survey_form_list')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('survey_form_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.survey_report')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_survey_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.manage_participant')}}</b>
                                    </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_participant',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.add_participant')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_participant',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.participant_list')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('participant_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.manage_send_survey')}}</b>
                                    </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_send_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.manual')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manual_send_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.auto_send')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('auto_send_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.trigger_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('trigger_list_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.add_new_trigger')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_trigger_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.schedule')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('schedule_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.schedule_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('schedule_list_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.add_new_schedule')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_schedule_survey',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.report')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-{{__('message.manage_kpi_campaign')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_kpi_campaign',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.create_kpis')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_create_kpi',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.kpi_report')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_kpi_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reason_kpi')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('reason_kpi',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_kpi_report')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_kpi_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.complain_kpi')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complain_kpi',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.view_setting')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.common_setting')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_common_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reset_setting')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('reset_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.city')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('city',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.participant_setting')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_category',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.add_category')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_participant_category',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.category_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_category_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.manage_group')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_group',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.group_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('group_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.add_group')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_group',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.manage_type')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_type',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.type_list')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('type_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.add_type')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('add_type',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.manage_template')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_template',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.manage_Email_campaign')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_email_campaign',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_email_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_add_email',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.manage_sms_campaign')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_sms_campaign',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_sms_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_add_sms',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.manage_user')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('view_manage_user',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--
                                        {{__('message.users_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_user_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.add_users')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('manage_add_user',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.quick_participant_setting')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('quick_participant_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">--{{__('message.user_role')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('user_role',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback_terminal')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_terminals',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_settings')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reason_settings')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('get_reason_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reason_chart')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('reason_chart',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_ratings')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_ratings',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_reply')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_reply',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_chart')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_chart',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_list')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_list',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.live_link')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('live_link',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.complain_menu')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complainMenu',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.complaints')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complaints',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.complain_chart')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complain_chart',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.notification_template')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('notification_template',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.complain_setting')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('get_complain_setting',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.complain_pop_up')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('complain_pop_up',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.user_report')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('userReport',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.user_report')}} </label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('get_user_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.location_report')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('get_location_report',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Feddback 2 Start -->
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback_terminal_2')}}</b></label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_terminals_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_list_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_list_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_setting_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_setting_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reason_setting_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('get_reason_setting_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.reason_chart_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('reason_chart_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_rating_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_ratings_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.feedback_reply_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('feedback_reply_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_chart_2')}}</label>
                                    <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                        <label class="checkbox checkbox-primary">
                                            {{ Form::checkbox('question_chart_2',1) }}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="staticEmail"
                                        class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                        {{__('message.question_list_2')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.live_link_2')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('live_link_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.user_report_2')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('userReport_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.user_report_2')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_user_report_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.location_report_2')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_location_report_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Feddback 3 Start -->
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback_terminal_3')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminals_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_setting_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_setting_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_setting_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_reason_setting_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_chart_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('reason_chart_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_rating_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_ratings_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_reply_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_reply_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_chart_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_chart_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.live_link_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('live_link_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.user_report_3')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('userReport_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.user_report_3')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_user_report_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.location_report_3')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_location_report_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Feddback 3 Start -->
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback_terminal_4')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminals_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_setting_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_setting_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_setting_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_reason_setting_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_chart_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('reason_chart_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_rating_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_ratings_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_reply_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_reply_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_chart_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_chart_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.live_link_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('live_link_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.user_report_4')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('userReport_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.user_report_4')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_user_report_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.location_report_4')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_location_report_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Feddback 5 Start -->
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.feedback_terminal_5')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminals_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_setting_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_setting_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_setting_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_reason_setting_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.reason_chart_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('reason_chart_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_rating_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_ratings_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.feedback_reply_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_reply_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_chart_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_chart_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.question_list_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('question_list_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.live_link_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('live_link_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4"><b>{{__('message.user_report_5')}}</b></label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('userReport_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.user_report_5')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_user_report_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">-
                                    {{__('message.location_report_5')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('get_location_report_5',1) }}
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
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.sms_sent_response')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('sms',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.email_sent_response')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('email',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.sms_balance')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('sms_balance',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complaints_box')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('complaints_box',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.feedback_responses_dashbord_1')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminal_responses_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.feedback_responses_dashbord_2')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminal_responses_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.feedback_responses_dashbord_3')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminal_responses_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.feedback_responses_dashbord_4')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminal_responses_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.feedback_responses_dashbord_5')}} </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('feedback_terminal_responses_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.survey_dashboard')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('report_sms_feedback',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.survey_kpis')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('kpi_sms_feedback',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_1')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_terminals_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_2')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_terminals_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_3')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_terminals_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_4')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_terminals_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_5')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_terminals_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complain_kpi')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_complain_kpi',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complain_status_chart')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('complain_status_chart',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.reason_kpi')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('reason_kpi_dashboard',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_reason_report_1')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_reason_1',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_reason_report_2')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_reason_2',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_reason_report_3')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_reason_3',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_reason_report_4')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_reason_4',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.feedback_terminal_reason_report_5')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('dashboard_feedback_reason_5',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.complain_list')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('complain_list',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.participant_list')}}</label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('participants_list',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.quick_add_participant_button')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('quick_add_participants_button',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">{{__('message.new_participant')}}
                                </label>
                                <div class="col-lg-2  col-md-2 col-sm-2 mb-2">
                                    <label class="checkbox checkbox-primary">
                                        {{ Form::checkbox('new_participant',1) }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-9  col-md-9 col-sm-9 col-form-label text-left pl-4">
                                    {{__('message.updated_participant')}}</label>
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
    .form-group {
        float: left;
        width: 100%;
    }

    .form-horizontal .form-group.inner_menu_label .control-label,
    .form-horizontal .form-group .control-label,
    .form-horizontal .form-group.inner_sub_menulabel .control-label {
        text-align: left;
        padding-left: 0px;
        padding-right: 0px;
    }

    .form-horizontal .form-group.inner_menu_label .control-label {
        font-weight: normal;
        padding-left: 25px;
        font-style: italic;
    }

    .form-horizontal .form-group.inner_sub_menulabel .control-label {
        font-size: 12px;
        font-weight: normal;
        padding-left: 50px;
        font-style: italic;
    }
</style>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop