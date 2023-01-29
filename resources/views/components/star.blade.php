@props(['star'])
<div class="product-rating">
    @for ($i = 0; $i < 5; $i++)
        <i class="fa fa-star-o {{$i < $star ? 'yellow' : ''}} "></i>
    @endfor
</div>
