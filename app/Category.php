<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    protected $table = 'tbl_categories';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'category_name', 'status', 'is_deleted'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    protected $casts = [
        'current_activity' => 'string',
    ];

   
}
