<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| CATATAN PERBAIKAN
|--------------------------------------------------------------------------
| Migration bawaan Laravel (tabel "users" dengan name/email) tidak dipakai
| oleh aplikasi ini. App\Models\User sudah diset memakai tabel "user"
| (tunggal) dengan kolom nama/username/password/role tanpa timestamps.
| Migration ini disesuaikan supaya sinkron dengan model & AuthController.
|--------------------------------------------------------------------------
*/

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
