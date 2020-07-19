<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->hasMany('App\Modal\HallGallery', 'id', 'hall_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Modal\HallGallery', 'id', 'hall_id');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Modal\HallFeedback', 'id', 'hall_id');
    }

    public function bookings()
    {
        return $this->hasMany('App\Modal\Booking', 'id', 'hall_id');
    }
}
