<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nama tabel database
    protected $table = 'user';

    // Tabel tidak mempunyai created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];
}