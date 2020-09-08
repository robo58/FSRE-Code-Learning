<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $casts = [
        'created_at' => 'datetime:jS F, Y, H:i:s',
        'updated_at' => 'datetime:jS F, Y, H:i:s'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function courseParts(){
        return $this->hasMany(CoursePart::class);
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_progress', 'course_id', 'user_id')->withTimeStamps();
    }
}
