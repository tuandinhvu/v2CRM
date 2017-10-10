<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public static function getMenu($id)
    {
        $data   =   Menu::find($id);
        if(!empty($data)){
            return json_decode($data->data, true);
        }
    }

    public static function pluginMenu()
    {
        $plugins = new \App\Plugin();
        $plugins = $plugins->select('name', 'icon', 'menu')->whereNotNull('menu');
        $plugins = $plugins->get();
        $result =   [];
        foreach ($plugins as $pl) {
            $result[]   =   [
                'name'  =>  $pl->name,
                'icon'  =>  $pl->icon,
                'child' =>  json_decode($pl->menu, true),
                'url'   =>  ''
            ];
        }
        return $result;
    }
    public static function renderMenu($data)
    {
        foreach ($data as $key => $item) {
            if (!empty($item['child'])) {
                foreach ($item['child'] as $k => $c) {
                    if (!p($c['path'], 'get')) {
                        unset($data[$key][$k]);
                    }
                }
                if (empty($data[$key]))
                    unset($data[$key]);
            } else {
                if (!p($item['url'], 'get'))
                    unset($data[$key]);
            }
        }
        return $data;
    }
}
