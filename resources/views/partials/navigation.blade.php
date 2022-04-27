<header>
    <div class="container-fluid navbar-quotated">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-2">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>
                <div class="col-md-6">
                    <form method="post" class="form">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Buscar productos"
                                       aria-label="Buscar productos">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-quotated">

                        <button class="navbar-toggler" type="button"
                                data-toggle="collapse"
                                data-target="navBar-menu"
                                aria-controlls="navBar-menu"
                                aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navBar-menu">
                            <!-- lefty side menu -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown mr-3">
                                    <a href="#" id="categoryDropdown" class="nav-link dropdown-toggle"
                                       data-toggle="dropdown" aria-labelledby="categoryDropdown" aria-expanded="false">
                                        Categorias
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                                        @isset ($categories)
                                            @foreach($categories as $cat)
                                                <a class="dropdown-item"
                                                   href="/category/{{ $cat->slug  }}">{{ $cat->title }}</a>
                                            @endforeach
                                        @endisset
                                    </div>
                                </li>
                                <li class="nav-item"><a href="{{ route("product.create") }}"
                                                        class="btn btn-outline-light nav-link">Vender</a></li>
                            </ul>

                            <!-- righty sida bar -->

                            <ul class="navbar-nav ml-auto">
                                @include('partials.navigation.' . \App\User::navigation())
                            </ul>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>
