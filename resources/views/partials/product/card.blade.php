<div class="card h-100">
    <div class="card-header">
    @if ($product->images->count() > 0)
        <a href="{{ route("product.detail", [ 'category' => $product->category->slug_name ?? 'uncat', 'slug' => $product->slug]) }}">
            <img class="card-img-top" src="{{ $product->images[0]->pathProduct() ?? '' }}" alt="{{ $product->title }}"/>
        </a>
    @endif
    </div>
    <div class="card-body">
        <h4 class="card-title currency">$ {{ $product->currency }}</h4>
        <h4 class="card-title">
            <a href="{{ route("product.detail", [
                'category' => $product->category->slug_name ?? 'uncat',
                'slug' => $product->slug]
                ) }}">
                {{ $product->title }}
            </a>
        </h4>
        <h6>{{ $product->category->title ?? '' }}</h6>
    </div>
</div>
