@extends('layouts.admin_app')

@section('title')
    @section('title') Admin | Add a Coupon | wabegadgets  @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

    <!-- <div class="content-page"> -->
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Add Coupon </h4>

                                @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                                @endif

                                <form method="post" action="{{ route('store.coupon') }}" enctype="multipart/form-data" id="sliderForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="influencer" class="col-sm-2 col-form-label">Influencers Name</label>
                                        <div class="col-sm-10">
                                            <input name="influencer_name" class="form-control" type="text" id="influencer">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="code" class="col-sm-2 col-form-label">Coupon Code</label>
                                        <div class="col-sm-10">
                                            <input name="code" class="form-control" type="text" id="code">
                                            <span class="text-danger" id="title-error"></span>
                                        </div>
                                    </div>

                                    <!-- end row -->

                                    <div class="row mb-3">
                                        <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-10">
                                            <input name="amount" class="form-control" type="number" id="amount">
                                            <span class="text-danger" id="author-error"></span>
                                        </div>
                                    </div>
                                    <!-- end row -->


                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Coupon ">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
    $('#sliderForm').submit(function(e) {
        e.preventDefault();

        // Clear previous error messages
        $('.text-danger').text('');

        // Retrieve form inputs
        var influencer = $('#influencer').val();
        var code = $('#code').val();
        var amount = $('#amount').val();

        // Perform validation
        var isValid = true;

        if (influencer.trim() === '') {
            $('#influencer-error').text('Influencer name is required.');
            isValid = false;
        }

        if (code.trim() === '') {
            $('#code-error').text('Coupon code is required.');
            isValid = false;
        }

        if (amount.trim() === '') {
            $('#amount-error').text('Amount is required.');
            isValid = false;
        }

        if (isValid) {
            // Submit the form if valid
            this.submit();
        }
    });
});

    </script>
    @endsection
