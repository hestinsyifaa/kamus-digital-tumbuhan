<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tumbuhan extends Model
{
    protected $table = 'tumbuhan';

    protected $fillable = [
        'nama_tumbuhan',
        'nama_latin',
        'jenis',
        'deskripsi',
        'lokasi',
        'latitude',
        'longitude',
        'gambar',
    ];
}