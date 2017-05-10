@extends('layouts.headers')
@extends('layouts.navbar')


{{$ownedCar->make_name}}
{{$ownedCar->model_name}}
<img src="{{$ownedCar->make_thumbnail}}">
{{$ownedCar->engine_health}}


