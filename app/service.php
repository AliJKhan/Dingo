<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'service';



    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }


}
