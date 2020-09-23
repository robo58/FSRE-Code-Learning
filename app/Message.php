<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $casts = [
        'created_at' => 'datetime:jS F, Y, H:i:s',
        'updated_at' => 'datetime:jS F, Y, H:i:s'
    ];

    public function sender()
    {
        return $this->hasOne(User::class);
    }

    public function receiver()
    {
        return $this->hasOne(User::class);
    }
}
