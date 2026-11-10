<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organigram extends Model
{
    protected $table = 'organigram';

    protected $primaryKey = 'id_pengurus';

    public $timestamps = false;

    protected $fillable = [
        'nama_pengurus',
        'jabatan',
        'bidang_pengurus',
        'foto',
    ];
}