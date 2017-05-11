<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelnyear extends Model
{
    protected $table = 'modelnyear';
    public $timestamps = false;
    public function getCapacity()
    {

        return $this->hasOne('App\engine_oil_capacity');
    }

    public function getModel()
    {

        return $this->belongsTo('App\car_models','car_models_id');
    }

    public function getYear()
    {

        return $this->belongsTo('App\years','years_id');
    }

}
