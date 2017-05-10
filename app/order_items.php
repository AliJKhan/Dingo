<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    protected $table = 'order_items';

    public function getServiceName()
    {
        $service = service::find($this->service_id)->getName();
        return $service;
    }

    public function getServicePrice()
    {
        $servicePrice = service::find($this->service_id)->getPrice();
        return $servicePrice ;
    }

}
