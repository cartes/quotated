@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7" id="steps-container" >
                {{ $product }}
            </div>
            <div class="col-md-5">
                @if ($product->condition_name)
                    <p class="text-uppercase text-secondary mb-0">
                        {{ $product->condition_name }}
                    </p>
                @endif
                <h1>{{ $product->title }}</h1>
                <h2>$ {{ $product->currency }}</h2>
            </div>
        </div>
    </div>
@endsection