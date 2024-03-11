<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Gate;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::all();
        return view('admin.permission.index',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('permission_create'),403);

        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required'
        ]);
        // $data = $request->all();
        // dd($data);
        Permission::create($data);

        return redirect()->route('permission.create')->withSuccess('data add success');
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
        $_permission = Permission::find($id);
        return view('admin.permission.edit',compact('_permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name'=>'required'
        ]);
        // dd($data);
        Permission::where('id',$id)->update($data);

        return redirect()->route('permission.index')->withSuccess('data updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::where('id',$id)->delete(); 
        return redirect()->route('permission.index')->withSuccess('data deleted');
    }
}
