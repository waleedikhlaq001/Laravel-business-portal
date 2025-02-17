<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount'
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
