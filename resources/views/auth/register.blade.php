<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-container">

        <div class="auth-card">

            <h1>Daftar</h1>

            <p>Buat akun terlebih dahulu</p>

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.process') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Nama</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <button type="submit">
                    Daftar
                </button>

            </form>

            <p class="bottom-text">
                Sudah punya akun?

                <a href="{{ route('user.login') }}">
                    Login
                </a>
            </p>

        </div>

    </div>
    */CODE JS/*
    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>