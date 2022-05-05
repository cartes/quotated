@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="slider-container col-md-7" id="steps-container">
                <product-detail :product-id="{{$product->id}}"></product-detail>
            </div>
            <div class="col-md-5">
                @if ($product->condition_name)
                    <h5 class="text-uppercase text-secondary mb-3">
                        {{ $product->condition_name }}
                    </h5>
                @endif
                <h1>{{ $product->title }}</h1>
                <h2>$ {{ $product->currency }}</h2>
                <div class="text-left mt-4">
                    {{ $product->description }}
                </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <product-contact :product-id="{{$product->seller_id}}"></product-contact>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
