<!DOCTYPE html>
<html lang="id"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigram | Seni Multikalter</title>
    <link rel="stylesheet" href="{{ asset('css/organigram.css') }}">
</head>
<body>
    @include('components.navbar')
    <main class="organigram">
        <section class="header-organigram">
            <h1>STRUKTUR KEPENGURUSAN</h1>
            <h2>SENI MULTIKALTER</h2>
            <p>Periode 2025/2026</p>
            <!-- FOTO HEADER -->
            <img src="{{ asset('img/SERTIJAB2526.jpeg') }}" alt="Kegiatan Seni Multikalter"class="foto-organigram">
            <p class="deskripsi-header">
                Memperkenalkan jajaran pengurus yang siap menginspirasi,
                berkarya, dan menghidupkan kreasi bersama.
            </p>
        </section>
       <!-- =====================================================
     PEMBINA
====================================================== -->
<section class="bagian">
    <h3 class="judul-bagian">Pembina</h3>
    <div class="card-pembina">
        @php
            $pembina = $organigram->filter(function ($item) {
                return strtolower(trim($item->jabatan)) === 'pembina';
            });
        @endphp
        @forelse($pembina as $item)
            @if($item->foto)
                {{-- Sesuaikan folder path foto dengan tempat simpan dari halaman Admin --}}
                <img src="{{ asset('images/organigram/' . $item->foto) }}" alt="{{ $item->nama_pengurus }}"
                    onerror="this.src='{{ asset('img/DokumSM(4).jpg') }}'">
            @else
                <img src="{{ asset('img/DokumSM(4).jpg') }}" alt="{{ $item->nama_pengurus }}">
            @endif
            <h4>{{ $item->nama_pengurus }}</h4>
            <p>Pembina Seni Multikalter</p>
        @empty
            <div class="foto-kosong">-</div>
            <h4>Belum ada data pembina</h4>
            <p>-</p>
        @endforelse
    </div>
</section>
        <!-- =====================================================
             PELATIH
        ====================================================== -->
        <section class="bagian">
            <h3 class="judul-bagian">Pelatih Bidang</h3>
            <div class="pelatih-container">
                @php
                    $pelatih = $organigram->filter(function ($item) {
                        return strtolower(trim($item->jabatan)) === 'pelatih';
                    });
                @endphp
                @forelse($pelatih as $item)
                    <div class="card-pelatih">
                        @if($item->foto)
                            <img src="{{ asset('images/organigram/' . $item->foto) }}" alt="{{ $item->nama_pengurus }}"
                                onerror="this.src='{{ asset('img/DokumSM(4).jpg') }}'">
                        @else
                            <div class="foto-kosong">-</div>
                        @endif
                        <h4>{{ $item->bidang_pengurus ?: 'Pelatih' }}</h4>
                        <p> {{ $item->nama_pengurus }}</p>
                    </div>
                @empty
                    <!-- VOKAL -->
                    <div class="card-pelatih">
                        <div class="foto-kosong">-</div>
                        <h4>Vokal</h4>
                        <p>Belum ada data</p>
                    </div>
                    <!-- TARI TRADISI -->
                    <div class="card-pelatih">
                        <div class="foto-kosong">-</div>
                        <h4>Tari Tradisi</h4>
                        <p>Belum ada data</p>
                    </div>
                    <!-- ANGKLUNG & MUSIK -->
                    <div class="card-pelatih">
                        <div class="foto-kosong">-</div>
                        <h4>Angklung & Musik</h4>
                        <p>Belum ada data</p>
                    </div>
                    <!-- KABARET -->
                    <div class="card-pelatih">
                        <div class="foto-kosong">-</div>
                        <h4>Kabaret</h4>
                        <p>Belum ada data</p>
                    </div>
                    <!-- MODERN DANCE -->
                    <div class="card-pelatih">
                        <div class="foto-kosong">-</div>
                        <h4>Modern Dance</h4>
                        <p>Belum ada data</p>
                    </div>
                @endforelse
            </div>
        </section>
        <!-- =====================================================
             INTI SENI & BIDANG
        ====================================================== -->
        <section class="bagian">
            <h3 class="judul-bagian">Inti Seni dan Bidang</h3>
            <div class="bidang-container">
                @php
                    $daftarBidang = [
                        'Inti Umum Seni',
                        'Vokal',
                        'Tari Tradisi',
                        'Modern Dance',
                        'Kabaret',
                        'Angklung & Musik'
                    ];
                @endphp
                @foreach($daftarBidang as $bidang)
                    <!-- =================================================
                         CARD BIDANG
                    ================================================== -->
                    <div class="card-bidang">
                        <h4>
                            @if($bidang === 'Inti Umum Seni')
                                Inti Umum Seni
                            @else
                                Bidang {{ $bidang }}
                            @endif
                        </h4>
                        <div class="isi-bidang">
                            @php
                                /*
                                |--------------------------------------------------------------------------
                                | MENCARI DATA BERDASARKAN BIDANG
                                |--------------------------------------------------------------------------
                                */
                                $anggotaBidang = $organigram->filter(function ($item) use ($bidang) {
                                    return strtolower(trim($item->bidang_pengurus))
                                        === strtolower(trim($bidang));

                                });
                            @endphp
                            @forelse($anggotaBidang as $anggota)
                                <p>
                                    @if(strtolower(trim($anggota->jabatan)) === 'ketua')
                                        <b>Mentri (Ketua):{{ $anggota->nama_pengurus }} </b>
                                    @elseif(strtolower(trim($anggota->jabatan)) === 'wakil ketua')
                                        Wamentri (Wakil Ketua):{{ $anggota->nama_pengurus }}
                                    @else
                                        {{ $anggota->jabatan }}:
                                        {{ $anggota->nama_pengurus }}
                                    @endif
                                </p>
                            @empty
                                <p>Belum ada data pengurus.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    <!-- =====================================================
         FOOTER
    ====================================================== -->
    @include('components.footer')
</body>
</html>