@extends('layouts.admin_app')

@section('title')
   Customers WIth Gas
   @endsection

@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Customers WIth Gas
                    </h4>
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
                                    <th>Gas Type</th>
                                    <th>Date</th>
                                    <th>Issue Status</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach( $details as $key=> $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{ asset($item->customer->photo) }}" style="width: 50px; height: 40px;"></td>
                                        <td>{{$item->customer->name}}</td>
                                          <td>{{$item->gas_type}}</td>


                                        <td>{{$item->date}}</td>
                                        <td>{{$item->issuing_status}}</td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container  fluid-->
    </div> <!-- container -->

    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
