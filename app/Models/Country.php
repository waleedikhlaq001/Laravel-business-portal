<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sort', 'phone_code', 'country_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
