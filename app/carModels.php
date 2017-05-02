<?php

namespace App;
use App\make;
use Illuminate\Database\Eloquent\Model;

class carModels extends Model
{
    protected $table = 'carModels';

    public function getModelsNYears()
    {
        return $this->hasMany('App\modelnyear');
    }

    public function getEngineCapacity()
    {
        return $this->hasOne('App\engine_oil_capacity');
    }

}
