@extends('layouts.admin_app')

@section('title') Admin |  Blog Posts | wabegadgets @endsection

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<div class="row">
    <!-- start page title -->
    
                <!-- end page title -->
    <div class="col-12">
        <div class="card">
             <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <a href="{{route('add.blog')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Blog Post</a>
                                </ol>
                            </div>
                            <h4 class="page-title">Blog Posts</h4>
                        </div>
                    </div>
            <div class="card-body">
                
                <p class="text-muted font-13 mb-4">
                    
                </p>
                @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    {{ session('message') }}
                </div>
                @endif

                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr><th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                       @foreach($blogs as $key=>$item)
                       
                       <tr>
                        <td>{{$key+1}}</td>
                        
                        <td><img src="{{ asset($item->image)}}" style="width: 60px; height: 45px;"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category->category_name}}</td>
                        <td>{{$item->author}}</td>
                        

                        <td>
                            <a href="{{route('edit.blog', $item->id)}}" class="btn btn-info rounded-pill waves-effect waves-light" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                            <a href="{{route('delete.blog', $item->id)}}" class="btn btn-danger rounded-pill waves-effect waves-light delete" title="Delete"><i class="fa fa-trash-alt"></i></a>
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

<script type="text/javascript">
    
 $(document).ready(function() {
    @if (session('message'))
    toastr.{{ session('alert-type') }}('{{ session('message') }}');
    @endif

    $('.delete').on('click', function () {
        return confirm('Are you sure you want to delete this item?');
    });
            // Form validation and image preview code...


});
</script>

@endsection

