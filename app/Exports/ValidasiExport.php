<?php

namespace App\Exports;

use App\Models\HasilKlasifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class ValidasiExport implements FromCollection
{
    public function collection()
    {
        return HasilKlasifikasi::all();
    }
}
