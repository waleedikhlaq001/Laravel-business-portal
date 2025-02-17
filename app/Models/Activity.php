<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    const READ = 1;
    const UNREAD = 0;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
