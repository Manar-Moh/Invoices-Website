<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesArchieveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_archieve',compact('invoices'));
    }

    public function destroy($id)
    {
        $attachments = invoices_attachments::where('invoice_id',$id)->first();
        if(!empty($attachments)){
            Storage::disk('attachments_upload')->deleteDirectory($attachments->invoice_number);
        }
        $invoice = invoices::find($id)->first();
        $invoice->forceDelete();
        session()->flash('success_delete','Invoice Was Deleted Successfully');

        return redirect('/invoicesArchieve');
    }

}
