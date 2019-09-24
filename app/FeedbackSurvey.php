<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackSurvey extends Model
{
    //
    protected $table = 'feedback_survey';
    protected $fillable = [
    	'user_id','user_city','question_id','rating','comments','name','email','mobile'
    ];
}
