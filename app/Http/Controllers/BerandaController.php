<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Agenda;
use App\Models\Galeri;

class BerandaController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | JUMLAH DATA
        |--------------------------------------------------------------------------
        */

        $totalAnggota = Anggota::count();
        $totalBerita = Berita::count();
        $totalPrestasi = Prestasi::count();
        $totalAgenda = Agenda::count();
        $totalGaleri = Galeri::count();


        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        |
        | Mengambil 5 berita terbaru berdasarkan tanggal_upload.
        |
        */

        $berita = Berita::orderBy('tanggal_upload', 'desc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AGENDA
        |--------------------------------------------------------------------------
        |
        | Mengambil 5 agenda berdasarkan waktu.
        |
        */

        $agenda = Agenda::orderBy('waktu', 'asc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PRESTASI
        |--------------------------------------------------------------------------
        |
        | Tidak menggunakan latest() karena tabel prestasi
        | tidak memiliki created_at.
        |
        */

        $prestasi = Prestasi::orderBy('id_prestasi', 'desc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GALERI
        |--------------------------------------------------------------------------
        */

        $galeri = Galeri::orderBy('tanggal_upload', 'desc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE BERANDA USER
        |--------------------------------------------------------------------------
        */

        return view('user.beranda', compact(
            'totalAnggota',
            'totalBerita',
            'totalPrestasi',
            'totalAgenda',
            'totalGaleri',
            'berita',
            'agenda',
            'prestasi',
            'galeri'
        ));
    }
}