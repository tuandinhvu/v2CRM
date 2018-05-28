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

//setting helpers
function opt_input($name, $type, $values=[]){
    switch ($type){
        case 'url':
            return redirect()->to($values);
            break;
        case 'text':
            $result = "<input type='text' name='$name' class='form-control' value='".settings($name,'')."' />";
            break;
        case 'checkbox':
            $result =   "";
            foreach($values as $item){
                $checked    =   in_array($item['value'], json_decode(settings($name)))?'checked':'';
                $result.= "<input type='checkbox' name='".$name."[]' value='".$item['value']."' $checked /> ".$item['label']."  ";
            }
            break;
        case 'radio':
            $result =   "";
            foreach($values as $item){
                $checked    =   $item['value'] == settings($name)?'checked':'';
                $result.= "<input type='checkbox' name='$name' value='".$item['value']."' $checked /> ".$item['label']."  ";
            }
            break;
        case 'select':
            $result =   "<select name='$name' class='form-control'>";
            foreach($values as $item){
                $selected   =   $item['value']==settings($name)?'selected':'';
                $result.= "<option value='".$item['value']."' $selected > ".$item['label']."</option>  ";
            }
            $result.=   "</select>";
            break;
        case 'textarea':
            $result =   "<textarea class='form-control' name='$name'>".settings($name)."</textarea>";
            break;
        default:
            $result =   '';
            break;
    }
    return $result;
}

function get_opt($source,$name){
    return settings($source.'_'.$name, FALSE);
}

function camelize($input, $separator = '_')
{
    return str_replace($separator, '', ucwords($input, $separator));
}