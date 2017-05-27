<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';
    public $timestamps = false;

    protected $fillable = [
        'house_street','block_area','address_optional','city','lattitude','longitude',
    ];
}
