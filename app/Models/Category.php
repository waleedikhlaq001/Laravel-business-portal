<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'residule_id'
    ];

    public function residule()
    {
        return $this->belongsTo(ResidulePayment::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
