@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    Payment Status - InvoicesOrg
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Change Payment Status
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('invoiceDetails.store')}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <label for="invoice_number" class="control-label">Invoice Number</label>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" title="Please Enter Invoice Number"
                                value="{{ $invoice->invoice_number }}" readonly>
                            </div>

                            <div class="col">
                                <label>Invoice Date</label>
                                <input class="form-control" name="invoice_Date"
                                type="text" value="{{ $invoice->invoice_Date }}" readonly >
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control" name="Due_date"
                                    type="text" value="{{ $invoice->Due_date }}" readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row pt-2">
                            <div class="col">
                                <label for="Section" class="control-label">Section</label>
                                <select name="Section" id="Section" class="form-control">
                                    <!--placeholder-->
                                    <option value="{{ $invoice->section_id }}" selected>{{ $invoice->section->section_name }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="product" class="control-label">Product</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}" selected>{{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="Amount_collection" class="control-label">Collection Amount</label>
                                <input type="text" class="form-control" id="Amount_collection" name="Amount_collection" value="{{ $invoice->Amount_collection }}" readonly>
                            </div>
                        </div>

                        {{-- 3 --}}

                        <div class="row pt-2">

                            <div class="col">
                                <label for="CommissionAmount" class="control-label">Commission Amount</label>
                                <input type="text" class="form-control form-control-lg" id="CommissionAmount"
                                    name="CommissionAmount" title="Please Enter Commission Amount"
                                    value="{{ $invoice->Amount_Commission }}" readonly>
                            </div>

                            <div class="col">
                                <label for="Discount" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="Please Enter Discount"
                                    value="{{ $invoice->Discount }}" readonly>
                            </div>

                            <div class="col">
                                <label for="Rate_VAT" class="control-label">Rate VAT</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" >
                                    <!--placeholder-->
                                    <option value="{{$invoice->Rate_VAT}}" selected >{{$invoice->Rate_VAT}}%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row pt-2">
                            <div class="col">
                                <label for="Value_VAT" class="control-label">Value VAT</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" value="{{$invoice->Value_VAT}}" readonly>
                            </div>

                            <div class="col">
                                <label for="Total" class="control-label">Total With Tax</label>
                                <input type="text" class="form-control" id="Total" name="Total" value="{{$invoice->Total}}" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row pt-2">
                            <div class="col">
                                <label for="note">Notes</label>
                                <textarea class="form-control" id="note" name="note" rows="3" readonly>
                                    {{$invoice->description}}</textarea>
                            </div>
                        </div>

                        <div class="row pt-2">
                            <div class="col">
                                <label for="status" class="control-label">Status</label>
                                <select name="status" id="status" class="form-control" >
                                    <!--placeholder-->
                                    <option value="" selected disabled>--Select Payment Status--</option>
                                    <option value="1" >Paid</option>
                                    <option value="2" >Partially Paid</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="Payment_Date" class="control-label">Payment Date</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" id="Payment_Date" value="{{ date('d-m-Y') }}" placeholder="YYYY-MM-DD"
                                type="text" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">Update Payment Status</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        }).val();
    </script>

@endsection

