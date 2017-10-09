<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLogin()
    {
        return v('pages.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $logins =   json_decode(settings('loginas', json_encode(['id'])), 'true');
        if(in_array('username',$logins))
            $loginUsername   =   auth()->attempt(['name'=>$request->input('id'),'password'=>$request->input('password')], $request->has('remember'));
        if(in_array('email',$logins))
            $loginEmail  =   auth()->attempt(['email'=>$request->input('id'),'password'=>$request->input('password')], $request->has('remember'));
        if(in_array('id',$logins))
            $loginId  =   auth()->attempt(['id'=>$request->input('id'),'password'=>$request->input('password')], $request->has('remember'));
        if(!empty($loginEmail) || !empty($loginUsername) || !empty($loginId)){
            return redirect()->to(asset('/'));
        } else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }
}
