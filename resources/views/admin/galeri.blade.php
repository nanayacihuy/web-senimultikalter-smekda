<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Galeri Admin | Seni Multikalter</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar-fixed {
            width: 256px;
            position: fixed;
            top: 72px;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 256px;
            padding-top: 72px;
            min-height: 100vh;
        }

        .modal-bg {
            background: rgba(0, 0, 0, 0.55);
        }

        @media (max-width: 768px) {
            .sidebar-fixed {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
            }
        }
    </style>
</head>

<body class="bg-[#f8f3ec]">

    {{-- =====================================================
        NAVBAR ADMIN
    ====================================================== --}}
    @include('components.admin.navbar')


    {{-- =====================================================
        SIDEBAR ADMIN
    ====================================================== --}}
    @include('components.admin.sidebar')


    {{-- =====================================================
        MAIN CONTENT
    ====================================================== --}}
    <main class="main-content">

        <div class="p-6 md:p-8">

            {{-- =================================================
                HEADER
            ================================================== --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div>
                    <h1 class="text-3xl font-bold text-[#560101]">
                        Galeri
                    </h1>

                    <p class="text-gray-600 mt-1">
                        Kelola foto galeri Seni Multikalter.
                    </p>
                </div>

                {{-- Tombol Tambah --}}
                <button
                    type="button"
                    onclick="openAddModal()"
                    class="bg-[#560101] hover:bg-[#3f0000] text-white px-5 py-3 rounded-lg font-semibold transition">
                    + Tambah Galeri
                </button>

            </div>


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}
            @if(session('success'))
                <div
                    class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif


            {{-- =================================================
                ERROR MESSAGE
            ================================================== --}}
            @if($errors->any())
                <div
                    class="mb-5 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">

                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif


            {{-- =================================================
                SEARCH & FILTER
            ================================================== --}}
            <div class="bg-white rounded-xl shadow-sm p-5 mb-6">

                <form
                    action="{{ route('admin.galeri') }}"
                    method="GET"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Search --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Cari Galeri
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari judul atau kategori..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#560101]">
                    </div>


                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Upload
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#560101]">
                    </div>


                    {{-- Button --}}
                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="bg-[#560101] hover:bg-[#3f0000] text-white px-5 py-2.5 rounded-lg font-semibold">
                            Cari
                        </button>

                        <a
                            href="{{ route('admin.galeri') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-semibold">
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- =================================================
                TABLE
            ================================================== --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-[#9E6B6B] text-white">

                            <tr>

                                <th class="px-5 py-4 text-sm font-semibold">
                                    No
                                </th>

                                <th class="px-5 py-4 text-sm font-semibold">
                                    Foto
                                </th>

                                <th class="px-5 py-4 text-sm font-semibold">
                                    Judul Galeri
                                </th>

                                <th class="px-5 py-4 text-sm font-semibold">
                                    Kategori
                                </th>

                                <th class="px-5 py-4 text-sm font-semibold">
                                    Tanggal
                                </th>

                                <th class="px-5 py-4 text-sm font-semibold text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            @forelse($galeri as $index => $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- No --}}
                                    <td class="px-5 py-4 text-gray-700">
                                        {{ $galeri->firstItem() + $index }}
                                    </td>


                                    {{-- FOTO --}}
                                    <td class="px-5 py-4">

                                        @if($item->foto)

                                            <img
                                                src="{{ asset('uploads/galeri/' . $item->foto) }}"
                                                alt="{{ $item->judul_galeri }}"
                                                class="w-20 h-16 object-cover rounded-lg border border-gray-200"
                                                onerror="this.onerror=null; this.src='https://via.placeholder.com/150?text=No+Image';">

                                        @else

                                            <div
                                                class="w-20 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500">
                                                Tidak ada foto
                                            </div>

                                        @endif

                                    </td>


                                    {{-- JUDUL --}}
                                    <td class="px-5 py-4">

                                        <p class="font-semibold text-[#560101]">
                                            {{ $item->judul_galeri }}
                                        </p>

                                    </td>


                                    {{-- KATEGORI --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-block bg-[#ecdcc3] text-[#560101] px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $item->kategori }}
                                        </span>

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td class="px-5 py-4 text-gray-600">

                                        {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d M Y') }}

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="px-5 py-4">

                                        <div class="flex justify-center gap-2">

                                            {{-- EDIT --}}
                                            <button
                                                type="button"
                                                onclick='openEditModal(
                                                    @json($item->id_galeri),
                                                    @json($item->judul_galeri),
                                                    @json($item->kategori),
                                                    @json($item->tanggal_upload),
                                                    @json($item->foto)
                                                )'
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                                                Edit
                                            </button>


                                            {{-- DELETE --}}
                                            <form
                                                action="{{ route('admin.galeri.destroy', $item->id_galeri) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-5 py-10 text-center text-gray-500">

                                        Belum ada data galeri.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                @if($galeri->hasPages())

                    <div class="px-5 py-4 border-t">
                        {{ $galeri->links() }}
                    </div>

                @endif

            </div>

        </div>

    </main>



    {{-- =====================================================
        MODAL TAMBAH GALERI
    ====================================================== --}}
    <div
        id="addModal"
        class="fixed inset-0 modal-bg hidden items-center justify-center z-50 p-4">

        <div
            class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

            {{-- Header Modal --}}
            <div class="flex items-center justify-between px-6 py-4 border-b">

                <h2 class="text-xl font-bold text-[#560101]">
                    Tambah Galeri
                </h2>

                <button
                    type="button"
                    onclick="closeAddModal()"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>

            </div>


            {{-- Form --}}
            <form
                action="{{ route('admin.galeri.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="p-6 space-y-5">

                    {{-- Judul --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Galeri
                        </label>

                        <input
                            type="text"
                            name="judul_galeri"
                            value="{{ old('judul_galeri') }}"
                            placeholder="Masukkan judul galeri"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                    </div>


                    {{-- Kategori --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option value="Tari Tradisi">
                                Tari Tradisi
                            </option>

                            <option value="Modern Dance">
                                Modern Dance
                            </option>

                            <option value="Vokal">
                                Vokal
                            </option>

                            <option value="Kabaret">
                                Kabaret
                            </option>

                            <option value="Angklung & Musik">
                                Angklung & Musik
                            </option>

                            <option value="Foto Bersama">
                                Foto Bersama
                            </option>

                        </select>

                    </div>


                    {{-- Tanggal --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Upload
                        </label>

                        <input
                            type="date"
                            name="tanggal_upload"
                            value="{{ old('tanggal_upload', date('Y-m-d')) }}"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                    </div>


                    {{-- FOTO --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            required
                            onchange="previewAddImage(event)"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        <p class="text-xs text-gray-500 mt-2">
                            Format: JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
                        </p>

                    </div>


                    {{-- Preview Foto --}}
                    <div id="addPreviewContainer" class="hidden">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Preview Foto
                        </p>

                        <img
                            id="addPreview"
                            src=""
                            alt="Preview"
                            class="w-full max-h-64 object-cover rounded-lg border">

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-4 border-t flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeAddModal()"
                        class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-semibold">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-[#560101] hover:bg-[#3f0000] text-white rounded-lg font-semibold">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- =====================================================
        MODAL EDIT GALERI
    ====================================================== --}}
    <div
        id="editModal"
        class="fixed inset-0 modal-bg hidden items-center justify-center z-50 p-4">

        <div
            class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b">

                <h2 class="text-xl font-bold text-[#560101]">
                    Edit Galeri
                </h2>

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                    &times;
                </button>

            </div>


            {{-- FORM EDIT --}}
            <form
                id="editForm"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    {{-- Judul --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Galeri
                        </label>

                        <input
                            type="text"
                            id="editJudul"
                            name="judul_galeri"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                    </div>


                    {{-- Kategori --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>

                        <select
                            id="editKategori"
                            name="kategori"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                            <option value="Tari Tradisi">
                                Tari Tradisi
                            </option>

                            <option value="Modern Dance">
                                Modern Dance
                            </option>

                            <option value="Vokal">
                                Vokal
                            </option>

                            <option value="Kabaret">
                                Kabaret
                            </option>

                            <option value="Angklung & Musik">
                                Angklung & Musik
                            </option>

                            <option value="Foto Bersama">
                                Foto Bersama
                            </option>

                        </select>

                    </div>


                    {{-- Tanggal --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Upload
                        </label>

                        <input
                            type="date"
                            id="editTanggal"
                            name="tanggal_upload"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#560101]">

                    </div>


                    {{-- FOTO LAMA --}}
                    <div id="oldImageContainer">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Foto Saat Ini
                        </p>

                        <img
                            id="oldImage"
                            src=""
                            alt="Foto saat ini"
                            class="w-full max-h-64 object-cover rounded-lg border">

                    </div>


                    {{-- FOTO BARU --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            Ganti Foto
                        </label>

                        <input
                            type="file"
                            id="editFoto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            onchange="previewEditImage(event)"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        <p class="text-xs text-gray-500 mt-2">
                            Kosongkan jika tidak ingin mengganti foto.
                        </p>

                    </div>


                    {{-- Preview Foto Baru --}}
                    <div id="editPreviewContainer" class="hidden">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Preview Foto Baru
                        </p>

                        <img
                            id="editPreview"
                            src=""
                            alt="Preview"
                            class="w-full max-h-64 object-cover rounded-lg border">

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-4 border-t flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-semibold">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-[#560101] hover:bg-[#3f0000] text-white rounded-lg font-semibold">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}
    <script>

        /* =====================================================
           MODAL TAMBAH
        ===================================================== */

        function openAddModal() {

            const modal = document.getElementById('addModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function closeAddModal() {

            const modal = document.getElementById('addModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

        }


        /* =====================================================
           PREVIEW FOTO TAMBAH
        ===================================================== */

        function previewAddImage(event) {

            const file = event.target.files[0];

            const preview = document.getElementById('addPreview');

            const container = document.getElementById('addPreviewContainer');

            if (file) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    preview.src = e.target.result;

                    container.classList.remove('hidden');

                };

                reader.readAsDataURL(file);

            } else {

                preview.src = '';

                container.classList.add('hidden');

            }

        }


        /* =====================================================
           MODAL EDIT
        ===================================================== */

        function openEditModal(id, judul, kategori, tanggal, foto) {

            const modal = document.getElementById('editModal');

            const form = document.getElementById('editForm');

            const judulInput = document.getElementById('editJudul');

            const kategoriInput = document.getElementById('editKategori');

            const tanggalInput = document.getElementById('editTanggal');

            const oldImage = document.getElementById('oldImage');

            const oldImageContainer = document.getElementById('oldImageContainer');

            const editFoto = document.getElementById('editFoto');

            const editPreviewContainer =
                document.getElementById('editPreviewContainer');

            const editPreview =
                document.getElementById('editPreview');


            /* Action form */

            form.action = "{{ url('/admin/galeri') }}/" + id;


            /* Isi data */

            judulInput.value = judul;

            kategoriInput.value = kategori;

            tanggalInput.value = tanggal;


            /* Reset input foto */

            editFoto.value = '';

            editPreview.src = '';

            editPreviewContainer.classList.add('hidden');


            /* Foto lama */

            if (foto) {

                oldImage.src =
                    "{{ asset('uploads/galeri') }}/" + foto;

                oldImageContainer.classList.remove('hidden');

            } else {

                oldImage.src = '';

                oldImageContainer.classList.add('hidden');

            }


            /* Tampilkan modal */

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function closeEditModal() {

            const modal = document.getElementById('editModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

        }


        /* =====================================================
           PREVIEW FOTO EDIT
        ===================================================== */

        function previewEditImage(event) {

            const file = event.target.files[0];

            const preview = document.getElementById('editPreview');

            const container =
                document.getElementById('editPreviewContainer');

            if (file) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    preview.src = e.target.result;

                    container.classList.remove('hidden');

                };

                reader.readAsDataURL(file);

            } else {

                preview.src = '';

                container.classList.add('hidden');

            }

        }


        /* =====================================================
           TUTUP MODAL KETIKA KLIK AREA LUAR
        ===================================================== */

        document.getElementById('addModal').addEventListener('click', function(e) {

            if (e.target === this) {

                closeAddModal();

            }

        });


        document.getElementById('editModal').addEventListener('click', function(e) {

            if (e.target === this) {

                closeEditModal();

            }

        });


        /* =====================================================
           ESC UNTUK MENUTUP MODAL
        ===================================================== */

        document.addEventListener('keydown', function(e) {

            if (e.key === 'Escape') {

                closeAddModal();

                closeEditModal();

            }

        });

    </script>

</body>

</html>