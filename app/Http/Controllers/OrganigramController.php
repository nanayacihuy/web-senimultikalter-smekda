<?php

namespace App\Http\Controllers;

use App\Models\Organigram;
use Illuminate\Http\Request;

class OrganigramController extends Controller
{
    public function index(Request $request)
    {
        $query = Organigram::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengurus', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('bidang_pengurus', 'like', "%{$search}%");
            });
        }

        $organigram = $query->orderBy('id_pengurus', 'asc')->get();

        return view('admin.organigram', compact('organigram'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bidang_pengurus' => 'nullable|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $namaFoto = null;


        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');

            $namaFoto = time() . '_' .
                        uniqid() . '.' .
                        $foto->getClientOriginalExtension();

            $foto->move(
                public_path('images/organigram'),
                $namaFoto
            );
        }


        Organigram::create([
            'nama_pengurus' =>
                $request->nama_pengurus,

            'jabatan' =>
                $request->jabatan,

            'bidang_pengurus' =>
                $request->bidang_pengurus,

            'foto' =>
                $namaFoto,
        ]);


        return redirect()
            ->route('admin.organigram')
            ->with(
                'success',
                'Data kepengurusan berhasil ditambahkan.'
            );
    }


    public function update(
        Request $request,
        $id
    ) {

        $request->validate([
            'nama_pengurus' =>
                'required|string|max:255',

            'jabatan' =>
                'required|string|max:255',

            'bidang_pengurus' =>
                'nullable|string|max:255',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $organigram =
            Organigram::findOrFail($id);


        $data = [
            'nama_pengurus' =>
                $request->nama_pengurus,

            'jabatan' =>
                $request->jabatan,

            'bidang_pengurus' =>
                $request->bidang_pengurus,
        ];


        // Kalau admin memilih foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $organigram->foto &&
                file_exists(
                    public_path(
                        'images/organigram/' .
                        $organigram->foto
                    )
                )
            ) {

                unlink(
                    public_path(
                        'images/organigram/' .
                        $organigram->foto
                    )
                );

            }


            // Simpan foto baru
            $foto = $request->file('foto');

            $namaFoto =
                time() . '_' .
                uniqid() . '.' .
                $foto->getClientOriginalExtension();


            $foto->move(
                public_path('images/organigram'),
                $namaFoto
            );


            $data['foto'] =
                $namaFoto;
        }


        $organigram->update($data);


        return redirect()
            ->route('admin.organigram')
            ->with(
                'success',
                'Data kepengurusan berhasil diperbarui.'
            );
    }


    public function destroy($id)
    {
        $organigram =
            Organigram::findOrFail($id);


        // Hapus file foto
        if (
            $organigram->foto &&
            file_exists(
                public_path(
                    'images/organigram/' .
                    $organigram->foto
                )
            )
        ) {

            unlink(
                public_path(
                    'images/organigram/' .
                    $organigram->foto
                )
            );

        }


        $organigram->delete();


        return redirect()
            ->route('admin.organigram')
            ->with(
                'success',
                'Data kepengurusan berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN USER
    |--------------------------------------------------------------------------
    */

    public function userIndex()
    {
        $organigram =
            Organigram::orderBy(
                'id_pengurus',
                'asc'
            )->get();


        return view(
            'user.organigram',
            compact('organigram')
        );
    }
}