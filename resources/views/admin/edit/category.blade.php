@extends("layouts.app")

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="px-5">
                <form class="form" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-7 form-group">
                            <label>Nombre categoría: </label>
                            <input type="text" class="form-control{{ $errors->has("title") ? " is-invalid" : '' }}"
                                   name="title"
                                   value="{{ $category->title }}"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Categoria Superior: </label>
                            <select class="form-control" name="cat_parent" >
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Orden: </label>
                            <input type="text" class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}"
                                   name="order"
                                   value="{{ $category->order }}"
                            >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i> Editar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
