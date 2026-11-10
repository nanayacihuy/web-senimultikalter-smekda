<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | Seni Multikalter</title>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}">
</head>
<body class="bg-[#4A0000] font-sans antialiased">
    <!-- ==================================================
         NAVBAR
    ================================================== -->
    @include('components.admin.navbar')
    <div class="flex pt-20 flex-1">
        <!-- ==================================================
             SIDEBAR
        ================================================== -->
        @include('components.admin.sidebar')
        <!-- ==================================================
             MAIN WORKSPACE
        ================================================== -->
        <main class="flex-1 bg-white rounded-tl-3xl p-6 md:p-8
                   min-h-[calc(100vh-5rem)]
                   overflow-x-hidden md:ml-64">
            <h2 class="text-3xl font-bold text-[#4A0000] mb-6">Kelola Berita</h2>
            <!-- ==================================================
                 SUCCESS MESSAGE
            ================================================== -->
            @if(session('success'))
                <div
                    class="mb-6 bg-green-100 border border-green-400
                           text-green-700 px-4 py-3 rounded-xl
                           font-semibold">{{ session('success') }}</div>
            @endif
            <!-- ==================================================
                 ERROR MESSAGE
            ================================================== -->
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- ==================================================
                 TOP CONTROL
            ================================================== -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <!-- SEARCH & FILTER -->
                <form
                    action="{{ route('admin.berita') }}"
                    method="GET"
                    class="flex flex-col gap-3 w-full lg:w-auto min-w-[280px]">
                    <!-- SEARCH -->
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari berita......"
                        class="w-full border-2 border-[#4A0000]
                               px-4 py-2 rounded-xl text-sm
                               font-semibold placeholder-gray-500
                               focus:outline-none
                               focus:ring-2 focus:ring-[#4A0000]">
                    <div class="flex gap-3">
                        <!-- TAMBAH -->
                        <label
                            for="modalTambah"
                            class="flex-1 border-2 border-[#4A0000]
                                   text-[#4A0000]
                                   hover:bg-[#4A0000]
                                   hover:text-white
                                   px-4 py-2 rounded-xl text-xs
                                   font-bold transition shadow-sm
                                   text-center cursor-pointer">+ Tambah berita</label>
                        <!-- FILTER TANGGAL -->
                        <input
                            type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="flex-1 border-2 border-[#4A0000]
                                   text-[#4A0000]
                                   px-3 py-2 rounded-xl text-xs
                                   font-bold focus:outline-none
                                   bg-white cursor-pointer">
                    </div>
                </form>
                <!-- ==================================================
                     STATS
                ================================================== -->
                <div
                    class="grid grid-cols-2 sm:grid-cols-4 gap-3 w-full lg:w-auto">
                    <!-- TOTAL -->
                    <div
                        class="bg-[#4A0000] text-white p-3.5
                               rounded-2xl text-center min-w-[100px]
                               flex flex-col justify-center
                               items-center shadow-md"
                    >
                        <span class="text-xs font-bold leading-tight mb-1">
                            Total Berita
                        </span>

                        <span class="text-2xl font-black">
                            {{ $berita->total() }}
                        </span>
                    </div>


                    <!-- TERPUBLIS -->
                    <div
                        class="bg-[#4A0000] text-white p-3.5
                               rounded-2xl text-center min-w-[100px]
                               flex flex-col justify-center
                               items-center shadow-md"
                    >
                        <span class="text-xs font-bold leading-tight mb-1">
                            Berita Terpublis
                        </span>

                        <span class="text-2xl font-black">
                            {{ $berita->total() }}
                        </span>
                    </div>


                    <!-- DRAFT -->
                    <div
                        class="bg-[#4A0000] text-white p-3.5
                               rounded-2xl text-center min-w-[100px]
                               flex flex-col justify-center
                               items-center shadow-md"
                    >
                        <span class="text-xs font-bold leading-tight mb-1">
                            Draft
                        </span>

                        <span class="text-2xl font-black">
                            0
                        </span>
                    </div>


                    <!-- SAMPAH -->
                    <div
                        class="bg-[#4A0000] text-white p-3.5
                               rounded-2xl text-center min-w-[100px]
                               flex flex-col justify-center
                               items-center shadow-md"
                    >
                        <span class="text-xs font-bold leading-tight mb-1">
                            Sampah
                        </span>

                        <span class="text-2xl font-black">
                            0
                        </span>
                    </div>

                </div>

            </div>


            <!-- ==================================================
                 TABLE
            ================================================== -->
            <div
                class="border-2 border-[#9E6B6B]
                       rounded-3xl overflow-hidden shadow-sm"
            >

                <div class="overflow-x-auto">

                    <table class="w-full text-center border-collapse">

                        <!-- HEADER -->
                        <thead>
                            <tr
                                class="bg-[#9E6B6B] text-white
                                       text-lg md:text-xl font-bold"
                            >

                                <th class="py-3.5 px-4 w-16">
                                    No
                                </th>

                                <th class="py-3.5 px-4 w-40">
                                    Gambar
                                </th>

                                <th class="py-3.5 px-6 text-left">
                                    Judul Berita
                                </th>

                                <th class="py-3.5 px-6 text-left">
                                    Deskripsi
                                </th>

                                <th class="py-3.5 px-6">
                                    Tanggal Upload
                                </th>

                                <th class="py-3.5 px-6 w-36">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <!-- BODY -->
                        <tbody
                            class="divide-y divide-emerald-600/30
                                   text-[#4A0000]
                                   font-bold text-base md:text-lg"
                        >

                            @forelse($berita as $index => $row)

                                <tr
                                    class="hover:bg-amber-50/50
                                           transition"
                                >

                                    <!-- NO -->
                                    <td class="py-4 px-4 text-xl">
                                        {{ $berita->firstItem() + $index }}.
                                    </td>


                                    <!-- FOTO -->
                                    <td class="py-4 px-4">

                                        <div
                                            class="w-32 h-20
                                                   bg-[#4A0000]
                                                   rounded-2xl mx-auto
                                                   shadow-inner
                                                   overflow-hidden
                                                   flex items-center
                                                   justify-center"
                                        >

                                            @if($row->foto)

                                                <img
                                                    src="{{ asset('images/berita/' . $row->foto) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $row->judul_berita }}"
                                                >

                                            @else

                                                <span
                                                    class="text-white text-xs"
                                                >
                                                    Tidak ada foto
                                                </span>

                                            @endif

                                        </div>

                                    </td>


                                    <!-- JUDUL -->
                                    <td
                                        class="py-4 px-6 text-left
                                               font-extrabold max-w-xs"
                                    >
                                        {{ $row->judul_berita }}
                                    </td>


                                    <!-- DESKRIPSI -->
                                    <td
                                        class="py-4 px-6 text-left
                                               font-semibold text-sm
                                               max-w-xs"
                                    >
                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($row->deskripsi_berita),
                                            100
                                        ) }}
                                    </td>


                                    <!-- TANGGAL -->
                                    <td
                                        class="py-4 px-6
                                               text-sm md:text-base"
                                    >
                                        {{ $row->tanggal_upload }}
                                    </td>


                                    <!-- ==================================================
                                         AKSI
                                    ================================================== -->
                                    <td class="py-4 px-6">

                                        <div
                                            class="flex justify-center
                                                   items-center gap-2"
                                        >

                                            <!-- ==========================
                                                 UBAH
                                            =========================== -->
                                            <a
                                                href="{{ route(
                                                    'admin.berita.edit',
                                                    $row->id_berita
                                                ) }}"
                                                class="bg-[#D9A336]
                                                       hover:bg-amber-600
                                                       text-white text-xs
                                                       px-3.5 py-1.5
                                                       rounded-lg
                                                       transition
                                                       font-medium
                                                       shadow-sm"
                                            >
                                                Ubah
                                            </a>


                                            <!-- ==========================
                                                 HAPUS
                                            =========================== -->
                                            <form
                                                action="{{ route(
                                                    'admin.berita.destroy',
                                                    $row->id_berita
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm(
                                                    'Yakin ingin menghapus berita ini?'
                                                )"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="bg-[#E53935]
                                                           hover:bg-red-700
                                                           text-white text-xs
                                                           px-3.5 py-1.5
                                                           rounded-lg
                                                           transition
                                                           font-medium
                                                           shadow-sm"
                                                >
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
                                        class="py-8 text-gray-400
                                               font-normal text-sm"
                                    >
                                        Belum ada berita.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- PAGINATION -->
                <div class="px-4 py-4">
                    {{ $berita->links() }}
                </div>

            </div>

        </main>

    </div>


    <!-- ==================================================
         MODAL TAMBAH BERITA
    ================================================== -->

    <input
        type="checkbox"
        id="modalTambah"
        class="modal-checkbox"
    >


    <div
        class="modal-overlay fixed inset-0
               bg-black/60 z-50
               items-center justify-center p-4"
    >

        <div
            class="bg-white rounded-2xl
                   max-w-lg w-full p-6
                   shadow-2xl space-y-4
                   border-2 border-[#9E6B6B]"
        >

            <!-- HEADER -->
            <div class="flex justify-between items-center">

                <h3
                    class="text-xl font-bold text-[#4A0000]"
                >
                    Tambah Berita
                </h3>

                <label
                    for="modalTambah"
                    class="text-gray-500
                           hover:text-red-600
                           text-2xl cursor-pointer
                           font-bold"
                >
                    ×
                </label>

            </div>


            <!-- FORM TAMBAH -->
            <form
                action="{{ route('admin.berita.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4"
            >

                @csrf


                <!-- JUDUL -->
                <div>

                    <label
                        class="block text-xs
                               font-bold text-[#4A0000]
                               mb-1"
                    >
                        Judul Berita
                    </label>

                    <input
                        type="text"
                        name="judul_berita"
                        value="{{ old('judul_berita') }}"
                        required
                        class="w-full px-3 py-2
                               rounded-lg border
                               border-gray-400
                               text-sm
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4A0000]"
                    >

                </div>


                <!-- DESKRIPSI -->
                <div>

                    <label
                        class="block text-xs
                               font-bold text-[#4A0000]
                               mb-1"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi_berita"
                        rows="4"
                        required
                        class="w-full px-3 py-2
                               rounded-lg border
                               border-gray-400
                               text-sm
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4A0000]"
                    >{{ old('deskripsi_berita') }}</textarea>

                </div>


                <!-- FOTO -->
                <div>

                    <label
                        class="block text-xs
                               font-bold text-[#4A0000]
                               mb-1"
                    >
                        Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        accept="image/jpeg,image/png,image/webp"
                        required
                        class="w-full px-3 py-2
                               rounded-lg border
                               border-gray-400
                               text-sm
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4A0000]"
                    >

                    <p class="text-xs text-gray-500 mt-1">
                        JPG, JPEG, PNG, WEBP — maksimal 2 MB.
                    </p>

                </div>


                <!-- TANGGAL -->
                <div>

                    <label
                        class="block text-xs
                               font-bold text-[#4A0000]
                               mb-1"
                    >
                        Tanggal Upload
                    </label>

                    <input
                        type="date"
                        name="tanggal_upload"
                        value="{{ old(
                            'tanggal_upload',
                            date('Y-m-d')
                        ) }}"
                        required
                        class="w-full px-3 py-2
                               rounded-lg border
                               border-gray-400
                               text-sm
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#4A0000]"
                    >

                </div>


                <!-- BUTTON -->
                <div class="flex justify-end gap-2 pt-3">

                    <!-- BATAL -->
                    <label
                        for="modalTambah"
                        class="px-4 py-2 rounded-lg
                               text-xs font-bold
                               bg-gray-200
                               text-gray-700
                               hover:bg-gray-300
                               transition cursor-pointer"
                    >
                        Batal
                    </label>


                    <!-- SIMPAN -->
                    <button
                        type="submit"
                        class="px-5 py-2 rounded-lg
                               text-xs font-bold
                               bg-[#4A0000]
                               text-white
                               hover:bg-[#660000]
                               transition"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>