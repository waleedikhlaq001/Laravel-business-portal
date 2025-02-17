<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketMessage extends Model
{
    use HasFactory;

    public function supportTicket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

}
