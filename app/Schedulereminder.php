<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Schedulereminder extends Authenticatable
{
    protected $table = 'tbl_schedule_reminder';
}
