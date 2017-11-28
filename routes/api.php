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
Route::post('v1/login', 'UserController@apiLogin');
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/short', 'UserController@store');
});