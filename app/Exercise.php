<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    public function course_part()
    {
        return $this->belongsTo(CoursePart::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
