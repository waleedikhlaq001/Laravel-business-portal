<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetails';
    protected $fillable = [
        'price',
        'name',
        'qty',
        'price',
        'sku',
        'order_id',
        'product_id',
        'user_id',
    ];


}
