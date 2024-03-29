@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!is_null($message))
            <div id="alerts">
                <div class="alert alert-{{$message['type']}}">
                    {{ $message['text'] }}
                </div>
            </div>
        @endif
            <div class="row breadcrumb">
                <div class="col-12">
                    <a href="{{route('home')}}">Inicio</a> &raquo;
                    {{$category}}
                </div>
            </div>
        <div class="row justify-content-center">
            @forelse($products as $product)
                <div class="col-md-3 my-2">
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
        <div class="row mt-4">
            <div class="col-12">
                <h3>Últimos productos</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($last as $product)
                <div class="col-md-3 my-2">
                    @include('partials.product.card')
                </div>
            @endforeach

        </div>
    </div>


    <script>
        jQuery(document).ready(function ($) {
            $('.alert').each(function () {
                let _this = $(this);
                setTimeout(function () {
                    _this.fadeOut();
                }, 3000)
            })
        })
    </script>
@endsection
