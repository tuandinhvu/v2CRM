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
//menu helper
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
    if(!empty($per) && ( $per->type=='public' || $per->group()->where('group_permission.group_id',auth()->user()->group_id)->count()))
        return TRUE;
    else
        return FALSE;
}


//build url helper
function a($url, $get='', $name='',$attr=[], $realurl='',$callback=''){
    if(p($url,'get')){
        $attrs  =   '';
        foreach($attr as $k=>$i){
            $attrs.=    "$k='$i'";
        }
        if(!empty($realurl)){
            $url    =   $realurl;
            $get    =   '';
        }
        else $get   =   '?'.$get;
        return "<a href='".asset($url)."$get' $attrs onclick=\"$callback\">".(!empty($name)?$name:$url)."</a>";
    }
}

//set notification
function set_notice($message, $type='warning'){
    \Illuminate\Support\Facades\Session::flash('message.type',$type);
    \Illuminate\Support\Facades\Session::flash('message.message',$message);
}
