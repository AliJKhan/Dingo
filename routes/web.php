<?php
use Barryvdh\Debugbar\LaravelDebugbar;
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
    $api->post('generateOtp','App\Http\Controllers\ApiController@postGenerateOtp');
    $api->post('verifyOtp','App\Http\Controllers\ApiController@postVerifyOtp');




    $api->get('test', function () {return 'Congratulations on setting this up!!'; });

});



$api->version('v1',['middleware'=>'tokenCheck'],function($api){

    $api->post('getMakes','App\Http\Controllers\ApiController@getMakes');
    $api->post('getModels','App\Http\Controllers\ApiController@getModel');
    $api->post('getModelNYear','App\Http\Controllers\ApiController@getModelNYear');
    $api->post('getOilFilterBrands','App\Http\Controllers\ApiController@getOilFilterBrands');
    $api->post('getOilFilterPrice','App\Http\Controllers\ApiController@getOilFilterPrice');
    $api->post('getAirFilterBrands','App\Http\Controllers\ApiController@getAirFilterBrands');
    $api->post('getAirFilterPrice','App\Http\Controllers\ApiController@getAirFilterPrice');
    $api->post('getEngineOilCapacity','App\Http\Controllers\ApiController@getEngineOilCapacity');


    $api->get('getAllUsers','App\Http\Controllers\ApiController@getAllUsers');
	$api->get('getUser','App\Http\Controllers\Auth\LoginController@getUser');
	$api->get('refreshToken','App\Http\Controllers\Auth\LoginController@refreshToken');



});