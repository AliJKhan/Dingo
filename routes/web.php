<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
$api = app('Dingo\Api\Routing\Router');

Route::get('/', function () {
    return view('welcome');
});


$api->version('v1',function($api){
	
	$api->post('authenticate','App\Http\Controllers\Auth\LoginController@authenticate');
	
});


$api->version('v1',['middleware'=>'api.auth'],function($api){
	$api->get('users','App\Http\Controllers\ApiController@index');
	$api->get('user','App\Http\Controllers\Auth\LoginController@show');
	$api->get('token','App\Http\Controllers\Auth\LoginController@getToken');
	
	//REQUEST CONTROLLER
	$api->get('request','App\Http\Controllers\ReqController@index');
	$api->post('request','App\Http\Controllers\ReqController@create');
	


});