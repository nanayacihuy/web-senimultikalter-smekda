<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Agenda | Seni Multikalter</title>


    {{-- =====================================================
        FONT
    ====================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- =====================================================
        CSS LANGSUNG DI BLADE
    ====================================================== --}}

    <style>

        /* =====================================================
           ROOT
        ====================================================== */

        :root {
            --brown: #481d08;
            --brown-dark: #351306;

            --green: #087849;
            --green-dark: #05633c;

            --white: #ffffff;

            --cream: #f7f2eb;

            --gold: #c8a363;

            --text: #3d1b0b;

            --muted: #756961;
        }


        /* =====================================================
           RESET
        ====================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: "DM Sans", sans-serif;

            background: var(--brown);

            color: var(--text);

            overflow-x: hidden;
        }


        img {
            display: block;

            max-width: 100%;
        }


        button,
        input {
            font-family: inherit;
        }


        /* =====================================================
           MAIN PAGE
        ====================================================== */

        .agenda-page {

            min-height: 100vh;

            background: var(--brown);

            padding:
                40px
                0
                90px;
        }


        .agenda-container {

            width: min(
                1120px,
                92%
            );

            margin:
                0
                auto;
        }


        /* =====================================================
           HERO
        ====================================================== */

        .agenda-hero {

            position: relative;

            margin-bottom: 55px;
        }


        .hero-content {

            position: relative;

            z-index: 2;
        }


        .hero-small-title {

            display: inline-block;

            margin-bottom: 12px;

            color: var(--green);

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1.5px;
        }


        .hero-content h1 {

            color: white;

            font-family:
                "Playfair Display",
                serif;

            font-size:
                clamp(
                    27px,
                    4vw,
                    40px
                );

            line-height: 1.25;
        }


        .hero-content p {

            max-width: 650px;

            margin-top: 15px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.7
                );

            font-family:
                "Playfair Display",
                serif;

            font-size: 13px;

            font-style: italic;

            line-height: 1.7;
        }


        /* =====================================================
           AGENDA GRID
        ====================================================== */

        .agenda-grid {

            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(
                        0,
                        1fr
                    )
                );

            gap: 28px;
        }


        /* =====================================================
           AGENDA CARD
        ====================================================== */

        .agenda-card {

            position: relative;

            min-height: 285px;

            padding:
                25px
                22px
                22px;

            display: flex;

            flex-direction: column;

            background: white;

            border-radius: 12px;

            box-shadow:
                0 10px 28px
                rgba(
                    0,
                    0,
                    0,
                    0.18
                );

            opacity: 0;

            transform:
                translateY(25px);

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                opacity 0.7s ease;
        }


        .agenda-card.show {

            opacity: 1;

            transform:
                translateY(0);
        }


        .agenda-card:hover {

            transform:
                translateY(-6px);

            box-shadow:
                0 18px 35px
                rgba(
                    0,
                    0,
                    0,
                    0.25
                );
        }


        /* =====================================================
           LABEL
        ====================================================== */

        .agenda-label {

            align-self: flex-start;

            display: inline-flex;

            padding:
                5px
                10px;

            border-radius: 20px;

            background:
                #e8f5ef;

            color: var(--green);

            font-size: 8px;

            font-weight: 700;

            letter-spacing: 0.8px;
        }


        /* =====================================================
           TITLE
        ====================================================== */

        .agenda-card h2 {

            margin-top: 14px;

            color: var(--brown);

            font-family:
                "Playfair Display",
                serif;

            font-size: 20px;

            line-height: 1.35;

            display: -webkit-box;

            -webkit-line-clamp: 2;

            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* =====================================================
           MATERI
        ====================================================== */

        .agenda-materi {

            margin-top: 9px;

            color: var(--muted);

            font-family:
                "Playfair Display",
                serif;

            font-size: 11px;

            font-style: italic;

            line-height: 1.7;

            display: -webkit-box;

            -webkit-line-clamp: 3;

            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* =====================================================
           INFO
        ====================================================== */

        .agenda-info {

            margin-top: auto;

            padding-top: 18px;

            display: flex;

            flex-direction: column;

            gap: 9px;

            border-top:
                1px solid
                #eeeeee;
        }


        .agenda-info-item {

            display: flex;

            align-items: flex-start;

            gap: 9px;

            color: #776c65;

            font-size: 10px;

            line-height: 1.5;
        }


        .agenda-info-icon {

            flex-shrink: 0;

            color: var(--green);

            font-size: 12px;
        }


        .agenda-info-item strong {

            color: var(--brown);

            font-weight: 600;
        }


        /* =====================================================
           EMPTY
        ====================================================== */

        .agenda-empty {

            grid-column:
                1 / -1;

            padding:
                65px
                25px;

            text-align: center;

            border:
                1px dashed
                rgba(
                    255,
                    255,
                    255,
                    0.3
                );

            border-radius: 12px;

            color: white;
        }


        .agenda-empty-icon {

            margin-bottom: 12px;

            font-size: 38px;
        }


        .agenda-empty h2 {

            font-family:
                "Playfair Display",
                serif;

            font-size: 24px;
        }


        .agenda-empty p {

            margin-top: 9px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.65
                );

            font-size: 12px;
        }


        /* =====================================================
           PAGINATION
        ====================================================== */

        .agenda-pagination {

            margin-top: 50px;

            display: flex;

            justify-content: center;

            align-items: center;
        }


        .agenda-pagination nav {

            display: flex;

            justify-content: center;
        }


        .agenda-pagination nav > div:first-child {

            display: none;
        }


        .agenda-pagination nav > div:last-child {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;
        }


        .agenda-pagination a,
        .agenda-pagination span {

            min-width: 35px;

            height: 35px;

            padding:
                0
                9px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 7px;

            text-decoration: none;

            font-size: 11px;

            font-weight: 600;
        }


        /* Nomor halaman */

        .agenda-pagination a {

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.10
                );

            color: white;

            transition:
                0.25s ease;
        }


        .agenda-pagination a:hover {

            background: white;

            color: var(--brown);
        }


        /* Halaman aktif */

        .agenda-pagination span[aria-current="page"] {

            background: white;

            color: var(--brown);
        }


        /* Disabled */

        .agenda-pagination span:not([aria-current="page"]) {

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.08
                );

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.4
                );
        }


        /* =====================================================
           CLOSING
        ====================================================== */

        .agenda-closing {

            max-width: 680px;

            margin:
                85px
                auto
                0;

            text-align: center;
        }


        .closing-line {

            width: 50px;

            height: 2px;

            margin:
                0
                auto
                22px;

            background:
                var(--green);
        }


        .agenda-closing h2 {

            color: white;

            font-family:
                "Playfair Display",
                serif;

            font-size: 25px;

            line-height: 1.4;
        }


        .agenda-closing h2 span {

            color:
                var(--green);
        }


        .agenda-closing p {

            margin-top: 10px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.65
                );

            font-family:
                "Playfair Display",
                serif;

            font-size: 11px;

            font-style: italic;

            line-height: 1.7;
        }


        /* =====================================================
           TABLET
        ====================================================== */

        @media (max-width: 850px) {

            .agenda-grid {

                grid-template-columns:
                    repeat(
                        2,
                        minmax(
                            0,
                            1fr
                        )
                    );
            }

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 560px) {

            .agenda-page {

                padding:
                    28px
                    0
                    65px;
            }


            .agenda-container {

                width: 90%;
            }


            .hero-content h1 {

                font-size: 26px;
            }


            .hero-content p {

                font-size: 11px;
            }


            .agenda-grid {

                grid-template-columns: 1fr;

                gap: 22px;
            }


            .agenda-card {

                min-height: 260px;
            }


            .agenda-closing {

                margin-top: 65px;
            }


            .agenda-closing h2 {

                font-size: 21px;
            }

        }

    </style>

