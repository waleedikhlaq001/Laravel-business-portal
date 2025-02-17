<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use DB;

class User extends Authenticatable implements JWTSubject
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
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'image',
        'street_address',
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
        'two_fa',
        'token',
        'ref',
        'country_id',
        'ref_code',
        'ref_earned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function influencer()
    {
        return $this->hasOne(Influencer::class);
    }

    public function ambassador()
    {
        return $this->belongsTo(Ambassador::class,  'ref_code');
    }

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function creative_rating()
    {
        return $this->hasMany(CreativeRating::class);
    }

    public function active_role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id')->where("role_user.active", 1)->withTimestamps();
    }

    public function countryname($id)
    {
        return Country::where('id', $id)->select('name')->first()->name;
    }
    public function statename($id)
    {
        return DB::table('states')->where('id', $id)->select('name')->first()->name;
    }
    public function hasRole($role)
    {
        if ($role == "Creative" || $role == "creative" || $role == "Vendor" || $role == "vendor") {
            if (is_array($role)) {
                if ($this->active_role()->whereIn('name', $role)->first()) {
                    return true;
                }
            } else {
                if ($this->active_role()->where('name', $role)->first()) {
                    return true;
                }
            }
        } else {
            if (is_array($role)) {
                if ($this->role()->whereIn('name', $role)->first()) {
                    return true;
                }
            } else {
                if ($this->role()->where('name', $role)->first()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isRole($role)
    {
        if (is_array($role)) {
            if ($this->role()->whereIn('name', $role)->first()) {
                return true;
            }
        } else {
            if ($this->role()->where('name', $role)->first()) {
                return true;
            }
        }

        return false;
    }

    public function job()
    {
        return $this->hasMany(Job::class, 'influencer_id');
    }

    public function flutterwaveSubaccount()
    {
        return $this->hasOne(FlutterwaveSubaccount::class);
    }

    public function stripe()
    {
        return $this->hasOne(StripeAccount::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function supportTicket()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function generalwallet()
    {
        return $this->hasOne(GeneralWallet::class);
    }

    public function comments()
    {
        return $this->hasMany(VideoContentComment::class);
    }

    public function details()
    {
        if ($this->hasRole("Creative")) {

            return $this->hasOne(InfluencerDetails::class);
        } else {
            return $this->hasOne(Vendor::class);
        }
    }

    public function influencer_details()
    {
        return $this->hasOne(InfluencerDetails::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function dispute_messages()
    {
        return $this->hasMany(disputeMessage::class);
    }

    public function mitigation()
    {
        return $this->hasMany(Mitigation::class);
    }
}
