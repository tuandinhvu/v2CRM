<?php

namespace App\Http\Controllers;

use App\Option;
use App\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SystemController extends Controller
{
    public function getSystem()
    {
        $db_categories =   Option::select(DB::raw('DISTINCT(source)'))->pluck('source')->all();
        $db_options =  new Option();
        $db_options    =   $db_options->where('source', request('source','system'));
        $db_options    =   $db_options->get();

        $options    =   [];
        $categories =   [];
        foreach($db_categories as $k=>$cat){
            if($cat=='system'){
                $categories[$k] =   [
                    'name'=>trans('system.system'),
                    'source'    =>  'system'
                ];
            } else {
                $categories[$k] = [
                    'name'  =>  Lang::has($cat.'::options.name')?trans($cat.'::options.name'):Plugin::where('folder',$cat)->first()->name,
                    'source'    =>  $cat
                ];
            }
        }
        foreach($db_options as $item){
            $label  =   $item->label;
            if($item->source == 'system'){
                if(Lang::has('options.system.'.$item['name']))
                    $label  =   trans('options.system.'.$item['name']);
            }elseif(Lang::has($item->source.'::options.'.$item['name'])){
                $label  =   trans($item->source.'::options.'.$item['name']);
            }
            $options[]    =   [
                'label' =>  $label,
                'name'  =>  $item->source.'_'.$item->name,
                'type'  =>  $item->type,
                'values'    =>  in_array($item->type, ['select','checkbox'])?json_decode($item->values, true):$item->values
            ];
        }
        return v('config.system', compact('options','categories'));
    }

    public function postSystem()
    {
        foreach(request()->all() as $k=>$item){
            $detail =   explode('_',$k);
            if((!empty($detail[0]) && !empty($detail[1]))&& Option::where('source',$detail[0])->where('name',$detail[1])->count() > 0){
                if(is_array($item)){
                    \Settings::set($k,json_encode($item));
                }
                else{
                    \Settings::set($k, $item);
                }
            }else{
                print_r($detail);
            }
        }
        set_notice(trans('system.edit_success'), 'success');
        return redirect()->back();
    }
}
