<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class HallGallery extends Model
{
    protected $guarded = [];

    public function hall()
    {
        return $this->belongsTo('App\Modal\Hall');
    }
}
