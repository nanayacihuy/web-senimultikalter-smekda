<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan semua berita di halaman admin.
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        // Pencarian berdasarkan judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul_berita', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_berita', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate(
                'tanggal_upload',
                $request->tanggal
            );
        }

        // Ambil data terbaru
        $berita = $query
            ->orderBy('tanggal_upload', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita', compact('berita'));
    }


    /**
     * Menampilkan berita di halaman user.
     */
    public function userIndex(Request $request)
    {
        $query = Berita::query();

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul_berita', 'like', "%{$search}%")
                  ->orWhere('deskripsi_berita', 'like', "%{$search}%");
            });
        }

        // Ambil berita terbaru
        $berita = $query
            ->orderBy('tanggal_upload', 'desc')
            ->orderBy('id_berita', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('user.berita', compact('berita'));
    }


    /**
     * Menyimpan berita baru dari halaman admin.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'deskripsi_berita' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_upload' => 'required|date',
        ]);

        // Nama foto
        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $namaFoto = time() . '_' .
                uniqid() . '.' .
                $foto->getClientOriginalExtension();

            // Simpan ke public/images/berita
            $foto->move(
                public_path('images/berita'),
                $namaFoto
            );
        }

        // Simpan ke database
        Berita::create([
            'judul_berita' => $request->judul_berita,
            'deskripsi_berita' => $request->deskripsi_berita,
            'foto' => $namaFoto,
            'tanggal_upload' => $request->tanggal_upload,
        ]);

        return redirect()
            ->route('admin.berita')
            ->with(
                'success',
                'Berita berhasil ditambahkan dan disimpan ke database.'
            );
    }


    /**
     * Menampilkan halaman edit berita.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        return view(
            'admin.berita-edit',
            compact('berita')
        );
    }


    /**
     * Memperbarui berita.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // Validasi
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'deskripsi_berita' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_upload' => 'required|date',
        ]);

        // Update data teks
        $berita->judul_berita = $request->judul_berita;
        $berita->deskripsi_berita = $request->deskripsi_berita;
        $berita->tanggal_upload = $request->tanggal_upload;


        // Kalau user mengganti foto
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $berita->foto &&
                file_exists(
                    public_path(
                        'images/berita/' . $berita->foto
                    )
                )
            ) {
                unlink(
                    public_path(
                        'images/berita/' . $berita->foto
                    )
                );
            }

            // Upload foto baru
            $foto = $request->file('foto');

            $namaFoto = time() . '_' .
                uniqid() . '.' .
                $foto->getClientOriginalExtension();

            $foto->move(
                public_path('images/berita'),
                $namaFoto
            );

            // Simpan nama foto baru
            $berita->foto = $namaFoto;
        }


        // Simpan perubahan
        $berita->save();

        return redirect()
            ->route('admin.berita')
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }


    /**
     * Menghapus berita.
     */
    public function destroy($id)
    {
        // Cari berita
        $berita = Berita::findOrFail($id);

        // Hapus foto dari folder
        if (
            $berita->foto &&
            file_exists(
                public_path(
                    'images/berita/' . $berita->foto
                )
            )
        ) {
            unlink(
                public_path(
                    'images/berita/' . $berita->foto
                )
            );
        }

        // Hapus data dari database
        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }
}