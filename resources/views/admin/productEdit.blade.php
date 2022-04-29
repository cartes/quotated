@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="py-3">
            <h1>Publicaciones</h1>
        </div>

        <product-edit
            :id="{{$idProduct}}"
        >
        </product-edit>
    </div>

@endsection
