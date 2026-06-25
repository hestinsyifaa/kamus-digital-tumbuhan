<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Kamus Digital Tumbuhan
    </title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/user/home.css') }}">

</head>

<body>

    <!-- NAVBAR -->
    @include('user.layouts.navbar')

    <!-- MAIN CONTENT -->
    <main class="container">
    
        <!-- ===================================================
             HEADER
        ==================================================== -->
        <section class="header">

            <div class="header-text">

                <h2>
                    Kamus dan Identifikasi Tumbuhan
                </h2>

                <p class="subtitle">
                    Cari informasi dan kenali jenis tumbuhan
                    melalui teks dan foto daun.
                </p>

            </div>

        </section>

        <!-- MENU -->
        <div class="menu">

            <!-- CARD 1 -->
            <div class="card">

                <div class="icon">
                    📖
                </div>

                <h2>
                    Informasi Tumbuhan
                </h2>

                <p>
                    Cari informasi dan karakteristik berbagai
                    jenis tumbuhan dengan mudah.
                </p>

                <a href="/tumbuhan"
                   class="btn">

                    Cari Tumbuhan

                </a>

            </div>

            <!-- CARD 2 -->
            <div class="card">

                <div class="icon">
                    🔍
                </div>

                <h2>
                    Identifikasi Tumbuhan
                </h2>

                <p>
                    Identifikasi tumbuhan monokotil dan dikotil 
                    melalui teks atau foto daun.
                </p>

                <a href="/klasifikasi"
                   class="btn">

                    Mulai Identifikasi

                </a>

            </div>

        </div>

        <!-- FOOTER -->
        <footer class="footer">

            <p>
                © 2026 Kamus Digital Taksonomi Tumbuhan
            </p>

            <span>
                Platform pencarian dan identifikasi tumbuhan
            </span>

        </footer>

    </main>

</body>

</html>