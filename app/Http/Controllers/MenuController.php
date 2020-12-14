<?php

namespace App\Http\Controllers;

use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;

class MenuController extends Controller
{
    public function getList() {
//        event_log('Truy cập trang ['.trans('system.menu').']');
        return v('menu.menulist');
    }

    public function getIndex()
    {
        $id     =   request('id');
        $data   =   Menu::find($id);
//        $data   =   json_decode($data->data, true);
//        print_r($data);
        if(!empty($data)){
//            event_log('Truy cập trang ['.trans('system.menu').']');
            return v('menu.menu',compact('data'));
        }
    }

    public function dataList() {
        $data   =   Menu::query();

        $result = Datatables::of($data)
            ->addColumn('name', function(Menu $menu) {
                return a('config/menu', 'id='.$menu->id,$menu->name);
            })->addColumn('manage', function($menu) {
                return a('config/menu/del', 'id='.$menu->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/menu/del?id='.$menu->id)."')}})").'  '.a('config/menu/edit', 'id='.$menu->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage','name']);

        return $result->make(true);
    }

    public function getCreate()
    {
//        event_log('Truy cập trang ['.trans('page.createmenu').']');
        return v('menu.create');
    }

    public function postCreate()
    {
        $data   =   new Menu();
        $data->name   =   \request('name');
        $data->data   =   \request('data');
        $data->options   =   '{}';
        $data->created_at   =   Carbon::now();
        $data->save();
//        event_log('Tạo Menu mới '.$data->name.' id '.$data->id);
        set_notice(trans('system.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   Menu::find(request('id'));
        if(!empty($data)){
//            event_log('Truy cập trang ['.trans('department.edit').']');
            return v('menu.edit', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit()
    {
        $id     =   \request('id');
        $data   =   Menu::find($id);
        if(!empty($data)){
            $data->name =   \request('name');
            $data->data =   \request('data');
            $data->save();
//            event_log('Sửa Menu '.$data->name.' id '.$data->id);
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   Menu::find(request('id'));
        if(!empty($data)){
//            event_log('Xóa Menu '.$data->name.' id '.$data->id);
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public static function getMenu($id)
    {
        $data   =   Menu::find($id);
        if(!empty($data)){
            return json_decode($data->data, true);
        }
    }

    public function dataMenu () {
        $id     =   request('id');
        $data   =   request('data');
        $name   =   request('name');
        $menu   =   Menu::find($id);

        if(!empty($menu))
        {
//            event_log('Chỉnh sửa menu');
            $menu->data = $data;
            $menu->name = $name;
            $menu->created_at = Carbon::now();
            $menu->save();
        }
        set_notice('Sửa menu thành công!', 'success');
        return redirect()->back();
    }

    public static function pluginMenu()
    {
        $plugins = new \App\Plugin();
        $plugins = $plugins->select('name', 'menu')->whereNotNull('menu');
        $plugins = $plugins->get();
        $result =   [];
        foreach ($plugins as $pl) {
            $result[]   =   [
                'name'  =>  $pl->name,
                'icon'  =>  $pl->icon,
                'children' =>  json_decode($pl->menu, true),
                'path'   =>  ''
            ];
        }
        return $result;
    }
    public static function renderMenu($data)
    {
        foreach ($data as $key => $item) {
            if (!empty($item['children'])) {
                foreach ($item['children'] as $k => $c) {
                    if (!p($c['path'], 'get')) {
                        unset($data[$key]['child'][$k]);
                    }
                }
                if (empty($data[$key]['children']))
                    unset($data[$key]);
            } else {
                if (!p($item['path'], 'get'))
                    unset($data[$key]);
            }
        }
        return $data;
    }
}
