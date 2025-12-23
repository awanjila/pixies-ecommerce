
@extends('layouts.admin_app')

@section('title')
    Edit Review
@endsection

@section('content')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>



    <div class="col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('review.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$review->id}}">
                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Review Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Review User Name</label>
                                <input type="text" name="product_name" class="form-control @error('user_name') is-invalid @enderror" id="name" value="{{$review->user_name}}">

                                @error('user_name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Product </label>
                                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="name" value="{{$review->product->product_name}}">

                                @error('user_name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->

                        

                      

                             <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Review Text</label>
                                <textarea type="text" name="review_text" class="form-control @error('review_text') is-invalid @enderror" id="review_text">{{$review->review_text}}</textarea>

                                @error('review_text')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div> <!-- end col -->


                        


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                    </div>
                </form>



            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                    supplier_id: {
                        required : true,
                    },

                    product_store: {
                        required : true,
                    },
                    buying_date: {
                        required : true,
                    },
                    expire_date: {
                        required : true,
                    },
                    buying_price: {
                        required : true,
                    },
                    product_image: {
                        required : true,
                    },
                },
                messages :{
                    product_name: {
                        required : 'Please Enter Product Name',
                    },
                    category_id: {
                        required : 'Please Select Category',
                    },
                    supplier_id: {
                        required : 'Please Select Supplier',
                    },
                    product_store: {
                        required : 'Please Enter Product Store',
                    },
                    buying_date: {
                        required : 'Please Select Buying Date',
                    },
                    expire_date: {
                        required : 'Please Select Expire Date',
                    },
                    buying_price: {
                        required : 'Please Enter Buying Price',
                    },
                    product_image: {
                        required : 'Please Select Product Image',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>



@endsection
