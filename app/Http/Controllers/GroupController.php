<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\FormGroupRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;

class GroupController extends Controller
{
    public function getList() {
        return v('config.groups');
    }
    public function dataList() {
        $data   =   Group::with('users');

        $result = Datatables::of($data)
            ->addColumn('count', function(Group $group) {
                return $group->users()->count();
            })->addColumn('manage', function($group) {
            return a('config/group/del', 'id='.$group->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/group/del?id='.$group->id)."')}})").'  '.a('config/group/edit', 'id='.$group->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
        })->rawColumns(['manage']);


        return $result->make(true);
    }

    public function getCreate()
    {
        return v('config.createGroup');
    }

    public function postCreate(FormGroupRequest $request)
    {
        $data   =   new Group();
        $data->name   =   $request->name;
        $data->created_at   =   Carbon::now();
        $data->save();
        set_notice(trans('groups.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   Group::find(request('id'));
        if(!empty($data)){
            return v('config.editGroup', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(FormGroupRequest $request)
    {
        $data   =   Group::find($request->id);
        if(!empty($data)){
            $data->name =   $request->name;
            $data->save();
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   Group::find(request('id'));
        if(!empty($data)){
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
}
