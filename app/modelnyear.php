<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelnyear extends Model
{
    protected $table = 'modelnyear';
    public function getCapacity()
    {

        return $this->hasOne('App\engine_oil_capacity');
    }

}
