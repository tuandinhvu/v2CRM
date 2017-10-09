<?php
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 10/9/2017
 * Time: 10:24 AM
 */
function v($view = null, $data = [], $mergeData = [])
{
    return view('themes.'.theme().'.'.$view, $data, $mergeData);
}
function theme($type=FALSE){
    $prefix =   $type==TRUE?'themes.':'';
    return $prefix.settings('theme','default');
}