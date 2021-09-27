<?php

namespace App\Http\Controllers;

use App\invoice_details;
use App\invoices;
use App\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class InvoiceDetailsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $invoises = invoices::find($request->invoice_id);
        if($request->status == 1){
            $invoises->update([
                'status' => $request->status,
                'Payment_Date' => date("Y-m-d",strtotime($request->Payment_Date))
            ]);
            invoice_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => '1',
                'description' => $request->note,
                'User' => Auth::user()->name,
                'Payment_Date' => date("Y-m-d",strtotime($request->Payment_Date))
            ]);
        }
        elseif($request->status == 2){
            $invoises->update([
                'status' => $request->status,
                'Payment_Date' => date("Y-m-d",strtotime($request->Payment_Date))
            ]);
            invoice_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => '2',
                'description' => $request->note,
                'User' => Auth::user()->name,
                'Payment_Date' => date("Y-m-d",strtotime($request->Payment_Date))
            ]);
        }

        session()->flash('success','Payment Status Was Updated Successfully');
        return redirect('/invoices');
    }

    public function show(invoice_details $invoice_details)
    {
        //
    }

    public function edit($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $details = invoice_details::where('id_Invoice',$id)->get();
        $attachments = invoices_attachments::where('invoice_id',$id)->get();
        return view('invoices.invoiceDetails',compact('invoice','details','attachments'));
    }

    public function update(Request $request, invoice_details $invoice_details)
    {
        //
    }

    public function destroy(Request $request)
    {

        invoices_attachments::find($request->id_file)->delete();
        Storage::disk('attachments_upload')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('success_delete','Attachment Was Deleted Successfully');
        return back();
    }

    public function viewFile($invoice_number,$file_name)
    {
        $path = public_path().'/Attachments/'.$invoice_number.'/'.$file_name;
        return response()->file($path);
    }

    public function downloadFile($invoice_number,$file_name)
    {
        $path = public_path().'/Attachments/'.$invoice_number.'/'.$file_name;
        return response()->download($path);
    }

}
