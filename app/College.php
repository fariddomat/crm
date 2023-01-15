<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $guarded=[];

    public function specializations( )
    {
        return $this->hasMany(Specialization::class);
    }
}
