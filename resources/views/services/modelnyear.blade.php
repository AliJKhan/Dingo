@extends('layouts.headers')
@extends('layouts.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
    <form class="form-horizontal" method="post" action="{{route('newModelnyear')}}">
        <fieldset>

            <div class="form-group" >
                <label class="col-md-4 control-label" for="models">Select Model:</label>
                <div class="col-md-4 ">
                    <select name="car_models" class="form-control" id="car_models" >
                        <option value=""></option>
                        @foreach($carModels as $model)
                            <option value="{{$model->id}}">{{$model->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-md-4 control-label" for="models">Starting Year:</label>
                <div class="col-md-4 ">
                    <select name="yearFrom" class="form-control" id="car_models" >
                        <option value=""></option>
                        @foreach($years as $year)
                            <option value="{{$year->id}}">{{$year->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-md-4 control-label" for="models">Ending Year:</label>
                <div class="col-md-4 ">
                    <select name="yearTo" class="form-control" id="car_models" >
                        <option value=""></option>
                        @foreach($years as $year)
                            <option value="{{$year->id}}">{{$year->name}}</option>
                        @endforeach
                    </select>
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
