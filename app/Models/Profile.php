<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $primaryKey = 'id_profile';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tujuan',
        'visi',
        'misi',
        'banner',
    ];
}