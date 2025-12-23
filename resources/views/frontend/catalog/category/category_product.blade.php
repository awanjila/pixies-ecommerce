@extends('layouts.front_app')

@section('content')
<main>
    <!-- breadcrumb area start -->
    <!-- <section class="breadcrumb__area include-bg pt-100 pb-50 breadcrumb__padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <div class="breadcrumb__list">
                            <span><a href="/">Home</a></span>
                            <span>{{$category->category_name}}</span>
                            {!! $category->category_description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- breadcrumb area end -->

    <slug-category :category-slug="'{{ $category->slug }}'"></slug-category>
</main>
@endsection
  
