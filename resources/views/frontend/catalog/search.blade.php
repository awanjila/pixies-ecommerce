@extends('layouts.front_app')

@section('title')
wabegadgets | Electronics, Security & Smart Devices in Nairobi Ke

@endsection

@section('meta_title', 'wabegadgets provides reliable Electronics, Security & Smart Devices  in Nairobi, Kenya.')

@section('content')


<main>

<!--
  - PRODUCT
-->

<div class="product-container">

  <div class="container">


	<!--
	  - SIDEBAR
	-->

	<div class="sidebar  has-scrollbar" data-mobile-menu>

	 @include('frontend.partials.leftsidebar')

	</div>



	<div class="product-box">

	 




	  <!--
		- PRODUCT GRID
	  -->

	  <div class="product-main">

		<h2 class="title">Search Results </h2>

		<div class="product-grid">

		  
		@if ($searchproducts->count() > 0)

@foreach($searchproducts as $item)



		  <div class="showcase">
		  
			<div class="showcase-banner">
			  <img src="{{asset($item->product_image)}}" alt="{{$item->product_name}}" class="product-img default"
				width="300">

				@if($item->images->isNotEmpty())
    {{-- Display the first image --}}
    

<img src="{{ asset($item->images->first()->filename) }}" alt="{{$item->product_name}}" class="product-img hover"
				width="300">
				@endif
		  
			  <!-- <div class="showcase-actions">
				<button class="btn-action">
				  <ion-icon name="heart-outline"></ion-icon>
				</button>
		  
				<button class="btn-action">
				  <ion-icon name="eye-outline"></ion-icon>
				</button>
		  
				<button class="btn-action">
				  <ion-icon name="repeat-outline"></ion-icon>
				</button>
		  
				<button class="btn-action">
				  <ion-icon name="bag-add-outline"></ion-icon>
				</button>
			  </div> -->
			</div>
		  
			<div class="showcase-content">
			  
		  
			  <h3>
				<a href="{{ route('show.product', ['slug' => $item->slug]) }}" class="showcase-title">{{$item->product_name}}</a>
			  </h3>
		  
			  <div class="showcase-rating">
				<ion-icon name="star"></ion-icon>
				<ion-icon name="star"></ion-icon>
				<ion-icon name="star"></ion-icon>
				<ion-icon name="star-outline"></ion-icon>
				<ion-icon name="star-outline"></ion-icon>
			  </div>
		  
			  <div class="price-box">
				<p class="price">{{$item->selling_price}}</p>
				<del>{{$item->buying_price}}</del>
			  </div>
		  
			</div>
		  
		  </div>
		  @endforeach
		  

		</div>

		@else
				<p>No products Marching Your Search.</p>
				@endif




	  </div>

	</div>

  </div>

</div>





<!--
  - TESTIMONIALS, CTA & SERVICE
-->


</main>





@endsection