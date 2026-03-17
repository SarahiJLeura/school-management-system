<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav>
        <ul class="flex space-x-4 p-4">
            <li><a href="">Home</a></li>
            @auth
                <li>
                    <a href="{{ route('index.admin') }}">Dashboard</a>
                </li>
                <li><a href="{{ route('index.materias') }}">Materias</a></li>
                <li><a href="{{ route('index.horarios') }}">Horarios</a></li>
                <li><a href="{{ route('index.grupos') }}">Grupos</a></li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Log out</button>
                </form>

            @else
                <li><a href="{{ route('index.login') }}">Login</a></li>
                <li><a href="{{ route('index.register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>
        
    </footer>
</body>
</html>