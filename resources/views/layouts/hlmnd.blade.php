<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title','SortLearn')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/dosen.css?v=2.0') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@yield('css')
{{-- @vite('resources/css/app.css') --}}
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dosen">
    <div class="container-fluid px-4">
        <button class="btn text-white me-2 d-md-none" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </button>
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
                @php
                    $user = auth()->user();
                    $fotoPath = null;
                    $fotoUrl = null;

                    // Tentukan path file berdasarkan role
                    if($user->mahasiswa && $user->mahasiswa->foto){
                        $fotoPath = public_path('profil_mahasiswa/' . $user->mahasiswa->foto);
                        $fotoUrl = asset('profil_mahasiswa/' . $user->mahasiswa->foto);
                    } elseif($user->dosen && $user->dosen->foto){
                        $fotoPath = public_path('profil_dosen/' . $user->dosen->foto);
                        $fotoUrl = asset('profil_dosen/' . $user->dosen->foto);
                    }

                    // Cek apakah file fisik fotonya benar-benar ada di folder
                    $hasFoto = ($fotoPath && file_exists($fotoPath));

                    // Logika Inisial
                    $nama = $user->nama ?? 'User';
                    $inisial = collect(explode(' ', $nama))
                        ->take(2)
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->implode('');
                @endphp
                @if($hasFoto)
                    <img src="{{ $fotoUrl }}"
                        class="rounded-circle me-2"
                        style="width:32px; height:32px; object-fit:cover; border: 1px solid #ddd;">
                @else
                    <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center fw-bold me-2"
                        style="width:32px; height:32px; font-size:13px; border: 1px solid #ececec; text-transform: uppercase;">
                        {{ $inisial }}
                    </div>
                @endif
                <span>{{ auth()->user()->nama }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{route("dosen.profil")}}">
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
    $setting   = request()->routeIs('dosen.kkm');
    $soal = request()->routeIs('dosen.soal.*');
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

    <!-- Data Mahasiswa -->
    <div class="menu-item {{ request()->routeIs('dosen.datamahasiswa.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.datamahasiswa.index') }}" class="menu-btn">
            <i class="fa-solid fa-users me-2"></i>
            Data Mahasiswa
        </a>
    </div>

    <!-- Data Nilai -->
    <div class="menu-item {{ request()->routeIs('dosen.nilai.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.nilai.index') }}" class="menu-btn">
            <i class="fa-solid fa-chart-simple me-2"></i>
            Data Nilai
        </a>
    </div>

    <!-- Data Praktikum -->
    <div class="menu-item {{ request()->routeIs('dosen.praktikum.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.praktikum.index') }}" class="menu-btn">
            <i class="fa-solid fa-flask me-2"></i>
            Manajemen Praktikum
        </a>
    </div>

    <!-- Data Soal -->
    <div class="menu-item {{ request()->routeIs('dosen.soal.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.soal.index') }}" class="menu-btn">
            <i class="fa-solid fa-file-pen"></i>
            Manajemen Soal
        </a>
    </div>



    <!-- Setting -->
    <div class="menu-item {{ request()->routeIs('dosen.kkm.*') ? 'active' : '' }}">
        <a href="{{ route('dosen.kkm.index') }}" class="menu-btn">
            <i class="fa-solid fa-gear me-2"></i>
            Pengaturan KKM
        </a>
    </div>

    {{-- <div class="menu-item {{ $setting ? 'active' : '' }}">
        <a href="{{ route('dosen.setting') }}" class="menu-btn">
            <i class="fa-solid fa-gear me-2"></i>
            Setting
        </a>
    </div> --}}

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

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}
</script>

<footer class="footer">
    <div class="text-center">
        <small>© 2026 SortLearn.</small>
    </div>
</footer>

</body>
</html>
