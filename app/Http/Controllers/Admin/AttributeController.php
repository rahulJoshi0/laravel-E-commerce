<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attribute =  Attribute::all();
        return view('admin.attribute.index',compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'status'=>'required',
            'is_variant'=>'required',
            // 'name_key'=>'required'
        ]);
        $name = $request->name_key ? $request->name_key : $request->name;
        $nameKey = generateUniqueNameKey($name);

        $data = $request->all();
        // dd($data);
        $attribute = Attribute::create([
            'name' => $request->name,       
            'status' => $request->status,
            'is_variant' => $request->is_variant,
            'name_key' => $nameKey,
        ]);
        $attr = $attribute->id;
        $_name = $request->attribute_name;
        $status = $request->attribute_status;
        $status = $request->attribute_status;

        // dd($Name);

        foreach($_name as $key=> $name ){
            $_status = $status[$key];
           $data =  AttributeValue::create([
                "name" => $name,
                "attribute_id" => $attr,
                "status" => $_status,
            ]);
        }
        // dd($data);

        if($request->save){
            return redirect()->route('attribute.index');
        }else{
            return redirect()->back();
        }
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
        $attribute = Attribute::find($id);
        return view('admin.attribute.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate ([
            'name'=>'required',
            'status'=>'required',
            'is_variant'=>'required',
        ]);
        // dd($data);
        $name = $request->name_key ? $request->name_key : $request->name;
        $data['nameKey'] = generateUniqueNameKey($name);
        $data = Attribute::where('id',$id)->update($data);
        $atrName = $request->attribute_name;
        $atrStatus = $request->attribute_status;
        $a_id = $request->aid;

        if(empty($a_id)){
            AttributeValue::where('attribute_id',$id)->delete();
        }else{
            AttributeValue::whereNotIn('id',$a_id)->where('attribute_id',$id)->delete();
        }

        foreach($atrName as $key=>$_name){
            $aid = $a_id[$key]??0;
            if($aid){
            AttributeValue::where('id',$aid)->update([
                'name'=>$_name,
                'status'=>$atrStatus[$key],
            ]);
        }else{
            AttributeValue::create([
                'name'=>$_name,
                'status'=>$atrStatus[$key],
                'attribute_id'=>$id
            ]);
        }
        }

        return redirect()->route('attribute.index')->withSuccess('data updated..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Attribute::where('id',$id)->delete();
        AttributeValue::where('attribute_id',$id)->delete();
        return redirect()->route('attribute.index')->withSucces('data deleted..');
    }
}
