<?php
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 7/1/2017
 * Time: 3:41 PM
 */
Route::group(['prefix'=>'ipfilter','middleware'=>['web','auth']], function(){
    Route::get('','v2CRM\Ipfilter\IpfilterController@getIndex');
    Route::post('widget/index', 'v2CRM\Ipfilter\IpfilterController@postWidget');
    Route::get('data', 'v2CRM\Ipfilter\IpfilterController@getData');
});
