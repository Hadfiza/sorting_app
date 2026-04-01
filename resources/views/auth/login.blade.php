<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>

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
            max-width: 900px;
            display: flex;
        }

        /* Bagian Kiri (Form) */
        .auth-form-section {
            padding: 50px 60px;
            width: 50%;
        }

        .auth-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .auth-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
            font-size: 0.9rem;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 0.95rem;
            padding-right: 40px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }

        /* Fitur Toggle Password */
        .password-wrapper {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 15px;
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

        .password-toggle-btn:hover, .password-toggle-btn:focus {
            color: #2563eb;
            outline: none;
        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .auth-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }

        .auth-footer a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* === PERBAIKAN BAGIAN KANAN (GAMBAR SESUAI PROPORSI) === */
        .auth-image-section {
            width: 50%;
            /* Ganti warna hex ini agar sama persis dengan background tepi gambar Anda */
            background: linear-gradient(135deg, #1f5ed6, #3f7cff);
            padding: 40px; /* Memberikan ruang napas agar gambar tidak terpotong */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-img-contained {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Menjaga gambar tetap utuh (tidak terpotong/gepeng) */
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 450px;
                margin: 20px;
            }
            .auth-form-section {
                width: 100%;
                padding: 40px 30px;
            }
            .auth-image-section {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="auth-container">
        
        <div class="auth-form-section">
            <h2 class="auth-title">Selamat Datang</h2>
            <p class="auth-subtitle">Silakan login untuk mengakses akun Anda.</p>

            @if (session('success'))
                <div class="alert alert-success py-2 px-3 small">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 small">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Masukkan password Anda" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('loginPassword', 'eyeIconLogin')">
                            <i class="bi bi-eye" id="eyeIconLogin"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Masuk ke Dashboard
                </button>
                
                <div class="auth-footer">
                    <span>Belum memiliki akun?</span> 
                    <a href="{{ route('register') }}">Daftar Sekarang</a>
                </div>
            </form>
        </div>

        <div class="auth-image-section">
            <img src="{{ asset('images/login.png') }}" alt="Banner Login" class="auth-img-contained">
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