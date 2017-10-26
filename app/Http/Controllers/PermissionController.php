<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreatePermissionRequest;
use App\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
class PermissionController extends Controller
{
    public function getList()
    {
        return v('permissions.list');
    }

    public function getData()
    {
        $data   =   Permission::with('group');

        $result = Datatables::of($data)
            ->addColumn('typename', function($permission) {
                return $permission->type=='public'?trans('g.public'):trans('g.private');
            })->addColumn('manage', function($permission) {
                return a('config/permission/del', 'id='.$permission->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/permission/del?id='.$permission->id)."')}})").'  '.a('config/permission/edit', 'id='.$permission->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        return $result->make(true);
    }

    public function getCreate()
    {
        return v('permissions.create');
    }

    public function postCreate(CreatePermissionRequest $request)
    {
        if (Permission::where('permission', $request->permission)->where('method', $request->input('method'))->count() == 0) {

            $data = new Permission();
            $data->name = $request->name;
            $data->permission = $request->permission;
            $data->method = $request->input('method');
            $data->type = $request->type;
            $data->created_at = Carbon::now();
            $data->save();
            if (!empty($request->groups)) {
                $data->group()->attach($request->groups);
            }
            set_notice(trans('permissions.add_success'), 'success');
        } else {
            set_notice(trans('permissions.already_exist'), 'danger');
        }
        return redirect()->back();
    }

    public function getDelete()
    {
        $data   =   Permission::find(request('id'));
        if(!empty($data)){
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else{
            set_notice(trans('system.not_exist'), 'danger');
        }
        return redirect()->back();
    }

    public function getEdit()
    {
        $data   =   Permission::find(request('id'));
        if(!empty($data)){
            return v('permissions.edit', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'danger');
        }
    }

    public function postEdit(CreatePermissionRequest $request)
    {
        $data   =   Permission::find(request('id'));
        if(!empty($data)){
            $data->name = $request->name;
            $data->permission = $request->permission;
            $data->method = $request->input('method');
            $data->type = $request->type;
            $data->save();
            if (!empty($request->groups)) {
                $data->group()->sync($request->groups);
            }
            set_notice(trans('permissions.edit_success'), 'success');
        }else{
            set_notice(trans('system.not_exist'), 'danger');
        }
        return redirect()->back();
    }
    public function getRoletable()
    {
        $data   =   new Permission();
        $data   =   $data->get();
        $arr    =   [];
        $groups  =   Group::pluck('id')->all();
        foreach($data as $item){
            $arr[$item->permission] =   !empty($arr[$item->permission])?$arr[$item->permission]:[];
            $arr[$item->permission][$item->method] = [
                'id'    =>  $item->id,
                'name' => $item->name,
                'data' => $item->type=='private'?$item->group()->pluck('groups.id')->all():$groups,
                'type'  =>  $item->type
            ];
        }
        return v('permissions.roletable', compact('arr'));
    }

    public function postAddGroupPermission()
    {
        $data   =   Permission::find(request()->input('route'));
        if(!empty($data)){
            $data->group()->toggle([request()->input('group')]);
            return response()->json([
                'code'  =>  0,
                'message'   =>  "Thay đổi trạng thái quyền thành công!"
            ]);
        }
    }
}