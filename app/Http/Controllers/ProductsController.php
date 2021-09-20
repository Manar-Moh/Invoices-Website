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

    public function update(Request $request, products $products)
    {
        //
    }

    public function destroy(products $products)
    {
        //
    }
}
