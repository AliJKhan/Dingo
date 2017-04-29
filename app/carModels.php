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

}
