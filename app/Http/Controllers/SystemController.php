<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SystemController extends Controller
{
    public function getSystem()
    {
        $categories =   Option::select(DB::raw('DISTINCT(source)'))->pluck('source')->all();
        $db_options =  new Option();
        $db_options    =   $db_options->where('source', request('source','system'));
        $db_options    =   $db_options->get();
        $options    =   [];
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
        
    }
}
