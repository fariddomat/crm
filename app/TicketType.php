<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $guarded=[];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticket_classifications()
    {
        return $this->hasMany(TicketClassification::class);
    }

}
