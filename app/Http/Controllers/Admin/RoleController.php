<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Gate;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $role = Role::all();
    //    $_permission = Permission::all();
       return view('admin.role.index',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('role_create'),403);

        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required'
        ]);
        // dd($data);
       $_role =  Role::create($data);
       $_role->syncpermissions($request->input('permissions'));

        return redirect()->route('role.index')->withSuccess('data add successfully');
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
        $_role = Role::find($id);
        $permissions = Permission::select('name')->get();
        $permissionName = $_role->permissions->pluck('name')->toArray();
        return view('admin.role.edit',compact('_role','permissions','permissionName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //    $data =  $request->validate([
    //         'name'=>'required'
    //     ]);
    //    $roles =  Role::where('id',$id)->update($data);
    //     // $roles = Permission::findOrFail($id);
    //    if($request->has('permissions')){
    //     $roles->syncPermissions($request->permissions);
    //    }
        $roles = Role::findOrFail($id);
        $roles->update([
           'name'=> $request->name,
        ]);
        if($request->has('permissions')){
            $roles->syncPermissions($request->permissions);
        }
        return redirect()->route('role.index')->withSuccess('data update successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();

        return redirect()->route('role.index')->withSuccess('data deleted');

    }
}
