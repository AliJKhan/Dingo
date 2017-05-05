@extends('layouts.headers')
<div class="container">
    <form class="form-horizontal" method="post" action="{{route('updateCar', ['id' => $ownedCar->id])}}">
        <fieldset>

            <!-- Form Name -->
            <legend>Edit Car</legend>

            <!-- Multiple Radios (inline) -->


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Registration Number</label>
                <div class="col-md-4">
                    <input id="textinput" name="registration_number" type="text" placeholder="XYZ 1234" class="form-control input-md" value="{{$ownedCar->registration_number}}">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Odometer Reading</label>
                <div class="col-md-4">
                    <input id="textinput" name="odometer_reading" type="text" placeholder="123456" class="form-control input-md" value="{{$ownedCar->odometer_reading}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Average Drive Per Day</label>
                <div class="col-md-4">
                    <input id="textinput" name="average_drive_per_day" type="number" placeholder="123456" class="form-control input-md" value="{{$ownedCar->average_drive_per_day}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Engine Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="engine_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->engine_health}}">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Air Filter Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="air_filter_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->air_filter_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Oil Filter Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="oil_filter_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->oil_filter_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Bumper Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_bumper_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_bumper_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Bumper Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_bumper_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_bumper_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Right Door Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_right_door_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_right_door_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Left Door Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_left_door_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_left_door_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Right Door Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_right_door_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_right_door_health}}" >


                </div>
            </div>



            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Left Door Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_left_door_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_left_door_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Right Fender Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_right_fender_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_right_fender_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Left Fender Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_left_fender_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_left_fender_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Right Fender Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_right_fender_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_right_fender_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Left Fender Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_left_fender_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_left_fender_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Roof Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="roof_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->roof_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Bonnet Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="bonnet_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->bonnet_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Trunk Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="trunk_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->trunk_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Right Mirror Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="right_mirror_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->right_mirror_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Left Mirror Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="left_mirror_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->left_mirror_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Right Light Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_right_light_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_right_light_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Left Light Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_left_light_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_left_light_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Right Light Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_right_light_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_right_light_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Left Light Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_left_light_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_left_light_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Seats Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_seats_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_seats_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Seats Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_seats_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_seats_health}}" >


                </div>
            </div>



            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">AC Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="ac_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->ac_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Heater Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="heater_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->heater_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Cabin Lights Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="cabin_lights_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->cabin_lights_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Engine Oil Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="engine_oil_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->engine_oil_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Transmission Oil Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="transmission_oil_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->transmission_oil_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Power Steering Oil Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="power_steering_oil_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->power_steering_oil_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Battery Water Level</label>
                <div class="col-md-4">
                    <input id="textinput" name="battery_water_level" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->battery_water_level}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Washer Water Level</label>
                <div class="col-md-4">
                    <input id="textinput" name="washer_water_level" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->washer_water_level}}" >


                </div>
            </div>



            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Coolant Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="coolant_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->coolant_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Radiator Water Level</label>
                <div class="col-md-4">
                    <input id="textinput" name="radiator_water_level" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->radiator_water_level}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Right Tyre Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_right_tyre_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_right_tyre_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Left Tyre Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_left_tyre_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_left_tyre_health}}" >


                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Right Tyre Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_right_tyre_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_right_tyre_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Right Brake Pad Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_right_brake_pad_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_right_brake_pad_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Front Left Brake Pad Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="front_left_brake_pad_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->front_left_brake_pad_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Right Brake Pad Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_right_brake_pad_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_right_brake_pad_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rear Left Brake Pad Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="rear_left_brake_pad_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->rear_left_brake_pad_health}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Over All Car Health</label>
                <div class="col-md-4">
                    <input id="textinput" name="over_all_car_health" type="number" placeholder="" class="form-control input-md" value="{{$ownedCar->over_all_car_health}}" >


                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <input type="submit" value="Submit">
                </div>
            </div>

        </fieldset>
    </form>

</div>