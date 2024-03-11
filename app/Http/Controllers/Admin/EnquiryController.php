<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiry = Enquiry::all();
        return view('admin.enquiry',compact('enquiry'));
    }
    public function store(request $request)
    {
        $data = $request->all();
        $enq = Enquiry::create($data);
       return back()->withSuccess('data Add successfully..');

    }
}
