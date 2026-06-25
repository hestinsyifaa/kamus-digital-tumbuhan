<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Detail Informasi Tumbuhan
    </title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/user/detail_tumbuhan.css') }}">

</head>

<body>

<div class="container">

    <!-- CARD -->
    <div class="card">

        <!-- TITLE -->
        <h2 class="page-title">
            Informasi Tumbuhan
        </h2>

        <!-- HEADER -->
        <div class="header">

            <!-- IMAGE -->
            <div class="image">

                @if($tumbuhan->gambar)

                    <img 
                        src="{{ asset('images/tumbuhan/' . $tumbuhan->gambar) }}"
                        alt="{{ $tumbuhan->nama_tumbuhan }}"
                        class="detail-image"
                    >

                @else

                    <div class="no-image">
                        Tidak Ada Gambar
                    </div>

                @endif

            </div>

            <!-- TITLE BOX -->
            <div class="title-box">

                <h3>
                    {{ $tumbuhan->nama_tumbuhan }}
                </h3>

                <div class="latin">

                    <i>
                        {{ $tumbuhan->nama_latin }}
                    </i>

                </div>

                <div class="badge {{ strtolower($tumbuhan->jenis) }}">

                    {{ $tumbuhan->jenis }}

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- LOKASI -->
            <div class="section">

                <span class="label">
                    📍 Lokasi
                </span>

                <div class="text">

                    {{ $tumbuhan->lokasi }}

                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="section">

                <span class="label">
                    📝 Deskripsi
                </span>

                <p class="description">

                    {{ $tumbuhan->deskripsi }}

                </p>

            </div>

            <!-- MAP -->
            <div class="section">

                <span class="label">
                    🗺️ Peta Lokasi
                </span>

                @if($tumbuhan->latitude && $tumbuhan->longitude)

                    <iframe
                        width="100%"
                        height="250"
                        loading="lazy"
                        allowfullscreen
                        src="https://www.google.com/maps?q={{ $tumbuhan->latitude }},{{ $tumbuhan->longitude }}&output=embed">
                    </iframe>

                @else

                    <p class="text">

                        Lokasi peta belum tersedia

                    </p>

                @endif

            </div>

        </div>

        <!-- BACK BUTTON -->
        <div class="bottom-action">

            <a href="/tumbuhan"
               class="btn-back">

                ← Kembali

            </a>

        </div>

    </div>

</div>

</body>
</html>