<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    public function getItems()
    {

        return $this->hasMany('App\order_items')->get();
    }

    public function getUser()
    {
        $user = User::find($this->user_id);
        return $user->phone_number;
    }

    public function getMechanic()
    {
        return $this->hasOne('App\mechanic');
    }

    public function getStatus()
    {
        return $this->hasOne('App\order_status');
    }

    public function getMechanicName()
    {

        $mechanicName = mechanic::find($this->mechanic_id)->getName();
        return $mechanicName ;
    }


}
