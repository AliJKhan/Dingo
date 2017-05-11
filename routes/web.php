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
/*
Route::get('/', function () {
    return view('welcome');
});*/

/* LOGIN CONTROLLER  */
Route::get('/', [ 'as' => 'index', 'uses' => 'WebController@index']);
Route::post('signup/store', [ 'as' => 'signup/store', 'uses' => 'WebController@postStore']);
Route::post('signin', [ 'as' => 'signin', 'uses' => 'WebController@signIn']);
Route::get('signup', [ 'as' => 'signup', 'uses' => 'WebController@signUp']);
Route::post('signout', [ 'as' => 'signout', 'uses' => 'WebController@signOut']);


Route::group(['middleware' => ['sentinelCheck'], function () {
    Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'WebController@dashboard']);

    Route::get('modelnyear', [ 'as' => 'modelnyear', 'uses' => 'ServicesController@getModelnyear']);




    /* CARS CONTROLLER  */
    Route::get('cars/view', [ 'as' => 'viewCar', 'uses' => 'CarsController@viewCar']);
    Route::get('cars/edit', [ 'as' => 'editCar', 'uses' => 'CarsController@editCar']);
    Route::post('cars/update', [ 'as' => 'updateCar', 'uses' => 'CarsController@updateCar']);


    /* SERVICES CONTROLLER  */
    Route::get('services/index', [ 'as' => 'services', 'uses' => 'ServicesController@index']);
    Route::get('services/edit', [ 'as' => 'editService', 'uses' => 'ServicesController@editService']);
    Route::post('services/update', [ 'as' => 'updateService', 'uses' => 'ServicesController@updateService']);
    Route::get('services/add', [ 'as' => 'addService', 'uses' => 'ServicesController@addService']);

    Route::get('airfilters/index', [ 'as' => 'airFilters', 'uses' => 'ServicesController@airFilters']);
    Route::get('battery/index', [ 'as' => 'batteries', 'uses' => 'ServicesController@batteries']);
    Route::get('oilFilters/index', [ 'as' => 'oilFilters', 'uses' => 'ServicesController@oilFilters']);
    Route::get('breakPads/index', [ 'as' => 'breakPads', 'uses' => 'ServicesController@breakPads']);

    Route::get('modelnyear/index', [ 'as' => 'addModelnyear', 'uses' => 'ServicesController@addModelnyear']);
    Route::post('modelnyear/add', [ 'as' => 'newModelnyear', 'uses' => 'ServicesController@newModelnyear']);



    Route::post('services/store', [ 'as' => 'newService', 'uses' => 'ServicesController@newService']);
    Route::get('services/delete', [ 'as' => 'deleteService', 'uses' => 'ServicesController@deleteService']);
    Route::get('mechanics/index', [ 'as' => 'mechanics', 'uses' => 'ServicesController@mechanics']);
    Route::get('mechanics/add', [ 'as' => 'addMechanic', 'uses' => 'ServicesController@addMechanic']);
    Route::post('mechanics/store', [ 'as' => 'newMechanic', 'uses' => 'ServicesController@newMechanic']);




    /* Orders CONTROLLER  */
    Route::get('orders/index', [ 'as' => 'orders', 'uses' => 'OrdersController@index']);
    Route::get('orders/view', [ 'as' => 'viewOrders', 'uses' => 'OrdersController@viewOrders']);
    Route::get('orders/edit', [ 'as' => 'editOrders', 'uses' => 'OrdersController@editOrders']);
    Route::post('orders/update', [ 'as' => 'updateOrders', 'uses' => 'OrdersController@updateOrders']);





});
