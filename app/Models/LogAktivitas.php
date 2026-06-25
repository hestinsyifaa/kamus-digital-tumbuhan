<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'tipe',
        'aksi',
        'deskripsi',
        'model_used',
        'user'
    ];
}