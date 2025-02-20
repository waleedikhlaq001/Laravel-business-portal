<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}
