<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('id_profile');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi1')->nullable();
            $table->text('misi2')->nullable();
            $table->text('misi3')->nullable();
            $table->text('misi4')->nullable();
            $table->text('misi5')->nullable();
            $table->string('banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};