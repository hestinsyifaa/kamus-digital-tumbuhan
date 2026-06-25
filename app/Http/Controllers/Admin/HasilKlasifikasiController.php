<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilKlasifikasi;

class HasilKlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilKlasifikasi::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('hasil', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->paginate(5);

        return view('admin.klasifikasi.index', compact('data'));
    }
}