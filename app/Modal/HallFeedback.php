<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class HallFeedback extends Model
{
    protected $guarded = [];

    public function hall()
    {
        return $this->belongsTo('App\Modal\Hall');
    }
}
