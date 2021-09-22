@extends('layouts.master')
@section('title','Products - InvoicesOrg')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <!-- begin::Alerts -->
                    <div class="col">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                                <span class="alert-inner--text">
                                    <strong>
                                        {{session()->get('success')}}
                                    </strong>
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif (session()->has('success_edit'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                                <span class="alert-inner--text">
                                    <strong>
                                        {{session()->get('success_edit')}}
                                    </strong>
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif (session()->has('success_delete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                                <span class="alert-inner--text">
                                    <strong>
                                        {{session()->get('success_delete')}}
                                    </strong>
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    <strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </strong>
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- end::Alerts -->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0 d-flex justify-content-end">
                                <div class="col-6 col-md-4 col-lg-2">
                                    <a class="modal-effect btn btn-primary-gradient btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8">Add Product</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Product Name</th>
                                                <th class="border-bottom-0">Section Name</th>
                                                <th class="border-bottom-0">Description</th>
                                                <th class="border-bottom-0">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num = 0 ?>
                                            @foreach ($products as $d)
                                                 <?php $num++ ?>
                                                <tr>
                                                    <td>{{$num}}</td>
                                                    <td>{{$d->product_name}}</td>
                                                    <td>{{$d->section->section_name}}</td>
                                                    <td>{{$d->description}}</td>
                                                    <td>
                                                        <a class="modal-effect btn btn-outline-info"
                                                        data-id="{{$d->id}}"
                                                        data-product-name="{{$d->product_name}}" data-desc="{{$d->description}}"  data-section-name="{{$d->section_id}}" data-effect="effect-rotate-bottom" data-toggle="modal" href="#modaldemo9"><i class="las la-pen"></i>
                                                        </a>

                                                        <a class="modal-effect btn btn-outline-danger" data-id="{{$d->id}}"
                                                        data-product-name="{{$d->product_name}}" data-desc="{{$d->description}}"  data-section-name="{{$d->section->section_name}}" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo12"><i
                                                        class="las la-trash"></i>
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

                    <!--  begin::Modal Add -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Add Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('products.store') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <!--Add Product Name-->
                                        <div class="form-group">
                                            <label for="section_name">Name</label>
                                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                                        </div>
                                        <!--Select Section Name-->
                                        <label for="section_id">Section Name</label>
                                        <select name="section_id" id="section_id" class="form-control mb-3">
                                            <option value="" selected disabled>-- Select Section --</option>
                                            @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{$section->section_name}}</option>
                                            @endforeach
                                        </select>
                                        <!--Add Product Description-->
                                        <div class="form-group">
                                            <label for="section_name">Description</label>
                                            <textarea name="product_desc" id="product_desc" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--  end::Modal Add -->

                    <!--  begin::Modal Edit -->
                    <div class="modal fade" id="modaldemo9">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Edit Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="products/update" method="post" autocomplete="off">
                                    @method('patch');
                                    @csrf
                                    <div class="modal-body">
                                        <!--Add Product Name-->
                                        <div class="form-group">
                                            <input type="hidden" id="id" name="id" value="">
                                            <label for="product_name">Name</label>
                                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                                        </div>
                                        <!--Select Section Name-->
                                        <label for="section_id">Section Name</label>
                                        <select name="section_id" id="section_id" class="form-control mb-3">
                                            @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{$section->section_name}}</option>
                                            @endforeach
                                        </select>
                                        <!--Add Product Description-->
                                        <div class="form-group">
                                            <label for="section_name">Description</label>
                                            <textarea name="product_desc" id="product_desc" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--  end::Modal Edit -->

                    <!--  begin::Modal Delete -->
                    <div class="modal effect-slide-in-right" id="modaldemo12">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="products/destroy" method="Post" autocomplete="off">
                                   @method('delete')
                                    @csrf
                                    <div class="modal-body">
                                        <!--Section Name-->
                                        <p style="margin-bottom: 15px">Are You Sure You Want To Delete This Product ?</p>
                                        <input type="hidden" id="id" name="id" value="">
                                        <input type="text" name="product_name" id="product_name" class="form-control" readonly>
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
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <!-- Edit Script-->
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product-name')
            var section_name = button.data('section-name')
            var description = button.data('desc')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_id').val(section_name);
            modal.find('.modal-body #product_desc').val(description);
        })
    </script>

   <!-- Delete Script-->
   <script>
    $('#modaldemo12').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product-name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>

@endsection
