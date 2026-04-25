<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- PAGE TITLE (Browser Tab) -->
<title>{{ $page_title ?? ($product->product_name ?? 'CCTV Cameras & Security Systems') }} | Pixies Technologies</title>

<!-- SEO META -->
<meta name="title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'Pixies Technologies')) }}">
<meta name="description" content="{{ $meta_description ?? ($product->product_description ?? 'Pixies Technologies is your trusted CCTV and security solutions provider in Kenya. Shop CCTV cameras, NVRs, DVRs, alarm systems, and smart security gear in Nairobi, Mombasa, Kisumu, Nakuru, Eldoret & all major towns. Professional installations available.') }}">
<meta name="keywords" content="{{ $meta_keywords ?? (($product->product_name ?? '') . ', ' . ($product->brand->name ?? 'Pixies Technologies') . ', CCTV Nairobi, CCTV Kenya, security cameras, CCTV Mombasa, CCTV Kisumu, IP cameras, NVR, DVR, alarm systems, smart security') }}">

<!-- BRAND & AUTHORSHIP -->
<meta name="author" content="Pixies Technologies">
<meta name="brand" content="Pixies Technologies">
<meta name="publisher" content="Pixies Technologies">

<!-- OPEN GRAPH (Facebook, LinkedIn, WhatsApp) -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Pixies Technologies">
<meta property="og:title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'CCTV Cameras & Security Systems')) }}">
<meta property="og:description" content="{{ $meta_description ?? ($product->product_description ?? 'Your trusted CCTV and security solutions provider in Kenya. Shop CCTV cameras, alarm systems, and security gear.') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $meta_image ?? (isset($product) && $product->product_image ? asset('storage/' . $product->product_image) : asset('front-assets/img/others/cta-banner.jpeg')) }}">

<!-- TWITTER / X META -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'CCTV Cameras & Security Systems')) }}">
<meta name="twitter:description" content="{{ $meta_description ?? ($product->product_description ?? 'CCTV & security solutions in Kenya. Nairobi, Mombasa, Kisumu, Nakuru.') }}">
<meta name="twitter:image" content="{{ $meta_image ?? (isset($product) && $product->product_image ? asset('storage/' . $product->product_image) : asset('front-assets/img/others/cta-banner.jpeg')) }}">

<!-- CANONICAL -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/favicon.png') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('frontend.partials.styles')
@stack('styles')

<!-- DYNAMIC PRODUCT JSON-LD -->
@if(isset($productSchema))
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

</head>

<body>

<div id="app">
      <!-- Include your Vue app-header here -->
      @include('frontend.partials.header')
      
      <!-- Blade inclusion for fallback static content -->
      

      <!-- Yield the dynamic content from Blade -->
      @yield('content')

      <!-- Include Vue component for WhatsApp integration -->
      <whatsapp-button />

    
      <brand-carousel />
    </div>

    <!-- footer area start -->
    <!-- @include('frontend.partials.footer') -->
    <!-- footer area end -->

    <!-- JS here -->
    
    @stack('scripts')
    
</body>
</html>