<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Menampilkan semua data prestasi
     */
    public function index(Request $request)
    {
        $query = Prestasi::query();

        // Pencarian berdasarkan nama prestasi atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_prestasi', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Ambil data terbaru
        $prestasi = $query
            ->orderBy('id_prestasi', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.prestasi', compact('prestasi'));
    }


    /**
     * Menampilkan prestasi di halaman user
     */
    public function userIndex(Request $request)
    {
        $query = Prestasi::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_prestasi', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $prestasi = $query
            ->orderBy('id_prestasi', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('user.prestasi', compact('prestasi'));
    }


    /**
     * Menyimpan prestasi baru
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Nama foto
        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            // Membuat nama file unik
            $namaFoto = time() . '_' .
                uniqid() . '.' .
                $foto->getClientOriginalExtension();

            // Simpan ke public/images/prestasi
            $foto->move(
                public_path('images/prestasi'),
                $namaFoto
            );
        }

        // Simpan ke database
        Prestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
        ]);

        return redirect()
            ->route('admin.prestasi')
            ->with(
                'success',
                'Prestasi berhasil ditambahkan dan disimpan ke database.'
            );
    }


    /**
     * Mengubah data prestasi
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Cari data berdasarkan id_prestasi
        $prestasi = Prestasi::findOrFail($id);

        // Data yang akan diperbarui
        $data = [
            'nama_prestasi' => $request->nama_prestasi,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika user memilih foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $prestasi->foto &&
                file_exists(
                    public_path(
                        'images/prestasi/' . $prestasi->foto
                    )
                )
            ) {
                unlink(
                    public_path(
                        'images/prestasi/' . $prestasi->foto
                    )
                );
            }

            // Upload foto baru
            $foto = $request->file('foto');

            $namaFoto = time() . '_' .
                uniqid() . '.' .
                $foto->getClientOriginalExtension();

            $foto->move(
                public_path('images/prestasi'),
                $namaFoto
            );

            // Masukkan nama foto baru ke data
            $data['foto'] = $namaFoto;
        }

        // Update database
        $prestasi->update($data);

        return redirect()
            ->route('admin.prestasi')
            ->with(
                'success',
                'Prestasi berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data prestasi
     */
    public function destroy($id)
    {
        // Cari berdasarkan id_prestasi
        $prestasi = Prestasi::findOrFail($id);

        // Hapus foto dari folder
        if (
            $prestasi->foto &&
            file_exists(
                public_path(
                    'images/prestasi/' . $prestasi->foto
                )
            )
        ) {
            unlink(
                public_path(
                    'images/prestasi/' . $prestasi->foto
                )
            );
        }

        // Hapus data dari database
        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi')
            ->with(
                'success',
                'Prestasi berhasil dihapus.'
            );
    }
}