<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'email',
        'phone',
        'shipping_name',
        'shipping_address',
        'shipping_address_2',
        'state',
        'zip',
        'quantity',
        'tax',
        'shipped',
        'tracking_number',
        'country',
        'user_id',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
