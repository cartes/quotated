@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3">
            <h1>Administrar Avisos</h1>

            <ads-list
                    :labels="{{ json_encode([
                    'id' => __("ID"),
                    'seller_id' => __("Vendedor"),
                    'title' => __('Título'),
                    'description' => __("Descripción"),
                    'price' => __("Precio"),
                    'status' => __('Estado'),
                    'activate' => __('Activar'),
                    'created_at' => __("Publicación"),
                ]) }}"
                    route="{{ route("admin.ads_json") }}"
            >

            </ads-list>
        </div>
    </div>

@endsection