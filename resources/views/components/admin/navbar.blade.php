<header
    class="fixed top-0 left-0 right-0 h-[72px] bg-[#4A0000] text-white flex items-center justify-between px-4 md:px-6 shadow-lg z-50">

    {{-- =====================================================
    KIRI
    ====================================================== --}}
    <div class="flex items-center gap-4">

        {{-- TOMBOL SIDEBAR --}}
        <button type="button" @click="sidebarOpen = !sidebarOpen"
            class="relative z-[60] w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10 transition duration-200 focus:outline-none"
            aria-label="Buka atau tutup sidebar">

            {{-- ICON HAMBURGER --}}
            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>


            {{-- ICON X --}}
            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </button>


        {{-- NAMA WEBSITE --}}
        <div class="hidden sm:block">

            <h1 class="font-bold text-base md:text-lg">
                Seni Multikalter
            </h1>

            <p class="text-xs text-white/60">
                Admin Panel
            </p>

        </div>

    </div>


    {{-- =====================================================
    KANAN
    ====================================================== --}}
    <div class="flex items-center gap-3">

        {{-- NAMA ADMIN --}}
        <div class="text-right hidden sm:block">

            <p class="font-semibold text-sm">
                {{ Auth::user()->nama ?? 'Admin' }}
            </p>

            <p class="text-xs text-white/60">
                admin utama
            </p>

        </div>


        {{-- FOTO / ICON ADMIN --}}
        <div class="w-10 h-10 rounded-full bg-[#330000] border border-white/40 flex items-center justify-center">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0
                       4 4 0 018 0z
                       M12 14a7 7 0 00-7 7h14
                       a7 7 0 00-7-7z" />

            </svg>

        </div>

    </div>

</header>