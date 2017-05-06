<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class oil_filter_brands extends Model
{
    protected $table = 'oil_filter_brands';
    public $timestamps = false;
    public function getPrice()
    {
        return $this->hasMany('App\oil_filter_price');
    }
}
