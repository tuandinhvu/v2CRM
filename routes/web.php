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
    Route::get('/user/logout', 'UserController@getLogout');

    Route::group(['middleware'=>'permission'], function(){
        Route::group(['prefix'=>'config'], function(){

            Route::get('system', 'SystemController@getSystem');
            Route::post('system', 'SystemController@postSystem');

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

            Route::get('branches', 'BranchController@getList');
            Route::get('branches/data', 'BranchController@dataList');
            Route::get('branches/create', 'BranchController@getCreate');
            Route::post('branches/create', 'BranchController@postCreate');
            Route::get('branch/del', 'BranchController@getDelete');
            Route::get('branch/edit', 'BranchController@getEdit');
            Route::post('branch/edit', 'BranchController@postEdit');

            Route::get('permissions', 'PermissionController@getList');
            Route::get('permissions/data', 'PermissionController@getData');
            Route::get('permissions/create', 'PermissionController@getCreate');
            Route::post('permissions/create', 'PermissionController@postCreate');
            Route::get('permission/del', 'PermissionController@getDelete');
            Route::get('permission/edit', 'PermissionController@getEdit');
            Route::post('permission/edit', 'PermissionController@postEdit');
            Route::get('permissions/roletable', 'PermissionController@getRoletable');
            Route::post('permissions/add-group-permission', 'PermissionController@postAddGroupPermission');

            Route::get('plugins', 'PluginController@getList');
            Route::get('plugins/create', 'PluginController@getCreate');
            Route::post('plugins/create', 'PluginController@postCreate');
            Route::get('plugin/{plugin}/install', 'PluginController@getInstallPlugin');
            Route::get('plugin/{plugin}/uninstall', 'PluginController@getUninstallPlugin');

            Route::get('widget', 'WidgetController@getIndex');
            Route::post('widget/add', 'WidgetController@postAdd');
            Route::post('widget/edit', 'WidgetController@postEdit');
            Route::get('widget/delete', 'WidgetController@getDelete');
        });
        Route::group(['prefix'=>'ajax'],function(){
            Route::get('routes-list', 'AjaxController@getRoutelist');
        });
    });
});


Route::get('t', function(){
   return v('plugins/success', ['name'=> 'test']);
});