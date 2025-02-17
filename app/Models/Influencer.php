<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'location', 'description', 'rating', 'skills', 'influencer_type_id', 'twitter', 'instagram', 'tiktok', 'twitter_followers', 'instagram_followers', 'tiktok_views'
    ];

    public function influencer_type()
    {
        return $this->belongsTo('App\Models\InfluencerType');
    }

    public function influencer_category()
    {
        return $this->belongsTo(InfluencerCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
