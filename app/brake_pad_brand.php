<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brake_pad_brand extends Model
{
    protected $table = 'brake_pad_brand';
    public $timestamps = false;
    public function getPrice()
    {
        return $this->hasMany('App\brake_pad_price');
    }
}
