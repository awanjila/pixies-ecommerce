@extends('layouts.admin_app')

@section('title', 'Add Product')

@section('content')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<div class="col-lg-10 col-xl-10 mx-auto">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="mdi mdi-package-variant me-2"></i> Add New Product</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('import.product') }}" class="btn btn-light btn-sm text-primary">
                    <i class="mdi mdi-file-excel me-1"></i> Import Excel
                </a>
                <a href="{{ route('export.product') }}" class="btn btn-light btn-sm text-success">
                    <i class="mdi mdi-download me-1"></i> Export Template
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <form id="productForm" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Product Basic Information -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="mdi mdi-information-outline me-1"></i> Basic Information
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_name" class="form-label required">Product Name</label>
                                <input type="text"
                                       name="product_name"
                                       class="form-control @error('product_name') is-invalid @enderror"
                                       id="product_name"
                                       value="{{ old('product_name') }}"
                                       placeholder="Enter product name">
                                @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="meta_title" class="form-label required">Meta Title</label>
                                <input type="text"
                                       name="meta_title"
                                       class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title"
                                       value="{{ old('meta_title') }}"
                                       placeholder="SEO / meta title">
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="category_id" class="form-label required">Category</label>
                                <select name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="supplier_id" class="form-label required">Supplier</label>
                                <select name="supplier_id"
                                        class="form-select @error('supplier_id') is-invalid @enderror"
                                        id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="brand_id" class="form-label required">Brand</label>
                                <select name="brand_id"
                                        class="form-select @error('brand_id') is-invalid @enderror"
                                        id="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing Information -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="mdi mdi-currency-usd me-1"></i> Pricing Information
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="buying_price" class="form-label required">Buying Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">KSh</span>
                                    <input type="number"
                                           name="buying_price"
                                           class="form-control @error('buying_price') is-invalid @enderror"
                                           id="buying_price"
                                           value="{{ old('buying_price') }}"
                                           step="0.01"
                                           min="0.01"
                                           placeholder="0.00">
                                </div>
                                @error('buying_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="selling_price" class="form-label required">Selling Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">KSh</span>
                                    <input type="number"
                                           name="selling_price"
                                           class="form-control @error('selling_price') is-invalid @enderror"
                                           id="selling_price"
                                           value="{{ old('selling_price') }}"
                                           step="0.01"
                                           min="0.01"
                                           placeholder="0.00">
                                </div>
                                @error('selling_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Information -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="mdi mdi-warehouse me-1"></i> Inventory Information
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_store" class="form-label required">Quantity in Stock</label>
                                <input type="number"
                                       name="product_store"
                                       class="form-control @error('product_store') is-invalid @enderror"
                                       id="product_store"
                                       value="{{ old('product_store') }}"
                                       min="1"
                                       step="1"
                                       placeholder="0">
                                @error('product_store')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Initial quantity available for sale.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description & Features -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="mdi mdi-text-box me-1"></i> Product Details
                    </h6>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="product_description" class="form-label required">Product Description</label>
                                <textarea name="product_description"
                                          class="form-control d-none @error('product_description') is-invalid @enderror"
                                          id="product_description">{{ old('product_description') }}</textarea>
                                <div class="quill-wrapper @error('product_description') is-invalid @enderror">
                                    <div id="editor_description"></div>
                                </div>
                                @error('product_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="product_features" class="form-label required">Product Features</label>
                                <textarea name="product_features"
                                          class="form-control d-none @error('product_features') is-invalid @enderror"
                                          id="product_features">{{ old('product_features') }}</textarea>
                                <div class="quill-wrapper @error('product_features') is-invalid @enderror">
                                    <div id="editor_features"></div>
                                </div>
                                @error('product_features')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Preview -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="mdi mdi-image me-1"></i> Product Image
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="product_image" class="form-label required">Image</label>
                                <input type="file"
                                       name="product_image"
                                       class="form-control @error('product_image') is-invalid @enderror"
                                       id="product_image"
                                       accept="image/*">
                                @error('product_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">JPG, PNG, GIF or WebP. Max 2MB.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <img id="showImage"
                                     src="{{ url('upload/no_image.jpg') }}"
                                     class="img-thumbnail shadow-sm"
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;"
                                     alt="Product Image Preview">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" onclick="history.back()">
                                <i class="mdi mdi-arrow-left me-1"></i> Cancel
                            </button>
                            <button type="reset" class="btn btn-warning" id="resetBtn">
                                <i class="mdi mdi-refresh me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="mdi mdi-content-save me-1"></i> Save Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .required::after {
        content: " *";
        color: red;
    }

    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }

    #showImage {
        border: 3px dashed #dee2e6;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    #showImage:hover {
        border-color: #007bff;
    }

    .quill-wrapper .ql-toolbar {
        border-radius: 8px 8px 0 0;
    }

    .quill-wrapper .ql-container {
        border-radius: 0 0 8px 8px;
        min-height: 120px;
        font-size: 14px;
    }

    .quill-wrapper.is-invalid .ql-toolbar,
    .quill-wrapper.is-invalid .ql-container {
        border-color: #f46a6a;
    }
</style>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var toolbarOptions = [
            [{ 'header': [2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['link'],
            ['clean']
        ];

        var descriptionQuill = new Quill('#editor_description', {
            theme: 'snow',
            placeholder: 'Enter detailed product description...',
            modules: { toolbar: toolbarOptions }
        });

        var featuresQuill = new Quill('#editor_features', {
            theme: 'snow',
            placeholder: 'Enter product features (one per line)...',
            modules: { toolbar: toolbarOptions }
        });

        descriptionQuill.root.innerHTML = {!! json_encode(old('product_description', '')) !!};
        featuresQuill.root.innerHTML = {!! json_encode(old('product_features', '')) !!};

        function syncQuill() {
            $('#product_description').val(descriptionQuill.root.innerHTML);
            $('#product_features').val(featuresQuill.root.innerHTML);
        }

        $.validator.addMethod('quillRequired', function (value, element) {
            var text = (descriptionQuill.getText() || '').trim();
            return text.length > 0;
        }, 'Please enter product description');

        $.validator.addMethod('quillMin', function (value, element, param) {
            var text = (descriptionQuill.getText() || '').trim();
            return text.length >= param;
        }, 'Please enter at least 10 characters');

        $.validator.addMethod('featuresRequired', function (value, element) {
            var text = (featuresQuill.getText() || '').trim();
            return text.length > 0;
        }, 'Please enter product features');

        $.validator.addMethod('featuresMin', function (value, element, param) {
            var text = (featuresQuill.getText() || '').trim();
            return text.length >= param;
        }, 'Please enter at least 10 characters');

        // Form validation
        $('#productForm').validate({
            rules: {
                product_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                },
                meta_title: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                },
                category_id: {
                    required: true,
                },
                supplier_id: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                buying_price: {
                    required: true,
                    number: true,
                    min: 0.01,
                },
                selling_price: {
                    required: true,
                    number: true,
                    min: 0.01,
                },
                product_store: {
                    required: true,
                    digits: true,
                    min: 1,
                },
                product_description: {
                    quillRequired: true,
                    quillMin: 10,
                },
                product_features: {
                    featuresRequired: true,
                    featuresMin: 10,
                },
                product_image: {
                    required: true,
                    extension: 'jpeg|jpg|png|gif|webp',
                },
            },
            ignore: [],
            messages: {
                product_name: {
                    required: 'Please enter product name',
                    minlength: 'Product name must be at least 3 characters',
                    maxlength: 'Product name cannot exceed 200 characters',
                },
                meta_title: {
                    required: 'Please enter meta title',
                    minlength: 'Meta title must be at least 3 characters',
                    maxlength: 'Meta title cannot exceed 200 characters',
                },
                category_id: {
                    required: 'Please select a category',
                },
                supplier_id: {
                    required: 'Please select a supplier',
                },
                brand_id: {
                    required: 'Please select a brand',
                },
                buying_price: {
                    required: 'Please enter buying price',
                    number: 'Please enter a valid number',
                    min: 'Buying price must be greater than 0',
                },
                selling_price: {
                    required: 'Please enter selling price',
                    number: 'Please enter a valid number',
                    min: 'Selling price must be greater than 0',
                },
                product_store: {
                    required: 'Please enter quantity in stock',
                    digits: 'Quantity must be a whole number',
                    min: 'Quantity must be at least 1',
                },
                product_image: {
                    required: 'Please select a product image',
                    extension: 'Please select a valid image file (jpg, jpeg, png, gif, webp)',
                },
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
                var id = $(element).attr('id');
                if (id === 'product_description' || id === 'product_features') {
                    $(element).closest('.form-group').find('.quill-wrapper').addClass('is-invalid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
                var id = $(element).attr('id');
                if (id === 'product_description' || id === 'product_features') {
                    $(element).closest('.form-group').find('.quill-wrapper').removeClass('is-invalid');
                }
            },
            submitHandler: function (form) {
                syncQuill();
                $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Saving...');
                form.submit();
            }
        });

        // Image preview functionality
        $('#product_image').change(function (e) {
            var file = e.target.files[0];
            if (file) {
                if (file.size > 2097152) {
                    alert('File size must be less than 2MB');
                    $(this).val('');
                    return;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Reset form functionality
        $('#resetBtn').click(function () {
            descriptionQuill.root.innerHTML = '';
            featuresQuill.root.innerHTML = '';
            $('#showImage').attr('src', '{{ url('upload/no_image.jpg') }}');
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            $('.invalid-feedback').remove();
            $('#productForm')[0].reset();
        });

        // Auto-format price inputs
        $('#buying_price, #selling_price').on('blur', function () {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                $(this).val(value.toFixed(2));
            }
        });
    });
</script>
@endsection
