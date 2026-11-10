<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita | Seni Multikalter</title>
    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- CSS Admin Berita --}}
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}">
</head>
<body class="bg-[#F8F3EC] min-h-screen">
    {{-- ==================================================
         NAVBAR ADMIN
    ================================================== --}}
    @include('components.admin.navbar')
    {{-- ==================================================
         SIDEBAR ADMIN
    ================================================== --}}
    @include('components.admin.sidebar')
    {{-- ==================================================
         CONTENT
    ================================================== --}}
    <main class="md:ml-[184px] pt-24 p-6">
        <div class="max-w-5xl mx-auto">
            {{-- HEADER --}}
            <div class="mb-6">
                <a href="{{ route('admin.berita') }}"
                    class="inline-flex items-center gap-2
                           text-[#560101]
                           hover:text-[#9E6B6B]
                           font-medium mb-4"> ← Kembali</a>
                <h1 class="text-2xl md:text-3xl font-bold text-[#4A0000]">Ubah Berita</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi berita yang sudah tersimpan.</p>
            </div>
            {{-- ==================================================
                 ERROR VALIDATION
            ================================================== --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100
                            border border-red-300
                            text-red-700 p-4">

                    <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- ==================================================
                 FORM EDIT
            ================================================== --}}
            <div class="bg-white rounded-2xl shadow-sm
                        border border-gray-200 p-6 md:p-8">
                <form
                    action="{{ route('admin.berita.update', $berita->id_berita) }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- JUDUL --}}
                    <div class="mb-6">
                        <label for="judul_berita" class="block text-sm font-semibold
                                   text-[#4A0000] mb-2">Judul Berita</label>
                        <input
                            type="text"
                            id="judul_berita"
                            name="judul_berita"
                            value="{{ old('judul_berita', $berita->judul_berita) }}"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#9E6B6B]"
                            required>
                    </div>
                    {{-- DESKRIPSI --}}
                    <div class="mb-6">
                        <label
                            for="deskripsi_berita"
                            class="block text-sm font-semibold
                                   text-[#4A0000] mb-2">Deskripsi Berita</label>
                        <textarea
                            id="deskripsi_berita"
                            name="deskripsi_berita"
                            rows="7"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#9E6B6B]"
                            required>{{ old('deskripsi_berita', $berita->deskripsi_berita) }}</textarea>
                    </div>
                    {{-- TANGGAL --}}
                    <div class="mb-6">
                        <label for="tanggal_upload" class="block text-sm font-semibold
                                   text-[#4A0000] mb-2">Tanggal Upload</label>
                        <input
                            type="date"
                            id="tanggal_upload"
                            name="tanggal_upload"
                            value="{{ old(
                                'tanggal_upload',
                                \Carbon\Carbon::parse($berita->tanggal_upload)->format('Y-m-d')
                            ) }}"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#9E6B6B]"
                            required>
                    </div>
                    {{-- FOTO LAMA --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-[#4A0000] mb-2">Foto Saat Ini</label>
                        @if ($berita->foto)
                            <div class="mb-4">
                                <img
                                    src="{{ asset('images/berita/' . $berita->foto) }}"
                                    alt="{{ $berita->judul_berita }}"
                                    class="w-full max-w-md h-56
                                           object-cover rounded-xl
                                           border border-gray-200">
                            </div>
                        @else
                            <p class="text-gray-500 text-sm mb-4">Belum ada foto.</p>
                        @endif
                    </div>
                    {{-- FOTO BARU --}}
                    <div class="mb-8">
                        <label for="foto"class="block text-sm font-semibold
                                   text-[#4A0000] mb-2">Ganti Foto</label>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-3
                                   bg-white"
                        >
                        <p class="text-xs text-gray-500 mt-2">
                            Kosongkan jika tidak ingin mengganti foto.
                            Maksimal 2 MB.
                        </p>
                    </div>
                    {{-- TOMBOL --}}
                    <div class="flex flex-col sm:flex-row
                                justify-end gap-3">
                        <a href="{{ route('admin.berita') }}"
                            class="px-5 py-3 rounded-lg
                                   border border-gray-300
                                   text-gray-700
                                   hover:bg-gray-100
                                   transition text-center">Batal</a>
                        <button type="submit"
                            class="px-5 py-3 rounded-lg
                                   bg-[#560101]
                                   hover:bg-[#4A0000]
                                   text-white
                                   font-medium
                                   transition">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>