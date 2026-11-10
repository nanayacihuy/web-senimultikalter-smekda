<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Seni Multikalter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>
<body>
    <!-- ==================================================
         NAVBAR
    =================================================== -->
    @include('components.navbar')
    <main>
        <!-- ==================================================
             HERO / HOME 1
        =================================================== -->
        <section class="hero">
            <div class="hero-container">
                <!-- TEXT -->
                <div class="hero-text reveal">
                    <span class="hero-small-title">EKSTRAKURIKULER</span>
                    <h1>SENI<span>MULTIKALTER</span></h1>
                    <div class="hero-badge">“Wadahna Para Seniman”</div>
                    <p>
                        Tempat untuk belajar, berkarya,
                        berproses dan mengembangkan bakat
                        bersama keluarga besar Ekstrakurikuler
                        Seni Multikalter SMKN 2 Purwakarta.
                    </p>
                    <div class="hero-buttons">
                        <a href="#bidang" class="btn-primary">Jelajahi Bidang<span>→</span></a>
                    </div>
                </div>

                <!-- IMAGE -->
                <div class="hero-image reveal">
                    <img src="{{ asset('img/DokumSM(5).jpg') }}" alt="Kegiatan Seni Multikalter">
                    <div class="hero-image-overlay"></div>
                    <div class="hero-image-text">
                        <span>SENI MULTIKALTER</span>
                        <strong>Berkarya Bersama</strong>
                    </div>
                </div>
            </div>
            <!-- SCROLL INDICATOR -->
            <a href="#tentang" class="scroll-down">
                <span>Scroll untuk menjelajah</span>
                <b>↓</b>
            </a>
        </section>
        <!-- ==================================================
             TENTANG KAMI / HOME 2
        =================================================== -->
        <section class="about" id="tentang">
            <div class="about-container">
                <!-- IMAGE -->
                <div class="about-image reveal">
                    <img src="{{ asset('img/DokumSM(4).jpg') }}" alt="Tentang Seni Multikalter">
                    <div class="about-image-number">01</div>
                </div>

                <!-- TEXT -->
                <div class="about-text reveal">
                    <span class="section-tag">TENTANG KAMI</span>
                    <h2>Berkarya,<span>Berproses,</span>Bersama.</h2>
                    <p>
                        Seni Multikalter adalah wadah bagi
                        siswa/i yang memiliki minat dan bakat
                        di bidang seni.
                    </p>
                    <p>
                        Ekstrakurikuler ini menjadi tempat bagi
                        siswa untuk mengembangkan kreativitas,
                        berproses, berkarya, serta membangun
                        kebersamaan bersama keluarga besar
                        Seni Multikalter.
                    </p>
                    <a href="{{ route('user.profile') }}" class="text-button">Baca Selengkapnya<span>→</span></a>
                </div>
            </div>
        </section>
        <!-- ==================================================
             BIDANG SENI
        =================================================== -->
        <section class="bidang" id="bidang">
            <div class="section-container">
                <div class="section-heading reveal">
                    <div>
                        <span class="section-tag">BIDANG SENI</span>
                        <h2>Temukan Bidangmu</h2>
                    </div>
                    <p>
                        Temukan bidang seni yang sesuai
                        dengan minat dan bakatmu.
                    </p>
                </div>

                <div class="bidang-grid">
                    <!-- VOKAL -->
                    <article class="bidang-card reveal">
                        <div class="card-image">
                            <img src="{{ asset('img/DokumVocal(4).jpg') }}" alt="Vokal">
                        </div>

                        <div class="card-content">
                            <h3>Vokal</h3>
                            <p>
                                Arahkan kemampuan suara
                                indahmu dengan bernyanyi
                                bersama.
                            </p>
                            <span class="card-arrow">→</span>
                        </div>
                    </article>
                    <!-- ANGKLUNG -->
                    <article class="bidang-card reveal">
                        <div class="card-image">
                            <img src="{{ asset('img/DokumASIK(4).jpg') }}" alt="Angklung dan Musik">
                        </div>

                        <div class="card-content">
                            <h3>Angklung & Musik</h3>
                            <p>
                                Belajar teknik dan bermain
                                alat musik bersama.
                            </p>
                            <span class="card-arrow">→</span>
                        </div>
                    </article>
                    <!-- TARI -->
                    <article class="bidang-card reveal">
                        <div class="card-image">
                            <img src="{{ asset('img/DokumTari(3).jpeg') }}" alt="Tari Tradisi">
                        </div>

                        <div class="card-content">
                            <h3>Tari Tradisi</h3>
                            <p>
                                Melestarikan budaya melalui
                                gerakan yang indah.
                            </p>
                            <span class="card-arrow">→</span>
                        </div>
                    </article>
                    <!-- MODERN DANCE -->
                    <article class="bidang-card reveal">
                        <div class="card-image">
                            <img src="{{ asset('img/DokumDance(4).jpg') }}" alt="Modern Dance">
                        </div>

                        <div class="card-content">
                            <h3>Modern Dance</h3>
                            <p>
                                Ekspresikan dirimu melalui
                                gerakan yang energik.
                            </p>
                            <span class="card-arrow">→</span>
                        </div>
                    </article>
                      <!-- KABARET -->
                    <article class="bidang-card reveal">
                        <div class="card-image">
                            <img src="{{ asset('img/DokumKabaret(1).jpeg') }}" alt="Modern Dance">
                        </div>

                        <div class="card-content">
                            <h3>KABARET</h3>
                            <p>
                                Tuangkan ekspresimu melalui seni peran yang penuh cerita.
                            </p>
                            <span class="card-arrow">→</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- ==================================================
             PRESTASI
        =================================================== -->
        <section class="prestasi">
            <div class="section-container">
                <div class="section-heading light reveal">
                    <div>
                        <span class="section-tag">PRESTASI</span>
                        <h2>Jejak Prestasi</h2>
                    </div>
                    <p>
                        Beberapa pencapaian dan prestasi
                        yang telah diperoleh anggota Seni
                        Multikalter.
                    </p>
                </div>

                <div class="prestasi-grid">
                    @forelse($prestasi as $item)
                        <article class="prestasi-card reveal">
                            <div class="prestasi-image">
                                <img
                                    src="{{ $item->foto ? asset('images/prestasi/' . $item->foto) : asset('img/DokumSM(4).jpg') }}"
                                    alt="{{ $item->nama_prestasi }}"
                                >
                            </div>

                            <div class="prestasi-content">
                                <h3>{{ $item->nama_prestasi }}</h3>
                                <p>{{ Str::limit($item->deskripsi, 90) }}</p>
                            </div>
                        </article>
                    @empty
                        <p style="color:#fff; text-align:center; width:100%;">
                            Belum ada prestasi yang ditambahkan.
                        </p>
                    @endforelse
                </div>


                <div class="center-button">
                    <a href="{{ route('user.prestasi') }}" class="outline-button">
                        Lihat Lebih Banyak
                        <span>→</span>
                    </a>
                </div>
            </div>
        </section>
        <!-- ==================================================
             GALERI
        =================================================== -->
        <section class="galeri">
            <div class="section-container">
                <div class="section-heading reveal">
                    <div>
                        <span class="section-tag">GALERI</span>
                        <h2>Momen Kami</h2>
                    </div>
                    <p>
                        Momen kebersamaan adalah hal yang
                        berharga. Lihat perjalanan Seni
                        Multikalter melalui galeri kami.
                    </p>
                </div>

                <div class="gallery-grid">
                    @forelse($galeri as $index => $item)
                        <div
                            class="gallery-item {{ $index === 0 ? 'gallery-large' : '' }} reveal"
                            data-image="{{ asset('storage/' . $item->foto) }}"
                        >
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul_galeri }}">
                        </div>
                    @empty
                        <p style="color:#fff; text-align:center; width:100%;">
                            Belum ada dokumentasi galeri.
                        </p>
                    @endforelse
                </div>

                <div class="center-button">
                     <a href="{{ route('user.galeri') }}" class="text-button">Lihat Dokumentasi Lainnya<span>→</span></a>
                </div>
            </div>
        </section>
        <!-- ==================================================
             AGENDA
        =================================================== -->
        <section class="agenda">
            <div class="section-container">
                <div class="section-heading light reveal">
                    <div>
                        <span class="section-tag">AGENDA</span>
                        <h2>Agenda Terdekat</h2>
                    </div>
                </div>

                <div class="agenda-box reveal">
                    <div class="agenda-title">
                        <span>JADWAL LATIHAN</span>
                        <h3>Bidang Seni Multikalter</h3>
                    </div>

                    <div class="jadwal-grid">
                        <div class="jadwal-card">
                            <span>RABU</span>
                            <h4>Tari Tradisi</h4>
                            <p>Latihan rutin bidang tari.</p>
                        </div>

                        <div class="jadwal-card">
                            <span>KAMIS</span>
                            <h4>Vokal</h4>
                            <p>Latihan rutin bidang vokal.</p>
                        </div>

                        <div class="jadwal-card">
                            <span>KAMIS</span>
                            <h4>Angklung & Musik</h4>
                            <p>Latihan rutin bidang musik.</p>
                        </div>

                        <div class="jadwal-card">
                            <span>SELASA</span>
                            <h4>Modern Dance</h4>
                            <p>Latihan rutin modern dance.</p>
                        </div>

                        <div class="jadwal-card">
                            <span>RABU</span>
                            <h4>Kabaret</h4>
                            <p>Jadwal latihan kabaret.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ==================================================
         FOOTER
    =================================================== -->
    @include('components.footer')
    <!-- ==================================================
         GALLERY MODAL
    =================================================== -->
    <div class="gallery-modal" id="galleryModal">
        <button class="modal-close" id="modalClose"> ×</button>
        <img src="" alt="Preview Galeri" id="modalImage">
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('js/user/beranda.js') }}"></script>
</body>

</html>