<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| CATATAN PERBAIKAN
|--------------------------------------------------------------------------
| Sebelumnya migration ini membuat tabel "anggotas" (jamak) dengan primary
| key default "id". Padahal App\Models\Anggota sudah diset untuk memakai
| tabel "anggota" (tunggal) dengan primary key "id_anggota" - sama seperti
| pola semua tabel lain di aplikasi ini (berita, prestasi, agenda, galeri,
| organigram, profile -> semuanya tunggal + id_xxx).
|
| Migration ini disesuaikan supaya cocok dengan model. PENTING: jika tabel
| "anggota" di database db_eskulsenismekda milikmu sudah ada dan strukturnya
| BERBEDA dari ini, JANGAN jalankan `migrate:fresh` begitu saja (akan
| menghapus data). Cek dulu struktur tabel asli via phpMyAdmin
| (Struktur / SHOW CREATE TABLE anggota) dan sesuaikan bila perlu.
|--------------------------------------------------------------------------
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->string('nama_anggota');
            $table->string('bidang_anggota'); // contoh: Tari, Musik, Theater
            $table->string('kelas_anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
