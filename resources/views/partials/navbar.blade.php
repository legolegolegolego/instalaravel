<nav>
    <ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        @auth
            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
        @else
            <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
            <li><a href="{{ route('register') }}">Registrarse</a></li>
        @endauth
    </ul>
</nav>
