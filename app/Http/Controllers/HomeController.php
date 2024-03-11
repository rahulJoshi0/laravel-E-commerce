<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\block;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        $block = Block::all();
        return view('admin.web.index',compact('slider','block'));
    }
    public function  page($urlKey){
       $pages = Page::where('url_key',$urlKey)->first();
        return view('admin.web.page',compact('pages'));
    }
    // public function  product($urlKey){
    //     $products = Product::where('url_key',$urlKey)->first();
    //      return view('admin.web.product',compact('products'));
    //     //  dd($products);
    //  }
    public function categories($url_key){
        $categori = Category::where('url_key',$url_key)->first();
        return view('admin.web.category',compact('categori'));
    }

    public function product($url_key)
    {
        $products = Product::where('url_key', $url_key)->where('status',1)->first();
        $productAttributes = ProductAttribute::where('product_id', $products->id)->get();
        $attributes = [];
            foreach ($productAttributes as $productAttribute) {
                $attributeId = $productAttribute->attribute_id;
                $attributeValueId = $productAttribute->attribute_value_id;
                $attribute = Attribute::find($attributeId);
                $attributeValue = AttributeValue::find($attributeValueId);
                
                if ($attribute && $attributeValue) {
                    if (!isset($attributes[$attribute->name])) {
                        $attributes[$attribute->name] = [];
                    }
                    $attributes[$attribute->name][] = $attributeValue;
                }
            }
        return view('admin.web.product', compact('products', 'attributes'));
    }
}