@extends('layouts.master')
@section('title','Invoice Details - InvoicesOrg')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice Details</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        <div class="row">
            <!--div-->

             <!-- begin::Alerts -->
             <div class="col">
                @if (session()->has('success_delete'))
                    <script>
                        window.onload = function(){
                            notif({
                                msg: '{{session()->get('success_delete')}}',
                                type: "error"
                            });
                        }
                    </script>
                @elseif (session()->has('success'))
                    <script>
                        window.onload = function(){
                            notif({
                                msg: '{{session()->get('success')}}',
                                type: "success"
                            });
                        }
                    </script>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <script>
                            window.onload = function(){
                                notif({
                                    msg: '{{$error}}',
                                    type: "error"
                                });
                            }
                        </script>
                    @endforeach
                @endif
            </div>
            <!-- end::Alerts -->

            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab4" class="nav-link active" data-toggle="tab">Invoice Details</a></li>
                                        <li><a href="#tab5" class="nav-link" data-toggle="tab">Payment status</a></li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">Attachments</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">

                                    <!-- Invoice -->
                                    <div class="tab-pane active" id="tab4">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>

                                                    <!-- 1 -->
                                                    <tr>
                                                        <th scope="row">Invoice Number</th>
                                                        <td>{{ $invoice->invoice_number }}</td>
                                                        <th scope="row">Release Date</th>
                                                        <td>{{ $invoice->invoice_Date }}</td>
                                                        <th scope="row">Due Date</th>
                                                        <td>{{ $invoice->Due_date }}</td>
                                                        <th scope="row">Section</th>
                                                        <td>{{ $invoice->section->section_name}}</td>
                                                    </tr>

                                                    <!-- 2 -->
                                                    <tr>
                                                        <th scope="row">Product</th>
                                                        <td>{{ $invoice->product }}</td>
                                                        <th scope="row">Collection Amount</th>
                                                        <td>{{ $invoice->Amount_collection }}</td>
                                                        <th scope="row">Commission Amount</th>
                                                        <td>{{ $invoice->Amount_Commission }}</td>
                                                        <th scope="row">Discount</th>
                                                        <td>{{ $invoice->Discount }}</td>
                                                    </tr>

                                                    <!-- 3 -->
                                                    <tr>
                                                        <th scope="row">Rate VAT</th>
                                                        <td>{{ $invoice->Rate_VAT }}%</td>
                                                        <th scope="row">Value VAT</th>
                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                        <th scope="row">Total With Tax</th>
                                                        <td>{{ $invoice->Total }}</td>
                                                        <th scope="row">Current Status</th>

                                                        @if ($invoice->status == 1)
                                                            <td>
                                                                <span class="badge badge-pill badge-success p-2">
                                                                    Paid
                                                                </span>
                                                            </td>
                                                        @elseif($invoice->status == 3)
                                                            <td>
                                                                <span class="badge badge-pill badge-danger p-2">
                                                                    Non Paid
                                                                </span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge badge-pill badge-warning p-2">
                                                                    Partially Paid
                                                                </span>
                                                            </td>
                                                        @endif
                                                    </tr>

                                                    <!-- 4 -->
                                                    <tr>
                                                        <th scope="row">Notes</th>
                                                        <td>{{ $invoice->description }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Invoice Details -->
                                    <div class="tab-pane" id="tab5">
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>Invoice Number</th>
                                                        <th>Product</th>
                                                        <th>Section</th>
                                                        <th>Payment Status</th>
                                                        <th>Payment Date </th>
                                                        <th>Notes</th>
                                                        <th>Release Date</th>
                                                        <th>User</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($details as $x)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $x->invoice_number }}</td>
                                                            <td>{{ $x->product }}</td>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                            @if ($x->status == 1)
                                                            <td>
                                                                <span class="badge badge-pill badge-success p-2">
                                                                    Paid
                                                                </span>
                                                            </td>
                                                        @elseif($x->status == 3)
                                                            <td>
                                                                <span class="badge badge-pill badge-danger p-2">
                                                                    Non Paid
                                                                </span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge badge-pill badge-warning p-2">
                                                                    Partially Paid
                                                                </span>
                                                            </td>
                                                        @endif
                                                            <td>{{ $x->Payment_Date }}</td>
                                                            <td>{{ $x->description }}</td>
                                                            <td>{{ $x->created_at }}</td>
                                                            <td>{{ $x->User }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Invoice Attachments-->
                                    <div class="tab-pane" id="tab6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-danger">* Attachment Format : pdf, jpeg, jpg, png </p>
                                                <form method="post" action="{{ url('invoiceAttachments') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="file_name" required>
                                                        <label class="custom-file-label" for="customFile" style="height: 55px">Browse Attachment</label>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                            value="{{ $invoice->invoice_number }}">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-4" name="uploadedFile">Add Attachment</button>
                                                </form>
                                            </div>
                                         <br>
                                        </div>
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th scope="col">#</th>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Created By</th>
                                                        <th scope="col">Creation Date</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($attachments as $attachment)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $attachment->file_name }}</td>
                                                            <td>{{ $attachment->Created_by }}</td>
                                                            <td>{{ $attachment->created_at }}</td>
                                                            <td colspan="2">

                                                                <a class="btn btn-outline-success btn-sm"
                                                                href="{{ url('view_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                View</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                role="button"><i
                                                                    class="fas fa-download"></i>&nbsp;
                                                                Download</a>

                                                                <button class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-file_name="{{ $attachment->file_name }}"
                                                                data-invoice_number="{{ $attachment->invoice_number }}"
                                                                data-id_file="{{ $attachment->id }}"
                                                                data-target="#delete_file"><i
                                                                class="fas fa-trash"></i>&nbsp; Delete</button>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- row closed -->

        <!-- delete -->
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ٍDelete Attachment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('delete_file')}}" method="Post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red">Are You Sure You Want To Delete This Attachment ?</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="text" name="file_name" id="file_name" value="" readonly class="text-muted form-control">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
