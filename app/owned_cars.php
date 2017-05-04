<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class owned_cars extends Model
{
    protected $table = 'owned_cars';

    protected $fillable = [
        'modelnyear_id','year','registration_number','odometer_reading','car_models_id','model_name',
        'model_thumbnail','average_drive_per_day','make_id','make_name','make_thumbnail','engine_health',
        'air_filter_health','oil_filter_health','front_bumper_health','rear_bumper_health','front_right_door_health',
        'front_left_door_health','rear_right_door_health','rear_left_door_health','front_right_fender_health',
        'front_left_fender_health','rear_right_fender_health','rear_left_fender_health','roof_health','bonnet_health',
        'trunk_health','right_mirror_health','front_right_light_health','front_left_light_health','rear_right_light_health',
        'rear_left_light_health','front_seats_health','rear_seats_health','ac_health','heater_health','cabin_lights_health',
        'engine_oil_health','transmission_oil_health','power_steering_oil_health','battery_water_level','washer_water_level',
        'coolant_health','radiator_water_level','front_right_tyre_health','front_right_brake_pad_health','front_left_tyre_health',
        'front_left_brake_pad_health','rear_right_tyre_health','rear_right_brake_pad_health','rear_left_tyre_health',
        'rear_left_brake_pad_health','over_all_car_health',
    ];
}
