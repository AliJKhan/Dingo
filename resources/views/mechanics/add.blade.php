@extends('layouts.headers')
@extends('layouts.navbar')
<form class="form-horizontal" method="post" action="{{route('newMechanic')}}">
    <div class="form-group" id="ampere">
        <label class="col-md-4 control-label" for="textinput">Name</label>
        <div class="col-md-4">
            <input id="textinput" name="name" type="text" placeholder="" class="form-control input-md" value="" >

        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="textinput" >Phone Number</label>
        <div class="col-md-4">
            <input id="textinput" name="phone_number" type="text" placeholder="+923xxxxxxxx" class="form-control input-md" value=""  >


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
</form>