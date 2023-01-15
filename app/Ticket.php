<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded=[];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search,function($q) use ($search){
            return $q->where('name','like',"%$search%");
        });
    }
    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function ticket_type()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function ticket_classification()
    {
        return $this->belongsTo(TicketClassification::class);
    }

    public function ticket_attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
