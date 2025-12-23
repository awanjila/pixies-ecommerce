@extends('layouts.front_app')

@section('title')
   wabegadgets | Smart Electronics & Security Devices in Nairobi, Kenya
@endsection

@section('meta_title')
    meta title
@endsection

@php
    $products = \App\Models\Product::all();
@endphp

@section('content')


<all-shop />

@endsection