<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketClassification extends Model
{
    protected $guarded=[];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticket_type()
    {
        return $this->belongsTo(TicketType::class);
    }
}
