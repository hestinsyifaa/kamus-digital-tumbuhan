<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tumbuhan;
use App\Models\HasilKlasifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTumbuhan = \App\Models\Tumbuhan::count();
        $totalKlasifikasi = \App\Models\HasilKlasifikasi::count();

        $valid = \App\Models\HasilKlasifikasi::where('status', 'valid')->count();
        $invalid = HasilKlasifikasi::where('status', 'tidak valid')->count();
        $pending = \App\Models\HasilKlasifikasi::where('status', 'pending')->count();

        // per model (YOLO vs MNB)
        $yolo = \App\Models\HasilKlasifikasi::where('model', 'yolo')->count();
        $mnb = \App\Models\HasilKlasifikasi::where('model', 'mnb')->count();

        return view('admin.dashboard', compact(
            'totalTumbuhan',
            'totalKlasifikasi',
            'valid',
            'invalid',
            'pending',
            'yolo',
            'mnb'
        ));
    }
}