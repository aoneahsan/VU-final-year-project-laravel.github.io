<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function hall()
    {
        return $this->hasOne('App\Modal\Hall', 'id', 'hall_id');
    }
}
