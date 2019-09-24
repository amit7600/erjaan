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
            <li class="nav-item" data-item="sendsurvey">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Paper-Plane"></i>
                    <span class="nav-text">{{__('message.send_survey')}}</span>
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
            <li class="nav-item" data-item="feedbackterminals_1">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_1')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="feedbackterminals_2">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_2')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="feedbackterminals_3">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_3')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="feedbackterminals_4">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_4')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="feedbackterminals_5">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_5')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="complainMenu">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.complain')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="report">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.kpis')}}</span>
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
            <li class="nav-item">
                <a href="{{route('report.index')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.survey_report')}}</span>
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
                        <a href="{{route('kpi_report')}}">{{__('message.kpis_report')}}</a>
                    </li>
                </ul>

            </li>
            <li class="nav-item">
                <a href="{{route('reason_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.reason_kpi_report')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('question_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.question_kpi_report')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('complain_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_kpi_report')}}</span>

                </a>
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
                    <span class="item-name">{{__('message.location')}}</span>
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
                    <span class="item-name">{{__('message.manage_user')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('user.index')}}">{{__('message.users_list')}}</a>
                    </li>
                    <li>
                        <a href="{{route('user.create')}}">{{__('message.add_users')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('user_roles.index')}}">
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.user_roles')}}</span>
                </a>
            </li>
        </ul>



        <ul class="childNav" data-parent="feedbackterminals_1">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_1')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- <li>
                        <a href="{{route('getFeedbackRatings')}}">{{__('message.feedback_ratings_1')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey')}}">{{__('message.feedback_setting_1')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('show_question_answer')}}">{{__('message.feedback_reply_1')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{route('show_table_value')}}">{{__('message.feedback_responses_1')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_1')}}</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_1')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_chart')}}">{{__('message.reason_report_1')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_reason_setting')}}">{{__('message.reason_setting_1')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_1')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('get_user_report_1')}}">{{__('message.user_report_1')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_location_report_1')}}">{{__('message.location_report_1')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_1')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_1')}}</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="feedbackterminals_2">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- <li>
                        <a href="{{route('getFeedbackRatings_2')}}">{{__('message.feedback_ratings_2')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_2')}}">{{__('message.feedback_setting_2')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('show_question_answer_2')}}">{{__('message.feedback_reply_2')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{route('show_table_value_2')}}">{{__('message.feedback_responses_2')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey_2.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_2')}}</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_chart_2')}}">{{__('message.reason_report_2')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_reason_setting_2')}}">{{__('message.reason_setting_2')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('get_user_report_2')}}">{{__('message.user_report_2')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_location_report_2')}}">{{__('message.location_report_2')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('question_chart_2')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_2')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_2')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_2')}}</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="feedbackterminals_3">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- <li>
                        <a href="{{route('getFeedbackRatings_3')}}">{{__('message.feedback_ratings_3')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_3')}}">{{__('message.feedback_setting_3')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('show_question_answer_3')}}">{{__('message.feedback_reply_3')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{route('show_table_value_3')}}">{{__('message.feedback_responses_3')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey_3.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_3')}}</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_chart_3')}}">{{__('message.reason_report_3')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_reason_setting_3')}}">{{__('message.reason_setting_3')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('get_user_report_3')}}">{{__('message.user_report_3')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_location_report_3')}}">{{__('message.location_report_3')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('question_chart_3')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_3')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_3')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_3')}}</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="feedbackterminals_4">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- <li>
                        <a href="{{route('getFeedbackRatings_4')}}">{{__('message.feedback_ratings_4')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_4')}}">{{__('message.feedback_setting_4')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('show_question_answer_4')}}">{{__('message.feedback_reply_4')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{route('show_table_value_4')}}">{{__('message.feedback_responses_4')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey_4.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_4')}}</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_chart_4')}}">{{__('message.reason_report_4')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_reason_setting_4')}}">{{__('message.reason_setting_4')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('get_user_report_4')}}">{{__('message.user_report_4')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_location_report_4')}}">{{__('message.location_report_4')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('question_chart_4')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_4')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_4')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_4')}}</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="feedbackterminals_5">
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- <li>
                        <a href="{{route('getFeedbackRatings_5')}}">{{__('message.feedback_ratings_5')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_5')}}">{{__('message.feedback_setting_5')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('show_question_answer_5')}}">{{__('message.feedback_reply_5')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{route('show_table_value_5')}}">{{__('message.feedback_responses_5')}}</a>
                    </li>
                    <li>
                        <a href="{{route('feedback_survey_5.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_5')}}</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('reason_chart_5')}}">{{__('message.reason_report_5')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_reason_setting_5')}}">{{__('message.reason_setting_5')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{route('get_user_report_5')}}">{{__('message.user_report_5')}}</a>
                    </li>
                    <li>
                        <a href="{{route('get_location_report_5')}}">{{__('message.location_report_5')}}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('question_chart_5')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_5')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_5')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_5')}}</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="complainMenu">
            <li class="nav-item">
                <a href="{{route('show_complain')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complaints')}}</span>

                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('complain_chart')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_report')}}</span>

                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('notification_template')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.notification_template')}}</span>

                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('get_complain_setting')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_setting')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('admin/complain_pop_up')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.complain_pop_up')}}</span>
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

            @if ($permission_data->view_manage_participant == 1 )
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
            <li class="nav-item" data-item="feedbackterminals_1">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_1')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->feedback_terminals_2 == 1)
            <li class="nav-item" data-item="feedbackterminals_2">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_2')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->feedback_terminals_3 == 1)
            <li class="nav-item" data-item="feedbackterminals_3">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_3')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->feedback_terminals_4 == 1)
            <li class="nav-item" data-item="feedbackterminals_4">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_4')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->feedback_terminals_5 == 1)
            <li class="nav-item" data-item="feedbackterminals_5">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.feedback_terminal_5')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif

            @if($permission_data->complainMenu == 1)
            <li class="nav-item" data-item="complainMenu">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Speach-Bubble-Dialog"></i>
                    <span class="nav-text">{{__('message.complain')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            @if($permission_data->view_manage_report == 1)
            <li class="nav-item" data-item="report">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">{{__('message.kpis')}}</span>
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
            @if($permission_data->manage_survey_report == 1)
            <li class="nav-item">
                <a href="{{route('report.index')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.survey_report')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->view_manage_participant == 1 )
        <ul class="childNav" data-parent="participantmanagement">
            @if($permission_data->add_participant == 1 )
            <li class="nav-item">
                <a href="{{route('participant.create')}}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">{{__('message.add_participant')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->participant_list == 1 )
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
            @if($permission_data->reset_setting == 1)
            <li class="nav-item">
                <a href="{{route('reset_setting')}}">
                    <i class="nav-icon i-Security-Settings"></i>
                    <span class="item-name">{{__('message.reset_setting')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->city == 1)
            <li class="nav-item">
                <a href="{{route('city.index')}}">
                    <i class="nav-icon  i-Building"></i>
                    <span class="item-name">{{__('message.location')}}</span>
                </a>
            </li>
            @endif
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
                    @if($permission_data->view_manage_type == 1 )
                    <li>
                        <a>
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">{{__('message.manage_type')}}</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu" style="max-height: inherit;padding-left: 20px;">
                            @if($permission_data->type_list == 1 )
                            <li>
                                <a href="{{route('type.index')}}">{{__('message.type_list')}}</a>
                            </li>
                            @endif
                            @if($permission_data->add_list == 1 )
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
                    <span class="item-name">{{__('message.manage_user')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->manage_user_list == 1)
                    <li>
                        <a href="{{route('user.index')}}">{{__('message.users_list')}}</a>
                    </li>
                    @endif
                    @if($permission_data->manage_add_user == 1)
                    <li>
                        <a href="{{route('user.create')}}">{{__('message.add_users')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->view_email_campaign == 1)
            <li class="nav-item">
                <a href="{{route('user_roles.index')}}">
                    <i class="nav-icon i-Male-21"></i>
                    <span class="item-name">{{__('message.user_roles')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->feedback_terminals == 1)
        <ul class="childNav" data-parent="feedbackterminals_1">
            @if($permission_data->feedback_terminals == 1)

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- @if($permission_data->feedback_ratings == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings')}}">{{__('message.feedback_ratings')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_setting == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey')}}">{{__('message.feedback_setting_1')}}</a>
                    </li>
                    @endif
                    {{-- @if($permission_data->feedback_reply == 1)
                    <li>
                        <a href="{{route('show_question_answer')}}">{{__('message.feedback_reply')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_response == 1)
                    <li>
                        <a href="{{route('show_table_value')}}">{{__('message.feedback_responses')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_list == 1)
                    <li>
                        <a href="{{route('feedback_survey.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    @if($permission_data->reason_chart == 1)
                    <li>
                        <a href="{{route('reason_chart')}}">{{__('message.reason_report')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_reason_setting == 1)
                    <li>
                        <a href="{{route('get_reason_setting')}}">{{__('message.reason_setting_1')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @if($permission_data->userReport == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_1')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->get_user_report == 1)
                    <li>
                        <a href="{{route('get_user_report_1')}}">{{__('message.user_report_1')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_location_report == 1)
                    <li>
                        <a href="{{route('get_location_report_1')}}">{{__('message.location_report_1')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->question_chart == 1)
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_1')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->live_link == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        {{-- feedback terminal 2 --}}

        @if($permission_data->feedback_terminals_2 == 1)
        <ul class="childNav" data-parent="feedbackterminals_2">
            @if($permission_data->feedback_terminals_2 == 1)

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- @if($permission_data->feedback_ratings_2 == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings_2')}}">{{__('message.feedback_ratings_2')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_setting_2 == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_2')}}">{{__('message.feedback_setting_2')}}</a>
                    </li>
                    @endif
                    {{-- @if($permission_data->feedback_reply_2 == 1)
                    <li>
                        <a href="{{route('show_question_answer_2')}}">{{__('message.feedback_reply_2')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_response_2 == 1)
                    <li>
                        <a href="{{route('show_table_value_2')}}">{{__('message.feedback_responses_2')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_list_2 == 1)
                    <li>
                        <a href="{{route('feedback_survey_2.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_2')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    @if($permission_data->reason_chart_2 == 1)
                    <li>
                        <a href="{{route('reason_chart_2')}}">{{__('message.reason_report_2')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_reason_setting_2 == 1)
                    <li>
                        <a href="{{route('get_reason_setting_2')}}">{{__('message.reason_setting_2')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @if($permission_data->userReport_2 == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_2')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->get_user_report_2 == 1)
                    <li>
                        <a href="{{route('get_user_report_2')}}">{{__('message.user_report_2')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_location_report_2 == 1)
                    <li>
                        <a href="{{route('get_location_report_2')}}">{{__('message.location_report_2')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->question_chart_2 == 1)
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_2')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->live_link_2 == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_2')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_2')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        {{-- feedback terminal 3 --}}

        @if($permission_data->feedback_terminals_3 == 1)
        <ul class="childNav" data-parent="feedbackterminals_3">
            @if($permission_data->feedback_terminals_3 == 1)

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- @if($permission_data->feedback_ratings_3 == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings_3')}}">{{__('message.feedback_ratings_3')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_setting_3 == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_3')}}">{{__('message.feedback_setting_3')}}</a>
                    </li>
                    @endif
                    {{-- @if($permission_data->feedback_reply_3 == 1)
                    <li>
                        <a href="{{route('show_question_answer_3')}}">{{__('message.feedback_reply_3')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_response_3 == 1)
                    <li>
                        <a href="{{route('show_table_value_3')}}">{{__('message.feedback_responses_3')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_list_3 == 1)
                    <li>
                        <a href="{{route('feedback_survey_3.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_3')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    @if($permission_data->reason_chart_3 == 1)
                    <li>
                        <a href="{{route('reason_chart_3')}}">{{__('message.reason_report_3')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_reason_setting_3 == 1)
                    <li>
                        <a href="{{route('get_reason_setting_3')}}">{{__('message.reason_setting_3')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @if($permission_data->userReport_3 == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_3')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->get_user_report_3 == 1)
                    <li>
                        <a href="{{route('get_user_report_3')}}">{{__('message.user_report_3')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_location_report_3 == 1)
                    <li>
                        <a href="{{route('get_location_report_3')}}">{{__('message.location_report_3')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->question_chart_3 == 1)
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_3')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->live_link_3 == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_3')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_3')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        {{-- feedback terminal 4 --}}

        @if($permission_data->feedback_terminals_4 == 1)
        <ul class="childNav" data-parent="feedbackterminals_4">
            @if($permission_data->feedback_terminals_4 == 1)

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- @if($permission_data->feedback_ratings_4 == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings_4')}}">{{__('message.feedback_ratings_4')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_setting_4 == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_4')}}">{{__('message.feedback_setting_4')}}</a>
                    </li>
                    @endif
                    {{-- @if($permission_data->feedback_reply_4 == 1)
                    <li>
                        <a href="{{route('show_question_answer_4')}}">{{__('message.feedback_reply_4')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_response_4 == 1)
                    <li>
                        <a href="{{route('show_table_value_4')}}">{{__('message.feedback_responses_4')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_list_4 == 1)
                    <li>
                        <a href="{{route('feedback_survey_4.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_4')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    @if($permission_data->reason_chart_4 == 1)
                    <li>
                        <a href="{{route('reason_chart_4')}}">{{__('message.reason_report_4')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_reason_setting_4 == 1)
                    <li>
                        <a href="{{route('get_reason_setting_4')}}">{{__('message.reason_setting_4')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @if($permission_data->userReport_4 == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_4')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->get_user_report_4 == 1)
                    <li>
                        <a href="{{route('get_user_report_4')}}">{{__('message.user_report_4')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_location_report_4 == 1)
                    <li>
                        <a href="{{route('get_location_report_4')}}">{{__('message.location_report_4')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->question_chart_4 == 1)
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_4')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->live_link_4 == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_4')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_4')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        {{-- feedback terminal 5 --}}

        @if($permission_data->feedback_terminals_5 == 1)
        <ul class="childNav" data-parent="feedbackterminals_5">
            @if($permission_data->feedback_terminals_5 == 1)

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">{{__('message.feedback_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    {{-- @if($permission_data->feedback_ratings_5 == 1)
                    <li>
                        <a href="{{route('getFeedbackRatings_5')}}">{{__('message.feedback_ratings_5')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_setting_5 == 1)
                    <li>
                        <a href="{{URL::to('admin/show_feedback_survey_5')}}">{{__('message.feedback_setting_5')}}</a>
                    </li>
                    @endif
                    {{-- @if($permission_data->feedback_reply_5 == 1)
                    <li>
                        <a href="{{route('show_question_answer_5')}}">{{__('message.feedback_reply_5')}}</a>
                    </li>
                    @endif --}}
                    @if($permission_data->feedback_response_5 == 1)
                    <li>
                        <a href="{{route('show_table_value_5')}}">{{__('message.feedback_responses_5')}}</a>
                    </li>
                    @endif
                    @if($permission_data->question_list_5 == 1)
                    <li>
                        <a href="{{route('feedback_survey_5.index')}}"><i
                                class="fa fa-list"></i>{{__('message.question_list_5')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.reason_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    @if($permission_data->reason_chart_5 == 1)
                    <li>
                        <a href="{{route('reason_chart_5')}}">{{__('message.reason_report_5')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_reason_setting_5 == 1)
                    <li>
                        <a href="{{route('get_reason_setting_5')}}">{{__('message.reason_setting_5')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @if($permission_data->userReport_5 == 1)
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Testimonal"></i>
                    <span class="item-name">{{__('message.user_report_5')}}</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    @if($permission_data->get_user_report_5 == 1)
                    <li>
                        <a href="{{route('get_user_report_5')}}">{{__('message.user_report_5')}}</a>
                    </li>
                    @endif
                    @if($permission_data->get_location_report_5 == 1)
                    <li>
                        <a href="{{route('get_location_report_5')}}">{{__('message.location_report_5')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->question_chart_5 == 1)
            <li class="nav-item">
                <a href="{{route('question_chart')}}"><i class="nav-icon i-Link-2"></i><span
                        class="item-name">{{__('message.feedback_terminal_report_5')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->live_link_5 == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('get_question_form_5')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.live_link_5')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif

        @if($permission_data->complainMenu == 1)
        <ul class="childNav" data-parent="complainMenu">
            @if($permission_data->complaints == 1)
            <li class="nav-item">
                <a href="{{route('show_complain')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complaints')}}</span>

                </a>
            </li>
            @endif

            @if($permission_data->complain_chart == 1)
            <li class="nav-item">
                <a href="{{route('complain_chart')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_report')}}</span>

                </a>
            </li>
            @endif
            @if($permission_data->notification_template == 1)
            <li class="nav-item">
                <a href="{{route('notification_template')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.notification_template')}}</span>

                </a>
            </li>
            @endif
            @if($permission_data->get_complain_setting == 1)
            <li class="nav-item">
                <a href="{{route('get_complain_setting')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_setting')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->complain_pop_up == 1)
            <li class="nav-item">
                <a target="_blank" href="{{URL::to('admin/complain_pop_up')}}">
                    <i class="nav-icon i-Link-2"></i>
                    <span class="item-name">{{__('message.complain_pop_up')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif
        @if($permission_data->view_manage_report == 1)
        <ul class="childNav" data-parent="report">
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
                        <a href="{{route('kpi_report')}}">{{__('message.kpis_report')}}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission_data->reason_kpi == 1)
            <li class="nav-item">
                <a href="{{route('reason_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.reason_kpi_report')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->question_kpi_report == 1)
            <li class="nav-item">
                <a href="{{route('question_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.question_kpi_report')}}</span>
                </a>
            </li>
            @endif
            @if($permission_data->complain_kpi == 1)
            <li class="nav-item">
                <a href="{{route('complain_report')}}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">{{__('message.complain_kpi_report')}}</span>
                </a>
            </li>
            @endif
        </ul>
        @endif
    </div>
    <div class="sidebar-overlay"></div>
</div>
<?php } ?>
<!--=============== Left side End ================-->