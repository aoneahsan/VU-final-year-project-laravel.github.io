<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function owner()
    {
        return $this->hasMany('App\Modal\HallGallery', 'id', 'hall_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Modal\HallGallery', 'id', 'hall_id');
    }

    public function foods()
    {
        return $this->hasMany('App\Modal\HallFood', 'id', 'hall_id');
    }

    public function features()
    {
        return $this->hasMany('App\Modal\HallFeature', 'id', 'hall_id');
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
