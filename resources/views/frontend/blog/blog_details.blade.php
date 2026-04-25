@extends('layouts.front_app')

@section('title')
Pixies Technologies | Electronics, Security & Smart Devices in Nairobi Kenya
@endsection

@section('content')

<div class="container">
<!-- <share-blog-details :blog="{{ json_encode($blog) }}"></share-blog-details> -->
  <blog-details :blog="{{ json_encode($blog) }}"></blog-details>
  <!-- Subscription Section -->
  <!-- <subscription-component /> -->
</div>

@endsection