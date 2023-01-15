<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded=[];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search,function($q) use ($search){
            return $q->orWhere('phone_number','like',"%$search%")
                ->orWhere('aou_number','like',"%$search%")
                ->orWhere('email','like',"%$search%")
                ->where('first_name','like',"%$search%")
                ->orWhere('last_name','like',"%$search%");
        });
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_name');
    }

    // specializations
    public function specialization_name()
    {
        return $this->belongsTo(Specialization::class,'specialization');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_name');
    }

}
