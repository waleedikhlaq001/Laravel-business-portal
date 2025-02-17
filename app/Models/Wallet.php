<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function walletTransaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function walletTransfer()
    {
        return $this->hasMany(WalletTransfer::class);
    }

    public function milestone()
    {
        return $this->hasMany(Milestone::class);
    }
}