</head>


<body>


{{-- =====================================================
    NAVBAR
====================================================== --}}

@include('components.navbar')



{{-- =====================================================
    MAIN
====================================================== --}}

<main class="agenda-page">

    <div class="agenda-container">


        {{-- =================================================
            HERO
        ================================================== --}}

        <section class="agenda-hero reveal">

            <div class="hero-overlay"></div>

            <div class="hero-content">

                <span class="hero-small-title">
                    AGENDA KEGIATAN
                </span>


                <h1>

                    Informasi jadwal dan kegiatan<br>

                    Ekstrakurikuler Seni Multikalter

                </h1>


                <p>

                    Temukan berbagai informasi kegiatan,
                    latihan, dan agenda Ekstrakurikuler
                    Seni Multikalter.

                </p>

            </div>

        </section>



        {{-- =================================================
            GRID AGENDA
        ================================================== --}}

        <section class="agenda-grid">


            @forelse($agenda as $item)


                <article class="agenda-card reveal">


                    {{-- LABEL --}}

                    <span class="agenda-label">

                        AGENDA

                    </span>



                    {{-- NAMA KEGIATAN --}}

                    <h2>

                        {{ $item->nama_kegiatan }}

                    </h2>



                    {{-- MATERI --}}

                    <p class="agenda-materi">

                        {{ $item->materi ?: 'Tidak ada materi yang tersedia.' }}

                    </p>



                    {{-- INFO --}}

                    <div class="agenda-info">


                        {{-- TEMPAT --}}

                        <div class="agenda-info-item">

                            <span class="agenda-info-icon">
                                📍
                            </span>


                            <div>

                                <strong>
                                    Tempat
                                </strong>

                                <br>

                                {{ $item->tempat ?: '-' }}

                            </div>

                        </div>



                        {{-- WAKTU --}}

                        <div class="agenda-info-item">

                            <span class="agenda-info-icon">
                                🕐
                            </span>


                            <div>

                                <strong>
                                    Waktu
                                </strong>

                                <br>

                                {{ $item->waktu ?: '-' }}

                            </div>

                        </div>


                    </div>


                </article>


            @empty


                {{-- =================================================
                    JIKA BELUM ADA DATA
                ================================================== --}}

                <div class="agenda-empty">


                    <div class="agenda-empty-icon">
                        📅
                    </div>


                    <h2>
                        Belum Ada Agenda
                    </h2>


                    <p>
                        Belum ada kegiatan yang
                        ditambahkan ke dalam agenda.
                    </p>


                </div>


            @endforelse


        </section>



        {{-- =================================================
            PAGINATION
        ================================================== --}}

        @if(
            $agenda instanceof \Illuminate\Pagination\LengthAwarePaginator
            &&
            $agenda->hasPages()
        )

            <div class="agenda-pagination">

                {{ $agenda->links() }}

            </div>

        @endif



        {{-- =================================================
            CLOSING
        ================================================== --}}

        <section class="agenda-closing reveal">


            <div class="closing-line"></div>


            <h2>

                Berkarya Bersama,

                <span>
                    Berkembang Bersama.
                </span>

            </h2>


            <p>

                Ikuti berbagai kegiatan Seni Multikalter
                dan jadilah bagian dari perjalanan
                berkarya bersama.

            </p>


        </section>


    </div>

</main>



{{-- =====================================================
    FOOTER
====================================================== --}}

@include('components.footer')



{{-- =====================================================
    JAVASCRIPT LANGSUNG DI BLADE
====================================================== --}}

<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {


        /* =================================================
           REVEAL ANIMATION
        ================================================== */

        const revealElements =
            document.querySelectorAll(
                ".reveal"
            );


        if (
            "IntersectionObserver"
            in window
        ) {


            const observer =
                new IntersectionObserver(

                    function (entries) {


                        entries.forEach(

                            function (entry) {


                                if (
                                    entry.isIntersecting
                                ) {


                                    entry.target
                                        .classList
                                        .add("show");


                                    observer.unobserve(
                                        entry.target
                                    );

                                }

                            }

                        );

                    },

                    {
                        threshold: 0.12
                    }

                );


            revealElements.forEach(

                function (element) {

                    observer.observe(
                        element
                    );

                }

            );


        } else {


            revealElements.forEach(

                function (element) {

                    element.classList.add(
                        "show"
                    );

                }

            );

        }


    }

);

</script>


</body>

</html>