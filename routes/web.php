<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\OrganigramController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    // Kalau belum login
    if (!auth()->check()) {
        return redirect()->route('user.login');
    }

    // Kalau sudah login sebagai admin
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Kalau sudah login sebagai user
    return redirect()->route('user.beranda');

})->name('home');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');


// LOGIN
Route::get('/user/login', [AuthController::class, 'showLogin'])
    ->name('user.login');

Route::post('/user/login', [AuthController::class, 'login'])
    ->name('login.process');


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| USER / FRONTEND
|--------------------------------------------------------------------------
*/

// BERANDA
Route::get('/user/beranda', [BerandaController::class, 'index'])
    ->name('user.beranda');


// PROFILE
Route::get('/user/profile', [ProfileController::class, 'indexUser'])
    ->name('user.profile');


// ORGANIGRAM
Route::get('/user/organigram', [OrganigramController::class, 'userIndex'])
    ->name('user.organigram');


// GALERI
Route::get('/user/galeri', [GaleriController::class, 'userIndex'])
    ->name('user.galeri');


// BERITA
Route::get('/user/berita', [BeritaController::class, 'userIndex'])
    ->name('user.berita');


// PRESTASI
Route::get('/user/prestasi', [PrestasiController::class, 'userIndex'])
    ->name('user.prestasi');


// AGENDA
Route::get('/user/agenda', [AgendaController::class, 'userIndex'])
    ->name('user.agenda');


// ANGGOTA
Route::get('/user/anggota', [AnggotaController::class, 'index'])
    ->name('user.anggota');


// DAFTAR
Route::get('/user/daftar', function () {
    return view('user.daftar');
})->name('user.daftar');

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | PROFILE ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/profile', [ProfileController::class, 'indexAdmin'])
        ->name('admin.profile');

    Route::put('/admin/profile', [ProfileController::class, 'updateAdmin'])
        ->name('admin.profile.update');


    /*
    |--------------------------------------------------------------------------
    | AKUN SAYA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/akun-saya', [AuthController::class, 'adminProfile'])
        ->name('admin.akun');

    Route::put('/admin/akun-saya', [AuthController::class, 'updateAdminProfile'])
        ->name('admin.akun.update');


    /*
    |--------------------------------------------------------------------------
    | ORGANIGRAM
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/organigram', [OrganigramController::class, 'index'])
        ->name('admin.organigram');

    Route::post('/admin/organigram', [OrganigramController::class, 'store'])
        ->name('admin.organigram.store');

    Route::put('/admin/organigram/{id}', [OrganigramController::class, 'update'])
        ->name('admin.organigram.update');

    Route::delete('/admin/organigram/{id}', [OrganigramController::class, 'destroy'])
        ->name('admin.organigram.destroy');


    /*
    |--------------------------------------------------------------------------
    | ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/anggota', [AnggotaController::class, 'adminIndex'])
        ->name('admin.anggota');

    Route::post('/admin/anggota', [AnggotaController::class, 'store'])
        ->name('admin.anggota.store');

    Route::put('/admin/anggota/{id}', [AnggotaController::class, 'update'])
        ->name('admin.anggota.update');

    Route::delete('/admin/anggota/{id}', [AnggotaController::class, 'destroy'])
        ->name('admin.anggota.destroy');


    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/berita', [BeritaController::class, 'index'])
        ->name('admin.berita');

    Route::post('/admin/berita', [BeritaController::class, 'store'])
        ->name('admin.berita.store');

    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])
        ->name('admin.berita.edit');

    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])
        ->name('admin.berita.update');

    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])
        ->name('admin.berita.destroy');


    /*
    |--------------------------------------------------------------------------
    | PRESTASI
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/prestasi', [PrestasiController::class, 'index'])
        ->name('admin.prestasi');

    Route::post('/admin/prestasi', [PrestasiController::class, 'store'])
        ->name('admin.prestasi.store');

    Route::put('/admin/prestasi/{id}', [PrestasiController::class, 'update'])
        ->name('admin.prestasi.update');

    Route::delete('/admin/prestasi/{id}', [PrestasiController::class, 'destroy'])
        ->name('admin.prestasi.destroy');


    /*
    |--------------------------------------------------------------------------
    | AGENDA
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/agenda', [AgendaController::class, 'index'])
        ->name('admin.agenda');

    Route::post('/admin/agenda', [AgendaController::class, 'store'])
        ->name('admin.agenda.store');

    Route::put('/admin/agenda/{id}', [AgendaController::class, 'update'])
        ->name('admin.agenda.update');

    Route::delete('/admin/agenda/{id}', [AgendaController::class, 'destroy'])
        ->name('admin.agenda.destroy');


    /*
    |--------------------------------------------------------------------------
    | GALERI
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/galeri', [GaleriController::class, 'index'])
        ->name('admin.galeri');

    Route::post('/admin/galeri', [GaleriController::class, 'store'])
        ->name('admin.galeri.store');

    Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])
        ->name('admin.galeri.update');

    Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])
        ->name('admin.galeri.destroy');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

});