
@extends('layouts.admin_app')

@section('title')
Add category
@endsection

@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<div class="col-lg-8 col-xl-8">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                @csrf
                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Brand</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control @error('name') is-invalid @enderror" id="name">

                            @error('name')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>


                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Brand Description</label>
                            <textarea type="text" name="brand_description" class="form-control @error('name') is-invalid @enderror" id="name"></textarea>

                            @error('name')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div> <!-- end row -->


                <div class="text-end">
                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                </div>
            </form>



        </div>
    </div> <!-- end card-->

</div> <!-- end col -->




@endsection
