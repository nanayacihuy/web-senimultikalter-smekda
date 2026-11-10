<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* =========================================
       HALAMAN LOGIN
    ========================================= */

    public function showLogin()
    {
        return view('user.login');
    }


    /* =========================================
       PROSES LOGIN
    ========================================= */

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:user,admin',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
            'role.required' => 'Silahkan pilih role terlebih dahulu.',
            'role.in' => 'Role tidak valid.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGIN ADMIN
        |--------------------------------------------------------------------------
        | Admin harus mengambil akun yang sudah tersimpan
        | di database dan role-nya harus admin.
        |--------------------------------------------------------------------------
        */

        if ($request->role === 'admin') {

            $admin = User::where('username', $request->username)
                ->where('role', 'admin')
                ->first();

            if (!$admin) {
                return back()
                    ->withErrors([
                        'username' => 'Akun admin tidak ditemukan.',
                    ])
                    ->withInput();
            }

            if (!Hash::check($request->password, $admin->password)) {
                return back()
                    ->withErrors([
                        'password' => 'Password admin salah.',
                    ])
                    ->withInput();
            }

            Auth::login($admin);

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login admin berhasil.');
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN USER
        |--------------------------------------------------------------------------
        | User tidak perlu dicocokkan dengan role admin.
        |--------------------------------------------------------------------------
        */

        $user = User::where('username', $request->username)
            ->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username tidak ditemukan.',
                ])
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.',
                ])
                ->withInput();
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('user.beranda')
            ->with('success', 'Login berhasil.');
    }


    /* =========================================
       LOGOUT
    ========================================= */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('user.login')
            ->with('success', 'Anda berhasil logout.');
    }


    /* =========================================
       HALAMAN REGISTER
    ========================================= */

    public function showRegister()
    {
        return view('user.daftar');
    }


    /* =========================================
       PROSES REGISTER
    ========================================= */

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username',
            'password' => 'required|string|min:6',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih username lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('user.beranda')
            ->with(
                'success',
                'Pendaftaran berhasil! Selamat datang di Seni Multikalter.'
            );
    }


    /* =========================================
       PROFIL ADMIN
    ========================================= */

    public function adminProfile()
    {
        $admin = Auth::user();

        return view('admin.akun', compact('admin'));
    }


    /* =========================================
       UPDATE PROFIL ADMIN
    ========================================= */

    public function updateAdminProfile(Request $request)
    {
        /** @var User $admin */
        $admin = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username,' . $admin->id,
            'password' => 'nullable|string|min:6',
        ], [
            'nama.required' => 'Nama admin wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'password.min' => 'Password baru minimal 6 karakter.',
        ]);

        $admin->nama = $request->nama;
        $admin->username = $request->username;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()
            ->route('admin.akun')
            ->with('success', 'Profil akun admin berhasil diperbarui.');
    }
}