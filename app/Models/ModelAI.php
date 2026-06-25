<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAI extends Model
{
    use HasFactory;

    protected $table = 'models';

    protected $fillable = [
        'name',
        'type',
        'file_path',
        'accuracy',
        'status',
        'description'
    ];
}
