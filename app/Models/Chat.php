<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'influencer_id'
    ];

    public function influencer()
    {
        return $this->belongsTo(User::class);
    }
    

    public function bids()
    {
        return $this->belongsTo(Bid::class);
    }
}
