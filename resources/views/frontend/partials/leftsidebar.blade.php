@php
$categories = \App\Models\Category::latest()->get();
$items = \App\Models\Product::inRandomOrder()->limit(5)->get();
@endphp

<div class="product-showcase">
    <h3 class="showcase-heading">best sellers</h3>
    <div class="showcase-wrapper">
        <div class="showcase-container">

            @foreach($items as $item)
                <div class="showcase">
                    <a href="{{ route('show.product', ['slug' => $item->slug]) }}" class="showcase-img-box">
                        <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}" width="75"
                             height="100" class="showcase-img">
                    </a>

                    <div class="showcase-content">
                        <a href="{{ route('show.product', ['slug' => $item->slug]) }}">
                            <h4 class="showcase-title">{{ $item->product_name }}</h4>
                        </a>

                        <div class="showcase-rating">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                        </div>

                        <div class="price-box">
                            <del>{{ $item->selling_price }}</del>
                            <p class="price">{{ $item->buying_price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>