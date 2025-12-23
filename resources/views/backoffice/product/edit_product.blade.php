@extends('layouts.admin_app')

@section('title', 'Edit Product')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
<style>
    .product-form-container {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 3rem 0;
    }
    
    .form-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.8);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .form-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.12);
    }
    
    .form-header {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
        padding: 3rem 2.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 50%);
        animation: shimmer 8s infinite linear;
    }
    
    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .form-header h4 {
        margin: 0;
        font-size: 2.25rem;
        font-weight: 700;
        text-shadow: 0 4px 8px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
        letter-spacing: -0.025em;
    }
    
    .form-header .subtitle {
        margin-top: 0.75rem;
        opacity: 0.9;
        font-size: 1.1rem;
        font-weight: 400;
    }
    
    .form-section {
        padding: 3rem 2.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #e2e8f0;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 2px;
    }
    
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        text-transform: none;
        letter-spacing: 0.025em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-label i {
        color: #6b7280;
        font-size: 1rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        font-weight: 500;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 8px 16px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
        background: white;
        outline: none;
    }
    
    .form-control.has-icon {
        padding-left: 3rem;
    }
    
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-icon {
        position: absolute;
        left: 1.25rem;
        color: #9ca3af;
        z-index: 10;
        pointer-events: none;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }
    
    .form-control:focus + .input-icon,
    .form-control:focus ~ .input-icon {
        color: #3b82f6;
    }
    
    .image-preview {
        border: 3px dashed #d1d5db;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f9fafb;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    
    .image-preview:hover {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.02);
        transform: scale(1.02);
    }
    
    .image-preview.drag-over {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.05);
        transform: scale(1.05);
    }
    
    .preview-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .preview-image {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 20px;
        border: 4px solid white;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .preview-image:hover {
        transform: scale(1.1) rotate(2deg);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .upload-text {
        color: #6b7280;
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
    }
    
    .upload-subtext {
        color: #9ca3af;
        font-size: 0.9rem;
        margin: 0;
    }
    
    .additional-images {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .additional-image {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        aspect-ratio: 1;
    }
    
    .additional-image:hover {
        transform: scale(1.08);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
    }
    
    .additional-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .delete-image {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(239, 68, 68, 0.95);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 12px;
        cursor: pointer;
        opacity: 0;
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
    }
    
    .additional-image:hover .delete-image {
        opacity: 1;
        transform: scale(1.1);
    }
    
    .delete-image:hover {
        background: rgba(220, 38, 38, 1);
        transform: scale(1.2);
    }
    
    .btn-modern {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border: none;
        border-radius: 16px;
        padding: 1rem 2.5rem;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-transform: none;
        letter-spacing: 0.025em;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    }
    
    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.8s;
    }
    
    .btn-modern:hover::before {
        left: 100%;
    }
    
    .btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(59, 130, 246, 0.4);
    }
    
    .btn-cancel {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        margin-right: 1.5rem;
        box-shadow: 0 8px 24px rgba(100, 116, 139, 0.3);
    }
    
    .btn-cancel:hover {
        box-shadow: 0 16px 32px rgba(100, 116, 139, 0.4);
    }
    
    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 0.75rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .error-message {
        color: #dc2626;
        font-size: 0.9rem;
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideIn 0.3s ease;
        padding: 0.75rem 1rem;
        background: rgba(220, 38, 38, 0.05);
        border-radius: 12px;
        border-left: 4px solid #dc2626;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .success-message {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        display: none;
        animation: slideDown 0.5s ease;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .section-divider {
        height: 3px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        margin: 3rem 0;
        border-radius: 2px;
        position: relative;
    }
    
    .section-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 2px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .textarea-wrapper {
        position: relative;
    }
    
    .char-counter {
        position: absolute;
        bottom: 15px;
        right: 20px;
        font-size: 0.85rem;
        color: #9ca3af;
        background: rgba(255, 255, 255, 0.9);
        padding: 4px 12px;
        border-radius: 12px;
        pointer-events: none;
        font-weight: 500;
        backdrop-filter: blur(8px);
    }
    
    .form-actions {
        background: #f8fafc;
        margin: 3rem -2.5rem -3rem -2.5rem;
        padding: 2.5rem;
        border-top: 1px solid #e2e8f0;
        text-align: center;
    }
    
    .current-images-section {
        background: #f8fafc;
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        border: 1px solid #e2e8f0;
    }
    
    .current-images-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .form-section {
            padding: 2rem 1.5rem;
        }
        
        .form-header {
            padding: 2rem 1.5rem;
        }
        
        .form-header h4 {
            font-size: 1.75rem;
        }
        
        .form-actions {
            margin: 2rem -1.5rem -2rem -1.5rem;
            padding: 2rem 1.5rem;
        }
        
        .additional-images {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .product-form-container {
            padding: 2rem 0;
        }
        
        .form-header h4 {
            font-size: 1.5rem;
        }
        
        .btn-modern {
            padding: 0.875rem 2rem;
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="product-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10">
                <div class="form-card">
                    <div class="form-header">
                        <h4><i class="fas fa-edit me-2"></i>Edit Product</h4>
                        <div class="subtitle">Update product information and images</div>
                    </div>
                    
                    <div class="success-message" id="successMessage">
                        <i class="fas fa-check-circle me-2"></i>Product updated successfully!
                    </div>
                    
                    <div class="form-section">
                        <form method="POST" action="{{route('product.update')}}" enctype="multipart/form-data" id="productForm">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            
                            <!-- Basic Information -->
                            <h3 class="section-title">Basic Information</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="product_name" class="form-label">
                                        <i class="fas fa-tag me-1"></i>Product Name
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-box input-icon"></i>
                                        <input type="text" 
                                               name="product_name" 
                                               class="form-control has-icon @error('product_name') is-invalid @enderror" 
                                               id="product_name" 
                                               value="{{old('product_name', $product->product_name)}}"
                                               placeholder="Enter product name">
                                    </div>
                                    @error('product_name')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category_id" class="form-label">
                                        <i class="fas fa-folder me-1"></i>Category
                                    </label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" 
                                                    @if($category->id == $product->category_id) selected @endif>
                                                {{$category->category_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="supplier_id" class="form-label">
                                        <i class="fas fa-truck me-1"></i>Supplier
                                    </label>
                                    <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id">
                                        <option value="">Select Supplier</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" 
                                                    @if($supplier->id == $product->supplier_id) selected @endif>
                                                {{$supplier->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="product_code" class="form-label">
                                        <i class="fas fa-barcode me-1"></i>Product Code
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-hashtag input-icon"></i>
                                        <input type="text" 
                                               name="product_code" 
                                               class="form-control has-icon @error('product_code') is-invalid @enderror" 
                                               id="product_code" 
                                               value="{{old('product_code', $product->product_code)}}"
                                               placeholder="Enter product code">
                                    </div>
                                    @error('product_code')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="section-divider"></div>

                            <!-- Pricing & Inventory -->
                            <h3 class="section-title">Pricing & Inventory</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="buying_price" class="form-label">
                                        <i class="fas fa-dollar-sign me-1"></i>Buying Price
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-coins input-icon"></i>
                                        <input type="number" 
                                               name="buying_price" 
                                               class="form-control has-icon @error('buying_price') is-invalid @enderror" 
                                               id="buying_price" 
                                               value="{{old('buying_price', $product->buying_price)}}"
                                               placeholder="0.00"
                                               step="0.01">
                                    </div>
                                    @error('buying_price')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="selling_price" class="form-label">
                                        <i class="fas fa-tag me-1"></i>Selling Price
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-money-bill input-icon"></i>
                                        <input type="number" 
                                               name="selling_price" 
                                               class="form-control has-icon @error('selling_price') is-invalid @enderror" 
                                               id="selling_price" 
                                               value="{{old('selling_price', $product->selling_price)}}"
                                               placeholder="0.00"
                                               step="0.01">
                                    </div>
                                    @error('selling_price')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="product_store" class="form-label">
                                        <i class="fas fa-warehouse me-1"></i>Product Quantity
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-cubes input-icon"></i>
                                        <input type="number" 
                                               name="product_store" 
                                               class="form-control has-icon @error('product_store') is-invalid @enderror" 
                                               id="product_store" 
                                               value="{{old('product_store', $product->product_store)}}"
                                               placeholder="Enter quantity"
                                               min="0">
                                    </div>
                                    @error('product_store')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_title" class="form-label">
                                        <i class="fas fa-search me-1"></i>Meta Title
                                    </label>
                                    <div class="textarea-wrapper">
                                        <textarea name="meta_title" 
                                                  class="form-control @error('meta_title') is-invalid @enderror" 
                                                  id="meta_title" 
                                                  rows="3" 
                                                  placeholder="Enter meta title for SEO"
                                                  maxlength="60">{{old('meta_title', $product->meta_title)}}</textarea>
                                        <div class="char-counter">
                                            <span id="meta_title_count">0</span>/60
                                        </div>
                                    </div>
                                    @error('meta_title')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="section-divider"></div>

                            <!-- Description & Features -->
                            <h3 class="section-title">Description & Features</h3>
                            <div class="form-group">
                                <label for="product_description" class="form-label">
                                    <i class="fas fa-align-left me-1"></i>Product Description
                                </label>
                                <div class="textarea-wrapper">
                                    <textarea name="product_description" 
                                              class="form-control @error('product_description') is-invalid @enderror" 
                                              id="product_description" 
                                              rows="5" 
                                              placeholder="Enter detailed product description">{{old('product_description', $product->product_description)}}</textarea>
                                </div>
                                @error('product_description')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_features" class="form-label">
                                    <i class="fas fa-list me-1"></i>Product Features
                                </label>
                                <div class="textarea-wrapper">
                                    <textarea name="product_features" 
                                              class="form-control @error('product_features') is-invalid @enderror" 
                                              id="product_features" 
                                              rows="5" 
                                              placeholder="Enter product features (one per line)">{{old('product_features', $product->product_features)}}</textarea>
                                </div>
                                @error('product_features')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="section-divider"></div>

                            <!-- Images -->
                            <h3 class="section-title">Product Images</h3>
                            <div class="form-group">
                                <label for="product_image" class="form-label">
                                    <i class="fas fa-camera me-1"></i>Product Main Image
                                </label>
                                <div class="image-preview" id="imageDropZone">
                                    <input type="file" 
                                           name="product_image" 
                                           class="form-control" 
                                           id="product_image" 
                                           accept="image/*" 
                                           style="display: none;">
                                    <div class="preview-content">
                                        <img id="imagePreview" 
                                             src="{{!empty($product->product_image) ? url('upload/product/'.$product->product_image) : url('upload/no_image.jpg')}}" 
                                             class="preview-image" 
                                             alt="Product Image">
                                        <div class="mt-3">
                                            <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #a0aec0;"></i>
                                            <p class="upload-text">Click to upload or drag and drop</p>
                                            <p class="upload-subtext">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="additional_images" class="form-label">
                                    <i class="fas fa-images me-1"></i>Additional Images
                                </label>
                                <div class="image-preview" id="additionalDropZone">
                                    <input type="file" 
                                           name="additional_images[]" 
                                           class="form-control" 
                                           id="additional_images" 
                                           accept="image/*" 
                                           multiple 
                                           style="display: none;">
                                    <div class="preview-content">
                                        <i class="fas fa-plus-circle" style="font-size: 2rem; color: #a0aec0;"></i>
                                        <p class="upload-text">Add more product images</p>
                                        <p class="upload-subtext">Select multiple files</p>
                                    </div>
                                </div>
                                
                                @if($product->images && $product->images->count())
                                <div class="current-images-section">
                                    <div class="current-images-title">
                                        <i class="fas fa-images"></i>
                                        Current Additional Images
                                    </div>
                                    <div class="additional-images" id="currentImages">
                                        @foreach($product->images as $img)
                                            <div class="additional-image" data-image-id="{{$img->id}}">
                                                <img src="{{ url('upload/product/'.$img->filename) }}" alt="Product Image">
                                                <button type="button" class="delete-image" onclick="deleteImage({{$img->id}})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                <div class="additional-images mt-3" id="newImagesPreview"></div>
                            </div>

                            <div class="section-divider"></div>

                        </form>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-modern btn-cancel" onclick="window.history.back()">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-modern" id="submitBtn" form="productForm">
                            <div class="loading-spinner" id="loadingSpinner"></div>
                            <i class="fas fa-save me-2"></i>Update Product
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/0mq6swtdkm89efyjaqer11cr7cojkd5ezhufky9fderhwt07/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize TinyMCE
    tinymce.init({
        selector: '#product_description, #product_features',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
        menubar: false,
        branding: false,
        skin: 'oxide',
        content_css: 'default'
    });

    // Initialize Select2
    $('#category_id, #supplier_id').select2({
        theme: 'default',
        width: '100%',
        placeholder: function() {
            return $(this).data('placeholder');
        }
    });

    // Character counter
    function updateCharCount(input, counter) {
        const current = input.val().length;
        const max = input.attr('maxlength') || 0;
        counter.text(current + '/' + max);
        
        if (current > max * 0.9) {
            counter.css('color', '#e53e3e');
        } else {
            counter.css('color', '#a0aec0');
        }
    }

    $('#meta_title').on('input', function() {
        updateCharCount($(this), $('#meta_title_count'));
    });
    
    // Initialize counter
    updateCharCount($('#meta_title'), $('#meta_title_count'));

    // Image upload handling
    function handleImageUpload(inputId, previewId, dropZoneId) {
        const input = $('#' + inputId);
        const preview = $('#' + previewId);
        const dropZone = $('#' + dropZoneId);

        // Click handler
        dropZone.on('click', function() {
            input.click();
        });

        // File input change
        input.on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.attr('src', e.target.result);
                    dropZone.addClass('has-image');
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop
        dropZone.on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('drag-over');
        });

        dropZone.on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('drag-over');
        });

        dropZone.on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('drag-over');
            
            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                input[0].files = files;
                input.trigger('change');
            }
        });
    }

    // Initialize image uploads
    handleImageUpload('product_image', 'imagePreview', 'imageDropZone');

    // Additional images handling
    $('#additionalDropZone').on('click', function() {
        $('#additional_images').click();
    });

    $('#additional_images').on('change', function(e) {
        const files = e.target.files;
        const previewContainer = $('#newImagesPreview');
        previewContainer.empty();

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageDiv = $(`
                    <div class="additional-image">
                        <img src="${e.target.result}" alt="New Image">
                        <button type="button" class="delete-image" onclick="removeNewImage(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `);
                previewContainer.append(imageDiv);
            };
            reader.readAsDataURL(file);
        });
    });

    // Form validation
    $('#productForm').validate({
        rules: {
            product_name: {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            category_id: {
                required: true
            },
            supplier_id: {
                required: true
            },
            product_code: {
                required: true,
                minlength: 2
            },
            product_store: {
                required: true,
                min: 0
            },
            buying_price: {
                required: true,
                min: 0,
                number: true
            },
            selling_price: {
                required: true,
                min: 0,
                number: true
            },
            meta_title: {
                maxlength: 60
            }
        },
        messages: {
            product_name: {
                required: 'Please enter product name',
                minlength: 'Product name must be at least 2 characters',
                maxlength: 'Product name cannot exceed 255 characters'
            },
            category_id: {
                required: 'Please select a category'
            },
            supplier_id: {
                required: 'Please select a supplier'
            },
            product_code: {
                required: 'Please enter product code',
                minlength: 'Product code must be at least 2 characters'
            },
            product_store: {
                required: 'Please enter product quantity',
                min: 'Quantity cannot be negative'
            },
            buying_price: {
                required: 'Please enter buying price',
                min: 'Price cannot be negative',
                number: 'Please enter a valid price'
            },
            selling_price: {
                required: 'Please enter selling price',
                min: 'Price cannot be negative',
                number: 'Please enter a valid price'
            },
            meta_title: {
                maxlength: 'Meta title cannot exceed 60 characters'
            }
        },
        errorElement: 'div',
        errorClass: 'error-message',
        errorPlacement: function(error, element) {
            error.insertAfter(element.closest('.input-group').length ? element.closest('.input-group') : element);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            const submitBtn = $('#submitBtn');
            const spinner = $('#loadingSpinner');
            
            // Show loading state
            submitBtn.prop('disabled', true);
            spinner.show();
            submitBtn.find('i').hide();
            
            // Submit form
            form.submit();
        }
    });

    // Custom validation for selling price vs buying price
    $('#selling_price, #buying_price').on('blur', function() {
        const buyingPrice = parseFloat($('#buying_price').val()) || 0;
        const sellingPrice = parseFloat($('#selling_price').val()) || 0;
        
        if (buyingPrice > 0 && sellingPrice > 0 && sellingPrice <= buyingPrice) {
            $('#selling_price').addClass('is-invalid');
            if (!$('#selling_price').next('.error-message').length) {
                $('<div class="error-message"><i class="fas fa-exclamation-triangle me-1"></i>Selling price should be higher than buying price</div>')
                    .insertAfter('#selling_price');
            }
        } else {
            $('#selling_price').removeClass('is-invalid');
            $('#selling_price').next('.error-message').remove();
        }
    });

    // Auto-calculate profit margin
    $('#buying_price, #selling_price').on('input', function() {
        const buyingPrice = parseFloat($('#buying_price').val()) || 0;
        const sellingPrice = parseFloat($('#selling_price').val()) || 0;
        
        if (buyingPrice > 0 && sellingPrice > 0) {
            const profit = sellingPrice - buyingPrice;
            const margin = ((profit / buyingPrice) * 100).toFixed(2);
            
            // Show profit margin indicator
            if (!$('#profit_indicator').length) {
                $('<div id="profit_indicator" class="mt-2 p-2" style="background: rgba(72, 187, 120, 0.1); border-radius: 8px; font-size: 0.9rem;"></div>')
                    .insertAfter('#selling_price').closest('.form-group');
            }
            
            $('#profit_indicator').html(`
                <i class="fas fa-chart-line me-1" style="color: #48bb78;"></i>
                Profit: ${profit.toFixed(2)} | Margin: ${margin}%
            `);
        } else {
            $('#profit_indicator').remove();
        }
    });

    // Initialize profit calculation
    $('#buying_price, #selling_price').trigger('input');
});

// Delete image function
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        $.ajax({
            url: '{{ route("product.deleteImage") }}',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                image_id: imageId
            },
            success: function(response) {
                if (response.success) {
                    $(`[data-image-id="${imageId}"]`).fadeOut(300, function() {
                        $(this).remove();
                    });
                    showNotification('Image deleted successfully', 'success');
                } else {
                    showNotification('Failed to delete image', 'error');
                }
            },
            error: function() {
                showNotification('An error occurred while deleting the image', 'error');
            }
        });
    }
}

// Remove new image from preview
function removeNewImage(button) {
    $(button).closest('.additional-image').fadeOut(300, function() {
        $(this).remove();
    });
}

// Show notification
function showNotification(message, type) {
    const notification = $(`
        <div class="notification ${type}" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#48bb78' : '#e53e3e'};
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            z-index: 9999;
            animation: slideInRight 0.5s ease;
        ">
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} me-2"></i>
            ${message}
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(() => {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}

// Add CSS animation
$('<style>').text(`
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
`).appendTo('head');
</script>
@endpush