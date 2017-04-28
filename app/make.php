<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class make extends Model
{
    protected $table = 'make';
    public function models()
    {

        return $this->hasMany('App\carModels');
    }
}
