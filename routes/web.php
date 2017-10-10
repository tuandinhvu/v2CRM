<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'UserController@getLogin')->name('login');
Route::post('login', 'UserController@postLogin');
Route::group(['middleware'=>'auth'], function(){

    Route::get('/', function () {
        return v('pages.index');
    });


    Route::group(['middleware'=>'permission'], function(){

    });
});


Route::get('/install', function(){
//    echo '<pre>';
    print_r(render_menu(array_merge(menu(1),plugin_menu())));
});