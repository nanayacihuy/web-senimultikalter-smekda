<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kelola Kepengurusan - Seni Multikalter</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/admin/organigram.css') }}">

</head>

<body class="bg-[#4A0000] font-sans antialiased">

 @include('components.admin.navbar')

    <div class="flex pt-20 flex-1">

        @include('components.admin.sidebar')


    <!-- ================================
         MAIN CONTENT
    ================================= -->
    <main
        class="flex-1 p-6 md:p-8
               bg-white rounded-tl-3xl
               min-h-[calc(100vh-5rem)]
               md:ml-64">


        <!-- HEADER PAGE -->
        <div
            class="flex flex-col sm:flex-row
                   justify-between
                   items-start sm:items-center
                   gap-4 mb-8">

            <h2
                class="text-3xl font-bold text-[#4A0000]">

                Kelola kepengurusan

            </h2>


            <!-- Tombol Tambah -->
            <button
                type="button"
                id="openModal"
                class="border-2 border-[#4A0000]
                       text-[#4A0000]
                       hover:bg-[#4A0000]
                       hover:text-white
                       px-5 py-2
                       rounded-xl
                       text-sm font-bold
                       transition duration-200">

                + Tambah Anggota

            </button>

        </div>


        <!-- PESAN SUCCESS -->
        @if(session('success'))

            <div
                class="mb-6 px-4 py-3
                       rounded-xl
                       bg-green-100
                       border border-green-300
                       text-green-700
                       font-semibold">

                {{ session('success') }}

            </div>

        @endif


        <!-- ERROR VALIDATION -->
        @if($errors->any())

            <div
                class="mb-6 px-4 py-3
                       rounded-xl
                       bg-red-100
                       border border-red-300
                       text-red-700">

                <ul class="list-disc ml-5 text-sm">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- TABLE -->
        <div
            class="border-2 border-[#9E6B6B]
                   rounded-3xl
                   overflow-hidden
                   shadow-sm">

            <div class="p-4">
                <form
                    method="GET"
                    action="{{ route('admin.organigram') }}"
                    class="flex flex-col sm:flex-row gap-3"
                >
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, jabatan, atau bidang..."
                        class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#4A0000] text-sm"
                    >

                    <button
                        type="submit"
                        class="bg-[#4A0000] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#660000] transition text-sm"
                    >
                        Cari
                    </button>

                    @if(request('search'))
                        <a
                            href="{{ route('admin.organigram') }}"
                            class="text-center px-6 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600 hover:bg-gray-100 transition"
                        >
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">

                <table
                    class="w-full text-center
                           border-collapse">

                    <!-- TABLE HEADER -->
                    <thead>

                        <tr
                            class="bg-[#9E6B6B]
                                   text-white
                                   text-lg
                                   font-bold">

                            <th class="py-3 px-4 w-16">
                                No
                            </th>

                            <th class="py-3 px-6">
                                Foto
                            </th>

                            <th
                                class="py-3 px-6
                                       text-left sm:text-center">

                                Nama

                            </th>

                            <th class="py-3 px-6">
                                Jabatan
                            </th>

                            <th class="py-3 px-6">
                                Bidang
                            </th>

                            <th class="py-3 px-6 w-36">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <!-- TABLE BODY -->
                    <tbody
                        class="divide-y
                               divide-emerald-600/40
                               text-[#4A0000]
                               font-bold
                               text-base md:text-lg">

                        @forelse($organigram as $index => $item)

                            <tr
                                class="hover:bg-amber-50/50
                                       transition">

                                <!-- NO -->
                                <td
                                    class="py-4 px-4">

                                    {{ $index + 1 }}.

                                </td>


                                <!-- FOTO -->
                                <td class="py-4 px-6">

                                    <div
                                        class="w-16 h-16
                                               mx-auto
                                               rounded-full
                                               overflow-hidden
                                               bg-[#4A0000]
                                               border-2
                                               border-[#9E6B6B]
                                               flex items-center
                                               justify-center">

                                        @if($item->foto)

                                            <img
                                                src="{{ asset('images/organigram/' . $item->foto) }}"
                                                alt="{{ $item->nama_pengurus }}"
                                                class="w-full h-full object-cover"
                                                onerror="this.style.display='none';">

                                        @else

                                            <span
                                                class="text-white
                                                       text-[10px]">

                                                Tidak ada foto

                                            </span>

                                        @endif

                                    </div>

                                </td>


                                <!-- NAMA -->
                                <td
                                    class="py-4 px-6
                                           text-left sm:text-center
                                           font-extrabold">

                                    {{ $item->nama_pengurus }}

                                </td>


                                <!-- JABATAN -->
                                <td class="py-4 px-6">

                                    {{ $item->jabatan }}

                                </td>


                                <!-- BIDANG -->
                                <td class="py-4 px-6">

                                    {{ $item->bidang_pengurus ?: '-' }}

                                </td>


                                <!-- AKSI -->
                                <td class="py-4 px-6">

                                    <div
                                        class="flex justify-center
                                               items-center gap-2">

                                        <!-- UBAH -->
                                        <button
                                            type="button"
                                            onclick="openEditModal(
                                                '{{ $item->id_pengurus }}',
                                                '{{ addslashes($item->nama_pengurus) }}',
                                                '{{ addslashes($item->jabatan) }}',
                                                '{{ addslashes($item->bidang_pengurus) }}'
                                            )"
                                            class="bg-[#D9A336]
                                                   hover:bg-amber-600
                                                   text-white
                                                   text-xs
                                                   px-3 py-1.5
                                                   rounded-lg
                                                   transition
                                                   font-medium
                                                   shadow-sm">

                                            Ubah

                                        </button>


                                        <!-- HAPUS -->
                                        <form
                                            action="{{ route('admin.organigram.destroy', $item->id_pengurus) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data pengurus ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-[#E53935]
                                                       hover:bg-red-700
                                                       text-white
                                                       text-xs
                                                       px-3 py-1.5
                                                       rounded-lg
                                                       transition
                                                       font-medium
                                                       shadow-sm">

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
                                    class="py-8
                                           text-gray-400
                                           font-normal
                                           text-sm">

                                    Belum ada data kepengurusan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>


<!-- ================================
     MODAL TAMBAH PENGURUS
================================= -->
<div
    id="modal"
    class="hidden fixed inset-0
           bg-black/60 z-50
           items-center justify-center
           p-4">

    <div
        class="bg-white
               rounded-2xl
               max-w-md
               w-full
               p-6
               shadow-2xl
               space-y-4
               border-2
               border-[#9E6B6B]">

        <!-- TITLE -->
        <h3
            class="text-xl font-bold
                   text-[#4A0000]">

            Tambah Anggota Kepengurusan

        </h3>


        <!-- FORM -->
        <form
            action="{{ route('admin.organigram.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf


            <!-- NAMA -->
            <div>

                <label
                    for="nama_pengurus"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Nama Lengkap

                </label>

                <input
                    type="text"
                    name="nama_pengurus"
                    id="nama_pengurus"
                    value="{{ old('nama_pengurus') }}"
                    required
                    placeholder="Masukkan nama lengkap"
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- JABATAN -->
            <div>

                <label
                    for="jabatan"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Jabatan

                </label>

                <input
                    type="text"
                    name="jabatan"
                    id="jabatan"
                    value="{{ old('jabatan') }}"
                    required
                    placeholder="Contoh: Ketua Umum, Sekretaris, Bendahara"
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- BIDANG -->
            <div>

                <label
                    for="bidang_pengurus"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Bidang

                </label>

                <input
                    type="text"
                    name="bidang_pengurus"
                    id="bidang_pengurus"
                    value="{{ old('bidang_pengurus') }}"
                    placeholder="Contoh: Tari Tradisi, Kabaret, Vokal"
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- FOTO -->
            <div>

                <label
                    for="foto"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Foto Pengurus

                </label>

                <input
                    type="file"
                    name="foto"
                    id="foto"
                    accept=".jpg,.jpeg,.png,.webp"
                    required
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           bg-white">

                <p
                    class="text-xs
                           text-gray-500
                           mt-1">

                    Format: JPG, JPEG, PNG, WEBP.
                    Maksimal 2 MB.

                </p>

            </div>


            <!-- BUTTON -->
            <div
                class="flex
                       justify-end
                       gap-2
                       pt-3">

                <!-- BATAL -->
                <button
                    type="button"
                    id="closeModal"
                    class="px-4 py-2
                           rounded-lg
                           text-xs
                           font-bold
                           bg-gray-200
                           text-gray-700
                           hover:bg-gray-300
                           transition">

                    Batal

                </button>


                <!-- SIMPAN -->
                <button
                    type="submit"
                    class="px-5 py-2
                           rounded-lg
                           text-xs
                           font-bold
                           bg-[#4A0000]
                           text-white
                           hover:bg-[#660000]
                           transition">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>


<!-- ================================
     MODAL UBAH PENGURUS
================================= -->
<div
    id="editModal"
    class="hidden fixed inset-0
           bg-black/60 z-50
           items-center justify-center
           p-4">

    <div
        class="bg-white
               rounded-2xl
               max-w-md
               w-full
               p-6
               shadow-2xl
               space-y-4
               border-2
               border-[#9E6B6B]">

        <h3
            class="text-xl font-bold
                   text-[#4A0000]">

            Ubah Data Kepengurusan

        </h3>


        <form
            id="editForm"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf
            @method('PUT')


            <!-- NAMA -->
            <div>

                <label
                    for="edit_nama_pengurus"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Nama Lengkap

                </label>

                <input
                    type="text"
                    name="nama_pengurus"
                    id="edit_nama_pengurus"
                    required
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- JABATAN -->
            <div>

                <label
                    for="edit_jabatan"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Jabatan

                </label>

                <input
                    type="text"
                    name="jabatan"
                    id="edit_jabatan"
                    required
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- BIDANG -->
            <div>

                <label
                    for="edit_bidang_pengurus"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Bidang

                </label>

                <input
                    type="text"
                    name="bidang_pengurus"
                    id="edit_bidang_pengurus"
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#4A0000]">

            </div>


            <!-- FOTO BARU -->
            <div>

                <label
                    for="edit_foto"
                    class="block
                           text-xs
                           font-bold
                           text-[#4A0000]
                           mb-1">

                    Ganti Foto
                    <span class="font-normal text-gray-500">
                        (opsional)
                    </span>

                </label>

                <input
                    type="file"
                    name="foto"
                    id="edit_foto"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="w-full
                           px-3 py-2
                           rounded-lg
                           border border-gray-400
                           text-sm
                           bg-white">

                <p
                    class="text-xs
                           text-gray-500
                           mt-1">

                    Kosongkan jika tidak ingin mengganti foto.

                </p>

            </div>


            <!-- BUTTON -->
            <div
                class="flex justify-end
                       gap-2 pt-3">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2
                           rounded-lg
                           text-xs
                           font-bold
                           bg-gray-200
                           text-gray-700
                           hover:bg-gray-300
                           transition">

                    Batal

                </button>


                <button
                    type="submit"
                    class="px-5 py-2
                           rounded-lg
                           text-xs
                           font-bold
                           bg-[#4A0000]
                           text-white
                           hover:bg-[#660000]
                           transition">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>


<!-- ================================
     JAVASCRIPT
================================= -->
<script>

    // =================================
    // SIDEBAR
    // =================================

    const menuToggle =
        document.getElementById('menuToggle');

    const sidebar =
        document.getElementById('sidebar');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    if (menuToggle) {

        menuToggle.addEventListener('click', function () {

            sidebar.classList.toggle('-translate-x-full');

            sidebarOverlay.classList.toggle('hidden');

        });

    }


    if (sidebarOverlay) {

        sidebarOverlay.addEventListener('click', function () {

            sidebar.classList.add('-translate-x-full');

            sidebarOverlay.classList.add('hidden');

        });

    }


    // =================================
    // MODAL TAMBAH
    // =================================

    const modal =
        document.getElementById('modal');

    const openModal =
        document.getElementById('openModal');

    const closeModal =
        document.getElementById('closeModal');


    if (openModal) {

        openModal.addEventListener('click', function () {

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        });

    }


    if (closeModal) {

        closeModal.addEventListener('click', function () {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

        });

    }


    // Klik luar modal tambah
    if (modal) {

        modal.addEventListener('click', function (event) {

            if (event.target === modal) {

                modal.classList.add('hidden');

                modal.classList.remove('flex');

            }

        });

    }


    // =================================
    // MODAL UBAH
    // =================================

    const editModal =
        document.getElementById('editModal');

    const editForm =
        document.getElementById('editForm');


    function openEditModal(
        id,
        nama,
        jabatan,
        bidang
    ) {

        editForm.action =
            "{{ url('/admin/organigram') }}/" + id;

        document.getElementById(
            'edit_nama_pengurus'
        ).value = nama;

        document.getElementById(
            'edit_jabatan'
        ).value = jabatan;

        document.getElementById(
            'edit_bidang_pengurus'
        ).value = bidang || '';

        document.getElementById(
            'edit_foto'
        ).value = '';

        editModal.classList.remove('hidden');

        editModal.classList.add('flex');

    }


    function closeEditModal() {

        editModal.classList.add('hidden');

        editModal.classList.remove('flex');

    }


    // Klik luar modal edit
    if (editModal) {

        editModal.addEventListener('click', function (event) {

            if (event.target === editModal) {

                closeEditModal();

            }

        });

    }


    // =================================
    // TOMBOL ESC
    // =================================

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                if (modal) {

                    modal.classList.add('hidden');

                    modal.classList.remove('flex');

                }

                if (editModal) {

                    closeEditModal();

                }

            }

        }
    );

</script>

</body>

</html>
