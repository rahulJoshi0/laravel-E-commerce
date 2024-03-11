<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishliststore(request $request)
    {
        // $data = $request->all();
        // dd($data);
        if (!Auth::user() == null) {
            $data = $request->all();
            if (Wishlist::where('product_id',$request->product_id)->where('user_id',$request->user_id)->exists()) {
                Wishlist::where('product_id',$request->product_id)->where('user_id',$request->user_id)->delete();
                return redirect()->back();
            } else {
                $wishlist = Wishlist::create($data);
                return redirect()->back()->with('success', 'Add to wishlist successfully.');
            }
        }
            return redirect()->route('customer.login');
    }
       public function wishlistdestroy($productId)
       {
        $product = Wishlist::where('product_id',$productId)->where('user_id',Auth::user()->id)->delete();
        if ($product) {
            return redirect()->route('wishlist.list')->with('success', 'Wishlist deleted successfully.');
        } else {
            return redirect()->back();
            // ->withErrors($validator)->withInput();
        }
       } 
    
       public function wishlistprofile()
       {
        $userId = Auth::user()->id;
        // $wishlists = Wishlist::all();
        $wishlists = Wishlist::where('user_id',$userId)->with('product')->get();
        // dd($wishlists);
        return view('admin.web.wishlist',compact('wishlists'));
       }
}
