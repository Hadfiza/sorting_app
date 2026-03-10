<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title','SortLearn')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/dosen.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@yield('css')
{{-- @vite('resources/css/app.css') --}}
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dosen">
    <div class="container-fluid px-4">
        <!-- BRAND -->
        <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="/">
            <img src="{{ asset('images/LOGO.png') }}" 
                alt="Logo" 
                style="height: 50px; width: auto; object-fit: contain;" 
                class="me-2">
            SortLearn
        </a>

        <!-- RIGHT -->
        <div class="dropdown ms-auto">
            <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               href="#" data-bs-toggle="dropdown">
                <img src="https://via.placeholder.com/32" class="rounded-circle me-2">
                <span>{{ auth()->user()->nama }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fa-solid fa-user me-2"></i> Profil
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

@php
    $dashboard = request()->routeIs('dosen.dashboard');
    $nilai     = request()->routeIs('dosen.nilai.*');
    $mahasiswa = request()->routeIs('dosen.datamahasiswa.*');
    $praktikum = request()->routeIs('dosen.praktikum.*');
    $kelas     = request()->routeIs('dosen.kelas.*');
    $setting   = request()->routeIs('dosen.setting');
@endphp

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">

    <!-- Dashboard -->
    <div class="menu-item {{ $dashboard ? 'active' : '' }}">
        <a href="{{ route('dosen.dashboard') }}" class="menu-btn">
            <i class="fa-solid fa-house me-2"></i>
            Dashboard
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <!-- Data Kelas -->
    <div class="menu-item {{ $kelas ? 'active' : '' }}">
        <a href="{{ route('dosen.kelas.index') }}" class="menu-btn">
            <i class="fa-solid fa-school me-2"></i>
            Data Kelas
        </a>
    </div>

    <!-- Data Nilai -->
    <div class="menu-item {{ request()->routeIs('dosen.nilai.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.nilai.index') }}" class="menu-btn">
            <i class="fa-solid fa-chart-column me-2"></i>
            Data Nilai
        </a>
    </div>

    <!-- Data Mahasiswa -->
    <div class="menu-item {{ request()->routeIs('dosen.datamahasiswa.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.datamahasiswa.index') }}" class="menu-btn">
            <i class="fa-solid fa-users me-2"></i>
            Data Mahasiswa
        </a>
    </div>

    <!-- Data Mahasiswa -->
    <div class="menu-item {{ request()->routeIs('dosen.praktikum.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.praktikum.index') }}" class="menu-btn">
            <i class="fa-solid fa-users me-2"></i>
            Hasil Praktikum
        </a>
    </div>

    <!-- Setting -->
    <div class="menu-item {{ $setting ? 'active' : '' }}">
        <a href="{{ route('dosen.setting') }}" class="menu-btn">
            <i class="fa-solid fa-gear me-2"></i>
            Setting
        </a>
    </div>

</div>


<!-- ===== CONTENT ===== -->
<div class="content">
    @yield('content')
</div>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleMenu(btn){
    const item = btn.closest('.menu-item');
    item.classList.toggle('open');
}
</script>

</body>
</html>
