<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $guarded=[];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
