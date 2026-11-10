<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita | Seni Multikalter</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
</head>

<body>
    {{-- =========================
    NAVBAR
    ========================== --}}
    @include('components.navbar')

    {{-- =========================
    HALAMAN BERITA
    ========================== --}}
    <main class="berita-page">
        <div class="berita-container">
            {{-- =========================
            HEADER
            ========================== --}}
            <section class="berita-header reveal">
                <h1>
                    BERITA
                    <span>SENI MULTIKALTER</span>
                </h1>

                <div class="header-image">
                    <img src="{{ asset('img/DokumSM(4).jpg') }}" alt="Kegiatan Seni Multikalter">
                </div>
                <p class="header-caption">
                    Kabar terbaru seputar kegiatan dan
                    prestasi Seni Multikalter
                </p>

                <p class="header-description">
                    Dapatkan informasi terkini mengenai
                    kegiatan, prestasi dan berbagai hal
                    menarik dari Ekstrakurikuler kami.
                </p>
            </section>
            {{-- =========================
            BERITA DARI DATABASE
            ========================== --}}

            @forelse($berita as $item)

                        <section class="featured-news reveal">

                            <article class="featured-card" data-title="{{ $item->judul_berita }}"
                                data-description="{{ strip_tags($item->deskripsi_berita) }}"
                                data-date="{{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d F Y') }}" data-image="{{ $item->foto
                    ? asset('images/berita/' . $item->foto)
                    : asset('img/DokumSM(4).jpg') }}">

                                {{-- FOTO BERITA --}}
                                <div class="featured-image">

                                    @if($item->foto)

                                        <img src="{{ asset('images/berita/' . $item->foto) }}" alt="{{ $item->judul_berita }}">

                                    @else

                                        <img src="{{ asset('img/DokumSM(4).jpg') }}" alt="{{ $item->judul_berita }}">

                                    @endif

                                </div>


                                {{-- ISI BERITA --}}
                                <div class="featured-content">

                                    <h2>
                                        {{ $item->judul_berita }}
                                    </h2>

                                    <p>
                                        {{ \Illuminate\Support\Str::limit(
                    strip_tags($item->deskripsi_berita),
                    180
                ) }}
                                    </p>

                                </div>

                            </article>


                            {{-- TANGGAL --}}
                            <div class="upload-date">

                                <span>
                                    upload:
                                </span>

                                {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d F Y') }}

                            </div>

                        </section>

            @empty

                {{-- JIKA BELUM ADA BERITA --}}

                <section class="featured-news reveal">

                    <article class="featured-card">

                        <div class="featured-content">

                            <h2>
                                Belum ada berita
                            </h2>

                            <p>
                                Belum ada berita yang dipublikasikan oleh
                                Seni Multikalter.
                            </p>

                        </div>

                    </article>

                </section>

            @endforelse

    </main>
    <!-- JS -->
    <script src="{{ asset('js/user/berita.js') }}"></script>
    {{-- =========================
    FOOTER
    ========================== --}}
    @include('components.footer')
</body>

</html>