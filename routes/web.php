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
    $api->post('signUp','App\Http\Controllers\Auth\LoginController@signUp');
	$api->post('authenticate','App\Http\Controllers\Auth\LoginController@authenticate');
    $api->post('mobileSignUp','App\Http\Controllers\Auth\LoginController@mobileSignUp');
	$api->get('test', function () {return 'Congratulations on setting this up!!'; });
	
});


$api->version('v1',['middleware'=>'api.auth'],function($api){
	$api->get('getAllUsers','App\Http\Controllers\ApiController@getAllUsers');
	$api->get('getUser','App\Http\Controllers\Auth\LoginController@getUser');
	$api->get('refreshToken','App\Http\Controllers\Auth\LoginController@refreshToken');
	


});