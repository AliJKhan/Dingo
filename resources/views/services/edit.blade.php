@extends('layouts.headers')
<div class="container">
    <form class="form-horizontal" method="post" action="{{route('updateService', ['id' => $object->id,'type'=>$type])}}">
        <fieldset>

            <!-- Form Name -->
                <legend>Edit Service</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Name</label>
                    <div class="col-md-4">
                        <input id="textinput" name="name" type="text" placeholder="" class="form-control input-md" value="{{$object->name}}">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Price</label>
                    <div class="col-md-4">
                        <input id="textinput" name="price" type="text" placeholder="2000" class="form-control input-md" value="{{$object->price}}" >


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