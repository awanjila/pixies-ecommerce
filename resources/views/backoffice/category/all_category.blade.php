@extends('layouts.admin_app')

@section('title')
  Categories - Electronics & Security
@endsection

@section('content')

<script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#category_description',
        plugins: 'advlist autolink lists link image charmap preview anchor',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
        toolbar_mode: 'floating',
        height: 250,
        menubar: false,
        branding: false,
    });
</script>

<style>
    .category-card {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .category-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .category-img-preview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e3e6f0;
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 8px 8px 0 0;
    }
    .btn-tech {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-tech:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .page-header-tech {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
        border-radius: 8px;
        color: white;
        margin-bottom: 20px;
    }
    .image-preview-container {
        position: relative;
        display: inline-block;
    }
    .image-preview-container img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #e3e6f0;
    }
    .form-label-tech {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    .required-asterisk {
        color: #e74c3c;
    }
</style>

<div class="content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-header-tech">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1"><i class="mdi mdi-shape-outline me-2"></i>Product Categories</h4>
                            <p class="mb-0 opacity-75">Manage your electronics, smart devices & security categories</p>
                        </div>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#signup-modal">
                            <i class="mdi mdi-plus-circle me-1"></i>Add New Category
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="row">
            <div class="col-12">
                <div class="card category-card">
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <strong>{{ $item->category_name }}</strong>
                                        @if($item->meta_title)
                                        <br><small class="text-muted">{{ Str::limit($item->meta_title, 40) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset($item->category_image) }}" class="category-img-preview" alt="{{ $item->category_name }}">
                                    </td>
                                    <td>
                                        @if($item->category_description)
                                        <small>{{ Str::limit(strip_tags($item->category_description), 50) }}</small>
                                        @else
                                        <small class="text-muted">No description</small>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.category',$item->id) }}" class="btn btn-sm btn-info rounded-pill">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('delete.category',$item->id) }}" class="btn btn-sm btn-danger rounded-pill" id="delete">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add Category Modal -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title"><i class="mdi mdi-shape-plus me-2"></i>Add New Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="categoryForm" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_name" class="form-label form-label-tech">
                                Category Name <span class="required-asterisk">*</span>
                            </label>
                            <input class="form-control @error('category_name') is-invalid @enderror" 
                                   type="text" 
                                   name="category_name" 
                                   id="category_name"
                                   placeholder="e.g., Smart Home Devices"
                                   value="{{ old('category_name') }}"
                                   required>
                            @error('category_name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meta_title" class="form-label form-label-tech">
                                Meta Title <span class="required-asterisk">*</span>
                            </label>
                            <input class="form-control @error('meta_title') is-invalid @enderror" 
                                   type="text" 
                                   name="meta_title" 
                                   id="meta_title"
                                   placeholder="SEO-friendly title"
                                   value="{{ old('meta_title') }}"
                                   required>
                            <small class="text-muted">Used for SEO optimization</small>
                            @error('meta_title')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category_description" class="form-label form-label-tech">
                            Category Description
                        </label>
                        <textarea name="category_description" 
                                  class="form-control @error('category_description') is-invalid @enderror" 
                                  id="category_description"
                                  rows="4">{{ old('category_description') }}</textarea>
                        @error('category_description')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label form-label-tech">
                            Parent Category (Optional)
                        </label>
                        <select name="parent_id" id="parent_id" class="form-select">
                            <option value="">None (Root Category)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Select a parent to create a subcategory</small>
                    </div>

                    <div class="mb-3">
                        <label for="category_image" class="form-label form-label-tech">
                            Category Image <span class="required-asterisk">*</span>
                        </label>
                        <input type="file" 
                               name="category_image" 
                               class="form-control @error('category_image') is-invalid @enderror" 
                               id="image"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               required>
                        <small class="text-muted">Recommended: Square image, minimum 500x500px. Max 2MB.</small>
                        @error('category_image')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 image-preview-container" id="imagePreviewContainer" style="display: none;">
                        <label class="form-label form-label-tech">Image Preview</label>
                        <div>
                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Preview">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Cancel
                        </button>
                        <button class="btn btn-tech" type="submit">
                            <i class="mdi mdi-check me-1"></i>Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('showImage').src = e.target.result;
                document.getElementById('imagePreviewContainer').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Show validation errors if modal needs to stay open
    @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('signup-modal'));
        myModal.show();
    @endif
</script>

@endsection