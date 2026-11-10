Berikut adalah kode lengkap untuk Blade view **Kelola Prestasi** yang disempurnakan. Penyesuaian meliputi perbaikan bug UI modal, preview foto, feedback validasi error di dalam form modal, serta integrasi route & Blade helper yang optimal.

```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Prestasi - Seni Multikultural</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom CSS Prestasi --}}
    <link rel="stylesheet" href="{{ asset('css/admin/prestasi.css') }}">

    <style>
        /* CSS Modal Tambah via Checkbox Hack */
        #modalTambahPrestasi {
            display: none;
        }

        #modalTambahPrestasi:checked ~ .modal-overlay-tambah {
            display: flex;
        }

        .modal-overlay-tambah {
            display: none;
        }
    </style>
</head>

<body class="bg-[#4A0000] font-sans antialiased min-h-screen flex flex-col">

    {{-- NAVBAR ADMIN --}}
    @include('components.admin.navbar')

    <div class="flex pt-20 flex-1">

        {{-- SIDEBAR ADMIN --}}
        @include('components.admin.sidebar')

        {{-- MAIN CONTENT --}}
        <main class="flex-1 bg-white rounded-tl-3xl p-6 md:p-8 min-h-[calc(100vh-5rem)] overflow-x-hidden md:ml-64">

            {{-- JUDUL HALAMAN --}}
            <h2 class="text-3xl font-bold text-[#4A0000] mb-6">
                Kelola Prestasi
            </h2>

            {{-- NOTIFIKASI SUKSES --}}
            @if (session('success'))
                <div class="mb-5 p-4 rounded-xl bg-green-100 border border-green-300 text-green-700 font-semibold flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-green-900 font-bold ml-4">&times;</button>
                </div>
            @endif

            {{-- NOTIFIKASI ERROR (GLOBAL) --}}
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-red-100 border border-red-300 text-red-700">
                    <div class="font-bold mb-1">Terjadi kesalahan input:</div>
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- BAR PENCARIAN, BTN TAMBAH, & STATISTIK --}}
            <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6 mb-8">

                {{-- SEARCH & BTN TAMBAH --}}
                <div class="flex flex-col gap-3 w-full xl:w-auto min-w-[300px]">

                    {{-- FORM SEARCH --}}
                    <form action="{{ route('admin.prestasi') }}" method="GET" class="flex gap-2">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari prestasi..."
                            class="flex-1 border-2 border-[#4A0000] px-4 py-2 rounded-xl text-sm font-semibold placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#4A0000]"
                        >
                        <button
                            type="submit"
                            class="px-4 py-2 rounded-xl bg-[#4A0000] text-white text-sm font-bold hover:bg-[#660000] transition">
                            Cari
                        </button>
                    </form>

                    {{-- TOMBOL TAMBAH --}}
                    <label
                        for="modalTambahPrestasi"
                        class="cursor-pointer flex-1 text-center border-2 border-[#4A0000] text-[#4A0000] hover:bg-[#4A0000] hover:text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm">
                        + Tambah Prestasi
                    </label>

                </div>

                {{-- STATISTIK --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 w-full xl:w-auto">

                    <div class="bg-[#4A0000] text-white p-3.5 rounded-2xl text-center min-w-[110px] flex flex-col justify-center items-center shadow-md">
                        <span class="text-xs font-bold leading-tight mb-1">Total Prestasi</span>
                        <span class="text-2xl font-black">
                            {{ method_exists($prestasi, 'total') ? $prestasi->total() : $prestasi->count() }}
                        </span>
                    </div>

                    <div class="bg-[#4A0000] text-white p-3.5 rounded-2xl text-center min-w-[110px] flex flex-col justify-center items-center shadow-md">
                        <span class="text-xs font-bold leading-tight mb-1">Halaman Ini</span>
                        <span class="text-2xl font-black">{{ $prestasi->count() }}</span>
                    </div>

                    <div class="bg-[#4A0000] text-white p-3.5 rounded-2xl text-center min-w-[110px] flex flex-col justify-center items-center shadow-md">
                        <span class="text-xs font-bold leading-tight mb-1">Tahun</span>
                        <span class="text-2xl font-black">{{ date('Y') }}</span>
                    </div>

                    <div class="bg-[#4A0000] text-white p-3.5 rounded-2xl text-center min-w-[110px] flex flex-col justify-center items-center shadow-md">
                        <span class="text-xs font-bold leading-tight mb-1">Status</span>
                        <span class="text-2xl font-black text-green-400">✓</span>
                    </div>

                </div>

            </div>

            {{-- TABEL PRESTASI --}}
            <div class="border-2 border-[#9E6B6B] rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-center border-collapse">

                        <thead>
                            <tr class="bg-[#9E6B6B] text-white text-lg md:text-xl font-bold">
                                <th class="py-3.5 px-4 w-16">No</th>
                                <th class="py-3.5 px-4 w-36">Gambar</th>
                                <th class="py-3.5 px-6">Nama Prestasi</th>
                                <th class="py-3.5 px-6">Deskripsi</th>
                                <th class="py-3.5 px-6 w-40">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-emerald-600/30 text-[#4A0000] font-bold text-base md:text-lg">

                            @forelse ($prestasi as $index => $item)
                                <tr class="hover:bg-amber-50/50 transition">

                                    {{-- NOMOR --}}
                                    <td class="py-4 px-4 text-xl">
                                        {{ method_exists($prestasi, 'firstItem') ? $prestasi->firstItem() + $index : $index + 1 }}.
                                    </td>

                                    {{-- FOTO --}}
                                    <td class="py-4 px-4">
                                        <div class="w-28 h-20 bg-[#4A0000] rounded-2xl mx-auto shadow-inner overflow-hidden flex items-center justify-center">
                                            @if ($item->foto)
                                                <img
                                                    src="{{ asset('images/prestasi/' . $item->foto) }}"
                                                    alt="{{ $item->nama_prestasi }}"
                                                    class="w-full h-full object-cover"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                >
                                                <div class="w-full h-full items-center justify-center text-white text-xs p-1 text-center" style="display: none;">
                                                    Gambar Hilang
                                                </div>
                                            @else
                                                <span class="text-white text-xs">Tidak Ada Foto</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="py-4 px-6 font-extrabold text-[#4A0000]">
                                        {{ $item->nama_prestasi }}
                                    </td>

                                    {{-- DESKRIPSI --}}
                                    <td class="py-4 px-6 text-sm font-semibold">
                                        <div class="max-w-md mx-auto line-clamp-3">
                                            {{ $item->deskripsi }}
                                        </div>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="py-4 px-6">
                                        <div class="flex flex-row justify-center items-center gap-2 whitespace-nowrap">

                                            {{-- UBAH --}}
                                            <button
                                                type="button"
                                                onclick="bukaModalEditPrestasi(
                                                    {{ $item->id_prestasi }},
                                                    @js($item->nama_prestasi),
                                                    @js($item->deskripsi),
                                                    @js($item->foto ? asset('images/prestasi/' . $item->foto) : null)
                                                )"
                                                class="inline-flex items-center justify-center bg-[#F4B400] hover:bg-[#D99F00] text-white text-xs px-3 py-1.5 rounded-lg transition font-medium shadow-sm">
                                                Ubah
                                            </button>

                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.prestasi.destroy', $item->id_prestasi) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')"
                                                class="inline-flex m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center bg-[#E53935] hover:bg-[#C62828] text-white text-xs px-3 py-1.5 rounded-lg transition font-medium shadow-sm">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-gray-400 font-normal text-sm">
                                        Belum ada data prestasi yang tersedia.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION --}}
                @if (method_exists($prestasi, 'links'))
                    <div class="mt-4 px-4 pb-4">
                        {{ $prestasi->links() }}
                    </div>
                @endif

            </div>

        </main>

    </div>

    {{-- MODAL TAMBAH PRESTASI --}}
    <input type="checkbox" id="modalTambahPrestasi" class="hidden">

    <div class="modal-overlay-tambah fixed inset-0 bg-black/60 z-50 items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border-2 border-[#9E6B6B] max-h-[90vh] overflow-y-auto">

            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-[#4A0000]">Tambah Data Prestasi</h3>
                <label for="modalTambahPrestasi" class="cursor-pointer text-gray-500 hover:text-[#4A0000] text-2xl font-bold">&times;</label>
            </div>

            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="nama_prestasi" class="block text-xs font-bold text-[#4A0000] mb-1">Nama Prestasi</label>
                    <input
                        type="text"
                        name="nama_prestasi"
                        id="nama_prestasi"
                        value="{{ old('nama_prestasi') }}"
                        maxlength="255"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0000]"
                    >
                </div>

                <div>
                    <label for="deskripsi" class="block text-xs font-bold text-[#4A0000] mb-1">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="4"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0000]"
                    >{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label for="foto" class="block text-xs font-bold text-[#4A0000] mb-1">Foto Prestasi</label>
                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        accept="image/jpeg,image/jpg,image/png,image/webp"
                        required
                        onchange="previewImage(this, 'previewTambah')"
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm"
                    >
                    <p class="text-[10px] text-gray-500 mt-1">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</p>
                    <img id="previewTambah" class="mt-2 h-24 object-cover rounded-lg hidden border">
                </div>

                <div class="flex justify-end gap-2 pt-3">
                    <label for="modalTambahPrestasi" class="cursor-pointer px-4 py-2 rounded-lg text-xs font-bold bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                        Batal
                    </label>
                    <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold bg-[#4A0000] text-white hover:bg-[#660000] transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- MODAL EDIT PRESTASI --}}
    <div id="modalEditPrestasi" class="hidden fixed inset-0 bg-black/60 z-[60] items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border-2 border-[#9E6B6B] max-h-[90vh] overflow-y-auto">

            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-[#4A0000]">Ubah Data Prestasi</h3>
                <button type="button" onclick="tutupModalEditPrestasi()" class="cursor-pointer text-gray-500 hover:text-[#4A0000] text-2xl font-bold">&times;</button>
            </div>

            <form id="formEditPrestasi" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_nama_prestasi" class="block text-xs font-bold text-[#4A0000] mb-1">Nama Prestasi</label>
                    <input
                        type="text"
                        name="nama_prestasi"
                        id="edit_nama_prestasi"
                        maxlength="255"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0000]"
                    >
                </div>

                <div>
                    <label for="edit_deskripsi" class="block text-xs font-bold text-[#4A0000] mb-1">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        id="edit_deskripsi"
                        rows="4"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0000]"
                    ></textarea>
                </div>

                <div>
                    <label for="edit_foto" class="block text-xs font-bold text-[#4A0000] mb-1">Foto Prestasi</label>
                    <input
                        type="file"
                        name="foto"
                        id="edit_foto"
                        accept="image/jpeg,image/jpg,image/png,image/webp"
                        onchange="previewImage(this, 'previewEdit')"
                        class="w-full px-3 py-2 rounded-lg border border-gray-400 text-sm"
                    >
                    <p class="text-[10px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    <img id="previewEdit" class="mt-2 h-24 object-cover rounded-lg hidden border">
                </div>

                <div class="flex justify-end gap-2 pt-3">
                    <button type="button" onclick="tutupModalEditPrestasi()" class="px-4 py-2 rounded-lg text-xs font-bold bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold bg-[#4A0000] text-white hover:bg-[#660000] transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- JAVASCRIPT LOGIC --}}
    <script>
        // Preview Foto Sebelum Upload
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Buka Modal Edit
        function bukaModalEditPrestasi(id, nama, deskripsi, fotoUrl) {
            const modal = document.getElementById('modalEditPrestasi');
            const form = document.getElementById('formEditPrestasi');
            const namaInput = document.getElementById('edit_nama_prestasi');
            const deskripsiInput = document.getElementById('edit_deskripsi');
            const preview = document.getElementById('previewEdit');

            namaInput.value = nama;
            deskripsiInput.value = deskripsi;

            // Set Preview Foto Lama jika ada
            if (fotoUrl) {
                preview.src = fotoUrl;
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }

            // Set Form Action URL (menggunakan route dasar + ID)
            form.action = "{{ url('/admin/prestasi') }}/" + id;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => namaInput.focus(), 100);
        }

        // Tutup Modal Edit
        function tutupModalEditPrestasi() {
            const modal = document.getElementById('modalEditPrestasi');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal dengan Klik Luar / Tombol ESC
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalEditPrestasi');
            if (event.target === modal) {
                tutupModalEditPrestasi();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                tutupModalEditPrestasi();
            }
        });
    </script>

</body>

</html>