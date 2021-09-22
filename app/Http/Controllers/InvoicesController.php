<?php

namespace App\Http\Controllers;

use App\invoices;
use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{

    public function index()
    {
        return view('invoices.invoices');
    }

    public function create()
    {
        $sections = sections::all();
        return view('invoices.addinvoice',compact('sections'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(invoices $invoices)
    {
        //
    }

    public function edit(invoices $invoices)
    {
        //
    }

    public function update(Request $request, invoices $invoices)
    {
        //
    }

    public function destroy(invoices $invoices)
    {
        //
    }

    public function getProducts($id){

        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
    }
}
