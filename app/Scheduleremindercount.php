<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Scheduleremindercount extends Authenticatable
{
    protected $table = 'tbl_schedule_reminder_count';
}
