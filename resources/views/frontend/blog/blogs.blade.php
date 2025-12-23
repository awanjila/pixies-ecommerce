@extends('layouts.front_app')

@section('title')
wabegadgets | Electronics, Security & Smart Devices in Nairobi Kenya
@endsection

@section('content')

      <!-- BREADCRUMB AREA START -->
      <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Blog</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- BLOG AREA START -->
    <div class="ltn__blog-area ltn__blog-item-3-normal mb-100">
        <div class="container">
            <div class="row">
                <!-- Blog Item -->
                 @foreach($blogs as $item)
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="{{ route('blogs.show', ['slug' => $item->slug]) }}"><img src="{{asset($item->image)}}" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: {{$item->author}}S</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Medical Equipments</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="{{ route('blogs.show', ['slug' => $item->slug]) }}">{{$item->name}}</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d')}} {{ \Carbon\Carbon::parse($item->created_at)->format('M')}},{{ \Carbon\Carbon::parse($item->created_at)->format('Y')}}</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="{{ route('blogs.show', ['slug' => $item->slug]) }}">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
            <div class="row">
    <div class="col-lg-12">
        <div class="ltn__pagination-area text-center">
            <div class="ltn__pagination">
                @if ($blogs->hasPages())
                    <ul>
                        {{-- Previous Page Link --}}
                        @if ($blogs->onFirstPage())
                            <li class="disabled">
                                <span><i class="fas fa-angle-double-left"></i></span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $blogs->previousPageUrl() }}">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            <li class="{{ $page == $blogs->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($blogs->hasMorePages())
                            <li>
                                <a href="{{ $blogs->nextPageUrl() }}">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="disabled">
                                <span><i class="fas fa-angle-double-right"></i></span>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    <!-- BLOG AREA END -->


@endsection