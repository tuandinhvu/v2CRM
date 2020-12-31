<?php
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 7/1/2017
 * Time: 3:41 PM
 */
Route::group(['prefix'=>'post','middleware'=>['web','auth']], function(){
    Route::get('','v2CRM\Post\PostController@getIndex');
    Route::post('widget/index', 'v2CRM\Post\PostController@postWidget');
});
