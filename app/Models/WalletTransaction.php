<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'status',
        'amount',
        'currency',
        'percent',
        'wallet_uid',
        'vendor_id',
        'job_id',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}