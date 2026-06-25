<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::latest()->paginate(20);

        return view('admin.log.index', compact('logs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|string',
            'aksi' => 'required|string',
        ]);

        LogAktivitas::create([
            'tipe'        => $request->tipe,
            'aksi'        => $request->aksi,
            'deskripsi'   => $request->deskripsi,
            'model_used'  => $request->model_used,
            'user'        => Auth::check() ? Auth::user()->name : 'system',
        ]);

        return response()->json([
            'message' => 'Log berhasil disimpan'
        ]);
    }

    public function show(int $id)
    {
        $log = LogAktivitas::findOrFail($id);

        return view('admin.log.show', compact('log'));
    }
}