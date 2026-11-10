<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Disesuaikan dengan App\Models\Agenda (tabel "agenda", PK "id_agenda").
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id('id_agenda');
            $table->string('nama_kegiatan');
            $table->string('waktu');
            $table->string('tempat');
            $table->text('materi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
