<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota | Seni Multikalter</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/anggota.css') }}">
</head>

<body>
    @include('components.navbar')
    <main class="anggota-page" x-data="anggotaApp({{ Js::from($anggota) }})">
        <!-- HERO -->
        <section class="anggota-hero reveal">
            <div class="hero-decoration">
                <span>SM</span>
            </div>

            <div class="hero-content">
                <span class="hero-label">SENI MULTIKALTER</span>
                <h1>Kenali para<span>seniman.</span></h1>
                <p>
                    Kenali anggota Seni Multikalter yang
                    menjadi bagian dari perjalanan berkarya,
                    berkolaborasi, dan melestarikan seni
                    di SMKN 2 Purwakarta.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="anggota-content">
            <div class="section-header reveal">
                <div>
                    <span class="section-label">OUR MEMBERS</span>
                    <h2>Anggota Seni Multikalter</h2>
                </div>
                <p>
                    Setiap anggota memiliki peran,
                    kemampuan, dan cerita yang berbeda.
                </p>
            </div>

            <div class="stats-grid reveal">
                <!-- TOTAL ANGGOTA -->
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div>
                        <span>Total Anggota</span>
                        <strong x-text="anggota.length"></strong>
                    </div>
                </div>

                <!-- BIDANG -->
                <div class="stat-card">
                    <div class="stat-icon green">✦</div>
                    <div>
                        <span>Bidang Seni</span>
                        <strong x-text="totalBidang"></strong>
                    </div>
                </div>

                <!-- ANGKATAN -->
                <div class="stat-card">
                    <div class="stat-icon">12</div>
                    <div>
                        <span>Angkatan</span>
                        <strong x-text="totalAngkatan"></strong>
                    </div>
                </div>

                <!-- ANGGOTA AKTIF -->
                <div class="stat-card">
                    <div class="stat-icon green">✓</div>
                    <div>
                        <span>Anggota Aktif</span>
                        <strong x-text="anggota.length"></strong>
                    </div>
                </div>
            </div>

            <!-- FILTER ANGGOTA -->
            <div class="filter-box reveal">
                <div class="filter-title">
                    <span>FILTER ANGGOTA</span>
                    <h3>Cari Anggota</h3>
                </div>

                <div class="filter-controls">
                    <!-- SEARCH -->
                    <div class="search-box">
                        <span>⌕</span>
                        <input type="text" x-model="search" placeholder="Cari nama anggota...">
                    </div>

                    <!-- BIDANG -->
                    <select x-model="bidang">
                        <option value="">Semua Bidang</option>
                        <template x-for="b in daftarBidang":key="b">
                            <optio :value="b" x-text="b"></option>
                        </template>
                    </select>

                    <!-- ANGKATAN -->
                    <select x-model="angkatan">
                        <option value="">Semua Angkatan</option>
                        <template x-for="a in daftarAngkatan":key="a">
                            <option :value="a" x-text="'Angkatan ' + a"></option>
                        </template>
                    </select>

                    <!-- RESET -->
                    <button type="button" class="reset-button" @click="reset()">Reset</button>
                </div>
            </div>

            <!-- HASIL FILTER -->
            <div class="result-info reveal">
                <div>
                    Menampilkan
                    <strong x-text="filtered.length"></strong>
                    anggota
                </div>

                <div>
                    <span x-show="search || bidang || angkatan">Filter aktif</span>
                </div>
            </div>

            <!-- DESKTOP TABLE -->
            <div class="member-table-wrapper reveal">
                <table class="member-table">
                    <thead>
                        <tr>
                            <th class="number-column">No</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- DATA DARI DATABASE -->
                        <template x-for="(row, i) in paginated" :key="row.id">
                            <tr>
                                <!-- NOMOR -->
                                <td
                                    class="number-column"
                                    x-text="startIndex + i + 1"
                                ></td>

                                <!-- NAMA -->
                                <td>
                                    <div class="member-name">
                                        <div
                                            class="member-avatar"
                                            x-text="initial(row.nama)"
                                        ></div>

                                        <span x-text="row.nama"></span>
                                    </div>
                                </td>

                                <!-- BIDANG -->
                                <td>
                                    <span
                                        class="field-badge"
                                        x-text="row.bidang"
                                    ></span>
                                </td>

                                <!-- KELAS -->
                                <td x-text="row.kelas"></td>

                                <!-- ANGKATAN -->
                                <td x-text="row.angkatan"></td>

                                <!-- STATUS -->
                                <td>
                                    <span class="status-badge status-active">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        </template>

                        <!-- DATA KOSONG -->
                        <tr x-show="filtered.length === 0">
                            <td colspan="6" class="empty-table">
                                <div>
                                    <span>☹</span>

                                    <h3>Anggota tidak ditemukan</h3>

                                    <p>
                                        Coba gunakan kata kunci
                                        atau filter yang berbeda.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARDS -->
            <div class="mobile-members">
                <template x-for="(row, i) in paginated" :key="'mobile-' + row.id">
                    <article class="member-mobile-card">
                        <div class="mobile-card-top">
                            <div
                                class="member-avatar large"
                                x-text="initial(row.nama)"
                            ></div>

                            <div>
                                <h3 x-text="row.nama"></h3>
                                <span x-text="row.bidang"></span>
                            </div>

                            <span class="status-badge status-active">
                                Aktif
                            </span>
                        </div>

                        <div class="mobile-card-info">
                            <div>
                                <small>Kelas</small>
                                <strong x-text="row.kelas"></strong>
                            </div>

                            <div>
                                <small>Angkatan</small>
                                <strong x-text="row.angkatan"></strong>
                            </div>
                        </div>
                    </article>
                </template>

                <!-- MOBILE EMPTY -->
                <div
                    class="mobile-empty"
                    x-show="filtered.length === 0"
                >
                    <strong>Tidak ada anggota</strong>

                    <p>
                        Data yang kamu cari belum ditemukan.
                    </p>
                </div>
            </div>

            <!-- PAGINATION -->
            <div
                class="pagination reveal"
                x-show="totalPages > 1"
            >
                <!-- PREVIOUS -->
                <button
                    type="button"
                    @click="previousPage()"
                    :disabled="currentPage === 1"
                    class="pagination-arrow"
                >
                    ←
                </button>

                <!-- NOMOR HALAMAN -->
                <template
                    x-for="
                        page in Array.from(
                            {
                                length: Math.min(
                                    6,
                                    totalPages -
                                    (Math.floor((currentPage - 1) / 6) * 6)
                                )
                            },
                            (_, i) =>
                                (Math.floor((currentPage - 1) / 6) * 6) + i + 1
                        )
                    "
                    :key="page"
                >
                    <button
                        type="button"
                        class="pagination-number"
                        :class="{ 'active': currentPage === page }"
                        @click="goToPage(page)"
                        x-text="page"
                    ></button>
                </template>

                <!-- NEXT -->
                <button
                    type="button"
                    @click="nextPage()"
                    :disabled="currentPage === totalPages"
                    class="pagination-arrow"
                >
                    →
                </button>
            </div>
        </section>

        <!-- QUOTE -->
        <section class="member-quote reveal">
            <div class="quote-inner">
                <span>SENI MULTIKALTER</span>

                <h2>
                    Bersama berkarya,
                    <em>bersama menginspirasi.</em>
                </h2>

                <p>
                    Karena setiap anggota memiliki cerita
                    dan setiap karya memiliki makna.
                </p>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    @include('components.footer')

    <!-- CUSTOM JS -->
    <script src="{{ asset('js/user/anggota.js') }}"></script>
</body>

</html>