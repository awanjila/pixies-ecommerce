@extends('frontend.layouts.app')

@section('content')
<div id="app">
    <!-- Hero Section with Slider -->
    <Slider></Slider>

    <!-- Features Section -->
    <Features></Features>

    <!-- Popular Categories -->
    <Examples class="section-spacing"></Examples>

    <!-- Featured Products -->
    <Products class="section-spacing"></Products>

    <!-- Promo Section -->
    <promo-section class="section-spacing"></promo-section>

    <!-- Trending Products -->
    <trending-products class="section-spacing"></trending-products>

    <!-- Brand Showcase -->
    <brand-carousel class="section-spacing"></brand-carousel>

    <!-- Newsletter Modal -->
    <subscription-modal></subscription-modal>

    <footer />
</div>
@endsection