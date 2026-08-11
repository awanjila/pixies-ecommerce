@extends('layouts.admin_app')

@section('title')
    Products
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('product.add') }}" class="btn btn-primary rounded-pill waves-effect waves-light">
                                <i class="mdi mdi-plus me-1"></i> Add Product
                            </a>
                        </ol>
                    </div>
                    <h4 class="page-title">Products</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Code</th>
                                    <th>Selling Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($item->product_image) }}" style="width: 50px; height: 40px; object-fit: cover; border-radius: 6px;" alt="{{ $item->product_name }}">
                                    </td>
                                    <td class="fw-semibold">{{ $item->product_name }}</td>
                                    <td>
                                        @if($item->category)
                                            {{ $item->category->category_name }}
                                        @else
                                            <span class="text-muted">No Category</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->supplier)
                                            {{ $item->supplier->name }}
                                        @else
                                            <span class="text-muted">No Supplier</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-soft-info text-info">{{ $item->product_code }}</span></td>
                                    <td>KSh {{ number_format($item->selling_price, 2) }}</td>
                                    <td class="text-center">{{ $item->product_store }}</td>
                                    <td>
                                        @php
                                            $stock = (int) $item->product_store;
                                        @endphp
                                        @if($stock <= 0)
                                            <span class="badge badge-soft-danger">Out of Stock</span>
                                        @elseif($stock < 10)
                                            <span class="badge badge-soft-warning">Low Stock</span>
                                        @else
                                            <span class="badge badge-soft-success">In Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.product', $item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="{{ route('barcode.product', $item->id) }}" class="btn btn-info rounded-pill waves-effect waves-light" title="Details"><i class="fa fa-barcode"></i></a>
                                        <a href="{{ route('delete.product', $item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light btn-delete" data-product="{{ $item->product_name }}" title="Delete"><i class="fa fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container  fluid-->
</div> <!-- container -->

<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif

    $(document).ready(function () {
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            var productName = $(this).data('product');
            var deleteUrl = $(this).attr('href');
            Swal.fire({
                title: 'Delete Product?',
                text: 'Are you sure you want to delete "' + productName + '"? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>

@endsection
