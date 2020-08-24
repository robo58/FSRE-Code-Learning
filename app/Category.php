<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $casts = [
      'created_at' => 'datetime:jS F, Y, H:i:s',
      'updated_at' => 'datetime:jS F, Y, H:i:s'
    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
