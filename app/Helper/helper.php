<?php
use App\Models\Page;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\QuoteItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Product::where('url_key', $urlKey)->exists();
    }
}
if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Page::where('url_key', $urlKey)->exists();
    }
}

if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Category::where('url_key', $urlKey)->exists();
    }
}

if (!function_exists('generateUniqueNameKey')) {
    function generateUniqueNameKey($name)
    {
        $baseSlug = Str::slug($name);
        $nameKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($nameKey)) {
            $nameKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $nameKey;
    }
}

if (!function_exists('nameKeyExists')) {
    function nameKeyExists($nameKey)
    {
        // Assuming Product is your model name
        return \App\Models\Attribute::where('url_key', $nameKey)->exists();
    }
}




function getMenuPage()
{
    $pages = Page::where('parent_id', 0)->get();
    return $pages;
}

function getPage($id)
{
    $page = page::where('parent_id', $id)->get();
    return $page;
}

function getCatgory()
{
    $category = Category::where('category_parent_id', 0)->get();
    return $category;
}
function getSubCategory($id)
{
    $_category = Category::where('category_parent_id', $id)->get();
    return $_category;
}
function getSubSubCategory($id)
{
    $categorys = Category::where('category_parent_id', $id)->get();
    return $categorys;
}

function getCategory()
{
    $categories = Category::where('category_parent_id',0)->get();
    return $categories;
}

function getProduct()
{
    $products = Product::all();
    return $products;
}
function getattribute()
{
    $attributes = Attribute::with('attribute_value')->get();
    return $attributes;
}

function getProductPrice($pId)
{

    $todayDate = Carbon\Carbon::now();

    $product = Product::find($pId);

    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
    // echo $mytime->toDateTimeString();
}

function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return($quote->quoteItems ?? 0) ? $quote->quoteItems->count() : 0;
    } else {
        return 0;
    }
}

function wishlastcount()
{
   $userId = Auth::user()->id ?? 0;
   $wishId = Wishlist::where('user_id',$userId)->get();
   $wistlistcount = $wishId->count();
   return $wistlistcount;
}

// recalculateCart helper

function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();
    $quotesItems = $quote->quoteItems;

    foreach ($quotesItems as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
        // echo $item;
    }


    $quote->subtotal = $quote->quoteItems->sum('row_total');
    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon = null;
        $quote->discount_coupon = 0;
    }
    $quote->save();
}

// get product image for view cart page

function productImage($pId)
{
    $product = Product::find($pId);
    return $product->getFirstMediaUrl('thumbnail_image');
}

function getProductSpecialPrice($pId)
{
    $todayDate = Carbon\Carbon::now();
    $product = Product::find($pId);
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate)) {
        ?>
        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
            ₹
            <?= $product->special_price ?>
        </h3>
        <h4 class="font-weight-semi-bold mb-4"><del>₹
                <?= $product->price ?>
            </del></h4>
        <?php

    } else {
        // return $product->price;
        ?>
        <h4 class="font-weight-semi-bold mb-4">₹
            <?= $product->price ?>
        </h4>
        <?php
    }
    return;
}
function successOrder()
{
    $order = Order::orderby('id','desc')->first();
    return $order;
}
// =============================================

function getRelatedProduct($pIds){
    $pId = explode(',',$pIds);
        $relatedproduct = Product::whereIn('id',$pId)->get();
        return $relatedproduct;
    }
// ===================================================
function reActiveCart($userId) {
    $cartId = Session::get('cart_id');
 

    if($cartId) {
        Quote::where('cart_id', $cartId)->update([
            'user_id' => $userId
        ]);
    }
  
    if($cartId) {
        $quoteOld = Quote::where('user_id', $userId)->where('cart_id', '!=', $cartId)->first();
        
        if($quoteOld) {
            $newQuote = Quote::where('cart_id', $cartId)->first();
            // dd($newQuote);
            $quoteId = $newQuote->id??0;
            QuoteItem::where('quote_id', $quoteOld->id)->update(['quote_id' => $quoteId]);
            $quoteOld->delete();
        } 
        

    } else {
        $quote = Quote::where('user_id', $userId)->first();
        // dd($quote);
        if ($quote) {
            $cartId = $quote->cart_id;
            Session::put('cart_id', $cartId);
        }
    }


}
?>