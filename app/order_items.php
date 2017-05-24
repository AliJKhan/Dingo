<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    protected $table = 'order_items';

    public function getServiceName()
    {

        $modelnyearService = modelnyear_service::find($this->service_id);
        $service = service::find($modelnyearService->service_id)->getName();
        return $service;
    }

    public function getServicePrice()
    {
        $modelnyearService = modelnyear_service::find($this->service_id);
        $servicePrice = service::find($modelnyearService->service_id)->getPrice();
        return $servicePrice ;
    }

    public function getSubItems()
    {

        return $this->hasMany('App\order_sub_items')->get();
    }

    protected $fillable = [
        'order_primary_id','primary_id','service_id','service_name','service_thumbnail','service_orignal_price','discount_amount',
        'after_discount_price','service_description','service_classification'
    ];
}
