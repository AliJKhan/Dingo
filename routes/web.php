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



Route::group(['middleware' => ['sentinelCheck']], function () {
    Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'WebController@dashboard']);

    /* CARS CONTROLLER  */
    Route::get('car/view', [ 'as' => 'viewCar', 'uses' => 'CarsController@viewCar']);
    Route::get('car/edit', [ 'as' => 'editCar', 'uses' => 'CarsController@editCar']);
    Route::post('car/update', [ 'as' => 'updateCar', 'uses' => 'CarsController@updateCar']);

});
