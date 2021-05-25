<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $with = ['professor'];

    function professor(){
        return $this->belongsTo('App\Professor');
    }
}
