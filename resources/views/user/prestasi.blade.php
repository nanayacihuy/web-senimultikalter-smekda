<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi | Seni Multikalter</title>

    {{-- =====================================================
        FONT
    ====================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    {{-- =====================================================
        CSS PRESTASI
    ====================================================== --}}
    <link rel="stylesheet" href="{{ asset('css/prestasi.css') }}">
</head>

<body>
    {{-- =====================================================
        NAVBAR
    ====================================================== --}}
    @include('components.navbar')

    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <main class="prestasi-page">
        <div class="prestasi-container">

            {{-- =================================================
                HEADER
            ================================================== --}}
            <section class="prestasi-header">
                <h1>
                    PRESTASI
                    <span>
                        SENI MULTIKALTER
                    </span>
                </h1>

                <p>
                    Berbagai pencapaian dan prestasi yang diraih
                    oleh anggota Seni Multikalter.
                </p>
            </section>

            {{-- =================================================
                SEARCH
            ================================================== --}}
            <section class="prestasi-search">
                <form action="{{ route('user.prestasi') }}" method="GET" class="search-form">
                    <div class="search-input-wrapper">
                        <span class="search-icon">
                            ⌕
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari prestasi..."
                            autocomplete="off"
                        >
                    </div>

                    <button type="submit" class="search-button">
                        Cari
                    </button>

                    @if (request('search'))
                        <a href="{{ route('user.prestasi') }}" class="reset-button">
                            Reset
                        </a>
                    @endif
                </form>
            </section>

            {{-- =================================================
                SEARCH RESULT
            ================================================== --}}
            @if (request('search'))
                <div class="search-result-info">
                    Hasil pencarian untuk:
                    <strong>
                        "{{ request('search') }}"
                    </strong>
                </div>
            @endif

            {{-- =================================================
                GRID PRESTASI
            ================================================== --}}
            <section class="prestasi-grid">
                @forelse ($prestasi as $item)
                    <article
                        class="prestasi-card"
                        data-title="{{ $item->nama_prestasi }}"
                        data-description="{{ strip_tags($item->deskripsi ?? 'Tidak ada deskripsi prestasi.') }}"
                        data-date="{{ $item->created_at ? $item->created_at->format('Y') : '-' }}"
                        data-image="{{ $item->foto ? asset('images/prestasi/' . $item->foto) : asset('img/DokumSM(4).jpg') }}"
                    >
                        {{-- =================================================
                            FOTO
                        ================================================== --}}
                        <div class="prestasi-image">
                            @if ($item->foto)
                                <img
                                    src="{{ asset('images/prestasi/' . $item->foto) }}"
                                    alt="{{ $item->nama_prestasi }}"
                                    loading="lazy"
                                    onerror="
                                        this.onerror=null;
                                        this.src='{{ asset('img/DokumSM(4).jpg') }}';
                                    "
                                >
                            @else
                                <img
                                    src="{{ asset('img/DokumSM(4).jpg') }}"
                                    alt="{{ $item->nama_prestasi }}"
                                >
                            @endif
                        </div>

                        {{-- =================================================
                            CONTENT
                        ================================================== --}}
                        <div class="prestasi-content">
                            <span class="prestasi-label">
                                PRESTASI
                            </span>

                            <h2>
                                {{ $item->nama_prestasi }}
                            </h2>

                            <p>
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? ''), 120) }}
                            </p>

                            <div class="prestasi-card-footer">
                                <span class="prestasi-date">
                                    {{ $item->created_at ? $item->created_at->format('Y') : '-' }}
                                </span>

                                <button type="button" class="detail-button">
                                    Lihat Detail →
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
                    {{-- =================================================
                        EMPTY
                    ================================================== --}}
                    <article class="prestasi-empty">
                        <div class="empty-icon">
                            🏆
                        </div>

                        <h2>
                            Belum Ada Prestasi
                        </h2>

                        @if (request('search'))
                            <p>
                                Prestasi dengan kata

                                <strong>
                                    "{{ request('search') }}"
                                </strong>

                                tidak ditemukan.
                            </p>

                            <a href="{{ route('user.prestasi') }}" class="empty-button">
                                Tampilkan Semua Prestasi
                            </a>
                        @else
                            <p>
                                Belum ada data prestasi
                                yang ditambahkan.
                            </p>
                        @endif
                    </article>
                @endforelse
            </section>

            {{-- =================================================
                PAGINATION
            ================================================== --}}
            @if (
                $prestasi instanceof \Illuminate\Pagination\LengthAwarePaginator &&
                $prestasi->lastPage() > 1
            )
                <div class="prestasi-pagination">
                    <ul class="pagination-list">

                        {{-- =================================================
                            PREVIOUS
                        ================================================== --}}
                        @if ($prestasi->onFirstPage())
                            <li>
                                <span class="pagination-link disabled">
                                    ‹
                                </span>
                            </li>
                        @else
                            <li>
                                <a
                                    href="{{ $prestasi->appends(request()->query())->previousPageUrl() }}"
                                    class="pagination-link"
                                    aria-label="Halaman sebelumnya"
                                >
                                    ‹
                                </a>
                            </li>
                        @endif

                        {{-- =================================================
                            NOMOR HALAMAN
                        ================================================== --}}
                        @php
                            $currentPage = $prestasi->currentPage();
                            $lastPage = $prestasi->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp

                        {{-- HALAMAN 1 + DOTS --}}
                        @if ($startPage > 1)
                            <li>
                                <a href="{{ $prestasi->appends(request()->query())->url(1) }}" class="pagination-link">
                                    1
                                </a>
                            </li>

                            @if ($startPage > 2)
                                <li>
                                    <span class="pagination-dots">
                                        ...
                                    </span>
                                </li>
                            @endif
                        @endif

                        {{-- NOMOR HALAMAN --}}
                        @for ($page = $startPage; $page <= $endPage; $page++)
                            @if ($page == $currentPage)
                                <li>
                                    <span class="pagination-link active">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $prestasi->appends(request()->query())->url($page) }}" class="pagination-link">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endfor

                        {{-- DOTS + LAST PAGE --}}
                        @if ($endPage < $lastPage)
                            @if ($endPage < $lastPage - 1)
                                <li>
                                    <span class="pagination-dots">
                                        ...
                                    </span>
                                </li>
                            @endif

                            <li>
                                <a href="{{ $prestasi->appends(request()->query())->url($lastPage) }}" class="pagination-link">
                                    {{ $lastPage }}
                                </a>
                            </li>
                        @endif

                        {{-- =================================================
                            NEXT
                        ================================================== --}}
                        @if ($prestasi->hasMorePages())
                            <li>
                                <a
                                    href="{{ $prestasi->appends(request()->query())->nextPageUrl() }}"
                                    class="pagination-link"
                                    aria-label="Halaman berikutnya"
                                >
                                    ›
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="pagination-link disabled">
                                    ›
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            {{-- =================================================
                CLOSING
            ================================================== --}}
            <section class="prestasi-closing">
                <div class="closing-line"></div>

                <h2>
                    Terus Berkarya,
                    <span>
                        Terus Berprestasi.
                    </span>
                </h2>

                <p>
                    Setiap pencapaian merupakan hasil dari proses,
                    kerja keras, kreativitas, dan kebersamaan
                    seluruh anggota Seni Multikalter.
                </p>
            </section>

        </div>
    </main>

    {{-- =====================================================
        FOOTER
    ====================================================== --}}
    @include('components.footer')

    {{-- =====================================================
        MODAL
    ====================================================== --}}
    <div class="prestasi-modal" id="prestasiModal" aria-hidden="true">
        <div class="modal-box" role="dialog" aria-modal="true">
            <button type="button" class="modal-close" id="modalClose">
                ×
            </button>

            <div class="modal-image-wrapper">
                <img src="{{ asset('img/DokumSM(4).jpg') }}" alt="Prestasi" id="modalImage">
            </div>

            <div class="modal-content">
                <span>
                    PRESTASI
                </span>

                <h2 id="modalTitle">
                    Prestasi Seni Multikalter
                </h2>

                <p id="modalDescription">
                    Deskripsi prestasi.
                </p>

                <div class="modal-divider"></div>

                <small id="modalDate">
                    Tahun -
                </small>
            </div>
        </div>
    </div>

    {{-- =====================================================
        JAVASCRIPT PRESTASI
    ====================================================== --}}
    <script src="{{ asset('js/user/prestasi.js') }}"></script>
</body>

</html>