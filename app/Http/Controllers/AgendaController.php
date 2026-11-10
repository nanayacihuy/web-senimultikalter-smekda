<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Agenda::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                    ->orWhere('waktu', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%')
                    ->orWhere('materi', 'like', '%' . $search . '%');
            });
        }

        $agenda = $query
            ->orderBy('id_agenda', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.agenda', compact('agenda'));
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN USER
    |--------------------------------------------------------------------------
    */
    public function userIndex(Request $request)
    {
        $query = Agenda::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                    ->orWhere('waktu', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%')
                    ->orWhere('materi', 'like', '%' . $search . '%');
            });
        }

        $agenda = $query
            ->orderBy('id_agenda', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('user.agenda', compact('agenda'));
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH AGENDA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu' => 'required|string',
            'tempat' => 'required|string',
            'materi' => 'required|string',
        ]);

        Agenda::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'waktu' => $validated['waktu'],
            'tempat' => $validated['tempat'],
            'materi' => $validated['materi'],
        ]);

        return redirect()
            ->route('admin.agenda')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }


    /*
    |--------------------------------------------------------------------------
    | UBAH AGENDA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu' => 'required|string',
            'tempat' => 'required|string',
            'materi' => 'required|string',
        ]);

        $agenda = Agenda::findOrFail($id);

        $agenda->update([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'waktu' => $validated['waktu'],
            'tempat' => $validated['tempat'],
            'materi' => $validated['materi'],
        ]);

        return redirect()
            ->route('admin.agenda')
            ->with('success', 'Agenda berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS AGENDA
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->delete();

        return redirect()
            ->route('admin.agenda')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}