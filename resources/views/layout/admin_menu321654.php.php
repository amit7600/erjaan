<?php
$user = Auth::user();
$role = $user->user_role;
?>

<?php if (Auth::user()->user_role == 0) { ?>
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item">
                <a class="nav-item-hold" href="{{route('dashboard')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">{{__('message.dashboard')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="surveymanagement">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.survey_managemnt')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="participantmanagement">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Conference"></i>
                    <span class="nav-text">{{__('message.participant_management')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="sendsurvey">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Paper-Plane"></i>
                    <span class="nav-text">{{__('message.send_survey')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="report">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.report')}}</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="settings">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Gear-2"></i>
                    <span class="nav-text">{{__('message.setting')}}</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="feedbackterminals">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item">
                <a class="nav-item-hold" href="{{route('logout')}}">
                    <i class="nav-icon i-Key-Lock"></i>
                    <span class="nav-text">{{__('message.logout')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <ul class="childNav" data-parent="surveymanagement">
            <li class="nav-item ">
                <a href="{{route('surveyform.create')}}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">{{__('message.add_survey_form')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('surveyform.index')}}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">{{__('message.survey_form_list')}}</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="participantmanagement">
            <li class="nav-item">
                <a href="{{route('participant.create')}}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">{{__('message.add_participant')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('participant.index')}}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">{{__('message.participant_list')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{URL::to('admin/participant/import')}}">
                    <i class="nav-icon i-Rewind"></i>
                    <span class="item-name">{{__('message.import_participant')}}</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="sendsurvey">
            <li class="nav-item">
                <a href="{{route('survey.send_manual')}}">
                    <i class="nav-icon i-Belt-3"></i>
                    <span class="item-name">{{__('message.manual')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Paper-Plane"></i>
                    <span class="item-name">{{__('message.auto_send')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('trigger.index')}}">{{__('message.trigger_list')}}</a>
                    </li>
                    <li>
                        <a href="{{route('trigger.create')}}">{{__('message.add_new_trigger')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Clock-Forward"></i>
                    <span class="item-name">{{__('message.schedule')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('schedule.list_schedule_data')}}">{{__('message.schedule_list')}}</a>
                    </li>
                    <li>
                        <a href="{{route('schedule.add_scheudle_manual')}}">{{__('message.add_new_schedule')}}</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="childNav" data-parent="report">
            <li class="nav-item">
                <a href="{{route('report.index')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.survey_report')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">{{__('message.kpis')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('report.create')}}">{{__('message.create_kpis')}}</a>
                    </li>
                    <li>
                        <a href="{{route('kpi_report')}}">{{__('message.kpis')}} {{__('message.report')}}</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="childNav" data-parent="settings">
            <li class="nav-item">
                <a href="{{route('common_setting')}}">
                    <i class="nav-icon i-Data-Settings"></i>
                    <span class="item-name">{{__('message.common_setting')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('reset_setting')}}">
                    <i class="nav-icon i-Security-Settings"></i>
                    <span class="item-name">{{__('message.reset_setting')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('city.index')}}">
                    <i class="nav-icon i-Building"></i>
                    <span class="item-name">{{__('message.city')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.participant_setting')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('category.create')}}">{{__('message.add_category')}}</a>
                    </li>
                    <li>
                        <a href="{{route('category.index')}}">{{__('message.category_list')}}</a>
                    </li>
                    <li>
                        <a href="{{route('quick_participant')}}">{{__('message.quick_add_participant')}}</a>
                    </li>
                    <li>
                        <a>
                            <i class="nav-icon i-Conference"></i>
                            <span class="item-name">{{__('message.manage_group')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            <li>
                                <a href="{{route('group.index')}}">{{__('message.group_list')}}</a>
                            </li>
                            <li>
                                <a href="{{route('group.create')}}">{{__('message.add_group')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">{{__('message.manage_type')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            <li>
                                <a href="{{route('type.index')}}">{{__('message.type_list')}}</a>
                            </li>
                            <li>
                                <a href="{{route('type.create')}}">{{__('message.add_type')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">{{__('message.manage_template')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a>
                            <i class="nav-icon i-Email"></i>
                            <span class="item-name">{{__('message.email_c')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            <li>
                                <a href="{{route('email-template.index')}}">{{__('message.email')}}
                                    {{__('message.list')}}</a>
                            </li>
                            <li>
                                <a href="{{route('email-template.create')}}">{{__('message.add')}}
                                    {{__('message.email')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <i class="nav-icon i-Mail-Forward"></i>
                            <span class="item-name">{{__('message.sms_c')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            <li>
                                <a href="{{route('sms-template.index')}}">{{__('message.sms_c')}}
                                    {{__('message.list')}}</a>
                            </li>
                            <li>
                                <a href="{{route('sms-template.create')}}">{{__('message.add')}}
                                    {{__('message.sms_c')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Administrator"></i>
                    <span class="item-name">{{__('message.manage')}} {{__('message.user')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('user.index')}}">{{__('message.users')}} {{__('message.list')}}</a>
                    </li>
                    <li>
                        <a href="{{route('user.create')}}">{{__('message.add')}} {{__('message.users')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('user_roles.index')}}">
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.user')}} {{__('message.roles')}}</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="feedbackterminals">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('getFeedbackRatings')}}">{{__('message.feedback_ratings')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey')}}">{{__('message.feedback')}}
                            {{__('message.setting')}}</a>
                    </li>
                    <li>
                        <a href="{{route('show_question_answer')}}">{{__('message.feedback_reply')}}</a>
                    </li>
                    <li>
                        <a href="{{route('show_table_value')}}">{{__('message.feedback')}}
                            {{__('message.responses')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complaints')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('show_complain')}}">{{__('message.complaints')}}</a>
                    </li>
                    <li>
                        <a href="{{route('complain_report')}}">{{__('message.complaints')}} {{__('message.kpi')}}
                            {{__('message.report')}}</a>
                    </li>
                    <li>
                        <a href="{{route('complain_chart')}}">{{__('message.complain')}} {{__('message.chart')}}</a>
                    </li>
                    <li>
                        <a href="{{route('notification_template')}}">{{__('message.notification')}}
                            {{__('message.template')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.question')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('question_report')}}"><i class="fa fa-list"></i>{{__('message.question')}}
                            {{__('message.kpi')}} {{__('message.report')}}</a>
                    </li>
                    <li>
                        <a href="{{route('question_chart')}}"><i class="fa fa-list"></i>{{__('message.question')}}
                            {{__('message.chart')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question')}} {{__('message.list')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_report')}}">{{__('message.reason')}} {{__('message.kpi')}}
                            {{__('message.report')}}</a>
                    </li>
                    <li>
                        <a href="{{route('reason_chart')}}">{{__('message.reason')}} {{__('message.chart')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('admin/complain_pop_up')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.complain')}} {{__('message.pop_up')}}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
<?php
} else {
    //$id = Auth::user()->id;
    $permission_data = CommonHelper::getUserPermissionData();

    ?>
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            @if($permission_data->view_dashboard == 1 )
            <li class="nav-item">
                <a class="nav-item-hold" href="{{route('dashboard')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">{{__('message.dashboard')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif

            @if($permission_data->view_manage_survey_form == 1 )
            <li class="nav-item" data-item="surveymanagement">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.survey_managemnt')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif

            @if ($permission_data->view_manage_participant == 1 || $role == 4)
            <li class="nav-item" data-item="participantmanagement">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Conference"></i>
                    <span class="nav-text">{{__('message.participant_management')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if ($permission_data->view_manage_send_survey == 1)
            <li class="nav-item" data-item="sendsurvey">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Paper-Plane"></i>
                    <span class="nav-text">{{__('message.send_survey')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->view_manage_report == 1)
            <li class="nav-item" data-item="report">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.report')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->view_setting == 1)
            <li class="nav-item" data-item="settings">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Gear-2"></i>
                    <span class="nav-text">{{__('message.setting')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->feedback_terminals == 1)
            <li class="nav-item" data-item="feedbackterminals">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-item-hold" href="{{route('logout')}}">
                    <i class="nav-icon i-Key-Lock"></i>
                    <span class="nav-text">{{__('message.logout')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        @if($permission_data->view_manage_survey_form == 1 )
        <ul class="childNav" data-parent="surveymanagement">
            @if($permission_data->add_survey_form == 1)
            <li class="nav-item ">
                <a href="{{route('surveyform.create')}}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">{{__('message.add_survey_form')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->survey_form_list == 1)
            <li class="nav-item">
                <a href="{{route('surveyform.index')}}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">{{__('message.survey_form_list')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->view_manage_participant == 1 || $role == 4)
        <ul class="childNav" data-parent="participantmanagement">
            @if($permission_data->add_participant == 1 || $role == 4)
            <li class="nav-item">
                <a href="{{route('participant.create')}}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">{{__('message.add_participant')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->participant_list == 1 || $role == 4)
            <li class="nav-item">
                <a href="{{route('participant.index')}}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">{{__('message.participant_list')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->view_manage_send_survey == 1)
        <ul class="childNav" data-parent="sendsurvey">
            @if($permission_data->manual_send_survey == 1)
            <li class="nav-item">
                <a href="{{route('survey.send_manual')}}">
                    <i class="nav-icon i-Belt-3"></i>
                    <span class="item-name">{{__('message.manual')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->auto_send_survey == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Paper-Plane"></i>
                    <span class="item-name">{{__('message.auto_send')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->trigger_list_survey == 1)
                    <li>
                        <a href="{{route('trigger.index')}}">{{__('message.trigger_list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->add_trigger_survey == 1)
                    <li>
                        <a href="{{route('trigger.create')}}">{{__('message.add_new_trigger')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if($permission_data->schedule_survey == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Clock-Forward"></i>
                    <span class="item-name">{{__('message.schedule')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->schedule_list_survey == 1)
                    <li>
                        <a href="{{route('schedule.list_schedule_data')}}">{{__('message.schedule_list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->add_schedule_survey == 1)
                    <li>
                        <a href="{{route('schedule.add_scheudle_manual')}}">{{__('message.add_new_schedule')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->view_manage_report == 1)
        <ul class="childNav" data-parent="report">
            @if($permission_data->manage_survey_report == 1)
            <li class="nav-item">
                <a href="{{route('report.index')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.survey_report')}}</span>
                </a>
            </li>
            @endif
            @if ($permission_data->view_kpi_campaign == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">{{__('message.kpis')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->manage_create_kpi == 1)
                    <li>
                        <a href="{{route('report.create')}}">{{__('message.create_kpis')}}</a>
                    </li>
                    @endif
                    @if($permission_data->manage_kpi_report == 1)
                    <li>
                        <a href="{{route('kpi_report')}}">{{__('message.kpis')}} {{__('message.kpi_report')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->view_setting == 1)
        <ul class="childNav" data-parent="settings">
            @if($permission_data->view_common_setting == 1)
            <li class="nav-item">
                <a href="{{route('common_setting')}}">
                    <i class="nav-icon i-Data-Settings"></i>
                    <span class="item-name">{{__('message.common_setting')}}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{route('reset_setting')}}">
                    <i class="nav-icon i-Security-Settings"></i>
                    <span class="item-name">{{__('message.reset_setting')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('city.index')}}">
                    <i class="nav-icon  i-Building"></i>
                    <span class="item-name">{{__('message.city')}}</span>
                </a>
            </li>
            @if($permission_data->view_manage_category == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.participant_setting')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->add_participant_category == 1)
                    <li>
                        <a href="{{route('category.create')}}">{{__('message.add_category')}}</a>
                    </li>
                    @endif
                    @if($permission_data->view_category_list == 1)
                    <li>
                        <a href="{{route('category.index')}}">{{__('message.category_list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->quick_participant_setting == 1)
                    <li>
                        <a href="{{route('quick_participant')}}">{{__('message.quick_add_participant')}}</a>
                    </li>
                    @endif
                    @if($permission_data->view_manage_group == 1)
                    <li>
                        <a>
                            <i class="nav-icon i-Conference"></i>
                            <span class="item-name">{{__('message.manage_group')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            @if($permission_data->group_list == 1)
                            <li>
                                <a href="{{route('group.index')}}">{{__('message.group_list')}}</a>
                            </li>
                            @endif
                            @if($permission_data->add_group == 1)
                            <li>
                                <a href="{{route('group.create')}}">{{__('message.add_group')}}</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($permission_data->view_manage_type == 1 || $role == 4)
                    <li>
                        <a>
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">{{__('message.manage_type')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            @if($permission_data->type_list == 1 || $role == 4)
                            <li>
                                <a href="{{route('type.index')}}">{{__('message.type_list')}}</a>
                            </li>
                            @endif
                            @if($permission_data->add_list == 1 || $role == 4)
                            <li>
                                <a href="{{route('type.create')}}">{{__('message.add_type')}}</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->view_manage_template == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">{{__('message.manage_template')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->view_email_campaign == 1)
                    <li>
                        <a>
                            <i class="nav-icon i-Email"></i>
                            <span class="item-name">{{__('message.email_c')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            @if($permission_data->manage_email_list == 1)
                            <li>
                                <a href="{{route('email-template.index')}}">{{__('message.email')}}
                                    {{__('message.list')}}</a>
                            </li>
                            @endif
                            @if($permission_data->manage_add_email == 1)
                            <li>
                                <a href="{{route('email-template.create')}}">{{__('message.add')}}
                                    {{__('message.email')}} </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($permission_data->view_sms_campaign == 1)
                    <li>
                        <a>
                            <i class="nav-icon i-Mail-Forward"></i>
                            <span class="item-name">{{__('message.sms_c')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            @if($permission_data->manage_sms_list == 1)
                            <li>
                                <a href="{{route('sms-template.index')}}">{{__('message.sms_c')}}
                                    {{__('message.list')}}</a>
                            </li>
                            @endif
                            @if($permission_data->manage_add_sms == 1)
                            <li>
                                <a href="{{route('sms-template.create')}}">{{__('message.add')}}
                                    {{__('message.sms_c')}}</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->view_manage_user == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Administrator"></i>
                    <span class="item-name">{{__('message.manage')}} {{__('message.users')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->manage_user_list == 1)
                    <li>
                        <a href="{{route('user.index')}}">{{__('message.users')}} {{__('message.list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->manage_add_user == 1)
                    <li>
                        <a href="{{route('user.create')}}">{{__('message.add')}} {{__('message.users')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->view_email_campaign == 1)
            <li class="nav-item">
                <a href="{{route('user_roles.index')}}">
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.user')}} {{__('message.roles')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->feedback_terminals == 1)
        <ul class="childNav" data-parent="feedbackterminals">
            @if($permission_data->feedback_terminals == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->question_list == 1)
                    <li>
                        <a href="{{route('feedback_survey.index')}}">{{__('message.question')}}
                            {{__('message.list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->feedback_ratings == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings')}}">{{__('message.feedback_ratings')}}</a>
                    </li>
                    @endif
                    @if($permission_data->feedback_setting == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey')}}">{{__('message.feedback')}}
                            {{__('message.setting')}}</a>
                    </li>
                    @endif
                    @if($permission_data->feedback_reply == 1)
                    <li>
                        <a href="{{route('show_question_answer')}}">{{__('message.feedback_reply')}}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('show_table_value')}}">{{__('message.feedback')}}
                            {{__('message.responses')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if($permission_data->complaints == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complaints')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->complaints == 1)
                    <li>
                        <a href="{{route('show_complain')}}">{{__('message.complaints')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_kpi_report == 1)
                    <li>
                        <a href="{{route('question_report')}}">{{__('message.complaints')}}
                            {{__('message.kpi')}} {{__('message.report')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_chart == 1)
                    <li>
                        <a href="{{route('question_chart')}}">{{__('message.complain')}} {{__('message.chart')}}</a>
                    </li>
                    @endif
                    @if($permission_data->complain_kpi == 1)
                    <li>
                        <a href="{{route('complain_report')}}">{{__('message.complaints')}} {{__('message.kpi')}}
                            {{__('message.report')}}</a>
                    </li>
                    @endif
                    @if($permission_data->complain_chart == 1)
                    <li>
                        <a href="{{route('complain_chart')}}">{{__('message.complain')}} {{__('message.chart')}}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('notification_template')}}">{{__('message.notification')}}
                            {{__('message.template')}}</a>
                    </li>
                    @if($permission_data->reason_kpi == 1)
                    <li>
                        <a href="{{route('reason_report')}}">{{__('message.reason')}} {{__('message.kpi')}}
                            {{__('message.report')}}</a>
                    </li>
                    @endif
                    @if($permission_data->reason_chart == 1)
                    <li>
                        <a href="{{route('reason_chart')}}">{{__('message.reason')}} {{__('message.chart')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->live_link == 1)
            <li class="nav-item dropdown-sidemenu">
                <a target="_blank" href="{{URL::to('get_question_form')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link')}}</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('complain_pop_up')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.complain')}} {{__('message.pop_up')}}</span>
                </a>
            </li>
        </ul>
        @endif
    </div>
    <div class="sidebar-overlay"></div>
</div>
<?php } ?>
<!--=============== Left side End ================-->