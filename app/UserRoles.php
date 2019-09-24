<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = "tbl_user_role";

    protected $fillable = ['role', 'status', 'view_dashboard', 'view_setting', 'view_common_setting', 'view_manage_user', 'view_manage_category', 'view_manage_group', 'view_manage_type', 'view_manage_survey_form', 'view_manage_participant', 'add_participant', 'participant_list', 'view_manage_send_survey', 'view_email_campaign', 'view_sms_campaign', 'view_kpi_campaign', 'add_survey_form', 'survey_form_list', 'group_list', 'add_group', 'type_list', 'add_list', 'manual_send_survey', 'auto_send_survey', 'trigger_list_survey', 'add_trigger_survey', 'schedule_survey', 'schedule_list_survey', 'add_schedule_survey', 'manage_survey_report', 'manage_kpi_campaign', 'manage_create_kpi', 'manage_kpi_report', 'view_participant_setting', 'add_participant_category', 'view_category_list', 'view_manage_template', 'manage_email_list', 'manage_add_email', 'manage_sms_list', 'manage_add_sms', 'manage_user_list', 'manage_add_user', 'view_manage_report', 'quick_participant_setting', 'feedback_terminals', 'question_list', 'feedback_setting', 'auto_send_survey_survey', 'feedback_ratings', 'user_role', 'add_type', 'complaints', 'question_kpi_report', 'question_chart', 'live_link', 'report_kpi', 'report_kpi_sms_feedback', 'report_kpi_reasons_complains', 'complains_status', 'participants_list', 'quick_add_participants_button', 'feedback_reply', 'sms', 'email', 'sms_balance', 'complaints_box', 'feedback_terminal_response', 'new_participant', 'updated_participant', 'complain_kpi', 'complain_chart', 'reason_kpi', 'reason_chart', 'created_at','complainMenu','level','reset_setting','city','get_reason_setting','notification_template','get_complain_setting','complain_pop_up','feedback_terminals_5','question_list_5','feedback_setting_5','get_reason_setting_5','reason_chart_5','feedback_ratings_5','feedback_reply_5','question_chart_5','live_link_5','complainMenu_5','complaints_5','complain_chart_5','notification_template_5','get_complain_setting_5','complain_pop_up_5','feedback_terminals_4','question_list_4','feedback_setting_4','get_reason_setting_4','reason_chart_4','feedback_ratings_4','feedback_reply_4','question_chart_4','live_link_4','complainMenu_4','complaints_4','complain_chart_4','notification_template_4','get_complain_setting_4','complain_pop_up_4','feedback_terminals_3','question_list_3','feedback_setting_3','get_reason_setting_3','reason_chart_3','feedback_ratings_3','feedback_reply_3','question_chart_3','live_link_3','complainMenu_3','complaints_3','complain_chart_3','notification_template_3','get_complain_setting_3','complain_pop_up_3','feedback_terminals_2','question_list_2','feedback_setting_2','get_reason_setting_2','reason_chart_2','feedback_ratings_2','feedback_reply_2','question_chart_2','live_link_2','complainMenu_2','complaints_2','complain_chart_2','notification_template_2','get_complain_setting_2','complain_pop_up_2','dashboard_feedback_terminals_2','dashboard_feedback_terminals_3','dashboard_feedback_terminals_4','dashboard_feedback_terminals_5','dashboard_feedback_reason_2','dashboard_feedback_reason_3','dashboard_feedback_reason_4','dashboard_feedback_reason_5','userReport','get_user_report','get_location_report','userReport_2','get_user_report_2','get_location_report_2','userReport_3','get_user_report_3','get_location_report_3','userReport_4','get_user_report_4','get_location_report_4','userReport_5','get_user_report_5','get_location_report_5','report_sms_feedback','kpi_sms_feedback','dashboard_feedback_terminals_1','dashboard_complain_kpi','complain_status_chart','dashboard_feedback_reason_1','complain_list','feedback_terminal_responses_1','feedback_terminal_responses_2','feedback_terminal_responses_3','feedback_terminal_responses_4','feedback_terminal_responses_5','reason_kpi_dashboard'];
}
