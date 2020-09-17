<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    protected $casts = [
        'created_at' => 'datetime:jS F, Y, H:i:s',
        'updated_at' => 'datetime:jS F, Y, H:i:s'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
