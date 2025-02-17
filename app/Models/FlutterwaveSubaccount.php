<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlutterwaveSubaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'account_bank',
        'full_name',
        'split_type',
        'split_value',
        'subaccount_id',
        'bank_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
