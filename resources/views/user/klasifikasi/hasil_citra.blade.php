<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Hasil Klasifikasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('css/user/hasil_citra.css') }}">

    <div class="container">

        <div class="card">

            <h1>Hasil Identifikasi Foto Daun</h1>

            <p class="subtitle">
                Berikut hasil identifikasi berdasarkan foto daun yang telah dimasukkan.
            </p>

            <!-- IMAGE -->
            <div class="image-box">
                <img src="{{ asset('uploads/' . $gambar) }}" alt="Hasil Upload">
            </div>

            <!-- RESULT -->
            <div class="result-box">

                <span class="label">Hasil Identifikasi:</span>

                @if($hasil == 'Tidak terdeteksi')

                    <div class="prediction danger">
                        ❌ Foto daun tidak dapat dikenali
                    </div>

                    <p class="description">
                        Foto daun yang telah dimasukan belum cukup jelas.
                        Pastikan daun terlihat jelas, fokus, dan tidak blur.
                    </p>

                @else

                    <div class="prediction success">
                        {{ ucfirst(strtolower($hasil)) }}
                    </div>

                    <div class="confidence-box">
                        <span class="confidence-label">Tingkat Kecocokan</span>
                        <div class="confidence">
                            {{ round($confidence * 100, 2) }}%
                        </div>
                    </div>

                    <p class="description">
                        Sistem mencocokkan foto daun yang telah dimasukkan dengan data tumbuhan yang tersedia.
                        Hasil menunjukkan bahwa foto daun ini paling sesuai dengan kategori
                        <strong>{{ ucfirst(strtolower($hasil)) }}</strong>
                        dengan tingkat kecocokan sebesar
                        <strong>{{ round($confidence * 100, 2) }}%</strong>.
                    </p>

                    <hr class="divider">

                    <div class="info-section">

                        <h3>Karakteristik {{ ucfirst(strtolower($hasil)) }}:</h3>

                        <ul class="ciri-list">
                            @if(strtolower(trim($hasil)) == 'monokotil')
                                <li>Biji hanya satu bagian</li>
                                <li>Akar serabut</li>
                                <li>Daun lurus atau sejajar</li>

                            @elseif(strtolower(trim($hasil)) == 'dikotil')
                                <li>Biji dua bagian</li>
                                <li>Akar tunggang</li>
                                <li>Daun bercabang atau menjari</li>
                            @endif
                        </ul>

                    </div>

                @endif

            <!-- KAMUS SECTION -->
            @if(!empty($tumbuhan) && $tumbuhan->count() > 0)

                <div class="kamus-section">

                    <h3>Data Tumbuhan {{ ucfirst(strtolower($hasil)) }}</h3>
                
                <div class="lihat-semua">
                    <p class="jumlah-data">
                        Total:
                        <strong>{{ $tumbuhan->count() }}</strong>
                        tumbuhan
                    </p>

                        <a href="{{ url('/tumbuhan?jenis=' . strtolower($hasil)) }}" class="btn-lihat">
                            Lihat Semua Tumbuhan
                        </a>
                    </div>

                </div>

            @endif
            
            </div>



            <!-- BUTTON -->
            <div class="button-group">

                <a href="{{ url('/klasifikasi/citra') }}" class="btn-primary">
                    Coba Lagi
                </a>

                <a href="/klasifikasi"
                class="btn-secondary">

                    Selesai

                </a>

            </div>

        </div>

    </div>

</body>

</html>