@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="py-3">
            <h1>Administrar usuarios</h1>
        </div>

        <users-list
                :labels="{{ json_encode([
                'id' => 'ID',
                'name' => 'Nombre',
                'surname' => 'Apellido',
                'email' => 'Email',
                'birthday' => 'Fecha de Nacimiento',
                'phone' => 'Teléfono',
                'status' => 'Estatus',
                'edit' => 'Editar'
                ]) }}" route="{{ route('admin.users_json') }}"
                session-id="{{ auth()->id() }}"
        >

        </users-list>
    </div>

@endsection