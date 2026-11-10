<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| CATATAN PERBAIKAN: disesuaikan dengan App\Models\Berita
| (tabel "berita" tunggal, primary key "id_berita", tanpa timestamps).
|--------------------------------------------------------------------------
*/

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul_berita');
            $table->text('deskripsi_berita');
            $table->string('foto')->nullable();
            $table->date('tanggal_upload');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
