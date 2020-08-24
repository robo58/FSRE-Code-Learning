<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursePart extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
