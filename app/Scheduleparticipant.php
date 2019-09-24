<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Scheduleparticipant extends Authenticatable
{
    protected $table = 'tbl_scheduled_participant';
}
