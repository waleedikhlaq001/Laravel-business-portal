<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class VideoContent extends Model
{
    use HasFactory;
    const EXPIRATION_IN_HOURS = 1;


    protected $fillable = [
        'name',
        'file',
        'influencer_id'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function influencer()
    {
        return $this->belongsTo(Influencer::class);
    }

    public function likes()
    {
        return $this->hasMany(VideoContentLike::class);
    }

    public function comments()
    {
        return $this->hasMany(VideoContentComment::class)->whereNull("parent_id");
    }

    public function views()
    {
        return $this->hasMany(VideoContentView::class);
    }

    public function hasExpired()
    {
        return !is_null($this->viewed_at) && Carbon::now()->diffInHours($this->viewed_at) > self::EXPIRATION_IN_HOURS;
    }
}
