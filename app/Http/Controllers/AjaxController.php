<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRoutelist()
    {
        $addition   =   !empty(request('type',''))?request('type','').'/':'';
        $hideinfo =   request('hideinfo', 0);
        $data   =   \Route::getRoutes();
        $result =   [];
        $string = request()->input('term');
        $method =   request('method','');
        foreach($data as $item){
            if(strstr($item->uri, $addition.$string) &&($method=='' || strtolower($item->methods()[0])==$method)) {
                $result[] = [
                    'id' => $item->uri,
                    'name' => $hideinfo==0?$item->methods()[0].'- '.$item->uri:$item->uri,
                    'method'    => strtolower($item->methods()[0])
                ];
            }
        }
        $result[]   =   [
            'id'    =>  $string,
            'name'  =>  trans('permissions.spec').': '.$string,
            'method'    =>  'get'
        ];
        return response()->json($result);
    }
}
