<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPermission extends Authenticatable
{
    protected $table = 'tbl_user_permission';
    use Notifiable;



   
    /**
     * The roles that belong to the user.
     */
    public function activity()
    {
        return $this->belongsToMany('App\Activity');
    }
}
