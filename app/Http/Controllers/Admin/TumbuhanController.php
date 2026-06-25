<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tumbuhan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TumbuhanController extends Controller
{
    // =========================
    // 1. LIST DATA
    // =========================
    public function index(Request $request)
    {
        $query = Tumbuhan::query();

        // search
        if ($request->search) {
            $query->where(
                'nama_tumbuhan',
                'like',
                '%' . $request->search . '%'
            );
        }

        $data = $query->orderBy('id', 'desc')->paginate(5);

        return view('admin.tumbuhan.index', compact('data'));
    }

    // =========================
    // 2. FORM CREATE
    // =========================
    public function create()
    {
        return view('admin.tumbuhan.create');
    }

    // =========================
    // 3. SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_tumbuhan' => 'required|unique:tumbuhan,nama_tumbuhan',
            'nama_latin'    => 'required',
            'jenis'         => 'required',
            'lokasi'        => 'required',
            'deskripsi'     => 'required',
            'latitude'      => 'nullable',
            'longitude'     => 'nullable',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_tumbuhan.required' => 'Nama tumbuhan wajib diisi',
            'nama_tumbuhan.unique' => 'Nama tumbuhan sudah terdaftar',
        ]);

        // upload gambar
        $namaFile = null;

        if ($request->hasFile('gambar')) {
            $namaFile = time() . '.' . $request->gambar->extension();

            $request->gambar->move(
                public_path('images/tumbuhan'),
                $namaFile
            );
        }

        // simpan data
        Tumbuhan::create([
            'nama_tumbuhan' => $request->nama_tumbuhan,
            'nama_latin'    => $request->nama_latin,
            'jenis'         => $request->jenis,
            'lokasi'        => $request->lokasi,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $namaFile,
        ]);

        return redirect('/admin/tumbuhan')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // 4. DETAIL DATA
    // =========================
    public function show(int $id)
    {
        $tumbuhan = Tumbuhan::findOrFail($id);

        return view('admin.tumbuhan.show', compact('tumbuhan'));
    }

    // =========================
    // 5. FORM EDIT
    // =========================
    public function edit(int $id)
    {
        $tumbuhan = Tumbuhan::findOrFail($id);

        return view('admin.tumbuhan.edit', compact('tumbuhan'));
    }

    // =========================
    // 6. UPDATE DATA
    // =========================
    public function update(Request $request, int $id)
    {
        $tumbuhan = Tumbuhan::findOrFail($id);

        $request->validate([
            'nama_tumbuhan' => [
                'required',
                Rule::unique('tumbuhan', 'nama_tumbuhan')->ignore($id),
            ],
            'nama_latin'    => 'required',
            'jenis'         => 'required',
            'lokasi'        => 'required',
            'deskripsi'     => 'required',
            'latitude'      => 'nullable',
            'longitude'     => 'nullable',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_tumbuhan.required' => 'Nama tumbuhan wajib diisi',
            'nama_tumbuhan.unique' => 'Nama tumbuhan sudah digunakan',
        ]);

        // upload gambar baru + hapus lama
        if ($request->hasFile('gambar')) {

            if ($tumbuhan->gambar && file_exists(public_path('images/tumbuhan/' . $tumbuhan->gambar))) {
                unlink(public_path('images/tumbuhan/' . $tumbuhan->gambar));
            }

            $namaFile = time() . '.' . $request->gambar->extension();

            $request->gambar->move(
                public_path('images/tumbuhan'),
                $namaFile
            );

            $tumbuhan->gambar = $namaFile;
        }

        // update data
        $tumbuhan->nama_tumbuhan = $request->nama_tumbuhan;
        $tumbuhan->nama_latin    = $request->nama_latin;
        $tumbuhan->jenis         = $request->jenis;
        $tumbuhan->lokasi        = $request->lokasi;
        $tumbuhan->latitude      = $request->latitude;
        $tumbuhan->longitude     = $request->longitude;
        $tumbuhan->deskripsi     = $request->deskripsi;

        $tumbuhan->save();

        return redirect('/admin/tumbuhan')
            ->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // 7. DELETE DATA
    // =========================
    public function destroy(int $id)
    {
        $tumbuhan = Tumbuhan::findOrFail($id);

        // hapus gambar juga
        if ($tumbuhan->gambar && file_exists(public_path('images/tumbuhan/' . $tumbuhan->gambar))) {
            unlink(public_path('images/tumbuhan/' . $tumbuhan->gambar));
        }

        $tumbuhan->delete();

        return redirect('/admin/tumbuhan')
            ->with('success', 'Data berhasil dihapus');
    }
}