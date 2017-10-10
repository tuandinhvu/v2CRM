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

use App\Http\Controllers\MenuController;
function menu($id){
    return MenuController::getMenu($id);
}
function plugin_menu(){
    return MenuController::pluginMenu();
}
function render_menu($data){
    return MenuController::renderMenu($data);
}
function p($permission, $method='get'){
    $per    =   new App\Permission();
    $per    =   $per->where('permission',$permission)->where('method',$method)->first();
    if(!empty($per) && ( $per->type=='public' || $per->role()->where('permission_role.role_id',auth()->user()->role_id)->count()))
        return TRUE;
    else
        return FALSE;
}