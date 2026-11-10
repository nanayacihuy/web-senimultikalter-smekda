<link rel="stylesheet"href="{{ asset('css/navbar.css') }}">
<nav class="navbar" id="navbar">
    <!-- ================= LOGO ================= -->
    <div class="navbar-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logoseni26.jpeg') }}"alt="Logo Seni Multikalter">
        </a>
    </div>
    <!-- ================= MENU ================= -->
    <div class="navbar-menu" id="navbarMenu">
        <a href="{{ route('user.beranda') }}" class="{{ request()->routeIs('user.beranda') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">Profile</a>
        <a href="{{ route('user.organigram') }}" class="{{ request()->routeIs('user.organigram') ? 'active' : '' }}">Organigram</a>
        <a href="{{ route('user.galeri') }}" class="{{ request()->routeIs('user.galeri') ? 'active' : '' }}">Galeri</a>
        <a href="{{ route('user.berita') }}"class="{{ request()->routeIs('user.berita') ? 'active' : '' }}">Berita</a>
        <a href="{{ route('user.prestasi') }}"class="{{ request()->routeIs('user.prestasi') ? 'active' : '' }}">Prestasi</a>
        <a href="{{ route('user.agenda') }}"class="{{ request()->routeIs('user.agenda') ? 'active' : '' }}">Agenda</a>
        <a href="{{ route('user.anggota') }}" class="{{ request()->routeIs('user.anggota') ? 'active' : '' }}">Anggota</a>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">Admin Panel</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline-block; margin: 0;">
                @csrf
                <button type="submit" style="background: transparent; border: none; color: inherit; font: inherit; font-size: inherit; font-weight: inherit; cursor: pointer; padding: 6px 2px;"title="Keluar akun">Logout</button>
            </form>
        @else
            <a href="{{ route('user.login') }}"class="{{ request()->routeIs('user.login') ? 'active' : '' }}">Login</a>
        @endauth
</div>
    <!-- ================= HAMBURGER ================= -->
    <button class="navbar-toggle"id="navbarToggle"type="button"aria-label="Buka menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>
<script src="{{ asset('js/user/navbar.js') }}" defer></script>