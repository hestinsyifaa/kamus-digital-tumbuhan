<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKlasifikasi extends Model
{
    protected $table = 'hasil_klasifikasi';

    protected $fillable = [
        'input_type',
        'input_name',
        'model',
        'hasil',
        'confidence',
        'status',
        'validator'
    ];
}