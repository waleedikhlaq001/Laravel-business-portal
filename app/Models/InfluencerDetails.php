<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'influencer_years_experience',
        'influencer_description',
        'inflencer_services_provided',
        'influencer_IG_followers',
        'influencer_previous_job',
        'influencer_turnaround_time',
        'influencer_charges',
        'influencer_clients',
        'influencer_skills'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
