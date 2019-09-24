<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBackComplains extends Model
{
    protected $table = 'feedback_complains';

    protected $fillable = ['name', 'email', 'mobile', 'comment','user_id', 'status', 'modified_by'];
}
