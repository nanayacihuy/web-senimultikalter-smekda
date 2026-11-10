<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Seni Multikalter</title>
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
</head>

<body>


    {{-- ================= DAFTAR ================= --}}
    <main class="daftar-page">

        {{-- ================= BAGIAN KIRI ================= --}}
        <section class="daftar-left">
            <div class="left-content">
                <div class="logo-container">
                    <img id="logoPreview" src="{{ asset('img/logoseni26.jpeg') }}" alt="Logo Seni Multikalter">
                </div>

                <h1>Seni Multikalter</h1>
                <p class="tagline">“Wadahnya Para Seniman”</p>
                <p class="left-description">
                    Silakan lengkapi data diri kalian untuk membuat akun dan menjadi bagian dari Seni Multikalter.
                </p>
            </div>
        </section>

        {{-- ================= BAGIAN KANAN ================= --}}
        <section class="daftar-right">
            <div class="daftar-card">

                <div class="card-header">
                    <h3>Daftar Akun</h3>
                    <p class="daftar-subtitle">Buat akun untuk melanjutkan</p>
                </div>

                {{-- PESAN ERROR / SUCCESS --}}
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

                {{-- FORM --}}
                <form id="registerForm" method="POST" action="{{ route('register.process') }}">
                    @csrf

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    {{-- USERNAME --}}
                    <div class="form-group">
                        <label for="regUsername">Username</label>
                        <input type="text" id="regUsername" name="username" placeholder="Buat username" required>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group">
                        <label for="regPassword">Password</label>
                        <div class="password-box">
                            <input type="password" id="regPassword" name="password" placeholder="Buat password" required>
                            <button type="button" class="show-password" data-target="regPassword" aria-label="Tampilkan Password">👁</button>
                        </div>
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="form-group">
                        <label for="confirmPassword">Konfirmasi Password</label>
                        <div class="password-box">
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Ulangi password" required>
                            <button type="button" class="show-password" data-target="confirmPassword" aria-label="Tampilkan Konfirmasi Password">👁</button>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="daftar-button">Daftar Sekarang</button>
                </form>

                {{-- PESAN JAVASCRIPT --}}
                <p id="registerMessage" class="register-message"></p>

                {{-- LOGIN LINK --}}
                <p class="register-text">
                    Sudah punya akun?
                    <a href="{{ route('user.login') }}" class="{{ request()->routeIs('user.login') ? 'active' : '' }}">
                        Login di sini
                    </a>
                </p>

            </div>
        </section>

    </main>
    {{-- JAVASCRIPT --}}
    <script src="{{ asset('js/user/daftar.js') }}"></script>

</body>

</html>