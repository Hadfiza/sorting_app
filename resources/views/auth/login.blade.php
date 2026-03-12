<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="card login-card shadow-lg">
        <div class="card-body p-4">

            <h3 class="text-center mb-4">Login Sistem</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Login
                </button>
                
                <div class="text-center mt-3">
                    <span class="text-muted">Belum punya akun?</span> 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar sekarang</a>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>