<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBackRatings extends Model
{
    protected $table = 'feedback_rating';

    protected $fillable = ['user_id', 'comment','user_city','feedback_id'];
}
