<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRoutelist()
    {
        $data   =   \Route::getRoutes();
        $result =   [];
        $string = request()->input('term');
        foreach($data as $item){
            if(strstr($item->uri, $string)) {
                $result[] = [
                    'id' => $item->uri,
                    'name' => $item->methods()[0].': '.$item->uri,
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
