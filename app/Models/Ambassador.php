<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    use HasFactory, Notifiable;
    const ACTIVE = 1;
    const INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'image',
        'address',
        'postal_code',
        'city',
        'phone_number',
        'status',
        'facebook',
        'instagran',
        'tiktok',
        'snapchat',
        'telegram',
        'twitter',
        'code',
        "bvn",
        "nin",
        'ref_code',
        "center",
        'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
