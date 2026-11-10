<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Disesuaikan dengan App\Models\Profile (tabel "profile", PK "id_profile").
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id('id_profile');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->text('visi');
            $table->text('misi');
            $table->string('banner')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
