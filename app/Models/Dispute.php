<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_message', 'job_id', 'title'
    ];

    public function disputeMessage()
    {
        return $this->hasMany(disputeMessage::class)->orderBy('id', "DESC");
    }

    public function mitigation()
    {
        return $this->hasOne(Mitigation::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

}
