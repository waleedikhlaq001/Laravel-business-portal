<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoContentComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function videoContent()
    {
        return $this->belongsTo(VideoContent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(VideoContentComment::class, 'parent_id');
    }
}
