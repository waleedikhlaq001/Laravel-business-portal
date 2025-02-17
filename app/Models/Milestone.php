<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}