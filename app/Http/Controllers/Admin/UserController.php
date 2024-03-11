<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('is_admin',1)->get();
        return view('admin.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('name')->get();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);
       $data =  $request->all();
    //    dd($data);
       $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        'is_admin'=>1
       ]);
       $user->syncRoles($request->input('roles'));
       
       return redirect()->route('user.index')->withSuccess('data add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $_user = User::find($id);
        $roles = Role::select('name')->get();
        $roleName = $_user->roles->pluck('name')->toArray();
        return view('admin.user.edit',compact('_user','roles','roleName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $password = $request->password;
        if(!$password){
            $data = $request->validate([
                'name'=>'required',
                'email'=> 'required'
            ]);
            User::where('id',$id)->update($data);
        }else{
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);
    //   $data = ([ $_name = $request->name,
    //     $_email = $request->email,
    //     $_password = $request->password,
    //     $_con_pass = $request->confirm_password]);

        User::where('id',$id)->update([
             'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            // 'confirm_password' => $request->confirm_password
        ]);
        $users = User::findOrFail($id);
        $users->syncRoles($request->input('roles'));
    }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('user.index')->withSuccess('data deleted');
    }
}
