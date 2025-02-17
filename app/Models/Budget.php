<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min',
        'max'
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
