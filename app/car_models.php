<?php

namespace App;
use App\make;
use Illuminate\Database\Eloquent\Model;

class car_models extends Model
{
    protected $table = 'car_models';

    public function getModelsNYears()
    {
        return $this->hasMany('App\modelnyear');
    }

    public function getEngineCapacity()
    {
        return $this->hasOne('App\engine_oil_capacity');
    }

}
