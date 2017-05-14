<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');


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
    $api->post('getOilFilterBrandsWithPrices','App\Http\Controllers\ApiController@getOilFilterBrandsWithPrices');
    $api->post('getAirFilterBrandsWithPrices','App\Http\Controllers\ApiController@getAirFilterBrands');
    $api->post('getAirFilterPrice','App\Http\Controllers\ApiController@getAirFilterBrandsWithPrices');
    $api->post('getEngineOilCapacity','App\Http\Controllers\ApiController@getEngineOilCapacity');
    $api->post('getAllServices','App\Http\Controllers\ApiController@getAllServices');
    $api->post('getOilBrandsWithPrices','App\Http\Controllers\ApiController@getOilBrandsWithPrices');
    $api->post('getBatteryBrandsWithPrices','App\Http\Controllers\ApiController@getBatteryBrandsWithPrices');


    $api->post('getAllBrands','App\Http\Controllers\ApiController@getAllBrands');


    $api->post('postOwnedCar','App\Http\Controllers\ApiController@postOwnedCar');
    $api->post('getOwnedCars','App\Http\Controllers\ApiController@getOwnedCars');
    $api->post('updateOwnedCar','App\Http\Controllers\ApiController@updateOwnedCar');


    $api->post('postOrder','App\Http\Controllers\ApiController@postOrder');
    $api->post('getOrder','App\Http\Controllers\ApiController@getOrder');




    $api->get('getAllUsers','App\Http\Controllers\ApiController@getAllUsers');
    $api->get('getUser','App\Http\Controllers\Auth\LoginController@getUser');
    $api->get('refreshToken','App\Http\Controllers\Auth\LoginController@refreshToken');



});