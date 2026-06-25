<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Identifikasi Tumbuhan
    </title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/user/klasifikasi.css') }}">

</head>

<body>

    <!-- =======================================================
         NAVBAR
    ======================================================== -->
    @include('user.layouts.navbar')


    <!-- =======================================================
         CONTAINER
    ======================================================== -->
    <main class="container">

        <!-- ===================================================
             HEADER
        ==================================================== -->
        <section class="header">

            <div class="header-text">

                <h2>
                    Identifikasi Tumbuhan
                </h2>

                <p class="subtitle">
                    Pilih metode identifikasi
                    yang ingin digunakan
                </p>

            </div>

        </section>

        <!-- ===================================================
             MENU
        ==================================================== -->
        <div class="menu">

            <!-- ===============================================
                 KLASIFIKASI TEKS
            ================================================ -->
            <div class="card">

                <div class="icon">
                    📄
                </div>

                <h2>
                    Identifikasi Ciri Tumbuhan
                </h2>

                <p>
                    Masukan ciri-ciri tumbuhan
                    untuk mengetahui jenisnya.
                </p>

                <a href="/klasifikasi/teks"
                   class="btn">

                    Mulai

                </a>

            </div>


            <!-- ===============================================
                 KLASIFIKASI CITRA
            ================================================ -->
            <div class="card">

                <div class="icon">
                    🍃
                </div>

                <h2>
                    Identifikasi Foto Daun
                </h2>

                <p>
                    Unggah foto daun untuk mengenali
                    jenis tumbuhan.
                </p>

                <a href="/klasifikasi/citra"
                   class="btn">

                    Mulai

                </a>

            </div>

        </div>

    </main>

</body>
</html>