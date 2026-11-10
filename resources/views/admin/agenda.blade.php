<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Agenda | Seni Multikalter</title>
    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}">
</head>
<body x-data="{ sidebarOpen: true }">
    @include('components.admin.navbar')
    <div class="agenda-layout">
    @include('components.admin.sidebar')
        {{-- ==================================================
             MAIN CONTENT
        ================================================== --}}
        <main class="agenda-main">
            <h2>Kelola agenda</h2>
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="top-section">
                {{-- CONTROLS --}}
                <div class="controls">
                    {{-- SEARCH --}}
                    <form
                        action="{{ route('admin.agenda') }}"
                        method="GET"
                        class="search-form">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari agenda......"
                            class="search-input">
                    </form>
                    <div class="control-row">
                        {{-- TAMBAH --}}
                        <button
                            type="button"
                            class="btn-add"
                            onclick="openAddModal()">+ Tambah agenda</button>
                        {{-- FILTER TANGGAL --}}
                        <input
                            type="date"
                            class="date-filter"
                            id="dateFilter">
                    </div>
                </div>
                <div class="stats">
                    {{-- TOTAL AGENDA --}}
                    <div class="stat-card">
                        <span class="stat-title">Total Agenda</span>
                        <span class="stat-number">{{ $agenda->count() }}</span>
                    </div>
                    {{-- AGENDA TERPUBLIS --}}
                    <div class="stat-card">
                        <span class="stat-title">Agenda terpublis</span>
                        <span class="stat-number">{{ $agenda->count() }}</span>
                    </div>
                    {{-- DRAFT --}}
                    <div class="stat-card">
                        <span class="stat-title">Draft</span>
                        <span class="stat-number">0</span>
                    </div>
                    {{-- SAMPAH --}}
                    <div class="stat-card">
                        <span class="stat-title">Sampah</span>
                        <span class="stat-number">0</span>
                    </div>
                </div>
            </div>
            {{-- ==================================================
                 TABLE
            ================================================== --}}
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="agenda-table" id="agendaTable">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Materi/kegiatan</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($agenda as $index => $item)
                                <tr>
                                    {{-- NOMOR --}}
                                    <td class="number-cell">
                                        {{ $agenda->firstItem() + $index }}.
                                    </td>
                                    {{-- NAMA --}}
                                    <td class="activity-name">
                                        {{ $item->nama_kegiatan }}
                                    </td>
                                    {{-- WAKTU --}}
                                    <td class="text-cell">
                                        {{ $item->waktu }}
                                    </td>
                                    {{-- TEMPAT --}}
                                    <td class="text-cell">{{ $item->tempat }}</td>
                                    {{-- MATERI --}}
                                    <td class="text-cell">{{ $item->materi }}</td>
                                    {{-- AKSI --}}
                                    <td>
                                        <div class="action-wrapper">
                                            {{-- UBAH --}}
                                            <button
                                                type="button"
                                                class="btn-edit"
                                                onclick="openEditModal(
                                                    {{ $item->id_agenda }},
                                                    @js($item->nama_kegiatan),
                                                    @js($item->waktu),
                                                    @js($item->tempat),
                                                    @js($item->materi)
                                                )">Ubah</button>
                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.agenda.destroy', $item->id_agenda) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn-delete">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"class="empty-row">Tidak ada agenda yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $agenda->links() }}</div>
            </div>
        </main>
    </div>
    {{-- ==================================================
         MODAL TAMBAH / EDIT
    ================================================== --}}
    <div class="modal-overlay"id="agendaModal">
        <div class="modal-box">
            <h3 class="modal-title" id="modalTitle">Tambah Agenda</h3>
            <form
                id="agendaForm"
                action="{{ route('admin.agenda.store') }}"
                method="POST">
                @csrf
                <input
                    type="hidden"
                    name="_method"
                    id="formMethod"
                    value="POST"
                >
                {{-- NAMA KEGIATAN --}}
                <div class="form-group">
                    <label class="form-label">Nama Kegiatan</label>
                    <input
                        type="text"
                        name="nama_kegiatan"
                        id="namaKegiatan"
                        class="form-input"
                        placeholder="Contoh: Latihan Tari Tradisi"
                        required>
                </div>
                {{-- WAKTU + TEMPAT --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Waktu</label>
                        <textarea
                            name="waktu"
                            id="waktu"
                            rows="3"
                            class="form-textarea"
                            placeholder="Rabu&#10;15.00 - 16.30"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat</label>
                        <textarea
                            name="tempat"
                            id="tempat"
                            rows="3"
                            class="form-textarea"
                            placeholder="Panggung&#10;SMKN 2 Purwakarta"
                            required></textarea>
                    </div>
                </div>
                {{-- MATERI --}}
                <div class="form-group">
                    <label class="form-label">Materi / Kegiatan</label>
                    <textarea
                        name="materi"
                        id="materi"
                        rows="3"
                        class="form-textarea"
                        placeholder="Latihan gerak dasar (olah tubuh)"
                        required
                    ></textarea>
                </div>
                {{-- BUTTON --}}
                <div class="modal-buttons">
                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closeModal()">Batal</button>
                    <button type="submit"class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    {{-- ==================================================
         ALPINE JS
         Dipakai oleh navbar + sidebar
    ================================================== --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/admin/agenda.js') }}"></script>
</body>
</html>