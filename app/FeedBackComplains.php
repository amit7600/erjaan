<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBackComplains extends Model
{
    protected $table = 'feedback_complains';

    protected $fillable = ['name', 'email', 'mobile', 'comment', 'user_id', 'status', 'modified_by', 'role_id', 'user_city', 'action_text'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function userRole()
    {
        return $this->belongsTo('App\UserRoles', 'role_id', 'id');
    }
}
