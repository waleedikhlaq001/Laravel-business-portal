<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbassadorUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'name',
        "phone",
        'image',
        'video',
        "ambassador_id",
        "approved",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
