<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('admin.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categorys = Category::all();
        $product = Product::all();
        return view('admin.category.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name'=>'required',
            'status'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'meta_tag'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required'
        ]);
        $data = $request->all();



        // $data = $request->all();
        // {{dd($data);}}
        // $category_parent_id = $request->category_parent_id;
        // $data['category_parent_id'] = $category_parent_id ?  $category_parent_id : 0;
        // dd($data);
        $name = $request->url_key ? $request->url_key : $request->name;
        $urlKey = generateUniqueUrlKey($name);

        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'show_in_menu' => $request->show_in_menu,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'url_key' => $urlKey,
            'meta_tag' => $request->meta_tag,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'category_parent_id' => $request->category_parent_id ?? 0
        ]);
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        if($request->hasFile('image') && $images = $request->file('image')){
            foreach($images as $image)

            $category->addMedia($image)->toMediaCollection('image');
        }

        if($request->has('products')){
            $category->products()->sync($request->input('products'));
        }
        if($request->save){
            return redirect()->route('category.index');
        } else {
            return redirect()->back();        }
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
        $products = Product::all();
        $category = Category::find($id);
        return view('admin.category.edit',compact('category','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =  $request->validate([
            'name'=>'required',
            'status'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'meta_tag'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required'
        ]);
        $name = $request->url_key ? $request->url_key : $request->name;
        $data['urlKey'] = generateUniqueUrlKey($name);
        $data = $request->all();
        $category = Category::findOrFail($id);
        $category->update($data);
       
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $category->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        if($request->hasFile('image') && $images = $request->file('image')){
            // foreach($images as $image)

            $category->clearMediaCollection('image');
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->has('products')){
            $category->products()->sync($request->input('products'));
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('category.index');
    }
}
