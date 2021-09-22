<?php

namespace App\Http\Controllers;

use App\products;
use App\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.products',compact('sections','products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => ['required', 'unique:products', 'max:255']
        ]);
        products::create([
            'product_name' => $request->product_name,
            'description' => $request->product_desc,
            'section_id' => $request->section_id,
        ]);
        session()->flash('success','Product Was Added Successfully');
        return redirect('/products');
    }

    public function show(products $products)
    {
        //
    }

    public function edit(products $products)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'product_name' => ['required', 'unique:products,product_name,'.$id, 'max:255']
        ]);
        $products_arr = products::find($id);
        $products_arr->update([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->product_desc
        ]);
        session()->flash('success_edit','Product Was Updated Successfully');
        return redirect('/products');
    }

    public function destroy(Request $request)
    {

        $id = $request->id;
        products::find($id)->delete();
        session()->flash('success_delete','Product Was Deleted Successfully');
        return redirect('/products');

    }
}
