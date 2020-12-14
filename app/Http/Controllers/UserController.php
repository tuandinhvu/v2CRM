<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\FormUserRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Namshi\JOSE\JWT;
use JWTAuth;

class UserController extends Controller
{
    public function getLogin()
    {
        return v('pages.login');
    }

    public function login($username, $password, $remember=false,$api=false)
    {
        $logins =   json_decode(settings('system_loginas', json_encode(['id'])), 'true');
        if(in_array('username',$logins))
            $loginUsername   =   auth()->attempt(['name'=>$username,'password'=>$password], $remember);
        if(in_array('email',$logins))
            $loginEmail  =   auth()->attempt(['email'=>$username,'password'=>$password], $remember);
        if(in_array('id',$logins))
            $loginId  =   auth()->attempt(['id'=>$username,'password'=>$password], $remember);
        if(!empty($loginEmail) || !empty($loginUsername) || !empty($loginId)){
            if($api==true){
                if(!empty($loginUsername))
                    return 'username';
                if(!empty($loginId))
                    return 'id';
                if(!empty($loginEmail))
                    return 'email';
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function postLogin(LoginRequest $request)
    {
        if($this->login($request->input('id'),$request->input('password'),$request->has('remember'))){
            event('event.login', []);
            return redirect()->to(asset('/'));
        } else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function getLogout()
    {
        auth()->logout();
        return redirect()->to(asset('/'));
    }
    public function getList() {
        return v('users.list');
    }
    public function dataList() {
        $data   =   User::with('group','branch');

        $result = Datatables::of($data)
            ->addColumn('group', function(User $user) {
                return $user->group->name;
            })->addColumn('branch', function(User $user) {
                return $user->branch->name;
            })->addColumn('manage', function($user) {
                return a('config/user/del', 'id='.$user->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('config/user/del?id='.$user->id)."')}})").'  '.a('config/user/edit', 'id='.$user->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);


        return $result->make(true);
    }

    public function getCreate()
     {
        return v('users.create');
    }

    public function postCreate(FormUserRequest $request)
    {
        $data   =   new User();
        $data->name   =   $request->name;
        $data->email    =   $request->email;
        $data->password =   Hash::make($request->password);
        $data->branch_id    =   $request->branch_id;
        $data->group_id =   $request->group_id;
        $data->created_at   =   Carbon::now();
        $data->save();
        set_notice(trans('users.add_success'), 'success');
        return redirect()->back();
    }
    public function getEdit()
    {
        $data   =   User::find(request('id'));
        if(!empty($data)){
            return v('users.edit', compact('data'));
        }else{
            set_notice(trans('system.not_exist'), 'warning');
            return redirect()->back();
        }
    }
    public function postEdit(EditUserRequest $request)
    {
        $data   =   User::find($request->id);
        if(!empty($data)){
            $data->name   =   $request->name;
            $data->email    =   $request->email;
            if($request->has('password'))
                $data->password =   Hash::make($request->password);
            $data->branch_id    =   $request->branch_id;
            $data->group_id =   $request->group_id;
            $data->save();
            set_notice(trans('system.edit_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   User::find(request('id'));
        if(!empty($data)){
            $data->delete();
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function apiLogin(LoginRequest $request)
    {
//        print_r($request->input());
        if($info = $this->login($request->input('id'),$request->input('password'),$request->has('remember'), true)){
            $api_token  =   str_random(60);
            User::where('id',auth()->user()->id)->update(['api_token'=>$api_token]);
            return response()->json(['status'=>'success', 'token'=>$api_token]);
        } else {
            return response()->json(['status'=>'wrong'],422);
        }
    }
}
