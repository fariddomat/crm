<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $guarded=[];

    public function college( )
    {
        return $this->belongsTo(College::class);
    }
}
