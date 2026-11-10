<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROFILE ADMIN
    |--------------------------------------------------------------------------
    */

    public function indexAdmin()
    {
        $profile = Profile::first();

        return view('admin.profile', compact('profile'));
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN / UPDATE PROFILE DARI ADMIN
    |--------------------------------------------------------------------------
    */

    public function updateAdmin(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'judul' => 'required|string|max:255',

            'deskripsi' => 'nullable|string',

            'tujuan' => 'nullable|string',

            'visi' => 'nullable|string',

            'misi1' => 'nullable|string|max:255',
            'misi2' => 'nullable|string|max:255',
            'misi3' => 'nullable|string|max:255',
            'misi4' => 'nullable|string|max:255',
            'misi5' => 'nullable|string|max:255',
            'misi6' => 'nullable|string|max:255',

            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile();
        }


        /*
        |--------------------------------------------------------------------------
        | DATA MISSION
        |--------------------------------------------------------------------------
        */

        $misi = [];

        for ($i = 1; $i <= 6; $i++) {

            $namaMisi = 'misi' . $i;

            if ($request->filled($namaMisi)) {

                $misi[] = $request->input($namaMisi);

            }
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA PROFILE
        |--------------------------------------------------------------------------
        */

        $profile->judul = $request->judul;

        $profile->deskripsi = $request->deskripsi;

        $profile->tujuan = $request->tujuan;

        $profile->visi = $request->visi;

        /*
        | Misi disimpan menjadi HTML <ul><li>...</li></ul>
        */

        $profile->misi = '';

        if (count($misi) > 0) {

            $profile->misi = '<ul>';

            foreach ($misi as $item) {

                $profile->misi .= '<li>' . e($item) . '</li>';

            }

            $profile->misi .= '</ul>';
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD BANNER
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner')) {

            $file = $request->file('banner');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/profile'),
                $namaFile
            );

            $profile->banner = $namaFile;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $profile->save();


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN ADMIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Data profile berhasil disimpan.');
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROFILE USER
    |--------------------------------------------------------------------------
    */

    public function indexUser()
    {
        $profile = Profile::first();

        return view('user.profile', compact('profile'));
    }
}