<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    /**
     * =========================================================
     * HALAMAN ADMIN
     * =========================================================
     */
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_upload', $request->tanggal);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul_galeri', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $galeri = $query
            ->orderBy('tanggal_upload', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.galeri', compact('galeri'));
    }


    /**
     * =========================================================
     * SIMPAN DATA GALERI BARU
     * =========================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_galeri' => 'required|string|max:255',

            'kategori' => [
                'required',
                'in:Tari Tradisi,Modern Dance,Vokal,Kabaret,Angklung & Musik,Foto Bersama'
            ],

            'tanggal_upload' => 'required|date',

            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);


        /*
        |--------------------------------------------------------------------------
        | BUAT FOLDER
        |--------------------------------------------------------------------------
        */

        $folder = public_path('uploads/galeri');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FOTO
        |--------------------------------------------------------------------------
        */

        $file = $request->file('foto');

        $filename = time()
            . '_'
            . uniqid()
            . '.'
            . $file->getClientOriginalExtension();

        $file->move($folder, $filename);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KE DATABASE
        |--------------------------------------------------------------------------
        */

        $galeri = new Galeri();

        $galeri->judul_galeri = $request->judul_galeri;
        $galeri->kategori = $request->kategori;
        $galeri->tanggal_upload = $request->tanggal_upload;

        // Yang disimpan ke database hanya nama file
        $galeri->foto = $filename;

        $galeri->save();


        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }


    /**
     * =========================================================
     * UPDATE DATA GALERI
     * =========================================================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_galeri' => 'required|string|max:255',

            'kategori' => [
                'required',
                'in:Tari Tradisi,Modern Dance,Vokal,Kabaret,Angklung & Musik,Foto Bersama'
            ],

            'tanggal_upload' => 'required|date',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);


        $galeri = Galeri::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | UPDATE FOTO JIKA ADA FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $folder = public_path('uploads/galeri');

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }


            // Hapus foto lama
            if (
                $galeri->foto &&
                File::exists($folder . '/' . $galeri->foto)
            ) {
                File::delete($folder . '/' . $galeri->foto);
            }


            // Simpan foto baru
            $file = $request->file('foto');

            $filename = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move($folder, $filename);

            $galeri->foto = $filename;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $galeri->judul_galeri = $request->judul_galeri;
        $galeri->kategori = $request->kategori;
        $galeri->tanggal_upload = $request->tanggal_upload;

        $galeri->save();


        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }


    /**
     * =========================================================
     * HAPUS DATA GALERI
     * =========================================================
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE FOTO
        |--------------------------------------------------------------------------
        */

        if ($galeri->foto) {

            $path = public_path(
                'uploads/galeri/' . $galeri->foto
            );

            if (File::exists($path)) {
                File::delete($path);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA DATABASE
        |--------------------------------------------------------------------------
        */

        $galeri->delete();


        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Data galeri berhasil dihapus.');
    }
}