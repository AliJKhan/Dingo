<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class battery_brand extends Model
{
    protected $table = 'battery_brand';
    public $timestamps = false;
    public function getAmps()
    {
        return $this->hasMany('App\battery_amps');
    }
}
