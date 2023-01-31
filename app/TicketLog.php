<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    protected $guarded=[];

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('ticket_id', "$search");
        });
    }


    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($ticket_id,$log)
    {
        TicketLog::create([
            'ticket_id'=>$ticket_id,
            'user_id'=>auth()->id(),
            'log'=>$log,
        ]);
    }

}
