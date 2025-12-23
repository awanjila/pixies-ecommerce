<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- PAGE TITLE (Browser Tab) -->
<title>{{ $page_title ?? ($product->product_name ?? 'Smart Electronics & Security Devices') }} | Wabegadgets</title>

<!-- SEO META -->
<meta name="title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'Wabegadgets')) }}">
<meta name="description" content="{{ $meta_description ?? ($product->product_description ?? 'Wabegadgets is your trusted electronics store in Nairobi, Kenya. Shop electronics, smart devices, CCTV, Bluetooth speakers, and security solutions.') }}">
<meta name="keywords" content="{{ $meta_keywords ?? (($product->product_name ?? '') . ', ' . ($product->brand->name ?? 'Wabegadgets') . ', electronics Nairobi, CCTV, smart devices') }}">

<!-- BRAND & AUTHORSHIP -->
<meta name="author" content="Wabegadgets">
<meta name="brand" content="Wabegadgets">
<meta name="publisher" content="Wabegadgets">

<!-- OPEN GRAPH (Facebook, LinkedIn, WhatsApp) -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Wabegadgets">
<meta property="og:title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'Smart Electronics & Security Devices')) }}">
<meta property="og:description" content="{{ $meta_description ?? ($product->product_description ?? 'Discover premium electronics, smart devices, and security solutions at Wabegadgets.') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $meta_image ?? (isset($product) && $product->product_image ? asset('storage/' . $product->product_image) : asset('front-assets/img/others/cta-banner.jpeg')) }}">

<!-- TWITTER / X META -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta_title ?? ($product->meta_title ?? ($product->product_name ?? 'Smart Electronics & Security Devices')) }}">
<meta name="twitter:description" content="{{ $meta_description ?? ($product->product_description ?? 'Shop reliable electronics, CCTV, and smart devices in Nairobi, Kenya.') }}">
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
