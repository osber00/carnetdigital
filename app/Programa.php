<?php

namespace Cdig;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public $timestamps = false;

    public function users()
    {
    	return $this->hasMany('Cdig\User','user_id');
    }

    public function facultad()
    {
    	return $this->belongsTo('Cdig\Facultad');
    }
}
