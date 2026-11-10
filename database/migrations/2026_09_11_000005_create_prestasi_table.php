<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Disesuaikan dengan App\Models\Prestasi (tabel "prestasi", PK "id_prestasi").
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->string('nama_prestasi');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
