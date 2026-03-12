<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="card login-card shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="card-body p-4 p-md-5">

            <h3 class="text-center mb-4 fw-bold">Daftar Akun Siswa</h3>

            @if ($errors->any())
                <div class="alert alert-danger pb-0">
                    <ul class="mb-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-medium">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required placeholder="Masukkan Nomor Induk Siswa/Mahasiswa">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium text-primary">Token Kelas <span class="text-danger">*</span></label>
                    <input type="text" name="token_kelas" class="form-control border-primary" value="{{ old('token_kelas') }}" required placeholder="Contoh: X7Y8Z9 (Dapatkan dari Dosen)" style="text-transform: uppercase;">
                    <div class="form-text small">Masukkan token kelas agar Anda langsung tergabung.</div>
                </div>

                <div class="col-md-5 mb-3">
                        <label class="form-label fw-medium">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}" required placeholder="Contoh: 2023" min="2000" max="2100">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="contoh@email.com">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Min. 6 karakter">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-medium">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3">
                    Daftar Sekarang
                </button>

                <div class="text-center">
                    <span class="text-muted">Sudah punya akun?</span> 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login di sini</a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>