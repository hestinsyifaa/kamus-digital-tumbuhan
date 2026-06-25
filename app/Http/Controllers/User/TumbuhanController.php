<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tumbuhan;
use App\Models\HasilKlasifikasi;
use Illuminate\Http\Request;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class TumbuhanController extends Controller
{
    /* =========================
       LIST DATA TUMBUHAN
    ========================= */
    public function index(Request $request)
    {
        // 🔥 VALIDASI SEARCH KOSONG
        if ($request->has('search') && trim($request->search) === '') {
            return redirect('/tumbuhan')
                ->with('error', 'Kolom pencarian tidak boleh kosong');
        }

        $query = Tumbuhan::query();

        // filter berdasarkan kategori
        if ($request->jenis) {

            $query->where(
                'jenis',
                ucfirst(strtolower($request->jenis))
            );
        }

        // search
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama_tumbuhan',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'nama_latin',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        $data = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'user.tumbuhan.index',
            compact('data')
        );
    }

    /* =========================
       DETAIL TUMBUHAN
    ========================= */
    public function show(int $id)
    {
        $tumbuhan =
            Tumbuhan::findOrFail($id);

        return view(
            'user.tumbuhan.show',
            compact('tumbuhan')
        );
    }

    /* =========================
       KLASIFIKASI CITRA YOLO
    ========================= */
    public function prosesCitra(Request $request)
    {
        /* =====================
           VALIDASI INPUT
        ===================== */

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_camera' => 'nullable|string'
        ]);

        // 🔥 TAMBAHKAN INI DI SINI (PALING ATAS LOGIKA)
        if ($request->hasFile('gambar') && $request->gambar_camera) {
            return back()->with(
                'error',
                'Hanya boleh pilih salah satu: upload gambar atau kamera.'
            );
        }

        /* =====================
           FOLDER UPLOAD
        ===================== */

        $uploadPath =
            public_path('uploads');

        if (!file_exists($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        /* =====================
           UPLOAD FILE BIASA
        ===================== */

        if ($request->hasFile('gambar')) {

            $file =
                $request->file('gambar');

            $namaFile =
                time() . '.' .
                $file->extension();

            $file->move(
                $uploadPath,
                $namaFile
            );
        }

        /* =====================
           FOTO DARI WEBCAM
        ===================== */

        elseif ($request->gambar_camera) {

            $image =
                $request->gambar_camera;

            $image =
                str_replace(
                    'data:image/png;base64,',
                    '',
                    $image
                );

            $image =
                str_replace(
                    ' ',
                    '+',
                    $image
                );

            $namaFile =
                time() . '.png';

            file_put_contents(
                $uploadPath .
                '/' .
                $namaFile,
                base64_decode($image)
            );
        }

        /* =====================
           JIKA TIDAK ADA INPUT
        ===================== */

        else {

            return back()->with(
                'error',
                'Silakan upload gambar atau ambil foto terlebih dahulu'
            );
        }

        /* =====================
           PATH FILE
        ===================== */

        $modelPath =
            base_path(
                'python/best.pt'
            );

        $imagePath =
            public_path(
                'uploads/' . $namaFile
            );

        $pythonScript =
            base_path(
                'python/predict_citra.py'
            );

        /* =====================
           JALANKAN PYTHON YOLO
        ===================== */

        $pythonCommand = PHP_OS_FAMILY === 'Windows'
            ? 'py -3.11'
            : 'python3';

        $command =
            $pythonCommand . ' '
            . escapeshellarg($pythonScript)
            . ' '
            . escapeshellarg($modelPath)
            . ' '
            . escapeshellarg($imagePath);

        $output =
            shell_exec($command);

        if (!$output) {

            return back()->with(
                'error',
                'Python gagal dijalankan'
            );
        }

        /* =====================
           DECODE JSON OUTPUT
        ===================== */

        $result =
            json_decode(
                trim($output),
                true
            );

        $hasil =
            $result['hasil']
            ?? 'Tidak terdeteksi';

        $confidence =
            $result['confidence']
            ?? 0;

        /* =====================
           SIMPAN HASIL
        ===================== */

        HasilKlasifikasi::create([
            'input_type' => 'gambar',
            'input_name' => $namaFile,
            'model' => 'YOLO',
            'hasil' => $hasil,
            'confidence' => $confidence,
            'status' => 'pending'
        ]);

        /* =====================
           LOG AKTIVITAS
        ===================== */

        LogAktivitas::create([
            'tipe' => 'klasifikasi',
            'aksi' => 'predict',
            'deskripsi' =>
                'User melakukan klasifikasi citra → hasil: '
                . $hasil .
                ' (' .
                round($confidence * 100, 2)
                . '%)',

            'model_used' => 'YOLO',

            'user' =>
                Auth::check()
                ? Auth::user()->name
                : 'guest',
        ]);

        /* =====================
           KIRIM KE BLADE
        ===================== */

        $tumbuhan = Tumbuhan::where(
            'jenis',
            trim($hasil)
        )->get();

        return view(
            'user.klasifikasi.hasil_citra',
            [
                'hasil' => $hasil,
                'confidence' => $confidence,
                'gambar' => $namaFile,
                'tumbuhan' => $tumbuhan
            ]
        );
    }

    /* =========================
       KLASIFIKASI TEKS MNB
    ========================= */
    public function prosesTeks(Request $request)
    {
        $request->validate([
            'daun'   => 'nullable|string',
            'akar'   => 'nullable|string',
            'batang' => 'nullable|string'
        ]);

        // Gabungkan semua pilihan menjadi satu teks
        $inputText = trim(
            $request->daun . ' ' .
            $request->akar . ' ' .
            $request->batang
        );

        if (empty($inputText)) {
            return back()->with(
                'error',
                'Silakan pilih minimal satu ciri tumbuhan'
            );
        }

        $pythonScript = base_path('python/predict_teks.py');

        $pythonCommand = PHP_OS_FAMILY === 'Windows'
            ? 'py -3.11'
            : 'python3';

        $command =
            $pythonCommand . ' '
            . escapeshellarg($pythonScript)
            . ' '
            . escapeshellarg($inputText);

        $output = shell_exec($command);

        if (!$output) {
            return back()->with(
                'error',
                'Python gagal dijalankan'
            );
        }

        $result = json_decode(
            trim($output),
            true
        );

        $hasil =
            $result['hasil']
            ?? 'Tidak terdeteksi';

        $confidence =
            $result['confidence']
            ?? 0;

        // Ambil data tumbuhan sesuai hasil
        $tumbuhan = Tumbuhan::where(
            'jenis',
            ucfirst(strtolower($hasil))
        )->get();

        // Simpan hasil klasifikasi
        HasilKlasifikasi::create([
            'input_type' => 'teks',
            'input_name' => $inputText,
            'model' => 'MNB',
            'hasil' => $hasil,
            'confidence' => $confidence,
            'status' => 'pending'
        ]);

        // Log aktivitas
        LogAktivitas::create([
            'tipe' => 'klasifikasi',
            'aksi' => 'predict',
            'deskripsi' =>
                'User melakukan klasifikasi teks → hasil: '
                . $hasil
                . ' ('
                . round($confidence * 100, 2)
                . '%)',
            'model_used' => 'MNB',
            'user' => Auth::check()
                ? Auth::user()->name
                : 'guest',
        ]);

        return view(
            'user.klasifikasi.hasil_teks',
            [
                'hasil' => $hasil,
                'confidence' => $confidence,
                'inputText' => $inputText,
                'tumbuhan' => $tumbuhan
            ]
        );
    }
}