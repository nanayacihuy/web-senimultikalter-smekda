<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Seni Multikalter</title>
    
    {{-- Tailwind CSS & Lucide Icons --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full text-slate-800 antialiased bg-slate-100">

    {{-- NAVBAR & SIDEBAR ADMIN --}}
    <x-admin.navbar />
    <x-admin.sidebar />

    {{-- MAIN CONTENT --}}
    <main class="lg:pl-64 pt-24 pb-12 min-h-screen flex flex-col bg-slate-100">
        <div class="px-4 sm:px-6 lg:px-8 max-w-7xl w-full mx-auto space-y-8 flex-1">
            
            {{-- HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-200 pb-5">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Ringkasan data & aktivitas Seni Multikalter.</p>
                </div>
                <span class="text-xs font-medium text-slate-600 bg-white border border-slate-200 px-3 py-1.5 rounded-lg shadow-sm">
                    {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
                </span>
            </div>

            {{-- RINGKASAN STATISTIK (TEMA MAROON) --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="p-2.5 rounded-lg bg-rose-50 text-rose-900 border border-rose-100"><i data-lucide="users" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Anggota</p>
                        <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalAnggota }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="p-2.5 rounded-lg bg-rose-50 text-rose-900 border border-rose-100"><i data-lucide="newspaper" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Berita</p>
                        <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalBerita }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="p-2.5 rounded-lg bg-rose-50 text-rose-900 border border-rose-100"><i data-lucide="trophy" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Prestasi</p>
                        <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalPrestasi }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="p-2.5 rounded-lg bg-rose-50 text-rose-900 border border-rose-100"><i data-lucide="calendar" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Agenda</p>
                        <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalAgenda }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3 col-span-2 sm:col-span-1">
                    <div class="p-2.5 rounded-lg bg-rose-50 text-rose-900 border border-rose-100"><i data-lucide="image" class="w-5 h-5"></i></div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Galeri</p>
                        <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $totalGaleri }}</p>
                    </div>
                </div>
            </div>

            {{-- KONTEN UTAMA: BERITA & AGENDA --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- BERITA TERBARU --}}
                <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="font-bold text-slate-900 flex items-center gap-2 text-sm">
                            <i data-lucide="newspaper" class="w-4 h-4 text-rose-900"></i> Berita Terbaru
                        </h2>
                        <a href="{{ route('admin.berita') }}" class="text-xs font-semibold text-rose-900 hover:text-rose-700 transition-colors">Lihat Semua</a>
                    </div>

                    @if($berita->count() > 0)
                        <div class="divide-y divide-slate-100">
                            @foreach($berita as $item)
                                <div class="py-3.5 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                                        <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                        {{ $item->tanggal_upload ? \Carbon\Carbon::parse($item->tanggal_upload)->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <h3 class="font-semibold text-slate-800 text-sm hover:text-rose-900 transition-colors">
                                        {{ $item->judul_berita }}
                                    </h3>
                                    @if($item->deskripsi_berita)
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                            {{ strip_tags($item->deskripsi_berita) }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-6">Belum ada berita.</p>
                    @endif
                </div>

                {{-- AGENDA MENDATANG --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="font-bold text-slate-900 flex items-center gap-2 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 text-rose-900"></i> Agenda
                        </h2>
                        <a href="{{ route('admin.agenda') }}" class="text-xs font-semibold text-rose-900 hover:text-rose-700 transition-colors">Lihat Semua</a>
                    </div>

                    @if($agenda->count() > 0)
                        <div class="space-y-3">
                            @foreach($agenda as $item)
                                <div class="p-3.5 rounded-lg bg-slate-50 border border-slate-100">
                                    <h3 class="font-semibold text-slate-800 text-sm">{{ $item->nama_kegiatan }}</h3>
                                    <div class="mt-2 space-y-1.5 text-xs text-slate-500">
                                        <p class="flex items-center gap-2">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i> {{ $item->waktu ?? '-' }}
                                        </p>
                                        <p class="flex items-center gap-2">
                                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i> {{ $item->tempat ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-6">Belum ada agenda.</p>
                    @endif
                </div>

            </div>

            {{-- KONTEN BAWAH: PRESTASI & GALERI --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- PRESTASI TERBARU --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="font-bold text-slate-900 flex items-center gap-2 text-sm">
                            <i data-lucide="trophy" class="w-4 h-4 text-rose-900"></i> Prestasi Terbaru
                        </h2>
                        <a href="{{ route('admin.prestasi') }}" class="text-xs font-semibold text-rose-900 hover:text-rose-700 transition-colors">Lihat Semua</a>
                    </div>

                    @if($prestasi->count() > 0)
                        <ul class="divide-y divide-slate-100 text-sm">
                            @foreach($prestasi as $item)
                                <li class="py-3 flex items-center justify-between gap-2">
                                    <span class="font-medium text-slate-700 truncate">
                                        {{ $item->nama_prestasi ?? $item->judul_prestasi ?? 'Prestasi' }}
                                    </span>
                                    @if($item->tahun)
                                        <span class="text-xs bg-rose-50 text-rose-900 font-medium px-2.5 py-0.5 rounded border border-rose-200/60 shrink-0">
                                            {{ $item->tahun }}
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-xs text-slate-400 text-center py-6">Belum ada prestasi.</p>
                    @endif
                </div>

                {{-- GALERI TERBARU --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h2 class="font-bold text-slate-900 flex items-center gap-2 text-sm">
                            <i data-lucide="image" class="w-4 h-4 text-rose-900"></i> Dokumentasi Galeri
                        </h2>
                        <a href="{{ route('admin.galeri') }}" class="text-xs font-semibold text-rose-900 hover:text-rose-700 transition-colors">Lihat Semua</a>
                    </div>

                    @if($galeri->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($galeri as $item)
                                @if($item->judul_galeri)
                                    <span class="inline-flex items-center gap-1.5 text-xs bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg border border-slate-200">
                                        <i data-lucide="tag" class="w-3 h-3 text-slate-400"></i>
                                        {{ $item->judul_galeri }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-6">Belum ada galeri.</p>
                    @endif
                </div>

            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="border-t border-slate-200 bg-white mt-12 py-4 px-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} Seni Multikalter SMKN 2 Purwakarta.
        </footer>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>