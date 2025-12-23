@extends('layouts.admin_app')

@section('title')
 Brands
@endsection

@section('content')

 <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea', // Change this to match the actual selector of your textarea
            plugins: 'advlist autolink lists link image charmap print preview hr anchor',
            toolbar_mode: 'floating',
            height: 300,
        });
    </script>


    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Add Brand</button>
                            </ol>
                        </div>
                        <h4 class="page-title">All Brand</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Brand Image </th>
                                    <th>Brand Name </th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($brands as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->brand_image) }}" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td>
                                            <a href="{{ route('edit.brand',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                            <a href="{{ route('delete.brand',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>

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

        </div> <!-- container -->

    </div> <!-- content -->



    <!-- Signup modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                 <div class="modal-body">
        <form class="px-3" method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Brand Name</label>
                <input class="form-control" type="text" name="brand_name" placeholder="Add Brand">
            </div>
            <div class="mb-3">
                <label for="brand_image" class="form-label">Brand Image</label>
                <input class="form-control" type="file" name="brand_image" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Brand Description</label>
                <textarea type="text" name="brand_description" class="form-control @error('brand_description') is-invalid @enderror" id="brand_description"></textarea>
                @error('brand_description')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection


