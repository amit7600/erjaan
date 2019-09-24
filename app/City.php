<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    //
    protected $table = 'city';
    
    protected $fillable = ['cityName', 'isActive'];
}
