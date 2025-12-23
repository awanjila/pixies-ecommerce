@extends('layouts.admin_app')

@section('title')
  Reviews
@endsection

@section('content')


    <!-- toastr -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- toastr -->

            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                
                                <h4 class="page-title">Reviews</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>

                                        <tr>
                                            <th>s1</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            
                                           
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $reviews as $key=> $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{ asset($item->product->product_image) }}" style="width: 50px; height: 40px;"></td>
                                            <td>{{$item->user_name}}</td>
                                            <td>{{$item->product->product_name}}</td>
                                            
                                            
                                            <td>

                                                <!-- <a href="{{route('edit.review', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light"title="Edit"><i class="fa fa-pencil-alt"></i></a> -->
                                            
                                                <a href="{{route('delete.review', $item->id)}}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"title="Delete"><i class="fa fa-trash-alt"></i></a>

                                            </td>


                                        </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->


                    <!-- end row-->

                </div> <!-- container  fluid-->
            </div> <!-- container -->

                <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
    </script>

@endsection
