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
            return $q->whereHas('profile',function($q2) use ($search){
                return $q2->where('first_name','like',"%$search%")
                ->orWhere('last_name','like',"%$search%")
                ->orWhere('phone_number','like',"$search")
                ->orWhere('aou_number','like',"$search")
                ->orWhere('email','like',"$search");
            });
        });
    }

    public function scopeWhenType($query, $type)
    {
        return $query->when($type,function($q) use ($type){
            return $q->whereHas('ticket_type',function($qu) use ($type){
                return $qu->whereIn('id',(array)$type);
            });
        });
    }

    public function scopeWhenStatus($query, $status)
    {
        return $query->when( $status,function($q) use ( $status){
            return $q->where('status', $status);
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
