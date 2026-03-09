<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title','SortLearn')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/siswa.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@yield('css')
{{-- @vite('resources/css/app.css') --}}
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg fixed-top navbar-siswa">
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
    $pendahuluan = request()->routeIs('mahasiswa.pendahuluan.*');
    $bubble      = request()->routeIs('mahasiswa.bubble.*');
    $selection   = request()->routeIs('mahasiswa.selection.*');
    $insertion   = request()->routeIs('mahasiswa.insertion.*');
    $merge       = request()->routeIs('mahasiswa.merge.*');
@endphp

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">

    <!-- Dashboard -->
    <div class="menu-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
        <a href="{{ route('mahasiswa.dashboard') }}" class="menu-btn">
            <i class="fa-solid fa-house me-2"></i>
            Dashboard
        </a>
    </div>

    <div class="sidebar-divider"></div>

    @php
    $namaFolder = [
        'pendahuluan' => 'Pendahuluan',
        'bubble' => 'Bubble Sort',
        'selection' => 'Selection Sort',
        'insertion' => 'Insertion Sort',
        'merge' => 'Merge Sort'
    ];

    $aktivitas = collect($aktivitas)->sortBy(function ($items, $folder) use ($namaFolder) {
        return array_search($folder, array_keys($namaFolder));
    });
    @endphp

    @foreach($aktivitas as $folder => $items)

    <div class="menu-item {{ request()->is('mahasiswa/'.$folder.'/*') ? 'open active' : '' }}">

        <button type="button" class="menu-btn" onclick="toggleMenu(this)">
            {{ $namaFolder[$folder] ?? ucfirst($folder) }}
            <span class="arrow">▾</span>
        </button>

        <div class="submenu">

            @foreach($items as $item)

            <a href="{{ route('mahasiswa.aktivitas.show',[$item->folder,$item->slug]) }}"
               class="{{ request()->is('mahasiswa/'.$item->folder.'/'.$item->slug) ? 'active-sub' : '' }}">

                @if($item->tipe == 'materi')
                    <i class="fa-solid fa-book me-2"></i>
                @elseif($item->tipe == 'quiz')
                    <i class="fa-solid fa-brain me-2"></i>
                @elseif($item->tipe == 'praktikum')
                    <i class="fa-solid fa-laptop-code me-2"></i>
                @endif

                {{ $item->nama }}

            </a>

            @endforeach

        </div>

    </div>

    @endforeach

    <div class="sidebar-divider"></div>

    <!-- Evaluasi -->
    <div class="menu-item {{ request()->routeIs('mahasiswa.evaluasi') ? 'active' : '' }}">
        <a href="#" class="menu-btn">
            <i class="fa-solid fa-file-pen"></i>
            Evaluasi
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
