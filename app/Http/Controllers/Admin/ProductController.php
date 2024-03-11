<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $products = Product::all();
        return view('admin.product.create',compact('category','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
            'name'=>'required',
            'status'=>'required',
            'is_featured'=>'required',
            'sku'=>'required',
            'qty'=>'required',
            'stock_status'=>'required',
            'weight'=>'required',
            'price'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'related_product'=>'nullable|array',
            'meta_tag'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required'
        ]);


        $data = $request->all();
        $name = $request->url_key ? $request->url_key : $request->name;
        $data['url_key'] = generateUniqueUrlKey($name);
        // {{dd($data);}}
        $data['related_product'] = implode(', ', $data['related_product'] ?? []);
        $product =  Product::create($data);
        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        if($request->hasFile('image') && $images = $request->file('image')){
            foreach($images as $image)

            $product->addMedia($image)->toMediaCollection('image');
        }
        if($request->has('categories')){
            $product->categories()->sync($request->input('categories'));
        }

        $attribute = $request->input('attribute',[]);
        $value = $request->input('value',[]);
        foreach($attribute as $key=> $atr){
            foreach($value[$atr] as $key=> $value_id){
                $data = [
                    'product_id' => $product->id,
                    'attribute_id'=> $atr,
                    'attribute_value_id'=>$value_id,
                ];
                ProductAttribute::create($data);
            }
        }

        return redirect()->route('product.index');
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
        $product = Product::find($id);
        $categories = Category::all();
        $relatedPdr = Product::all();
        $pro_Attr_Value = ProductAttribute::where('product_id',$id)->pluck('attribute_value_id')->toArray();
        return view('admin.product.edit',compact('product','categories','relatedPdr','pro_Attr_Value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'is_featured'=>'required',
            'sku'=>'required',
            'qty'=>'required',
            'stock_status'=>'required',
            'weight'=>'required',
            'price'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'related_product'=>'nullable|array',
            'meta_tag'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required'
        ]);
        // Product::where('id',$id)->update($data);
        $data = $request->all();
        $name = $request->url_key ? $request->url_key : $request->name;
        $data['url_key'] = generateUniqueUrlKey($name);
        $data['related_product'] = implode(', ', $data['related_product'] ?? []);

        $product = Product::findOrFail($id);
        $product->update($data);

        if($request->hasFile('thumbnail_image') && $request->file('thumbnail_image')->isValid()){
            $product->addMediaFromRequest('thumbnail_image')->toMediaCollection('thumbnail_image');
        }

        if($request->hasFile('image') && $images = $request->file('image')){
            foreach($images as $image)

            $product->addMedia($image)->toMediaCollection('image');
        }
        if($request->has('categories')){
            $product->categories()->sync($request->input('categories'));
        }
        $attribute = $request->input('attribute',[]);
        $value = $request->input('value',[]);
        ProductAttribute::where('product_id',$product->id)->delete();
        foreach($attribute as $key=> $atr){
            foreach($value[$atr] as $key=> $value_id){
                $data = [
                    'product_id' => $product->id,
                    'attribute_id'=> $atr,
                    'attribute_value_id'=>$value_id,
                ];
                ProductAttribute::create($data);
            }
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('product.index')->withSuccess('data deleted...');
    }
}
