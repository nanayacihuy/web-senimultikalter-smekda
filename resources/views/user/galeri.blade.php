<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Galeri | Seni Multikalter</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    {{-- CSS Galeri --}}
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">

</head>


<body class="bg-[#481d08]">

    {{-- =====================================================
         NAVBAR
    ====================================================== --}}

    @include('components.navbar')



    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <main class="py-10 md:py-14">

        <section class="text-center px-4 reveal">

            <h1 class="text-3xl md:text-4xl font-serif font-bold tracking-wide text-white">
                GALERI
            </h1>

            <p class="text-white/80 mt-2 font-serif italic text-sm md:text-base">
                Dokumentasi kegiatan Seni Multikalter
            </p>

        </section>



        {{-- =================================================
             PENCARIAN
        ================================================== --}}

        <section class="px-4 mb-8">

            <form
                method="GET"
                action="{{ route('user.galeri') }}"
                class="max-w-xl mx-auto flex flex-wrap gap-3"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari galeri..."
                    class="flex-1 min-w-[200px] px-4 py-2.5 rounded-lg border border-white/30 bg-white/10 text-white placeholder-white/60 text-sm focus:outline-none focus:ring-2 focus:ring-white/50"
                >

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-lg bg-white text-[#481d08] font-semibold text-sm hover:bg-white/90 transition"
                >
                    Cari
                </button>


                @if(request('search'))

                    <a
                        href="{{ route('user.galeri') }}"
                        class="px-6 py-2.5 rounded-lg border border-white/40 text-white text-sm hover:bg-white/10 transition"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </section>



        {{-- =================================================
             TARI TRADISI
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Tari Tradisi
                </h2>

                <p>
                    Dokumentasi kegiatan dan latihan
                    bidang Tari Tradisi.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Tari Tradisi') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>



        {{-- =================================================
             MODERN DANCE
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Modern Dance
                </h2>

                <p>
                    Dokumentasi kegiatan dan latihan
                    bidang Modern Dance.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Modern Dance') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>



        {{-- =================================================
             VOKAL
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Vokal
                </h2>

                <p>
                    Dokumentasi kegiatan dan latihan
                    bidang Vokal.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Vokal') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>



        {{-- =================================================
             KABARET
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Kabaret
                </h2>

                <p>
                    Dokumentasi kegiatan dan latihan
                    bidang Kabaret.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Kabaret') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>



        {{-- =================================================
             ANGKLUNG & MUSIK
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Angklung & Musik
                </h2>

                <p>
                    Dokumentasi kegiatan dan latihan
                    bidang Angklung & Musik.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Angklung & Musik') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>



        {{-- =================================================
             FOTO BERSAMA
        ================================================== --}}

        <section class="gallery-section reveal">

            <div class="section-heading">

                <h2>
                    Foto Bersama
                </h2>

                <p>
                    Momen kebersamaan seluruh anggota
                    Ekstrakurikuler Seni Multikalter.
                </p>

            </div>


            <div class="gallery-grid">

                @foreach ($galeri->where('kategori', 'Foto Bersama') as $item)

                    <div
                        class="gallery-item reveal"
                        data-image="{{ asset('uploads/galeri/' . $item->foto) }}"
                        data-title="{{ $item->judul_galeri }}"
                    >

                        <img
                            src="{{ asset('uploads/galeri/' . $item->foto) }}"
                            alt="{{ $item->judul_galeri }}"
                            loading="lazy"
                            onerror="this.onerror=null; this.src='{{ asset('img/DokumSM(4).jpg') }}';"
                        >

                    </div>

                @endforeach

            </div>

        </section>

    </main>



    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    @include('components.footer')



    {{-- =====================================================
         LIGHTBOX / MODAL
    ====================================================== --}}

    <div
        id="imageModal"
        class="image-modal"
    >

        <div class="modal-container">

            <button
                id="closeModal"
                class="close-modal"
                type="button"
            >
            </button>


            <img
                id="modalImg"
                src=""
                alt="Preview"
            >


            <div class="modal-caption">

                <h3 id="modalTitle">
                    Dokumentasi
                </h3>

                <p>
                    Seni Multikalter
                </p>

            </div>


            {{-- Navigation --}}

            <button
                id="prevImage"
                class="modal-nav prev"
                type="button"
            >
            </button>


            <button
                id="nextImage"
                class="modal-nav next"
                type="button"
            >
            </button>

        </div>

    </div>



    {{-- =====================================================
         JS GALERI
    ====================================================== --}}

    <script src="{{ asset('js/user/galeri.js') }}"></script>

</body>

</html>