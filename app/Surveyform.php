<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Surveyform extends Authenticatable
{
    protected $table = 'tbl_survey_form';
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
    public function survey_questions()
    {
        return $this->hasMany('App\SurveyQuestion','survey_form_id')->orderBy('id');
    }
    
    
    public function setSurveyOptiontTitle($value)
    {
        if(empty($value)){
            $this->attributes['survey_option_title'] = strtolower($value);
        }
        
    }
}
