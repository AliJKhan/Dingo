@extends('layouts.headers')
@extends('layouts.navbar')


<a href="{{route('addMechanic')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Add</a>

@foreach($mechanics as $mechanic)
{{$mechanic->name}}
{{$mechanic->phone_number}}
@endforeach