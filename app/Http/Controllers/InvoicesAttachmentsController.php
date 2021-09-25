<?php

namespace App\Http\Controllers;

use App\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentsController extends Controller
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
        $validatedData = $request->validate([
            'file_name' => ['mimes:png,jpg,pdf,jpeg'],
        ]);

        if($request->hasFile('file_name')){

            $attachment = new invoices_attachments();
            $attachment->file_name = $request->file('file_name')->getClientOriginalName();
            $attachment->invoice_number = $request->invoice_number;
            $attachment->Created_by = Auth::user()->name;
            $attachment->invoice_id = $request->invoice_id;
            $attachment->save();

            //Save File To Server
            $fileName = $request->file('file_name')->getClientOriginalName();
            $request->file('file_name')->move(public_path('Attachments/'.$request->invoice_number),$fileName);
        }

        session()->flash('success','Attachment Was Added Successfully');
        return back();
    }

    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
