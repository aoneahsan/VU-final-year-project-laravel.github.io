<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HallGallery extends Model
{
    protected $guarded = [];

    public function hall()
    {
        return $this->belongsTo('App\Modal\Hall');
    }

    public function file_url()
    {
        return Storage::url($this->file_path);
    }
}
