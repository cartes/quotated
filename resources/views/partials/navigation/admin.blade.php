<li class="nav-item"><a class="nav-link" href="{{ route('category.admin') }}">Administrar categorias</a></li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}"
       onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"
    >
        {{ __("Cerrar sesión") }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
