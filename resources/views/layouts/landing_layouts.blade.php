<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SortingLearn')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    
    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            
            <a class="navbar-brand fw-bold d-flex align-items-center fs-3" href="/">
                <img src="{{ asset('images/LOGO.png') }}" alt="Logo" height="50" class="me-2">
                SortLearn
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}" 
                        href="{{ route('home') }}">
                        Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kodeku') ? 'active fw-bold text-primary' : '' }}" href="{{ route('kodeku') }}">Kodeku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petunjuk') ? 'active fw-bold text-primary' : '' }}" href="{{route('petunjuk')}}">Petunjuk Penggunaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active fw-bold text-primary' : '' }}" href="{{ route('tentang') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @yield('scripts')

</body>
</html>