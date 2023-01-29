<x-layout>
    <div class="shop-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details dec-img-wrap">
                        <img src="/storage/{{$car->image}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content ml-70">
                        <h2>{{$car->name}} - {{$car->brand}}</h2>
                        <div class="product-details-price">
                            <span>PHP {{number_format($car->price_per_hour, 2)}} </span>
                            <small> &nbsp;/ hour</small>
                        </div>
                        <p>
                            {!!$car->specs!!}
                        </p>

                        <div class="pro-details-meta">
                            <span>Category :</span>
                            <ul>
                                <li><a href="#">{{$car->category}}</a></li>
                            </ul>
                        </div>
                        <div class="pro-details-quality">
                            <div class="pro-details-cart btn-hover">
                                <a href="/book/{{$car->id}}">BOOK NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product-area pb-95">
        <div class="container">
            <div class="section-title text-center mb-50">
                <h2>Other Cars</h2>
            </div>
            <div class="row">
                @foreach (\App\Models\Car::where('id', '!=', $car->id)->latest()->get() as $item)
                <div class="col-md-3 col-6">
                    <x-item :item="$item"></x-item>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
