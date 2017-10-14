<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBranchRequest;
use Illuminate\Http\Request;
use App\Branch;
use App\Http\Requests\FormGroupRequest;
use Carbon\Carbon;
use \DataTables;
class BranchController extends Controller
{
    public function getList() {
        return v('config.branches');
    }
    public function dataList() {
        $data   =   Branch::with('users');

        $result = Datatables::of($data)
            ->addColumn('count', function(Branch $branch) {
                return $branch->users()->count();
            })->addColumn('manage', function($branch) {
                return a('config/branch/del', 'id='.$branch->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/branch/del?id='.$branch->id)."')}})").'  '.a('config/branch/edit', 'id='.$branch->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);


        return $result->make(true);
    }

    public function getCreate()
    {
        return v('config.createBranch');
    }

    public function postCreate(CreateBranchRequest $request)
    {
        $data   =   new Branch();
        $data->name   =   $request->name;
        $data->is_head  =   $request->has('is_head')?1:0;
        $data->created_at   =   Carbon::now();
        $data->save();
        set_notice(trans('branches.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   Branch::find(request('id'));
        if(!empty($data)){
            return v('config.editBranch', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(FormGroupRequest $request)
    {
        $data   =   Branch::find($request->id);
        if(!empty($data)){
            $data->name =   $request->name;
            $data->is_head  =   $request->has('is_head')?1:0;
            $data->save();
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   Branch::find(request('id'));
        if(!empty($data)){
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
}
