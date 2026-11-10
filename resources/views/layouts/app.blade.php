<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Seni Multikalter')
    </title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}">

</head>

<body>

    <!-- NAVBAR -->

    <header class="navbar">

        <div class="navbar-logo">

            <img
                src="{{ asset('img/logo.png') }}"
                alt="Logo Seni Multikalter"
            >

        </div>


        <nav class="navbar-menu">

            <a href="{{ route('home') }}">
                Beranda
            </a>

            <a href="#">
                Profile
            </a>

            <a href="{{ route('organigram') }}"
               class="active">
                Organigram
            </a>

            <a href="#">
                Galeri
            </a>

            <a href="#">
                Berita
            </a>

            <a href="#">
                Prestasi
            </a>

            <a href="#">
                Agenda
            </a>

            <a href="#">
                Anggota
            </a>

        </nav>

    </header>


    <!-- CONTENT -->

    <main>

        @yield('content')

    </main>


    <!-- FOOTER -->

    <footer class="footer">

        <div class="footer-brand">

            <img
                src="{{ asset('img/logo.png') }}"
                alt="Logo"
            >

            <div>

                <h3>
                    SMKN 2 PURWAKARTA
                </h3>

                <p>
                    Wadahnya Para Seniman
                </p>

            </div>

        </div>


        <div class="footer-address">

            <h3>
                Alamat
            </h3>

            <p>
                Jln. Jend. Ahmad Yani No. 98 Nagri Tengah<br>
                Kab. Purwakarta 41114
            </p>

        </div>


        <div class="footer-social">

            <h3>
                Media Sosial
            </h3>

            <div class="social-icons">

                <a href="#">◉</a>
                <a href="#">♪</a>
                <a href="#">◎</a>

            </div>

        </div>

    </footer>

</body>

</html>