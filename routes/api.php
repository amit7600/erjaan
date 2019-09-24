<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('form/{ids}','ApiController@index')->name('view_api');

Route::get('get-sub-category-by-category-id','Admin\SubCategoryController@getSubCategoryByCategoryId')->name('get_sub_category_by_category_id');


Route::get('more-details-participant','Admin\ParticipantController@moreDetailsParticipant')->name('more_details_participant');
Route::post('send-survey-to-participant','Admin\SurveyformController@sendSurveyToParticipant')->name('send_survey_to_participant');

Route::get('participantData/{id}', 'ApiController@participantData');
Route::get('participantData', 'ApiController@participantData');

Route::get('surveyData/{id}', 'ApiController@surveyData');
Route::get('surveyData', 'ApiController@surveyData');

//Route that are no need to authenticate

Route::group(['namespace'=>'API'],function(){
});


