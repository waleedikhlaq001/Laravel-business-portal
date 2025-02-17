<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    const APPROVED = 1;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'colors',
        'status',
        'unique_id',
        'vendor_id',
        'category_id',
        'influencer_code'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
// Pa$$word0808080
