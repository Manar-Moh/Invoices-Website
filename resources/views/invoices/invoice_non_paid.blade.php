@extends('layouts.master')
@section('title','Non-Paid Invoices - InvoicesOrg')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
     <!--Internal   Notify -->
     <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Non-Paid Invoices</span>
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
                    </div>
                    <!-- end::Alerts -->

                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0 d-flex justify-content-end">
                                <div class="col-6 col-md-4 col-lg-2">
                                    <a class="modal-effect btn btn-primary-gradient btn-block" href="invoices/create">Add Invoice</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Invoice Number</th>
                                                <th class="border-bottom-0">Invoice Date</th>
                                                <th class="border-bottom-0">Due Date</th>
                                                <th class="border-bottom-0">Product</th>
                                                <th class="border-bottom-0">Section</th>
                                                <th class="border-bottom-0">Discount</th>
                                                <th class="border-bottom-0">Value VAT</th>
                                                <th class="border-bottom-0">Rate VAT</th>
                                                <th class="border-bottom-0">Total</th>
                                                <th class="border-bottom-0">Status</th>
                                                <th class="border-bottom-0">Note</th>
                                                <th class="border-bottom-0">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num = 0 ?>
                                            @foreach ($invoices as $d)
                                                 <?php $num++ ?>
                                                <tr>
                                                    <td>{{$num}}</td>
                                                    <td>{{$d->invoice_number}}</td>
                                                    <td>{{$d->invoice_Date}}</td>
                                                    <td>{{$d->Due_date}}</td>
                                                    <td>{{$d->product}}</td>
                                                    <td>{{$d->section->section_name}}</td>
                                                    <td>{{$d->Discount}}</td>
                                                    <td>{{$d->Value_VAT}}</td>
                                                    <td>{{$d->Rate_VAT}}%</td>
                                                    <td>{{$d->Total}}</td>
                                                    <td>
                                                        @if ($d->status == 1)
                                                            <span class="text-success">Paid</span>
                                                        @elseif ($d->status == 2)
                                                            <span class="text-warning">Partially Paid</span>
                                                        @elseif ($d->status == 3)
                                                            <span class="text-danger">Non Paid</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$d->description}}</td>
                                                    <td>
                                                        <a class="btn btn-outline-info btn-rounded btn-sm" href="{{url('invoiceDetails')}}/{{$d->id}}">Show Details<i class="las la-eye"></i>
                                                        </a>
                                                        <a class="btn btn-outline-info btn-rounded btn-sm" href="{{url('edit_invoice')}}/{{$d->id}}">Edit Invoice<i class="las la-pen"></i>
                                                        </a>
                                                        <a class="btn btn-outline-info btn-rounded btn-sm" href="{{url('payment_change')}}/{{$d->id}}">Change Payment Status<i class="las la-pen"></i>
                                                        </a>
                                                        <a class="btn btn-outline-info btn-rounded btn-sm"
                                                        data-invoice-id="{{$d->id}}" data-invoice-number="{{$d->invoice_number}}"
                                                        data-toggle="modal"
                                                        data-target="#modaldemo12"
                                                        href="#">Delete Invoice<i class="las la-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->

                     <!--  begin::Modal Delete -->
                     <div class="modal effect-slide-in-right" id="modaldemo12">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Invoice</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="invoices/destroy" method="Post" autocomplete="off">
                                   @method('delete')
                                    @csrf
                                    <div class="modal-body">
                                        <!--Invoice Number-->
                                        <p style="margin-bottom: 15px">Are You Sure You Want To Delete This Invoice ?</p>
                                        <input type="hidden" id="id" name="id" value="">
                                        <input type="text" name="invoice_number" id="invoice_number" class="form-control" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--  end::Modal Delete -->

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

    <!-- Delete Script-->
    <script>
        $('#modaldemo12').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('invoice-id')
                var invoice_number = button.data('invoice-number')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #invoice_number').val(invoice_number);
            })
    </script>

@endsection
