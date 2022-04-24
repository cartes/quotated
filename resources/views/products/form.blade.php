@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9" id="steps-container" >
                <form-products
                    route="{{ route("product.create") }}" :seller-id="{{ auth()->user()->id }}">
                </form-products>
            </div>
        </div>
    </div>
@endsection
