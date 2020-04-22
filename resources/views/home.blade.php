@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @forelse($products as $product)
                <div class="col-md-3">
                    @include('partials.product.card')
                </div>
            @empty
                <div class="alert alert-dark">
                    {{ __('No hay productos disponibles') }}
                </div>
            @endforelse
        </div>
        <div class="row justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
