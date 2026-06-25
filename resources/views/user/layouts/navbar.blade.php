<!-- =======================================================
     NAVBAR
======================================================= -->

<link rel="stylesheet"
      href="{{ asset('css/user/navbar.css') }}">

<nav class="navbar">

    <!-- LOGO -->
    <div class="nav-left">

        <a href="/home"
           class="logo-link">

            <span class="logo-icon">
                🌿
            </span>

            <span class="logo-text">
                Kamus Digital Tumbuhan
            </span>

        </a>

    </div>

    <!-- MENU -->
    <div class="nav-menu">

        <a href="/home"
           class="{{ request()->is('home') ? 'active' : '' }}">

            Beranda

        </a>

        <a href="/tumbuhan"
           class="{{ request()->is('tumbuhan*') ? 'active' : '' }}">

            Kamus

        </a>

        <a href="/klasifikasi"
           class="{{ request()->is('klasifikasi*') ? 'active' : '' }}">

            Identifikasi

        </a>

    </div>

</nav>