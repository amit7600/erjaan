<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trigger extends Authenticatable
{
    protected $table = 'tbl_auto_trigger_setting';
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

    
}
