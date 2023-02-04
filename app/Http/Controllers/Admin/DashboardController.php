<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController
{
    public function home(){
        return view('admin.dashboard');
    }
    public function getLogin()
    {
        return view('admin.login');
    }

    public function login(){
        return view('admin.login-server.login');
    }

    public function postLogin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])){
            return \redirect('/backend/user');
        }else{
            return Redirect::to('/')->withInput()->withErrors("Email hoac pass sai");
        }
    }
    public function Logout(){
        if (Auth::logout()){
            return \redirect('/login');
        }
        return \redirect('/');
    }
}
