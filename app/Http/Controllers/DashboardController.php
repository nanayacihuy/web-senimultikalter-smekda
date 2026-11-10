<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Agenda;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // JUMLAH DATA
        // =========================
        $totalAnggota = Anggota::count();
        $totalBerita = Berita::count();
        $totalPrestasi = Prestasi::count();
        $totalAgenda = Agenda::count();
        $totalGaleri = Galeri::count();

        // =========================
        // DATA TERBARU
        // =========================
        $berita = Berita::orderByDesc('tanggal_upload')
            ->take(5)
            ->get();

        $agenda = Agenda::take(5)
            ->get();

        $prestasi = Prestasi::orderByDesc('id_prestasi')
            ->take(5)
            ->get();

        $galeri = Galeri::orderByDesc('tanggal_upload')
            ->take(6)
            ->get();

        // =========================
        // KIRIM KE VIEW
        // =========================
        return view('admin.dashboard', compact(
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