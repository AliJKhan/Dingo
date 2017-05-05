@extends('layouts.headers')
<div class="span3 well">
    <legend>New to WebApp? Sign up!</legend>
    <form  action="{{route('signup/store')}}" method="post">

        <input class="span3" name="email" placeholder="Email" type="text">
        <input class="span3" name="password" placeholder="Password" type="password">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-warning" type="submit">Sign up for WebApp</button>
    </form>
</div>