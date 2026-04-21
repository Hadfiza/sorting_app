<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title','SortLearn')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/siswa.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@yield('css')
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-siswa">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="/">
            <img src="{{ asset('images/LOGO.png') }}" 
                alt="Logo" 
                style="height: 50px; width: auto; object-fit: contain;" 
                class="me-2">
            SortLearn
        </a>

        <div class="dropdown ms-auto">
            <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            href="#" data-bs-toggle="dropdown">
                <img src="https://via.placeholder.com/32" class="rounded-circle me-2">
                <span>{{ auth()->user()->nama }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{route("mahasiswa.profil")}}">
                        <i class="fa-solid fa-user me-2"></i> Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

@php
    $user = auth()->user();
    $mahasiswa = $user->mahasiswa ?? null;

    // FITUR BYPASS: Akun ini tidak akan terkena lock sama sekali
    $isBypass = ($user->email === 'fiz@gmail.com');

    // 1. Ambil array ID aktivitas yang sudah SELESAI
    $progresSelesai = [];
    if ($mahasiswa) {
        $progresSelesai = \App\Models\ProgresMahasiswa::where('id_mahasiswa', $mahasiswa->id)
                            ->where('status', 'selesai')
                            ->pluck('id_aktivitas')
                            ->toArray();
    }

    // 2. Daftar ID Kuis yang menjadi "Gerbang/Syarat" antar BAB
    $syaratLulus = [
        'bubble'    => 3,  
        'selection' => 7,  
        'insertion' => 12, 
        'merge'     => 17, 
        'evaluasi'  => 22  
    ];

    $namaFolder = [
        'pendahuluan' => 'Pendahuluan',
        'bubble'      => 'Bubble Sort',
        'selection'   => 'Selection Sort',
        'insertion'   => 'Insertion Sort',
        'merge'       => 'Merge Sort'
    ];

    // Urutkan Folder
    $aktivitasSorted = collect($aktivitas)->sortBy(function ($items, $folder) use ($namaFolder) {
        return array_search($folder, array_keys($namaFolder));
    });
@endphp

<div class="sidebar">

    <div class="menu-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
        <a href="{{ route('mahasiswa.dashboard') }}" class="menu-btn">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>
    </div>

    <div class="sidebar-divider"></div>

    @foreach($aktivitasSorted as $folder => $items)
        @if($folder == 'evaluasi') @continue @endif
        @php
            $isLocked = false;
            
            // Pengecekan Syarat Lulus Antar BAB (Ditambah kondisi pengecualian bypass)
            if (isset($syaratLulus[$folder]) && !$isBypass) {
                $idSyarat = $syaratLulus[$folder];
                if (!in_array($idSyarat, $progresSelesai)) {
                    $isLocked = true; 
                }
            }
            
            $isActiveFolder = request()->is('mahasiswa/'.$folder.'/*');
        @endphp

        <div class="menu-item {{ $isActiveFolder && !$isLocked ? 'open active' : '' }}">
            
            @if(!$isLocked)
                <button type="button" class="menu-btn" onclick="toggleMenu(this)">
                    {{ $namaFolder[$folder] ?? ucfirst($folder) }}
                    <span class="arrow">▾</span>
                </button>

                <div class="submenu">
                    @php
                        // AWAL SUB-MENU: Item pertama selalu terbuka
                        $prevSelesai = true; 
                    @endphp

                    @foreach($items as $item)
                        @php
                            // Submenu terkunci jika sebelumnya belum selesai DAN bukan akun bypass
                            $isSubmenuLocked = !$prevSelesai && !$isBypass;
                        @endphp

                        @if(!$isSubmenuLocked)
                            <a href="{{ route('mahasiswa.aktivitas.show', [$item->folder, $item->slug]) }}"
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
                        @else
                            <a href="#" class="text-muted" style="cursor: not-allowed; " 
                               onclick="alert('Selesaikan aktivitas sebelumnya di bab ini terlebih dahulu!'); return false;">
                                
                                @if($item->tipe == 'materi')
                                    <i class="fa-solid fa-book me-2"></i>
                                @elseif($item->tipe == 'quiz')
                                    <i class="fa-solid fa-brain me-2"></i>
                                @elseif($item->tipe == 'praktikum')
                                    <i class="fa-solid fa-laptop-code me-2"></i>
                                @endif

                                {{ $item->nama }}
                            </a>
                        @endif

                        @php
                            // Update syarat untuk item berikutnya:
                            // Apakah aktivitas ini sudah selesai dikerjakan?
                            $prevSelesai = in_array($item->id, $progresSelesai);
                        @endphp
                    @endforeach
                </div>

            @else
                <button type="button" class="menu-btn " style="cursor: not-allowed;"
                        onclick="alert('Selesaikan Kuis pada Modul sebelumnya terlebih dahulu!');">
                    <i class="fa-solid fa-lock me-2"></i>
                    {{ $namaFolder[$folder] ?? ucfirst($folder) }}
                </button>
            @endif

        </div>
    @endforeach

    <div class="sidebar-divider"></div>

    @php
        // Evaluasi terkunci jika syarat tidak terpenuhi DAN bukan akun bypass
        $evaluasiLocked = !in_array($syaratLulus['evaluasi'], $progresSelesai) && !$isBypass;
    @endphp

    <div class="menu-item {{ request()->routeIs('mahasiswa.evaluasi') ? 'active' : '' }}">
        @if(!$evaluasiLocked)
            <a href="{{ route('mahasiswa.aktivitas.show', ['evaluasi', 'quiz']) }}" class="menu-btn fw-bold">
                <i class="fa-solid fa-file-pen me-2"></i> Evaluasi Akhir
            </a>
        @else
            <a href="#" class="menu-btn" style="cursor: not-allowed;" 
            onclick="alert('Selesaikan Kuis Merge Sort terlebih dahulu!'); return false;">
                <i class="fa-solid fa-lock me-2"></i> Evaluasi Akhir
            </a>
        @endif
    </div>

</div>

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