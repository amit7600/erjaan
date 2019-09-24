<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackReason extends Model
{
	protected $table = 'feedback_reason';
    protected $fillable = [
    	'feedback_reason','feedback_id'
    ];
}
