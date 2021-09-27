<?php

namespace App\Http\Controllers;

use App\invoice_details;
use App\invoices;
use App\invoices_attachments;
use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    public function create()
    {
        $sections = sections::all();
        return view('invoices.addinvoice',compact('sections'));
    }

    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => date("Y-m-d",strtotime($request->invoice_Date)),
            'Due_date' => date("Y-m-d",strtotime($request->Due_date)),
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->CommissionAmount,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'status' => '3',
            'description' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;

        invoice_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => '3',
            'description' => $request->note,
            'User' => Auth::user()->name,
        ]);

        if($request->hasFile('attachmentfile')){

            $attachment = new invoices_attachments();
            $attachment->file_name = $request->file('attachmentfile')->getClientOriginalName();
            $attachment->invoice_number = $request->invoice_number;
            $attachment->Created_by = Auth::user()->name;
            $attachment->invoice_id = $invoice_id;
            $attachment->save();

            //Save File To Server
            $fileName = $request->file('attachmentfile')->getClientOriginalName();
            $request->file('attachmentfile')->move(public_path('Attachments/'.$request->invoice_number),$fileName);
        }

        session()->flash('success','Invoice Was Added Successfully');
        return back();
    }

    public function show($id)
    {
        $invoice = invoices::where('id',$id)->first();
        return view('invoices.change_paymentStatus',compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoice',compact('invoice','sections'));
    }

    public function update(Request $request)
    {
        $invoises = invoices::find($request->invoice_id1);
        $invoises->update([
            'invoice_Date' => date("Y-m-d",strtotime($request->invoice_Date)),
            'Due_date' => date("Y-m-d",strtotime($request->Due_date)),
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->CommissionAmount,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'description' => $request->note,
        ]);

        session()->flash('success_edit','Invoice Was Updated Successfully');
        return back();
    }

    public function destroy(Request $request)
    {
        /*** FOR DELETE FILES PERMANENTLY (FORCE DELETE) ***
        $attachments = invoices_attachments::where('invoice_id',$request->id)->first();
        if(!empty($attachments)){
            Storage::disk('attachments_upload')->deleteDirectory($attachments->invoice_number);
        }*/

        invoices::find($request->id)->delete();
        session()->flash('success_delete','Invoice Was Deleted Successfully');
        return redirect('/invoices');
    }

    public function getProducts($id){

        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
    }
}
