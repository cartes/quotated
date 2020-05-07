<li class="nav-item dropdown">
    <a id="navUserDropdown" class="nav-link dropdown-toggle"
       href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ auth()->user()->name }} {{ auth()->user()->surname }} <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navUserDropdown">
        <a class="dropdown-item" href="#">{{__("Perfil")}}</a>
        <hr />
        <a class="dropdown-item" href="{{ route("logout") }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
            {{ __("Cerrar sesión") }}
        </a>
        <form id="logout-form" action="{{ route("logout") }}" method="post" style="display: none;">
            @csrf
        </form>
    </div>
</li>