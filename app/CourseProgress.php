<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function courses(){
        return $this->belongsToMany('App\Course');
    }
}
