<?php

namespace App\Helpers;

use App\FeedBackComplains;
use App\FeedbackSurvey;
use App\SurveyFormInfo;
use App\SurveyFormInfoCheckboxAns;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class FeedbackHelper
{
    /* ===========================================================
     * This function is use for get multiple option
     */

    public static function getMultipleSurveyOption($question_id)
    {
        $option_data = DB::table('tbl_survey_options')->select('*')
            ->where('is_deleted', 0)
            ->where('question_id', $question_id)
            ->get();
        return $option_data;
    }

//END getMultipleSurveyOption();

    /* ===========================================================
     * This function is use for get setting data
     */

    public static function getSettingByKey($key)
    {
        $setting_data = DB::table('tbl_settings')->select('setting_value')
            ->where('setting_key', $key)
            ->first();
        return $setting_data;
    }

//END getSettingByKey();

    /* ===========================================================
     * This function is use for get permission data data
     */

    public static function getUserPermissionData($id)
    {
        $permission_data = DB::table('tbl_user_permission')->select('tbl_user_permission.*', 'users.name', 'users.user_role')
            ->join('users', 'users.id', '=', 'tbl_user_permission.user_id')
            ->where('tbl_user_permission.user_id', $id)
            ->first();
        return $permission_data;
    }

//END getUserPermissionData();

    /* ===========================================================
     * This function is use for get answer data
     */

    public static function getAnswerByQuestionId($question_id)
    {

        Session::get('select_chart_by');
        $answer_data = DB::table('tbl_survey_options')->select('id', 'survey_option_title', 'option_point')->where('question_id', $question_id)->get();
        return $answer_data;
    }

//END getAnswerByQuestionId();

    /* ===========================================================
     * This function is use for get answer data
     */

    public static function getTotalAnswer($question_id)
    {

        $results = DB::table('feedback_survey')->select('*')
            ->where('question_id', $question_id);

        // if($user_id != null){
        //     $results = $results->where('user_id',$user_id);
        // }
        // if($city != null){
        //     $results = $results->where('user_city',$city);
        // }
        // if($created_from != null && $created_to != null){
        //      $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
        //     }
        $results = $results->get();

        return $results;
    }

//END getTotalAnswer();

    /* ===========================================================
     * This function is use for get answer data for separate participant
     */

    public static function getTotalAnswerParticipant($question_id, $form_id, $participant_id = false, $question_type)
    {
        $results = DB::table('tbl_survey_form_info')->select('id', 'start_rating_answer')
            ->where(['form_id' => $form_id, 'participant_id' => $participant_id, 'question_type' => $question_type]);
        $results = $results->get();
        return $results;
    }

//END getTotalAnswer();

    /* ===========================================================
     * This function is use for get permission data data
     */

    // public static function getAnswerCount($question_id,$answer) {
    //     $columns = array(
    //         DB::Raw('count(id) as ans_count'),
    //         DB::Raw("TRIM(BOTH". "'".'"'."'"." FROM SUBSTRING_INDEX(SUBSTRING_INDEX(answer,';',3),':',-1)) AS answer")
    //     );
    //     $results = SurveyFormInfo::where('question_id',$question_id)
    //     ->having('answer', '=', $answer)
    //     ->first($columns);
    //     return $results;
    // }//END getAnswerCount();

    /* ===========================================================
     * This function is use for get radio button answer count
     */
    public static function getAnswerCount($question_id, $years = false, $answer, $participant_id = false)
    {

        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );
        $results = SurveyFormInfo::where('question_id', $question_id)
            ->where('survey_answer', $answer);
        if (strlen($years) == 4) {
            $results->whereYear('created_at', $years);
        } else {
            $results->whereMonth('created_at', $years);
        }

        if ($participant_id) {
            $results->whereIn('participant_id', $participant_id);
        }

        $results = $results->first($columns);
        return $results;
    }

