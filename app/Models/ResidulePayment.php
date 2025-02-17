<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidulePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'percentage'
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
