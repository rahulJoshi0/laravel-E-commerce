<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('admin.login.index');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $data = $request->only('email','password');
        // dd($data);
        if(Auth::attempt($data)){
            return redirect()->route('dashboard')->withSuccess('user login successfully');
        }else{
            return redirect()->route('login')->withSuccess('user not login');
            
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('logout');
    }
}
