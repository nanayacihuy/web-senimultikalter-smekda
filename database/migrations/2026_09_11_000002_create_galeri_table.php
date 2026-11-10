<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Disesuaikan dengan App\Models\Galeri (tabel "galeri", PK "id_galeri").
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->string('judul_galeri');
            $table->string('foto')->nullable();
            $table->date('tanggal_upload');
            $table->string('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
