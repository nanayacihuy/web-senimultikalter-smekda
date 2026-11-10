<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Disesuaikan dengan App\Models\Organigram (tabel "organigram", PK "id_pengurus").
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organigram', function (Blueprint $table) {
            $table->id('id_pengurus');
            $table->string('nama_pengurus');
            $table->string('jabatan');
            $table->string('bidang_pengurus')->nullable();
            $table->string('foto')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organigram');
    }
};
