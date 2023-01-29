@props(['item'])
<div class="product-wrap mb-25 scroll-zoom">
    <div class="product-img">
        <a href="product-details.html">
            <img class="default-img" src="/storage/{{$item->image}}" alt="">
            <img class="hover-img" src="/storage/{{$item->image}}" alt="" style="filter:grayscale(1)">
        </a>
        <span class="pink">{{$item->category}}</span>
        <div class="product-action">
            <div class="pro-same-action pro-wishlist">
                <a title="Like" href="#"><i class="pe-7s-like"></i></a>
            </div>
            <div class="pro-same-action pro-cart">
                <a title="Book now" href="/book/{{$item->id}}"><i class="pe-7s-car"></i> Book now</a>
            </div>
            <div class="pro-same-action pro-quickview">
                <a title="Show Details" href="/cars/{{$item->id}}" ><i class="pe-7s-look"></i></a>
            </div>
        </div>
    </div>
    <div class="product-content text-center">
        <h3><a href="product-details.html">{{\Str::limit($item->name, 10)}}/{{\Str::limit($item->brand, 10)}}</a> </h3>
         {{-- <x-star :star="2"></x-star> --}}
        <div class="product-price">
            <span>PHP {{number_format($item->price_per_hour, 2)}}</span>
        </div>
    </div>
</div>
