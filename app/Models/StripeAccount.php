<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account',
        'details_submitted_status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
