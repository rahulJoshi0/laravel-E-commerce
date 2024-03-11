<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->all();
        // dd($data);
       $slider = Slider::create($data);
       if($request->hasFile('image') && $request->file('image')->isValid()){
        $slider->addMediaFromRequest('image')->toMediaCollection('image');
       }
       return redirect()->route('slider.index')->withSuccess('data Add successfully..');
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
        $sliderData = Slider::find($id);
        return view('admin.slider.edit',compact('sliderData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ([$_title = $request->title,
                  $_order = $request->ordering,
                  $_status = $request->status
                 ]);
        $_slider = Slider::findOrFail($id);
        $_slider->update([
                'title'=>$_title,
                'ordering'=>$_order,
                'status'=>$_status

        ]);
        if($request->hasFile('image')){
            $_slider->clearMediaCollection('image');
            $_slider->addMedia($request->file('image'))->toMediaCollection('image');
           }
     
       
        return redirect()->route('slider.index')->withsuccess('data updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        $slider->getFirstMediaUrl('id');
        return redirect()->route('slider.index')->withSucess('data deleted');
    }
}
