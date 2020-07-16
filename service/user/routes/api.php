<?php

use Illuminate\Support\Facades\Route;

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
Route::get('v1/', 'API\v1\IndexController@index');
Route::post('v1/user', 'API\v1\UserController@store');
Route::post('v1/user/authenticate', 'API\v1\UserController@authenticate');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('v1/user', 'API\v1\UserController@index');
    Route::get('v1/user/{id}', 'API\v1\UserController@show');
    Route::put('v1/user/{id}', 'API\v1\UserController@update');
    Route::delete('v1/user/{id}', 'API\v1\UserController@update');
    Route::post('v1/user/logout', 'API\v1\UserController@logout');
});
