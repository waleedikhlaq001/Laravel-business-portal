<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_station', 'rating', 'status', 'facebook', 'instagram', 'tiktok', 'twitter', 'phone_number', 'location', 'vendor_type_id', 'user_id'
    ];

    public function vendor_type()
    {
        return $this->belongsTo('App\Models\VendorType');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function walletTransaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}