//END getAnswerCount();

    /* ===========================================================
     * This function is use for get radio button answer count participatn seprate
     */

    public static function getAnswerCountParticipant($question_id, $years = false, $answer, $participant_id = false, $question_type)
    {

        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );
        $results = SurveyFormInfo::where(['participant_id' => $participant_id, 'question_type' => $question_type]);

        if (strlen($years) == 4) {
            $results->whereYear('created_at', $years);
        } else {

            $results->whereMonth('created_at', $years);
        }

        $results = $results->first($columns);
        return $results;
    }

//END getAnswerCount();

    /* ===========================================================
     * This function is use for get star rating answer count
     */

    public static function getStarRatingAnswerCount($question_id, $years = false, $answer, $user_id, $city, $created_from, $created_to, $time_period = null)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );

        $results = DB::table('feedback_survey')->where('question_id', $question_id)
            ->where('rating', $answer);

        if ($user_id != null && $user_id != '0') {
            $results = $results->where('user_id', $user_id);
        }
        if ($city != null && $city != '0') {
            $results = $results->where('user_city', $city);
        }
        // if(($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')){
        //     $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");

        // }
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if ($time_period == 'specific_date') {
            if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                $created_from = date('Y/m/d', strtotime($created_from));
                $created_to = date('Y/m/d', strtotime($created_to));
                $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
            }
            if (strlen($years) == 4) {

                $results->whereYear('created_at', $years);

            } else {
                $results->whereMonth('created_at', $years);

            }

        } elseif ($time_period == 'today') {
            // $results = $results->whereDate('created_at', Carbon::now()->format('Y/m/d'));
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'yesterday') {
            // $results = $results->whereDate('created_at','=', Carbon::yesterday()->format('Y-m-d'));
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'last_14_day') {

            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'this_week') {
            // $start = Carbon::now()->startOfWeek();
            // $end =  Carbon::now()->endOfWeek();
            // echo "<br/>";print_r($years);
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_week') {
            $results = $results->whereDate("created_at", $years);
            // $start = Carbon::now()->startOfWeek()->subDays(7);
            // $end =  Carbon::now()->startOfWeek();
            // $results = $results->whereRaw(" Date(created_at) between '$start' and '$end'");
        } elseif ($time_period == 'this_month') {
            $results = $results->whereDate("created_at", $years);
            // $results = $results->whereDate('created_at','>=', Carbon::now()->startOfMonth()->toDateTimeString());
        } elseif ($time_period == 'last_month') {
            // $start = Carbon::now()->subMonth()->startOfMonth()->toDateString();
            // $end = Carbon::now()->subMonth()->endOfMonth()->toDateString();
            // $results = $results->whereRaw(" Date(created_at) between '$start' and '$end'");
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_year') {
            // dd($years);
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y'));

        } elseif ($time_period == 'last_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y', strtotime("-1 year")));
        } else {
            $results = $results->whereMonth('created_at', $years);
        }
        $results = $results->first($columns);

        return $results;
    }

//END getStarRatingAnswerCount();

    /* ===========================================================
     * This function is use for get star rating answer count
     */

    public static function getStarRatingAnswerCountParticipant($question_id, $years = false, $answer, $participant_id = false)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );

        $results = SurveyFormInfo::where('question_id', $question_id)
            ->where('start_rating_answer', $answer);

        if (strlen($years) == 4) {
            $results->whereYear('created_at', $years);
        } else {

            $results->whereMonth('created_at', $years);
        }

        if ($participant_id) {
            $results->where('participant_id', $participant_id);
        }

        $results = $results->first($columns);
        return $results;
    }

//END getStarRatingAnswerCount();

    /* ===========================================================
     * This function is use for get star rating answer count
     */

    // public static function getStarRatingAnswerCount($question_id, $answer, $participant_id) {
    //     $columns = array(
    //         DB::Raw('count(id) as ans_count')
    //     );
    //     $results = SurveyFormInfo::where('question_id',$question_id)
    //     ->where('start_rating_answer', $answer)
    //     ->whereIn('participant_id', $participant_id)
    //     ->first($columns);
    //     return $results;
    // }//END getStarRatingAnswerCount();

    /* ===========================================================
     * This function is use for get checkbox answer count
     */
    public static function getCheckboxAnswerCount($question_id, $years = false, $answer, $participant_id = false)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );
        $results = SurveyFormInfoCheckboxAns::where('question_id', $question_id)
            ->where('check_box_ans', $answer);

        if (strlen($years) == 4) {
            $results->whereYear('created_at', $years);
        } else {

            $results->whereMonth('created_at', $years);
        }

        if ($participant_id) {
            $results->whereIn('participant_id', $participant_id);
        }

        $results = $results->first($columns);
        return $results;
    }

