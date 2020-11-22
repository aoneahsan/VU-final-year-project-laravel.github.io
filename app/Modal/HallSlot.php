<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class HallSlot extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hall()
    {
        return $this->hasOne('App\Modal\Hall');
    }

    public function booking()
    {
        return $this->hasOne('App\Modal\Booking');
    }

    public function hall_time()
    {
        return $this->hasOne('App\Modal\HallTime');
    }
}
