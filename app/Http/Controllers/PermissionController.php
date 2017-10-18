<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function getList()
    {
        return v('permission.list');
    }

    public function getData()
    {
        $data   =   Permission::with('group','type');

        $result = Datatables::of($data)
            ->addColumn('group', function(Permission $permission) {
                return $permission->group->name;
            })->addColumn('type', function(Permission $permission) {
                return $permission->type=='public'?trans('g.public'):trans('g.private');
            })->addColumn('manage', function($permission) {
                return a('config/permission/del', 'id='.$permission->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/permission/del?id='.$user->id)."')}})").'  '.a('config/$permission/edit', 'id='.$user->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        return $result->make(true);
    }
}
