<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'token',
        'expires_at'
    ];
}