//END getCheckboxAnswerCount();

    /* ===========================================================
     * This function is use for get checkbox answer count
     */

    public static function getCheckboxAnswerCountParticipant($question_id, $years = false, $answer, $participant_id = false)
    {

        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );

        $results = SurveyFormInfoCheckboxAns::where(['question_id' => $question_id, 'participant_id' => $participant_id]);

        if (strlen($years) == 4) {
            $results->whereYear('created_at', $years);
        } else {

            $results->whereMonth('created_at', $years);
        }

        if ($participant_id) {
            $results->whereIn('participant_id', $participant_id);
        }

        $results = $results->get($columns);
        return $results;
    }
    //complain section
    public static function getTotalComplain($user_id, $city, $created_from, $created_to)
    {
        // dd($user_id,$city,$created_from,$created_to);
        $results = DB::table('feedback_complains')->select('*');
        $results = $results->get();
        return $results;
    }
    public static function getComplainStatusCount($years = false, $status, $user_id, $city, $created_from, $created_to, $time_period = null)
    {
        // $years = '2019';
        $columns = array(
            DB::Raw('count(id) as status_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );
        $results = DB::table('feedback_complains')->where('status', $status);

        if ($user_id != null && $user_id != '0') {
            $results = $results->where('user_id', $user_id);
        }
        if ($city != null && $city != '0') {
            $results = $results->where('user_city', $city);
        }

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if ($time_period == 'specific_date') {
            if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                $created_from = date('Y/m/d', strtotime($created_from));
                $created_to = date('Y/m/d', strtotime($created_to));
                $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
            }
            if (strlen($years) == 4) {

                $results->whereYear('created_at', $years);

            } else {
                $results->whereMonth('created_at', $years);

            }

        } elseif ($time_period == 'today') {
            // $results = $results->whereDate('created_at', Carbon::now()->format('Y/m/d'));
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'yesterday') {
            // $results = $results->whereDate('created_at','=', Carbon::yesterday()->format('Y-m-d'));
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'last_14_day') {

            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'this_week') {
            // $start = Carbon::now()->startOfWeek();
            // $end =  Carbon::now()->endOfWeek();
            // echo "<br/>";print_r($years);
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_week') {
            $results = $results->whereDate("created_at", $years);
            // $start = Carbon::now()->startOfWeek()->subDays(7);
            // $end =  Carbon::now()->startOfWeek();
            // $results = $results->whereRaw(" Date(created_at) between '$start' and '$end'");
        } elseif ($time_period == 'this_month') {
            $results = $results->whereDate("created_at", $years);
            // $results = $results->whereDate('created_at','>=', Carbon::now()->startOfMonth()->toDateTimeString());
        } elseif ($time_period == 'last_month') {
            // $start = Carbon::now()->subMonth()->startOfMonth()->toDateString();
            // $end = Carbon::now()->subMonth()->endOfMonth()->toDateString();
            // $results = $results->whereRaw(" Date(created_at) between '$start' and '$end'");
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_year') {
            // dd($years);
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y'));

        } elseif ($time_period == 'last_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y', strtotime("-1 year")));
        } else {
            $results = $results->whereMonth('created_at', $years);
        }
        $results = $results->first($columns);
        // dd($results);
        return $results;
    }
    //Start getStarRatingReasonCount();
    public static function getStarRatingReasonCount($question_id, $years = false, $answer, $user_id, $city, $created_from, $created_to)
    {
        //$years = 2019;
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('YEAR(created_at) year'),
            DB::Raw('MONTH(created_at) month'),
        );
        $results = DB::table('feedback_rating')
            ->where('comment', $answer);
        if ($user_id != null && $user_id != '0') {
            $results = $results->where('user_id', $user_id);
        }
        if ($city != null && $city != '0') {

            $results = $results->where('user_city', $city);

        }
        if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
            $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");

        }
        if (strlen($years) == 4) {

            $results->whereYear('created_at', $years);

        } else {
            $results->whereMonth('created_at', $years);

        }
        $results = $results->first($columns);

        //dd($results);

        return $results;
    }
    //End getStarRatingReasonCount();
    public static function getTotalUser($user_id, $feedback_id)
    {
        $results = FeedbackSurvey::where('user_id', $user_id)->where('feedback_id', $feedback_id)->get();

        return $results;
    }
    public static function getUserCount($years, $feedback_id, $user_id, $created_from, $created_to, $time_period)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('SUM(rating) as rating_sum'),
        );

        $results = FeedbackSurvey::where('user_id', $user_id)->where('feedback_id', $feedback_id);
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if ($time_period == 'specific_date') {
            if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                $created_from = date('Y/m/d', strtotime($created_from));
                $created_to = date('Y/m/d', strtotime($created_to));
                $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
            }
            if (strlen($years) == 4) {

                $results->whereYear('created_at', $years);

            } else {
                $results->whereMonth('created_at', $years);

            }

        } elseif ($time_period == 'today') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'yesterday') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'last_14_day') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'this_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y'));
        } elseif ($time_period == 'last_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y', strtotime("-1 year")));
        } else {
            $results = $results->whereMonth('created_at', $years);
        }
        $results = $results->first($columns);
        return $results;
    }
    public static function getTotalcity($city_id, $feedback_id)
    {
        $results = FeedbackSurvey::where('user_city', $city_id)->where('feedback_id', $feedback_id)->get();

        return $results;
    }
    public static function getLocationCount($years, $feedback_id, $user_city, $created_from, $created_to, $time_period)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
            DB::Raw('SUM(rating) as rating_sum'),
        );

        $results = FeedbackSurvey::where('user_city', $user_city)->where('feedback_id', $feedback_id);
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if ($time_period == 'specific_date') {
            if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                $created_from = date('Y/m/d', strtotime($created_from));
                $created_to = date('Y/m/d', strtotime($created_to));
                $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
            }
            if (strlen($years) == 4) {

                $results->whereYear('created_at', $years);

            } else {
                $results->whereMonth('created_at', $years);

            }

        } elseif ($time_period == 'today') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'yesterday') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'last_14_day') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'this_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y'));
        } elseif ($time_period == 'last_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y', strtotime("-1 year")));
        } else {
            $results = $results->whereMonth('created_at', $years);
        }
        $results = $results->first($columns);
        return $results;
    }
    public static function getTotalRole($role_id, $user_id, $city, $created_from, $created_to)
    {
        $complain = FeedBackComplains::where('role_id', $role_id)->get();
        return $complain;
    }
    public static function getRoleCount($years, $role_id, $created_from, $created_to, $time_period)
    {
        $columns = array(
            DB::Raw('count(id) as ans_count'),
        );
        $results = FeedBackComplains::where('role_id', $role_id);
        
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if ($time_period == 'specific_date') {
            if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                $created_from = date('Y/m/d', strtotime($created_from));
                $created_to = date('Y/m/d', strtotime($created_to));
                $results = $results->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
            }
            if (strlen($years) == 4) {

                $results->whereYear('created_at', $years);

            } else {
                $results->whereMonth('created_at', $years);

            }

        } elseif ($time_period == 'today') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'yesterday') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'last_14_day') {
            $results = $results->whereDate('created_at', $years);
        } elseif ($time_period == 'this_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_week') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'last_month') {
            $results = $results->whereDate("created_at", $years);
        } elseif ($time_period == 'this_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y'));
        } elseif ($time_period == 'last_year') {
            $results = $results->whereMonth('created_at', $years)->whereYear('created_at', date('Y', strtotime("-1 year")));
        } else {
            $results = $results->whereMonth('created_at', $years);
        }
        $results = $results->first($columns);
        return $results;
    }

//END getCheckboxAnswerCount();
}
