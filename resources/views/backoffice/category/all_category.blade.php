@extends('layouts.admin_app')

@section('title')
  Categories
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Add Category</button>
                            </ol>
                        </div>
                        <h4 class="page-title">All Category</h4>
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
                                    <th>Category Name </th>
                                    <th>Category Image </th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($categories as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td><img src="{{ asset($item->category_image) }}" width="100" height="100"></td>
                                        <td>
                                            <a href="{{ route('edit.category',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                            <a href="{{ route('delete.category',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete">Delete</a>

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
        <form class="px-3" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Category Name</label>
                <input class="form-control" type="text" name="category_name" placeholder="Add Category">
            </div>

             <div class="mb-3">
                <label for="username" class="form-label">Meta Title * Data about the Title</label>
                <textarea class="form-control" type="text" name="meta_title" placeholder="Add Category"></textarea>
            </div>

             
            <div class="mb-3">
                <label for="name" class="form-label">Category Description</label>
                <textarea type="text" name="category_description" class="form-control @error('category_description') is-invalid @enderror" id="category_description"></textarea>
                @error('category_description')
                <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">

            <!-- <label for="parent_category">Parent Category</label>
            <select name="parent_id" id="parent_category">
    <option value="">Default</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
    @endforeach
</select> -->
</div>

<div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="category_image" class="form-label">category Image</label>
                        <input type="file" name="category_image" class="form-control" id="image">
                    </div>
                    <img id="showImage" src="{{ (!empty($category->category_image)) ? url('upload/categories/' . $category->category_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                </div> <!-- end col -->

            <div class="mb-3 text-center">
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
        </form>
    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection


