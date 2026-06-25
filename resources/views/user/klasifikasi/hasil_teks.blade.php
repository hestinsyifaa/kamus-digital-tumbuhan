<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Hasil Klasifikasi Teks
    </title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="{{ asset('css/user/hasil_teks.css') }}">
</head>

<body>

<div class="container">

    <div class="card">

        <!-- TITLE -->
        <h1>
            Hasil Identifikasi Ciri Tumbuhan
        </h1>

        <p class="subtitle">
            Berikut hasil identifikasi berdasarkan
            ciri tumbuhan yang telah dimasukan.
        </p>

        <!-- INPUT USER -->
        <div class="input-box">

            <span class="label">
                Ciri tumbuhan yang dimasukkan:
            </span>

            <div class="input-preview">

                "{{ $inputText }}"

            </div>

        </div>

        <!-- RESULT -->
        <div class="result-box">

            <span class="label">
                Hasil Identifikasi
            </span>

            @if($hasil == 'Tidak terdeteksi')

                <div class="prediction danger">

                    ❌ Ciri tanaman tidak dapat dikenali

                </div>

                <p class="description">
                    Ciri tumbuhan yang telah dimasukan belum cukup jelas.
                    Coba tambahkan informasi ciri tanaman lebih jelas, seperti bentuk daun atau akar.
                </p>

            @else

                <div class="prediction success">

                    {{ ucfirst(strtolower($hasil)) }}

                </div>

                <!-- CONFIDENCE -->
                <div class="confidence-box">

                    <span class="confidence-label">
                        Tingkat Kecocokan
                    </span>

                    <div class="confidence">

                        {{ round($confidence * 100, 2) }}%

                    </div>

                </div>

                <p class="description">

                    Sistem mencocokkan ciri tumbuhan yang telah dimasukkan dengan data tumbuhan yang tersedia.
                    Hasil menunjukkan bahwa ciri tumbuhan ini paling sesuai dengan ketegori
                    <strong>
                        {{ ucfirst(strtolower($hasil)) }}
                    </strong>
                    dengan tingkat kecocokan sebesar
                    <strong>
                        {{ round($confidence * 100, 2) }}%
                    </strong>.

                </p>

            @endif

            @if(!empty($tumbuhan) && $tumbuhan->count() > 0)

                <div class="kamus-section">

                    <h3>Data Tumbuhan {{ ucfirst(strtolower($hasil)) }}</h3>

                    <div class="lihat-semua">
                        <p class="jumlah-data">
                            Total:
                            <strong>{{ $tumbuhan->count() }}</strong>
                            tumbuhan
                        </p>

                        <a href="{{ url('/tumbuhan?jenis=' . strtolower($hasil)) }}" 
                        class="btn-lihat">
                            Lihat Semua Tumbuhan
                        </a>
                    </div>

                </div>

            @endif

    </div>

            <!-- BUTTON -->
        <div class="button-group">

            <a href="/klasifikasi/teks"
            class="btn-primary">

                Coba Lagi

            </a>

            <a href="/klasifikasi"
            class="btn-secondary">

                Selesai

            </a>

        </div>

</div>

</body>
</html>
