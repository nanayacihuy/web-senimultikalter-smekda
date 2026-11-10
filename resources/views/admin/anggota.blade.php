<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Data Anggota | Seni Multikalter</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
    </script>

    {{-- CSS Anggota --}}
    <link rel="stylesheet" href="{{ asset('css/admin/anggotaa.css') }}">
</head>

<body x-data="{ sidebarOpen: false }">

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
    <main class="admin-content anggota-page">

        <div class="content-inner">

            {{-- HEADER --}}
            <div class="page-header">

                <h2 class="page-title">
                    Kelola data anggota
                </h2>

                <button type="button" class="btn-add" id="btnTambah">
                    + Tambah anggota
                </button>

            </div>


            {{-- =================================================
            PESAN BERHASIL
            ================================================== --}}
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            {{-- =================================================
            ERROR VALIDASI
            ================================================== --}}
            @if($errors->any())

                <div class="alert alert-error">

                    <strong>
                        Data belum berhasil disimpan.
                    </strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- =================================================
            TABEL ANGGOTA
            ================================================== --}}
            <div class="table-wrapper">

                <table class="anggota-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Bidang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($anggota as $index => $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $index + 1 }}.
                                </td>


                                {{-- NAMA --}}
                                <td>
                                    {{ $item->nama_anggota }}
                                </td>


                                {{-- KELAS --}}
                                <td>
                                    {{ $item->kelas_anggota }}
                                </td>


                                {{-- BIDANG --}}
                                <td>
                                    {{ $item->bidang_anggota }}
                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="action-buttons">

                                        {{-- =========================
                                        UBAH
                                        ========================== --}}
                                        <button type="button" class="btn-edit" onclick="bukaModalEdit(
                                                        {{ $item->id_anggota }},
                                                        @js($item->nama_anggota),
                                                        @js($item->kelas_anggota),
                                                        @js($item->bidang_anggota)
                                                    )">
                                            Ubah
                                        </button>


                                        {{-- =========================
                                        HAPUS
                                        ========================== --}}
                                        <form action="{{ route('admin.anggota.destroy', $item->id_anggota) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="empty-data">
                                    Belum ada data anggota.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>


    {{-- =====================================================
    MODAL TAMBAH / EDIT
    ====================================================== --}}
    <div class="modal-overlay" id="modalOverlay">

        <div class="modal-box" id="modalBox">

            <h3 class="modal-title" id="modalTitle">
                Tambah Data Anggota
            </h3>


            {{-- FORM --}}
            <form action="{{ route('admin.anggota.store') }}" method="POST" id="anggotaForm">

                @csrf

                {{-- METHOD --}}
                <input type="hidden" name="_method" id="methodInput" value="POST">


                {{-- =========================
                NAMA
                ========================== --}}
                <div class="form-group">

                    <label for="nama_anggota">
                        Nama Lengkap
                    </label>

                    <input type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota"
                        value="{{ old('nama_anggota') }}" required>

                </div>


                {{-- =========================
                KELAS
                ========================== --}}
                <div class="form-group">

                    <label for="kelas_anggota">
                        Kelas
                    </label>

                    <input type="text" id="kelas_anggota" name="kelas_anggota" placeholder="Contoh: XII RPL 1"
                        value="{{ old('kelas_anggota') }}" required>

                </div>


                {{-- =========================
                BIDANG
                ========================== --}}
                <div class="form-group">

                    <label for="bidang_anggota">
                        Bidang Seni
                    </label>

                    <input type="text" id="bidang_anggota" name="bidang_anggota" placeholder="Contoh: Tari Tradisi"
                        value="{{ old('bidang_anggota') }}" required>

                </div>


                {{-- =========================
                TOMBOL
                ========================== --}}
                <div class="modal-actions">

                    <button type="button" class="btn-cancel" id="btnBatal">
                        Batal
                    </button>

                    <button type="submit" class="btn-save">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
    JAVASCRIPT TAMBAH / UBAH / TUTUP MODAL
    ====================================================== --}}
    <script>

        // =========================
        // ELEMENT
        // =========================

        const modalOverlay = document.getElementById('modalOverlay');

        const modalTitle = document.getElementById('modalTitle');

        const anggotaForm = document.getElementById('anggotaForm');

        const methodInput = document.getElementById('methodInput');

        const namaInput = document.getElementById('nama_anggota');

        const kelasInput = document.getElementById('kelas_anggota');

        const bidangInput = document.getElementById('bidang_anggota');

        const btnTambah = document.getElementById('btnTambah');

        const btnBatal = document.getElementById('btnBatal');


        // =========================
        // TAMBAH ANGGOTA
        // =========================

        btnTambah.addEventListener('click', function () {

            modalTitle.textContent = 'Tambah Data Anggota';

            anggotaForm.action =
                "{{ route('admin.anggota.store') }}";

            methodInput.value = 'POST';

            namaInput.value = '';
            kelasInput.value = '';
            bidangInput.value = '';

            modalOverlay.classList.add('show');

            namaInput.focus();

        });


        // =========================
        // UBAH ANGGOTA
        // =========================

        function bukaModalEdit(id, nama, kelas, bidang) {

            modalTitle.textContent = 'Ubah Data Anggota';

            anggotaForm.action =
                "{{ url('/admin/anggota') }}/" + id;

            methodInput.value = 'PUT';

            namaInput.value = nama;

            kelasInput.value = kelas;

            bidangInput.value = bidang;

            modalOverlay.classList.add('show');

            namaInput.focus();
        }


        // =========================
        // TUTUP MODAL
        // =========================

        function tutupModal() {

            modalOverlay.classList.remove('show');

        }


        // =========================
        // TOMBOL BATAL
        // =========================

        btnBatal.addEventListener('click', function () {

            tutupModal();

        });


        // =========================
        // KLIK DI LUAR MODAL
        // =========================

        modalOverlay.addEventListener('click', function (event) {

            if (event.target === modalOverlay) {

                tutupModal();

            }

        });


        // =========================
        // TOMBOL ESC
        // =========================

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                tutupModal();

            }

        });

    </script>

</body>

</html>