@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="py-3">
            <h1>Administrar Categorias</h1>

            <categories-list
                    :labels="{{ json_encode([
                    'id' => __("ID"),
                    'title' => __("Titulo"),
                    'cat_parent' => __('Categoria Superior'),
                    'change_parent' => __("Superior"),
                    'order' => __("Orden"),
                    'edit' => __('Editar'),
                ]) }}"
                    route="{{ route("admin.categories_json") }}"
            >

            </categories-list>
        </div>
    </div>
@endsection
