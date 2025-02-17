<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price'
    ];

    public function vendor()
    {
        return $this->hasMany('App\Models\Vendor');
    }
}
