<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price'
    ];

    public function influencer()
    {
        return $this->hasMany('App\Models\Influencer');
    }
}
