<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_attachments;
use App\InvoicesArchieve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesArchieveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_archieve',compact('invoices'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(InvoicesArchieve $invoicesArchieve)
    {
        //
    }

    public function edit(InvoicesArchieve $invoicesArchieve)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;
        Invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('success','Invoice Was Restored Successfully');
        return redirect('/invoicesArchieve');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoice_number = $request->invoice_number;
        $attachments = invoices_attachments::where('invoice_number',$invoice_number)->first();
        if(!empty($attachments)){
            Storage::disk('attachments_upload')->deleteDirectory($invoice_number);
        }
        $invoice = invoices::withTrashed()->where('id',$id)->first();
        $invoice->forceDelete();
        session()->flash('success','Invoice Was Deleted Successfully');

        return redirect('/invoicesArchieve');
    }
}
