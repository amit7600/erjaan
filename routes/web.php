<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::get('/', function() {
//     return view('api/index');
// });

Route::get('/', function () {
    return view('front/welcome');
})->name('home');

Route::get('/cache_clean', function () {
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    echo 'clear';
});
Route::get('/ar', function () {
    return view('front_arebic/welcome');
})->name('home');
Route::get('locale/{locale}', 'HomeController@setLocale')->name('setLocale');
Route::get('testSMS', 'HomeController@testSMS')->name('testSMS');
Route::get('check_sms_balence', 'HomeController@checkSmsBalence')->name('check_sms_balence');

Route::get('survey_form/{token?}/{id?}/{ids?}/{unique_id?}/{submitted_by}', 'HomeController@surveyForm')->name('survey_form');
Route::get('survey_result/{id?}', 'HomeController@surveyResult')->name('survey_result');

Route::post('submit_survey_form', 'HomeController@submitSurveyForm')->name('submit_survey_form');

Route::get('change-password/{token?}', 'HomeController@change_password')->name('change_password');
Route::post('change-new-password', 'HomeController@save_new_password')->name('change_new_password');

Route::get('admin', 'Admin\HomeController@getLogin')->name('admin');
Route::post('admin/login', 'Admin\HomeController@postLogin')->name('admin_login');

Route::post('admin/database_config', 'Admin\HomeController@database_config')->name('database_config');
Route::get('admin/admin_edit', 'Admin\HomeController@admin_edit')->name('admin_edit');

Route::post('admin/admin_config', 'Admin\HomeController@admin_config')->name('admin_config');

//register reparimens form
Route::get('register', 'Admin\HomeController@getRegister')->name('getRegister');
Route::post('admin/register', 'Admin\HomeController@postRegister')->name('repairmen_register');

//lost password
Route::get('forgotpassword', 'Admin\HomeController@forgotPassword')->name('forgotPassword');
Route::post('forgotPasswordRequest', 'Admin\HomeController@forgotPasswordRequest')->name('forgotPasswordRequest');

//cron job controller for triggers
Route::get('newusertrigger', 'Admin\CronjobtriggerController@triggerForNewParticipant')->name('newusertrigger');
Route::get('updateusertrigger', 'Admin\CronjobtriggerController@triggerForUpdateParticipant')->name('updateusertrigger');

//cron job controller for schedule
Route::get('scheduletrigger', 'Admin\CronjobtriggerController@scheduleTrigger')->name('scheduletrigger');
Route::get('scheduleremindertrigger', 'Admin\CronjobtriggerController@scheduleReminderTrigger')->name('scheduleremindertrigger');

// cron job for change status for complain
Route::get('changeComplainStatus', 'Admin\CronjobtriggerController@changeComplainStatus')->name('changeComplainStatus');

Route::group(['middleware' => 'auth'], function () {
//03/05/2019
    //show question in front end.
    Route::get('get_question_form', 'Admin\FeedbackController@get_question_form');
    Route::get('get_question_form_2', 'Admin\Feedback2Controller@get_question_form');
    Route::get('get_question_form_3', 'Admin\Feedback3Controller@get_question_form');
    Route::get('get_question_form_4', 'Admin\Feedback4Controller@get_question_form');
    Route::get('get_question_form_5', 'Admin\Feedback5Controller@get_question_form');
    Route::post('store_survey', 'Admin\FeedbackController@store_survey_question')->name('store_survey');
    Route::post('store_survey_2', 'Admin\Feedback2Controller@store_survey_question')->name('store_survey_2');
    Route::post('store_survey_3', 'Admin\Feedback3Controller@store_survey_question')->name('store_survey_3');
    Route::post('feedBackComplaints', 'Admin\FeedbackController@feedBackComplaints')->name('feedBackComplaints');
    Route::post('feedBackComplaints_2', 'Admin\FeedbackController@feedBackComplaints')->name('feedBackComplaints_2');
    Route::post('feedBackComplaints_3', 'Admin\FeedbackController@feedBackComplaints')->name('feedBackComplaints_3');
    Route::post('store_survey_4', 'Admin\Feedback4Controller@store_survey_question')->name('store_survey_4');
    Route::post('store_survey_4', 'Admin\Feedback4Controller@store_survey_question')->name('store_survey_4');
    Route::post('store_survey_5', 'Admin\Feedback5Controller@store_survey_question')->name('store_survey_5');
    Route::post('store_survey_5', 'Admin\Feedback5Controller@store_survey_question')->name('store_survey_5');

    // for feedback ratiing --- 09-05-2019
    Route::post('feedBackRatings', 'Admin\FeedbackController@feedBackRatings')->name('feedBackRatings');
    Route::post('feedBackRatings_2', 'Admin\Feedback2Controller@feedBackRatings')->name('feedBackRatings_2');
    Route::post('feedBackRatings_3', 'Admin\Feedback3Controller@feedBackRatings')->name('feedBackRatings_3');
    Route::post('feedBackRatings_4', 'Admin\Feedback4Controller@feedBackRatings')->name('feedBackRatings_4');
    Route::post('feedBackRatings_5', 'Admin\Feedback5Controller@feedBackRatings')->name('feedBackRatings_5');
});

//this route for complain pop-up
Route::get('admin/complain_pop_up', 'Admin\FeedbackController@complain_pop_up')->name('complain_pop_up');
Route::post('post_complain', 'Admin\FeedbackController@post_complain')->name('post_complain');

/**
 * ADMIN::ROUTE START HERE
 * Route for admin section with middleware
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('get_question_answer_dashbaord/{id}', 'DashboardController@getQuestionAnswersDashboard')->name('get_question_answer_dashbaord');
    Route::get('profile', 'ProfileController@getProfile')->name('get_admin_profile');
    Route::post('profile', 'ProfileController@updateProfile')->name('update_admin_profile');
    Route::get('logout', 'ProfileController@logout')->name('logout');

    //user list
    Route::resource('user', 'UserController');

    //survery form list
    Route::resource('surveyform', 'SurveyformController');
    //Route::resource('surveyquestion', 'SurveyQuestionController');
    Route::resource('survey_option', 'SurveyOptionController');

    Route::resource('category', 'CategoryController');
    Route::resource('sub_category', 'SubCategoryController');
    Route::get('sub_category_list/{id}', 'SubCategoryController@index')->name('sub_category_list');

    Route::get('participant/export', 'ExcelController@export');
    Route::get('participant/import', 'ExcelController@showImport');
    Route::post('participant/import', 'ExcelController@import');

    Route::resource('group', 'GroupController');
    Route::resource('type', 'TypeController');
    Route::resource('participant', 'ParticipantController');
    Route::resource('email-template', 'EmailTemplateController');
    Route::resource('sms-template', 'SMSTemplateController');
    Route::resource('trigger', 'TriggerController');
    Route::resource('report', 'ReportController');

    Route::get('participant_submitted_form/{id?}', 'ReportController@participantSubmittedForms')->name('participant_form');

    Route::get('survey_report/{token?}', 'ReportController@filterSurveyReport')->name('survey_report');
    Route::get('get_question_answer/{id}', 'ReportController@getQuestionAnswers')->name('get_question_answer');
    Route::get('get_question_answer_participant/{id?}', 'ReportController@getParticipantQuestionAnswers')->name('get_question_answer_participant');

    Route::any('get_survey_report/{token?}', 'ReportController@getSurveyReport')->name('get_survey_report');
    Route::any('get_survey_report_for_participant/{token?}', 'ReportController@getSurveyReportForParticipant')->name('get_survey_report_for_participant');
    Route::post('get_survey_report_kpi', 'ReportController@getSurveyReportKpi')->name('get_survey_report_kpi');
//    Route::get('created_kpi', 'ReportController@createKpiReportForm')->name('created_kpi');
    Route::get('kpi_report', 'ReportController@getKpiReports')->name('kpi_report');
    Route::get('get_kpi_report_detials', 'ReportController@getKpiReportDetails')->name('get_kpi_report_detials');
    //24/09/2018
    Route::get('get_kpi_report_details', 'ReportController@get_Kpi_ReportDetails')->name('get_kpi_report_details');
    //

    //Route::get('delete_kpi_report_detials/{id}', 'ReportController@deleteKpiReportDetails');
    Route::post('delete_kpi_report_detials', 'ReportController@deleteKpiReportDetails')->name('delete_kpi_report_detials');

    Route::get('get_survery_form_detials', 'ReportController@getSurveyFormDetails')->name('get_survery_form_detials');
    Route::get('get_survey_question_option_highest_value', 'ReportController@getSurveyQuestionOptionHighestValue')->name('get_survey_question_option_highest_value');
    Route::get('get_survey_form', 'ReportController@getSurveyForm')->name('get_survey_form');

    Route::post('check_balence', 'ParticipantController@checkSMSBalence')->name('check_balence');
    Route::get('participant_form_details/{id?}/{token?}', 'ParticipantController@form_detail')->name('participant_form_details');
    Route::get('display_survey_participant', 'ParticipantController@displaySurveyParticipant')->name('display_survey_participant');
    Route::get('get_country_code/{id?}', 'ParticipantController@get_dialing_code')->name('get_country_code');

    Route::get('get_email_template', 'EmailTemplateController@emailTemplateList')->name('get_email_template');
    Route::get('get_sms_template', 'SMSTemplateController@smsTemplateList')->name('get_sms_template');

    Route::post('resend_survey_to_participant', 'SurveyformController@reSendNotifyToParticipant')->name('resend_survey_to_participant');
    Route::post('survey_form_details', 'SurveyformController@get_survey_form_details')->name('survey_form_details');
    Route::post('delete_survey_option', 'SurveyformController@deleteSurveyOption')->name('delete_survey_option');
    Route::post('delete_survey_question', 'SurveyformController@deleteSurveyQuestion')->name('delete_survey_question');
    Route::get('send-survey-manual', 'SurveyformController@sendSurveyManual')->name('survey.send_manual');

    //schedule api
    Route::resource('schedule', 'ScheduleController');
    Route::get('add-schedule-manual', 'ScheduleController@addScheduleManual')->name('schedule.add_scheudle_manual');
    Route::post('add_schedule_reminder', 'ScheduleController@addScheduleReminder')->name('schedule.add_schedule_reminder');
    Route::post('get_schedule_reminder', 'ScheduleController@getScheduleReminderData')->name('schedule.get_schedule_reminder');
    Route::post('add_schedule_data', 'ScheduleController@addScheduleData')->name('schedule.add_schedule_data');
    Route::get('list_schedule_data', 'ScheduleController@listScheduleData')->name('schedule.list_schedule_data');

    Route::delete('activate_schedule/{id}', 'ScheduleController@activateSchedule')->name('schedule.activate_schedule');
    Route::delete('dactivate_schedule/{id}', 'ScheduleController@dactivateSchedule')->name('schedule.dactivate_schedule');

    //toshow the attached participant in a schedule
    Route::get('list_schedule_participants/{id}', 'ParticipantController@listScheduleParticipants')->name('schedule.list_schedule_participants');

    Route::get('auto_trigger_setting', 'SurveyformController@autoTriggerSetting')->name('survey.auto_trigger_setting');
    Route::post('save_auto_trigger_setting', 'SurveyformController@saveAutoTriggerSetting')->name('save_auto_trigger_setting');
    Route::get('common_setting', 'SettingController@commonSetting')->name('common_setting');
    Route::get('reset_setting', 'SettingController@resetSetting')->name('reset_setting');
    Route::post('save_common_setting', 'SettingController@saveCommonSetting')->name('save_common_setting');

    // 30-08-2018
    Route::post('dashboardChange', 'DashboardController@dashboardChange');
    // 31-08-2018
    Route::post('Quick_Add_Participant', 'ParticipantController@Quick_Add_Participant');
    // 07-09-2018
    Route::get('get_form_question', 'SettingController@get_form_question')->name('get_form_question');
    //sms reset
    Route::get('sms_reset', 'DashboardController@sms_reset');
    Route::get('email_reset', 'DashboardController@email_reset');

    //16-01-2019
    Route::get('quick_participant', 'SettingController@quick_participant')->name('quick_participant');
    Route::get('quick_participant_setting', 'ParticipantController@quick_participant_setting');

    //feedback survey 1
    Route::resource('feedback_survey', 'FeedbackController');

    Route::get('show_feedback_survey', 'FeedbackController@show_feedback_survey')->name('show_feedback_survey');
    Route::match(array('PUT', 'POST'), 'store_question', 'FeedbackController@store_question')->name('store_question');
    Route::post('change_status', 'FeedbackController@change_status')->name('change_status');
    Route::post('removeImage', 'FeedbackController@removeImage')->name('removeImage');
    Route::post('removeImage_mobile', 'Feedback2Controller@removeImageMobile')->name('removeImage_mobile');
    Route::get('show_question_answer', 'FeedbackController@show_question_answer')->name('show_question_answer');

    //feedback survey 2
    Route::resource('feedback_survey_2', 'Feedback2Controller');
    Route::get('getFeedbackRatings_2', 'Feedback2Controller@getFeedbackRatings')->name('getFeedbackRatings_2');
    Route::get('show_question_answer_2', 'Feedback2Controller@show_question_answer')->name('show_question_answer_2');
    Route::get('show_table_value_2', 'Feedback2Controller@show_table_value')->name('show_table_value_2');
    Route::get('question_chart_2', 'Feedback2Controller@question_chart')->name('question_chart_2');
    Route::post('chart_session_2', 'Feedback2Controller@chart_session')->name('chart_session_2');
    Route::get('reason_chart_2', 'Feedback2Controller@reason_chart')->name('reason_chart_2');
    Route::post('reason_chart_filter_2', 'Feedback2Controller@reason_chart_filter')->name('reason_chart_filter_2');
    Route::get('get_reason_setting_2', 'Reason2Controller@get_reason_setting')->name('get_reason_setting_2');
    Route::match(array('PUT', 'POST'), 'reason_setting_2', 'Reason2Controller@reason_setting')->name('reason_setting_2');

    Route::get('show_feedback_survey_2', 'Feedback2Controller@show_feedback_survey')->name('show_feedback_survey_2');
    Route::match(array('PUT', 'POST'), 'store_question_2', 'Feedback2Controller@store_question')->name('store_question_2');
    Route::post('change_status_2', 'Feedback2Controller@change_status')->name('change_status_2');
    Route::post('removeImage_2', 'Feedback2Controller@removeImage')->name('removeImage_2');

    //feedback survey 3
    Route::resource('feedback_survey_3', 'Feedback3Controller');
    Route::get('getFeedbackRatings_3', 'Feedback3Controller@getFeedbackRatings')->name('getFeedbackRatings_3');
    Route::get('show_question_answer_3', 'Feedback3Controller@show_question_answer')->name('show_question_answer_3');
    Route::get('show_table_value_3', 'Feedback3Controller@show_table_value')->name('show_table_value_3');
    Route::get('question_chart_3', 'Feedback3Controller@question_chart')->name('question_chart_3');
    Route::post('chart_session_3', 'Feedback3Controller@chart_session')->name('chart_session_3');
    Route::get('reason_chart_3', 'Feedback3Controller@reason_chart')->name('reason_chart_3');
    Route::post('reason_chart_filter_3', 'Feedback3Controller@reason_chart_filter')->name('reason_chart_filter_3');
    Route::get('get_reason_setting_3', 'Reason3Controller@get_reason_setting')->name('get_reason_setting_3');
    Route::match(array('PUT', 'POST'), 'reason_setting_3', 'Reason3Controller@reason_setting')->name('reason_setting_3');
    Route::get('show_feedback_survey_3', 'Feedback3Controller@show_feedback_survey')->name('show_feedback_survey_3');
    Route::match(array('PUT', 'POST'), 'store_question_3', 'Feedback3Controller@store_question')->name('store_question_3');

    //feedback survey 4
    Route::resource('feedback_survey_4', 'Feedback4Controller');
    Route::get('getFeedbackRatings_4', 'Feedback4Controller@getFeedbackRatings')->name('getFeedbackRatings_4');
    Route::get('show_question_answer_4', 'Feedback4Controller@show_question_answer')->name('show_question_answer_4');
    Route::get('show_table_value_4', 'Feedback4Controller@show_table_value')->name('show_table_value_4');
    Route::get('question_chart_4', 'Feedback4Controller@question_chart')->name('question_chart_4');
    Route::post('chart_session_4', 'Feedback4Controller@chart_session')->name('chart_session_4');
    Route::get('reason_chart_4', 'Feedback4Controller@reason_chart')->name('reason_chart_4');
    Route::post('reason_chart_filter_4', 'Feedback4Controller@reason_chart_filter')->name('reason_chart_filter_4');
    Route::get('get_reason_setting_4', 'Reason4Controller@get_reason_setting')->name('get_reason_setting_4');
    Route::match(array('PUT', 'POST'), 'reason_setting_4', 'Reason4Controller@reason_setting')->name('reason_setting_4');
    Route::get('show_feedback_survey_4', 'Feedback4Controller@show_feedback_survey')->name('show_feedback_survey_4');
    Route::match(array('PUT', 'POST'), 'store_question_4', 'Feedback4Controller@store_question')->name('store_question_4');

    //feedback survey 4
    Route::resource('feedback_survey_5', 'Feedback5Controller');
    Route::get('getFeedbackRatings_5', 'Feedback5Controller@getFeedbackRatings')->name('getFeedbackRatings_5');
    Route::get('show_question_answer_5', 'Feedback5Controller@show_question_answer')->name('show_question_answer_5');
    Route::get('show_table_value_5', 'Feedback5Controller@show_table_value')->name('show_table_value_5');
    Route::get('question_chart_5', 'Feedback5Controller@question_chart')->name('question_chart_5');
    Route::post('chart_session_5', 'Feedback5Controller@chart_session')->name('chart_session_5');
    Route::get('reason_chart_5', 'Feedback5Controller@reason_chart')->name('reason_chart_5');
    Route::post('reason_chart_filter_5', 'Feedback5Controller@reason_chart_filter')->name('reason_chart_filter_5');
    Route::get('get_reason_setting_5', 'Reason5Controller@get_reason_setting')->name('get_reason_setting_5');
    Route::match(array('PUT', 'POST'), 'reason_setting_5', 'Reason5Controller@reason_setting')->name('reason_setting_5');
    Route::get('show_feedback_survey_5', 'Feedback5Controller@show_feedback_survey')->name('show_feedback_survey_5');
    Route::match(array('PUT', 'POST'), 'store_question_5', 'Feedback5Controller@store_question')->name('store_question_5');

    //user roles
    Route::resource('user_roles', 'UserRolesController');
    Route::post('user_status', 'UserRolesController@user_status')->name('user_status');
    //question order
    Route::post('question_order', 'FeedbackController@question_order')->name('question_order');

    Route::get('show_complain', 'FeedbackController@show_complain')->name('show_complain');
    Route::post('complain_status_filter', 'FeedbackController@complain_status_filter')->name('complain_status_filter');

    //for feedback question report
    Route::get('question_report', 'FeedbackController@question_report')->name('question_report');

    Route::get('get_question_average_report', 'FeedbackController@get_question_report')->name('get_question_report');
    // Route::match(array('GET','POST'),'get_question_average_report', 'FeedbackController@get_question_report')->name('get_question_report');

    Route::get('question_chart', 'FeedbackController@question_chart')->name('question_chart');
    Route::post('chart_session', 'FeedbackController@chart_session')->name('chart_session');

    // for feedback ratiing and change status --- 09-05-2019
    Route::get('getFeedbackRatings', 'FeedbackController@getFeedbackRatings')->name('getFeedbackRatings');
    Route::post('change_status_feedback', 'FeedbackController@change_status_feedback')->name('change_status_feedback');
    Route::post('get_question_report_kpi', 'FeedbackController@get_question_report_kpi')->name('get_question_report_kpi');

    Route::get('feedback_report', 'DashboardController@feedback_report')->name('feedback_report');

    Route::get('participant_table', 'DashboardController@participant_table')->name('participant_table');

    //complain chart and report
    Route::get('complain_report', 'FeedbackController@complain_report')->name('complain_report');
    Route::get('complain_chart', 'FeedbackController@complain_chart')->name('complain_chart');
    Route::post('complain_chart_filter', 'FeedbackController@complain_chart_filter')->name('complain_chart_filter');
    Route::get('get_complain_report', 'FeedbackController@get_complain_report')->name('get_complain_report');
    Route::post('get_complain_report_kpi', 'FeedbackController@get_complain_report_kpi')->name('get_complain_report_kpi');

    //reason chart and report
    Route::get('reason_report', 'FeedbackController@reason_report')->name('reason_report');
    Route::get('reason_chart', 'FeedbackController@reason_chart')->name('reason_chart');
    Route::post('reason_chart_filter', 'FeedbackController@reason_chart_filter')->name('reason_chart_filter');
    Route::get('get_kpi_report', 'FeedbackController@get_kpi_report')->name('get_kpi_report');
    Route::post('get_reason_report_kpi', 'FeedbackController@get_reason_report_kpi')->name('get_reason_report_kpi');

    Route::get('dashboard_complain', 'DashboardController@dashboard_complain')->name('dashboard_complain');

    Route::post('search_participant', 'DashboardController@search_participant')->name('search_participant');
    Route::post('edit_participant', 'DashboardController@edit_participant')->name('edit_participant');

    Route::resource('city', 'CityController');
    Route::post('city_status', 'CityController@city_status')->name('city_status');

    Route::get('notification_template', 'FeedbackController@notification_template')->name('notification_template');
    Route::get('view_reason_template/{id}', 'FeedbackController@view_reason_template')->name('view_reason_template');
    Route::post('save_reason_status_template', 'FeedbackController@save_reason_status_template')->name('save_reason_status_template');
    Route::post('template_status', 'FeedbackController@template_status')->name('template_status');
    Route::post('participantSearch', 'ParticipantController@participantSearch')->name('participantSearch');
    Route::post('send_survey_to_participant', 'SurveyformController@sendSurveyToParticipant')->name('send_survey_to_participant');

    Route::get('show_table_value', 'FeedbackController@show_table_value')->name('show_table_value');
    Route::get('show_table_value/feedbackResponce', 'ExcelController@feedbackResponce')->name('feedbackResponce');
    Route::match(array('PUT', 'POST'), 'complain_setting', 'ComplainController@complain_setting')->name('complain_setting');
    Route::get('get_complain_setting', 'ComplainController@get_complain_setting')->name('get_complain_setting');
    Route::get('get_reason_setting', 'ReasonController@get_reason_setting')->name('get_reason_setting');
    Route::match(array('PUT', 'POST'), 'reason_setting', 'ReasonController@reason_setting')->name('reason_setting');
    Route::post('generate_pdf', 'PdfController@generate_pdf')->name('generate_pdf');
    // this section for userReport and location report
    //Report 1
    Route::get('get_user_report_1', 'UserReportController@get_user_report_1')->name('get_user_report_1');
    Route::get('get_location_report_1', 'UserReportController@get_location_report_1')->name('get_location_report_1');
    Route::post('get_user_report_filter_1', 'UserReportController@get_user_report_filter_1')->name('get_user_report_filter_1');
    Route::post('get_location_report_filter_1', 'UserReportController@get_location_report_filter_1')->name('get_location_report_filter_1');
    //report 2
    Route::get('get_user_report_2', 'UserReportController@get_user_report_2')->name('get_user_report_2');
    Route::get('get_location_report_2', 'UserReportController@get_location_report_2')->name('get_location_report_2');
    Route::post('get_user_report_filter_2', 'UserReportController@get_user_report_filter_2')->name('get_user_report_filter_2');
    Route::post('get_location_report_filter_2', 'UserReportController@get_location_report_filter_2')->name('get_location_report_filter_2');
    //report 3
    Route::get('get_user_report_3', 'UserReportController@get_user_report_3')->name('get_user_report_3');
    Route::get('get_location_report_3', 'UserReportController@get_location_report_3')->name('get_location_report_3');
    Route::post('get_user_report_filter_3', 'UserReportController@get_user_report_filter_3')->name('get_user_report_filter_3');
    Route::post('get_location_report_filter_3', 'UserReportController@get_location_report_filter_3')->name('get_location_report_filter_3');
    //report 4
    Route::get('get_user_report_4', 'UserReportController@get_user_report_4')->name('get_user_report_4');
    Route::get('get_location_report_4', 'UserReportController@get_location_report_4')->name('get_location_report_4');
    Route::post('get_user_report_filter_4', 'UserReportController@get_user_report_filter_4')->name('get_user_report_filter_4');
    Route::post('get_location_report_filter_4', 'UserReportController@get_location_report_filter_4')->name('get_location_report_filter_4');
    //report 5
    Route::get('get_user_report_5', 'UserReportController@get_user_report_5')->name('get_user_report_5');
    Route::get('get_location_report_5', 'UserReportController@get_location_report_5')->name('get_location_report_5');
    Route::post('get_user_report_filter_5', 'UserReportController@get_user_report_filter_5')->name('get_user_report_filter_5');
    Route::post('get_location_report_filter_5', 'UserReportController@get_location_report_filter_5')->name('get_location_report_filter_5');

    Route::get('participant_export', 'ExcelController@export')->name('participant_export');

    Route::get('view_complain_notification', 'FeedbackController@view_complain_notification')->name('view_complain_notification');
    Route::match(array('PUT', 'POST'), 'save_complain_notification', 'FeedbackController@save_complain_notification')->name('save_complain_notification');
    Route::post('send_complain_notification', 'FeedbackController@send_complain_notification')->name('send_complain_notification');
    Route::post('save_action_text', 'FeedbackController@save_action_text')->name('save_action_text');

    Route::post('complainExport', 'ExcelController@complainExport')->name('complainExport');

});
