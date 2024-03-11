<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.ragister');
    }

    public function profile()
    {
       $userId = Auth::user()->id ?? null;
    //    dd($userId);
       if ($userId) {
        $orders = Order::where('user_id', $userId)->get();
        $billingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'billing')->get();
        $shippingAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'shipping')->get();
        // dd($orderAddress);
        $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();
       }
        return view('admin.customer.profile',compact('orders','billingAddress','shippingAddress','wishlists'));
    }

    public function update(request $request)
    {
        $auth = Auth::user();
        // dd($auth);
        if (!Hash::check($request->current_password, $auth->password)) {
            return back()->with('error',"current Password is Invalid");
        }
        if (strcmp($request->current_password, $request->password) == 0) {
            return redirect()->back()->with('error',"new password cannot be same as your current password");
        }

        $user = User::find($auth->id);
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back()->with('success',"Password changed Successfully");
    }
    
    public function store(request $request)
    {
        $customer = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'is_admin'=>0
        ]);
        if($customer)
        {
            return redirect()->route('customer.login');
        }else{
            
        }
    }

    public function login()
    {
        return view('admin.customer.login');
    }
    public function authenticate(request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'is_admin'=> 0])){
            $request->session()->regenerate();
            reActiveCart(Auth::user()->id);
            return redirect()->route('home')->withSuccess('You have successfully logged in');
        }
        return back()->with('error','your provided credentials do not match');
    }
    public function logout(){
        Session::forget('cart_id');
        Auth::logout();
        return redirect()->route('home');
        
    }
}
