<div class="card h-100">
    @if ($product->images->count() > 0)
        <img class="card-img-top" src="{{ $product->images[0]->pathProduct() ?? '' }}" alt="{{ $product->title }}" />
    @endif
    <div class="card-body">
        <h4 class="card-title currency">$ {{ $product->currency }}</h4>
        <h4 class="card-title">{{ $product->title }}</h4>
        <h6>{{ $product->category->title ?? '' }}</h6>
    </div>
</div>
