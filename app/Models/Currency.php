<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'symbol', 'status'
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function generalWallet()
    {
        return $this->hasMany(GeneralWallet::class);
    }

    public function walletTransaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }
}