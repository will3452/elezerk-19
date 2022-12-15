<x-layout>
    <x-header></x-header>
    <div class="row">
        @foreach ($products as $item)
        <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6">
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="{{route('products.show', ['product' => $item->id])}}">
                        <img src="/storage/{{$item->image}}" alt="" class="default-img">
                    </a>
                    <div class="product-action">
                        <div class="pro-same-action pro-wishlist">
                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div>
                        <div class="pro-same-action pro-cart">
                            <form id="form" method="POST" action="{{route('products.store', ['product' => $item->id])}}">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <a title="Add To Cart" href="#" onclick="document.getElementById('form').submit()"><i class="pe-7s-cart"></i> Add to cart</a>
                            </form>
                        </div>
                        <div class="pro-same-action pro-quickview">
                            <a title="Quick View" href="{{route('products.show', ['product' => $item->id])}}"  ><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="{{route('products.show', ['product' => $item->id])}}">{{$item->name}}</a></h3>
                    {{-- <div class="product-rating">
                        <i class="fa fa-star-o yellow"></i>
                        <i class="fa fa-star-o yellow"></i>
                        <i class="fa fa-star-o yellow"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div> --}}
                    <div class="product-price">
                        <span>PHP {{number_format($item->selling_price, 2)}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<x-footer></x-footer>

</x-layout>
