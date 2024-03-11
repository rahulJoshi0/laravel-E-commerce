<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class ManagecustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('is_admin',0)->get();
        return view('admin.customer.index',compact('customers'));
    }
    
    public function show($id)
    {
        // $user = User::where('id',$id)->first();
        $orders= Order::where('user_id',$id)->get();
        // $orderaddress= OrderAddress::where('user_id',$id)->get();
        return view('admin.customer.show',compact('orders'));
    }
}
