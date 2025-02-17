<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'duration',
        'proposal',
        'influencer_id',
        'chat_initiated'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function influencer()
    {
        return $this->belongsTo(User::class);
    }

    public function bid()
    {
        return $this->hasMany(Chat::class);
    }
}
