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
        return $this->hasMany('App\Modal\HallGallery', 'hall_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Modal\HallGallery', 'hall_id', 'id');
    }

    public function allFoods()
    {
        return $this->hasMany('App\Modal\HallFood', 'hall_id', 'id');
    }

    public function foods()
    {
        return $this->allFoods()->where('is_available', true);
    }

    public function allFeatures()
    {
        return $this->hasMany('App\Modal\HallFeature', 'hall_id', 'id');
    }

    public function features()
    {
        return $this->allFeatures()->where('is_available', true);
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Modal\HallFeedback', 'hall_id', 'id');
    }

    public function timings()
    {
        return $this->hasMany('App\Modal\HallTime', 'hall_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany('App\Modal\Booking', 'hall_id', 'id');
    }
}
