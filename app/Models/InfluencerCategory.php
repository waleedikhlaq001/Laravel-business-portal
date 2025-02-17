<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min',
        'max',
        'provided_for'
    ];

    public function influencer()
    {
        return $this->hasMany(Influencer::class);
    }
}
