<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mechanic extends Model
{
    protected $table = 'mechanic';
    public $timestamps = false;

    public function getName()
    {
        return $this->name;
    }

}
