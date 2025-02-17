<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitigation extends Model
{
    use HasFactory;

    public function dispute()
    {
        return $this->belongsTo(Dispute::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'payee_id');
    }
}
