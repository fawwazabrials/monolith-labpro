<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Monolith 🗿</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <x-flash-message />

    {{-- Navbar --}}
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light border">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">Monolith</a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <span class="navbar-text me-4"><strong>{{"Hi, " .auth()->user()->first_name . ' ' . auth()->user()->last_name}}</strong></span>
                        <li class="nav-item">
                            <a href="{{ route("history") }}" class="nav-link">History</a>
                        </li>
                        <form method="POST" action="/logout">
                            @csrf
                            <button class="nav-link" type="submit">
                              <i class=""></i> Logout
                            </button>
                          </form>
                        {{-- <li class="nav-item">
                            <a href="auth/logout" class="nav-link">Logout</a>
                        </li>     --}}
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("register") }}" class="nav-link">Register</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- Main content --}}
    <div class="container my-4" role="main">
        {{ $slot }}
    </div>

    {{-- <footer class="mt-auto bg-light d-flex justify-content-center align-items-center">
        <p class="text-muted credit my-3">Made by Fawwaz Abrial Saffa / 18221067</p>
    </footer> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>