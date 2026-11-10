 <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
<aside class="sidebar" id="sidebar">

    <nav class="sidebar-menu">

        {{-- DASHBOARD --}}
        <a href="{{ url('/admin/beranda') }}"
           class="menu-item {{ request()->is('admin/beranda') ? 'active' : '' }}">

            <span class="menu-icon">⌂</span>
            <span class="menu-text">Dashboard</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- PROFILE --}}
        <a href="{{ url('/admin/profile') }}"
           class="menu-item {{ request()->is('admin/profile') ? 'active' : '' }}">

            <span class="menu-icon">♙</span>
            <span class="menu-text">Profile</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- ORGANIGRAM --}}
        <a href="{{ url('/admin/organigram') }}"
           class="menu-item {{ request()->is('admin/organigram') ? 'active' : '' }}">

            <span class="menu-icon">♧</span>
            <span class="menu-text">Organigram</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- ANGGOTA --}}
        <a href="{{ url('/anggota') }}"
           class="menu-item {{ request()->is('anggota') ? 'active' : '' }}">

            <span class="menu-icon">♙</span>
            <span class="menu-text">Anggota</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- BERITA --}}
        <a href="{{ url('/admin/berita') }}"
           class="menu-item {{ request()->is('admin/berita') ? 'active' : '' }}">

            <span class="menu-icon">▤</span>
            <span class="menu-text">Berita</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- PRESTASI --}}
        <a href="{{ url('/admin/prestasi') }}"
           class="menu-item {{ request()->is('admin/prestasi') ? 'active' : '' }}">

            <span class="menu-icon">♕</span>
            <span class="menu-text">Prestasi</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- AGENDA --}}
        <a href="{{ url('/admin/agenda') }}"
           class="menu-item {{ request()->is('admin/agenda') ? 'active' : '' }}">

            <span class="menu-icon">▣</span>
            <span class="menu-text">Agenda</span>
            <span class="menu-arrow">›</span>

        </a>


        {{-- GALERI --}}
        <a href="{{ url('/admin/galeri') }}"
           class="menu-item {{ request()->is('admin/galeri') ? 'active' : '' }}">

            <span class="menu-icon">▧</span>
            <span class="menu-text">Galeri</span>
            <span class="menu-arrow">›</span>

        </a>

    </nav>


    {{-- LOGIN USER --}}
    <a href="{{ url('/login') }}" class="login-user">

        <span class="menu-icon">↪</span>

        <span class="menu-text">
            Login User
        </span>

    </a>

</aside>
