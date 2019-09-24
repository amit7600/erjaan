<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Participant extends Authenticatable
{
    protected $table = 'tbl_participants';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'dial_code', 'mobile', 'on_behalf_first_name', 'on_behalf_last_name', 'on_behalf_email', 'on_behalf_mobile', 'gender', 'dob', 'comment', 'category_id', 'sub_category_id', 'location_id', 'group_id', 'type_id', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    protected $casts = [
        'gender' => 'string',
    ];

    function category()
    {
        return $this->hasOne('App\Category','id','category_id');
    }

    function sub_category()
    {
        return $this->hasOne('App\Category','id','sub_category_id');
    }

    function location()
    {
        return $this->hasOne('App\Country','id','location_id');
    }

    function group()
    {
        return $this->hasOne('App\Group','id','group_id');
    }

    function type()
    {
        return $this->hasOne('App\Type','id','type_id');
    }
}
