<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
        }

        /* Bagian Kiri (Form Register) */
        .auth-form-section {
            padding: 12px 20px;
            width: 60%;
        }

        .auth-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .auth-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
            font-size: 0.85rem;
            margin-bottom: 4px;
        }

        .form-control {
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 0.9rem;
            padding-right: 40px; /* Space for the icon */
        }

        /* === UBAH FOKUS MENJADI BIRU === */
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }

        /* CSS Untuk Ikon Mata */
        .password-wrapper {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        /* === UBAH HOVER IKON MATA MENJADI BIRU === */
        .password-toggle-btn:hover, .password-toggle-btn:focus {
            color: #2563eb;
            outline: none;
        }

        /* === UBAH TOMBOL PRIMARY MENJADI BIRU === */
        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .auth-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }

        /* === UBAH LINK FOOTER MENJADI BIRU === */
        .auth-footer a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Bagian Kanan (Gambar & Background Biru) */
        .auth-image-section {
            width: 40%;
            background : linear-gradient(135deg, #1f5ed6, #3f7cff);
            padding: 40px; 
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-img-contained {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; 
            border-radius: 8px; 
        }


        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column-reverse;
                max-width: 500px;
                margin: 20px;
            }
            .auth-form-section {
                width: 100%;
                padding: 30px;
            }
            .auth-image-section {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center h-100 py-4">
    <div class="auth-container">
        
        <div class="auth-form-section">
            <h2 class="auth-title">Daftar Akun Baru</h2>
            <p class="auth-subtitle">Isi data di bawah ini untuk membuat akun Mahasiswa.</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Nama Lengkap">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Induk (NIM)</label>
                        <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required placeholder="Contoh: 123456">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label text-primary fw-bold">Token Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="token_kelas" class="form-control border-primary bg-primary-subtle" value="{{ old('token_kelas') }}" required placeholder="Contoh: X7Y8Z9" style="text-transform: uppercase;">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Tahun Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}" required placeholder="Contoh: 2023" min="2000" max="2100">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Masukkan email aktif">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="regPassword" class="form-control" required placeholder="Minimal 6 karakter">
                            <button type="button" class="password-toggle-btn" onclick="togglePassword('regPassword', 'eyeIconReg1')">
                                <i class="bi bi-eye" id="eyeIconReg1"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" id="regConfirmPassword" class="form-control" required placeholder="Ulangi password">
                            <button type="button" class="password-toggle-btn" onclick="togglePassword('regConfirmPassword', 'eyeIconReg2')">
                                <i class="bi bi-eye" id="eyeIconReg2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Daftar Sekarang
                </button>

                <div class="auth-footer">
                    <span>Sudah memiliki akun?</span> 
                    <a href="{{ route('login') }}">Login di sini</a>
                    <br>
                    <span class="text-muted small">Daftar sebagai Dosen? <a href="{{ route('register.dosen') }}">Daftar di sini</a></span>
                </div>
            </form>
        </div>

        <div class="auth-image-section">
            <img src="{{ asset('images/register.png') }}" alt="Register Banner" class="auth-img-contained">
        </div>

    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>

</body>
</html>