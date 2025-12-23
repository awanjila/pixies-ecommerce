@extends('layouts.front_app')

{{-- Page Title (shown in browser tab) --}}
@section('title')
    {{ $product->product_name }} | Wabegadgets | Smart Electronics & Security Devices in Nairobi, Kenya
@endsection

{{-- Meta Title (for SEO purposes, can differ from page title) --}}
@section('meta_title')
    {{ $meta_title ?? $product->meta_title ?? $product->product_name . ' - Wabegadgets' }}
@endsection

{{-- Meta Description --}}
@section('meta_description')
    {{ $meta_description ?? $product->product_description ?? 'Shop ' . $product->product_name . ' at Wabegadgets, Nairobi’s trusted electronics store.' }}
@endsection

{{-- Meta Keywords --}}
@section('meta_keywords')
    {{ $meta_keywords ?? $product->product_name . ', ' . ($product->brand->name ?? 'Wabegadgets') . ', electronics Nairobi, CCTV, smart devices' }}
@endsection

{{-- Meta Image --}}
@section('meta_image')
    {{ $meta_image ?? ($product->product_image ? asset('storage/' . $product->product_image) : asset('front-assets/img/others/cta-banner.jpeg')) }}
@endsection

{{-- Main Content --}}
@section('content')
<div id="app">
    <product-detail 
        :product='@json($product)' 
        :hot-products='@json($hotproducts)'>
    </product-detail>
</div>
@endsection

{{-- JSON-LD Structured Data --}}
@section('scripts')
@if(isset($productSchema))
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endif
@endsection
