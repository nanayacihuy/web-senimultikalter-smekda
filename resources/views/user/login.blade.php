<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Seni Multikalter</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <main class="login-page">

        <!-- ================= BAGIAN KIRI ================= -->
        <section class="login-left">
            <div class="left-content">
                <div class="logo-container">
                    <img id="logoPreview" src="{{ asset('img/logoseni26.jpeg') }}" alt="Logo Seni Multikalter">
                </div>
                
                <h1>Seni Multikalter</h1>
                <p class="tagline">“Wadahnya Para Seniman”</p>
                <p class="left-description">
                    Sebelum mulai berproses bersama kami, silakan daftarkan diri Anda di website resmi kami.
                </p>
            </div>
        </section>

        <!-- ================= BAGIAN KANAN ================= -->
        <section class="login-right">
            <div class="login-card">

                <div class="card-header">
                    <h3>Selamat Datang</h3>
                    <p class="login-subtitle">Masuk untuk melanjutkan ke akun Anda</p>
                </div>

                <!-- PESAN ERROR / SUCCESS -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- FORM -->
                <form id="loginForm" action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <!-- USERNAME -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            placeholder="Masukkan username Anda" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-box">
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                            <button type="button" id="showPassword" aria-label="Tampilkan Password">👁</button>
                        </div>
                    </div>

                    <!-- ROLE -->
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="login-button">Masuk</button>
                </form>

                <!-- DAFTAR -->
                <p class="register-text">
                    Belum punya akun?
                    <a href="{{ route('user.daftar') }}" class="{{ request()->routeIs('user.daftar') ? 'active' : '' }}">
                        Daftar sekarang
                    </a>
                </p>

                <!-- PESAN JAVASCRIPT -->
                <p id="loginMessage" class="login-message"></p>

            </div>
        </section>

    </main>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('js/user/login.js') }}"></script>

</body>

</html>