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
        Route::group(['prefix'=>'config'], function(){
            Route::get('groups', 'GroupController@getList');
            Route::get('groups/data', 'GroupController@dataList');
            Route::get('groups/create', 'GroupController@getCreate');
            Route::post('groups/create', 'GroupController@postCreate');
            Route::get('group/del', 'GroupController@getDelete');
            Route::get('group/edit', 'GroupController@getEdit');
            Route::post('group/edit', 'GroupController@postEdit');

            Route::get('users', 'UserController@getList');
            Route::get('users/data', 'UserController@dataList');
            Route::get('users/create', 'UserController@getCreate');
            Route::post('users/create', 'UserController@postCreate');
            Route::get('user/del', 'UserController@getDelete');
            Route::get('user/edit', 'UserController@getEdit');
            Route::post('user/edit', 'UserController@postEdit');
        });

    });
});


Route::get('/install', function(){
    echo '<pre>';
    print_r(render_menu(array_merge(menu(1),plugin_menu())));
});