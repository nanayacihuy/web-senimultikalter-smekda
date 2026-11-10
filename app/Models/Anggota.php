<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    // Nama tabel database
    protected $table = 'anggota';

    // Primary key tabel
    protected $primaryKey = 'id_anggota';

    // Tabel tidak menggunakan created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi / diubah
    protected $fillable = [
        'nama_anggota',
        'kelas_anggota',
        'bidang_anggota',
    ];
}