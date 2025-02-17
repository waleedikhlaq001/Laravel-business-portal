<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Portfolio extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        "thumbnail",
        "link",
        "description",
        "channel",
        "for_kids",
        "views",
        'file',
        'user_id'
    ];


    public function influencer()
    {
        return $this->belongsTo(Influencer::class);
    }

}
