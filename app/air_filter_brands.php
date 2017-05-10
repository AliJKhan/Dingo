<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class air_filter_brands extends Model
{
    protected $table = 'air_filter_brands';
    public $timestamps = false;
    public function getPrice()
    {
        return $this->hasMany('App\air_filter_price');
    }


}
