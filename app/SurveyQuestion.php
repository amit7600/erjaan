<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SurveyQuestion extends Authenticatable
{
    protected $table = 'tbl_survey_question';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [''];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    protected $casts = [
        'current_activity' => 'string',
    ];

    /**
     * The roles that belong to the user.
     */
    public function question_options()
    {
        return $this->hasMany('App\SurveyOption','question_id')->orderBy('id');
    }
}
