<?php

namespace Cdig;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    public $timestamps = false;

    public function programas()
    {
    	return $this->hasMany('Cdig\Programa');
    }
}
