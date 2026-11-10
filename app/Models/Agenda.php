<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $primaryKey = 'id_agenda';

    public $timestamps = false;

    protected $fillable = [
        'nama_kegiatan',
        'waktu',
        'tempat',
        'materi',
    ];
}