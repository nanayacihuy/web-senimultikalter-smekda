{{-- =========================================================
SIDEBAR ADMIN
========================================================= --}}

{{-- OVERLAY MOBILE --}}
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
    class="fixed inset-0 z-30 bg-black/40 md:hidden" style="display: none;"></div>


{{-- =========================================================
SIDEBAR
========================================================= --}}
<aside class="fixed top-[72px] left-0 z-40
           w-64 h-[calc(100vh-72px)]
           bg-[#4A0000] text-white
           flex flex-col
           shadow-xl
           overflow-y-auto
           transition-transform duration-300 ease-in-out
           md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">


    {{-- =====================================================
    BRAND
    ====================================================== --}}
    <div class="flex items-center gap-3 px-5 py-6 border-b border-white/10">

        {{-- LOGO --}}
        <div class="w-11 h-11 shrink-0 rounded-full
                   bg-white text-[#4A0000]
                   flex items-center justify-center
                   font-bold">
            SM
        </div>


        {{-- NAMA --}}
        <div class="min-w-0">

            <h2 class="font-bold text-sm leading-tight">
                Seni Multikalter
            </h2>

            <span class="text-xs text-white/60">
                Admin Panel
            </span>

        </div>

    </div>



    {{-- =====================================================
    MENU UTAMA
    ====================================================== --}}
    <nav class="flex-1 p-4 space-y-1">

        @php

            $menu = [

                [
                    'route' => 'admin.dashboard',
                    'label' => 'Dashboard',
                    'is' => 'admin.dashboard'
                ],

                [
                    'route' => 'admin.profile',
                    'label' => 'Profile',
                    'is' => 'admin.profile'
                ],

                [
                    'route' => 'admin.organigram',
                    'label' => 'Organigram',
                    'is' => 'admin.organigram'
                ],

                [
                    'route' => 'admin.anggota',
                    'label' => 'Anggota',
                    'is' => 'admin.anggota'
                ],

                [
                    'route' => 'admin.berita',
                    'label' => 'Berita',
                    'is' => 'admin.berita'
                ],

                [
                    'route' => 'admin.prestasi',
                    'label' => 'Prestasi',
                    'is' => 'admin.prestasi'
                ],

                [
                    'route' => 'admin.agenda',
                    'label' => 'Agenda',
                    'is' => 'admin.agenda'
                ],

                [
                    'route' => 'admin.galeri',
                    'label' => 'Galeri',
                    'is' => 'admin.galeri'
                ],

            ];


            $icons = [

                'admin.dashboard' =>
                    'M3 12l9-9 9 9M5 10v10h14V10',

                'admin.profile' =>
                    'M12 12a4 4 0 100-8 4 4 0 000 8z
                                 M4 21a8 8 0 0116 0',

                'admin.organigram' =>
                    'M12 3v4
                                 M6 8h12
                                 M6 8v4
                                 M18 8v4
                                 M6 12H4v5h4v-5H6
                                 M18 12h2v5h-4v-5h2
                                 M12 12v5h-2v4h4v-4h-2',

                'admin.anggota' =>
                    'M16 21v-2
                                 a4 4 0 00-4-4H6
                                 a4 4 0 00-4 4v2
                                 M9 11a4 4 0 100-8
                                 4 4 0 000 8z
                                 M22 21v-2
                                 a4 4 0 00-3-3.87
                                 M16 3.13a4 4 0 010 7.75',

                'admin.berita' =>
                    'M4 4h16v16H4z
                                 M8 8h8
                                 M8 12h8
                                 M8 16h5',

                'admin.prestasi' =>
                    'M8 21h8
                                 M12 17v4
                                 M7 4h10v5
                                 a5 5 0 01-10 0V4z
                                 M7 7H4a3 3 0 003 3
                                 M17 7h3a3 3 0 01-3 3',

            ];

        @endphp



        {{-- =================================================
        LOOP MENU
        ================================================== --}}
        @foreach ($menu as $item)

            <a href="{{ route($item['route']) }}" class="flex items-center gap-3
                           px-4 py-2.5
                           rounded-xl
                           text-sm font-medium
                           transition duration-200

                           {{ request()->routeIs($item['is'])
            ? 'bg-white text-[#4A0000]'
            : 'text-white/85 hover:bg-white/10' }}">


                {{-- =========================================
                ICON
                ========================================== --}}

                @if ($item['is'] === 'admin.agenda')

                    {{-- ICON AGENDA --}}
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <rect x="3" y="4" width="18" height="17" rx="2" />

                        <path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18" />

                    </svg>


                @elseif ($item['is'] === 'admin.galeri')

                    {{-- ICON GALERI --}}
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <rect x="3" y="3" width="18" height="18" rx="2" />

                        <circle cx="8.5" cy="8.5" r="1.5" />

                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21" />

                    </svg>


                @else

                    {{-- ICON MENU LAIN --}}
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$item['is']] }}" />

                    </svg>

                @endif


                {{-- LABEL --}}
                <span>
                    {{ $item['label'] }}
                </span>

            </a>

        @endforeach

    </nav>



    {{-- =====================================================
    AKUN & LOGOUT
    ====================================================== --}}
    <div class="p-4 border-t border-white/10 space-y-1">


        {{-- =================================================
        AKUN SAYA
        ================================================== --}}
        <a href="{{ route('admin.akun') }}" class="flex items-center gap-3
                   px-4 py-2.5
                   rounded-xl
                   text-sm font-medium
                   transition duration-200

                   {{ request()->routeIs('admin.akun')
    ? 'bg-white text-[#4A0000]'
    : 'text-white/85 hover:bg-white/10' }}">

            <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804
                       A9 9 0 1118.88 17.8
                       M15 10a3 3 0 11-6 0
                       3 3 0 016 0z" />

            </svg>


            <span>
                Akun Saya
            </span>

        </a>



        {{-- =================================================
        LOGOUT
        ================================================== --}}
        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="w-full
                       flex items-center gap-3
                       px-4 py-2.5
                       rounded-xl
                       text-sm font-medium
                       text-white/85
                       hover:bg-white/10
                       transition duration-200">

                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7
                           m6 5v1a3 3 0 01-3 3H6
                           a3 3 0 01-3-3V6
                           a3 3 0 013-3h4
                           a3 3 0 013 3v1" />

                </svg>


                <span>
                    Logout
                </span>

            </button>

        </form>



        {{-- =================================================
        COPYRIGHT
        ================================================== --}}
        <div class="pt-2 px-4 text-[10px] text-white/40">
            © {{ date('Y') }} Seni Multikalter
        </div>

    </div>

</aside>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>