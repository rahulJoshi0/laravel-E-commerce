<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Gate;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('page_create'),403);
        $_page = Page::all();
        return view('admin.page.create',compact('_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'heading'=>'required',
            'ordering'=>'required',
            'status'=>'required',
            // 'url_key'=>'required',
            'description'=>'required',
        ]);
    //    $data = $request->all();
    //    dd($data);
      $name = $request->url_key ? $request->url_key : $request->title;
      $urlKey = generateUniqueUrlKey($name);
        // dd($urlKey);

    //    $parent_id = $request->parent_id;
    //    $data['parent_id'] = $parent_id ? $parent_id : 0;
       $page = Page::create([
        'title' => $request->title,
            'heading' => $request->heading,
            'ordering' => $request->ordering,
            'status' => $request->status,
            'description' => $request->description,
            'url_key' => $urlKey,
            'parent_id' => $request->parent_id ?? 0
       ]);
       if($request->hasFile('image') && $request->file('image')->isValid()){
        $page->addMediaFromRequest('image')->toMediaCollection('image');

    }

       return redirect()->route('page.index')->withSuccess('Data Add Successfully');
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
        $page = Page::find($id);
        // $_page = Page::select('title')->);
        return view('admin.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $data = $request->all();
        // $data = $request->except('_method','_token');
        $data = $request->validate([
            'title'=>'required',
            'heading'=>'required',
            'ordering'=>'required',
            'status'=>'required',
            // 'url_key'=>'required',
            'description'=>'required',
        ]);
        // $title = preg_replace("/[^a-zA-Z]+/", "",$data["title"]);
        // $url_key = strtolower($title);
        // // dd($data);
        // $data['url_key'] = $url_key;
        $name = $request->url_key ? $request->url_key : $request->title;
        $data['urlKey'] = generateUniqueUrlKey($name);

        $parent_id = $request->parent_id;
        $data['parentId'] = $parent_id ? $parent_id : 0;
        $_page = Page::findOrFail($id);
        $_page->update($data);

        if($request->hasFile('image')){
            $_page->clearMediaCollection('image');
            $_page->addMedia($request->file('image'))->toMediaCollection('image');
           }
        return redirect()->route('page.index')->withSucess('data updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        $page->getFirstMediaUrl('id');
        return redirect()->route('page.index')->withSucess('data deleted');

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
