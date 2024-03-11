<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Http\JsonResponse;


class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $block = Block::all();
        return view('admin.block.index',compact('block'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.block.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','_method');
        $block = Block::create($data);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $block->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('block.index')->withSuccess('data add successs');
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
        $blocks = Block::find($id);
        return view('admin.block.edit',compact('blocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token','_method');
        // dd($data);
        // $block = Block::where('id',$id)->update($data);
        $_block = Block::findOrFail($id);
        $_block->update($data);
        if($request->hasFile('image')){
            $_block->clearMediaCollection('image');
            $_block->addMedia($request->file('image'))->toMediaCollection('image');
           }
        return redirect()->route('block.index')->withSuccess('data updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $block = Block::findOrFail($id);
        $block->delete();
        $block->getFirstMediaUrl('id');
        return redirect()->route('block.index')->withSuccess('data deleted');

    }
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('media'), $fileName);
      
            $url = asset('media/' . $fileName);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
