<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // ==========================================
    // HALAMAN USER
    // ==========================================
    public function index()
    {
        $anggota = Anggota::orderBy('id_anggota', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_anggota,
                    'id_anggota' => $item->id_anggota,

                    'nama' => $item->nama_anggota,
                    'nama_anggota' => $item->nama_anggota,

                    'kelas' => $item->kelas_anggota,
                    'kelas_anggota' => $item->kelas_anggota,

                    'bidang' => $item->bidang_anggota,
                    'bidang_anggota' => $item->bidang_anggota,

                    'angkatan' => $this->ambilAngkatan(
                        $item->kelas_anggota
                    ),

                    'status' => 'Aktif',
                ];
            })
            ->values();

        return view('user.anggota', compact('anggota'));
    }


    // ==========================================
    // HALAMAN ADMIN
    // ==========================================
    public function adminIndex(Request $request)
    {
        $query = Anggota::query();

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama_anggota',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'kelas_anggota',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'bidang_anggota',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $anggota = $query
            ->orderBy('id_anggota', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.anggota',
            compact('anggota')
        );
    }


    // ==========================================
    // TAMBAH ANGGOTA
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'kelas_anggota' => 'required|string|max:255',
            'bidang_anggota' => 'required|string|max:255',
        ]);

        Anggota::create([
            'nama_anggota' => $request->nama_anggota,
            'kelas_anggota' => $request->kelas_anggota,
            'bidang_anggota' => $request->bidang_anggota,
        ]);

        return redirect()
            ->route('admin.anggota')
            ->with(
                'success',
                'Data anggota berhasil ditambahkan.'
            );
    }


    // ==========================================
    // UPDATE / UBAH ANGGOTA
    // ==========================================
    public function update(Request $request, $id)
    {
        // VALIDASI DATA
        $validated = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'kelas_anggota' => 'required|string|max:255',
            'bidang_anggota' => 'required|string|max:255',
        ]);

        // CARI DATA BERDASARKAN id_anggota
        $anggota = Anggota::where(
            'id_anggota',
            $id
        )->firstOrFail();

        // UPDATE DATA
        $anggota->update([
            'nama_anggota' => $validated['nama_anggota'],
            'kelas_anggota' => $validated['kelas_anggota'],
            'bidang_anggota' => $validated['bidang_anggota'],
        ]);

        // KEMBALI KE HALAMAN ADMIN
        return redirect()
            ->route('admin.anggota')
            ->with(
                'success',
                'Data anggota berhasil diperbarui.'
            );
    }


    // ==========================================
    // HAPUS ANGGOTA
    // ==========================================
    public function destroy($id)
    {
        // CARI DATA
        $anggota = Anggota::where(
            'id_anggota',
            $id
        )->firstOrFail();

        // HAPUS DATA
        $anggota->delete();

        // KEMBALI KE HALAMAN ADMIN
        return redirect()
            ->route('admin.anggota')
            ->with(
                'success',
                'Data anggota berhasil dihapus.'
            );
    }


    // ==========================================
    // MENGAMBIL ANGKATAN DARI KELAS
    // ==========================================
    private function ambilAngkatan($kelas)
    {
        if (empty($kelas)) {
            return '-';
        }

        $upper = strtoupper(trim($kelas));

        // XII / 12
        if (
            preg_match('/\bXII\b/', $upper) ||
            str_starts_with($upper, '12')
        ) {
            return '12';
        }

        // XI / 11
        if (
            preg_match('/\bXI\b/', $upper) ||
            str_starts_with($upper, '11')
        ) {
            return '11';
        }

        // X / 10
        if (
            preg_match('/\bX\b/', $upper) ||
            str_starts_with($upper, '10')
        ) {
            return '10';
        }

        return '12';
    }
}