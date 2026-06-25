<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilKlasifikasi;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ValidasiKlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilKlasifikasi::query();

        if ($request->search) {
            $query->where('input_name', 'like', '%' . $request->search . '%');
        }

        // pagination
        $data = (clone $query)
            ->orderBy('id', 'desc')
            ->paginate(5);

        // statistik GLOBAL
        $totalPending = (clone $query)->where('status', 'pending')->count();
        $totalValid   = (clone $query)->where('status', 'valid')->count();
        $totalInvalid = (clone $query)->where('status', 'invalid')->count();

        return view('admin.validasi.index', compact(
            'data',
            'totalPending',
            'totalValid',
            'totalInvalid'
        ));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:valid,tidak valid'
        ]);

        $data = HasilKlasifikasi::findOrFail($id);

        $data->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function exportPdf()
    {
        $data = HasilKlasifikasi::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.validasi.export', compact('data'));

        return $pdf->download('Lembar Validasi Pakar.pdf');
    }
}