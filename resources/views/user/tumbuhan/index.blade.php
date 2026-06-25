<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Kamus Tumbuhan
    </title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/user/tumbuhan.css') }}">

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
                    Kamus Tumbuhan
                </h2>

                <p class="subtitle">
                    Cari informasi dan karakteristik tumbuhan
                    dengan mudah.
                </p>

            </div>

        </section>


        <!-- ===================================================
             MAIN CARD
        ==================================================== -->
        <section class="card">

            <!-- ===============================================
                 TOP BAR
            ================================================ -->
            <div class="top-bar">

                <!-- SEARCH -->
                <form method="GET"
                    action="/tumbuhan"
                    class="search-box"
                    onsubmit="return validateSearch()">

                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Contoh: Mangga, Pisang, Jagung..."
                        value="{{ request('search') }}"
                    >

                    <button type="submit">
                        Cari
                    </button>

                </form>

                <!-- INFO -->
                <div class="info">

                    Jumlah Tumbuhan:
                    <strong>
                        {{ $data->total() }}
                    </strong>

                </div>

            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div id="searchAlert" class="custom-alert" style="display:none;">
                ⚠️ Kolom pencarian tidak boleh kosong
            </div>

            <!-- ===============================================
                 TABLE
            ================================================ -->
            <div class="table-wrapper">

                <table>

                    <!-- TABLE HEAD -->
                    <thead>

                        <tr>

                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Nama Latin</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <!-- TABLE BODY -->
                    <tbody>

                        @forelse($data as $t)

                            <tr>

                                <!-- IMAGE -->
                                <td>

                                    @if($t->gambar)

                                        <img
                                            src="{{ asset('images/tumbuhan/' . $t->gambar) }}"
                                            alt="{{ $t->nama_tumbuhan }}"
                                            class="plant-image"
                                        >

                                    @else

                                        <span class="no-image">

                                            Tidak Ada Gambar

                                        </span>

                                    @endif

                                </td>


                                <!-- NAMA -->
                                <td>

                                    {{ $t->nama_tumbuhan }}

                                </td>


                                <!-- NAMA LATIN -->
                                <td>

                                    <i>
                                        {{ $t->nama_latin }}
                                    </i>

                                </td>


                                <!-- JENIS -->
                                <td>

                                    <span class="badge {{ strtolower($t->jenis) }}">

                                        {{ $t->jenis }}

                                    </span>

                                </td>


                                <!-- LOKASI -->
                                <td>

                                    {{ $t->lokasi }}

                                </td>


                                <!-- BUTTON -->
                                <td>

                                    <a href="/tumbuhan/{{ $t->id }}"
                                       class="btn-detail">

                                        Lihat Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="empty">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- ===============================================
                 PAGINATION
            ================================================ -->
            <div class="pagination-wrapper">

                {{-- PREVIOUS --}}
                @if ($data->onFirstPage())

                    <span class="pagination-btn disabled">

                        ‹

                    </span>

                @else

                    <a href="{{ $data->previousPageUrl() }}"
                       class="pagination-btn">

                        ‹

                    </a>

                @endif


                {{-- NUMBER --}}
                @for ($i = 1; $i <= $data->lastPage(); $i++)

                    @if ($i == $data->currentPage())

                        <span class="pagination-btn active">

                            {{ $i }}

                        </span>

                    @elseif (
                        $i == 1 ||
                        $i == $data->lastPage() ||
                        ($i >= $data->currentPage() - 1 &&
                         $i <= $data->currentPage() + 1)
                    )

                        <a href="{{ $data->url($i) }}"
                           class="pagination-btn">

                            {{ $i }}

                        </a>

                    @elseif (
                        $i == 2 && $data->currentPage() > 3 ||
                        $i == $data->lastPage() - 1 &&
                        $data->currentPage() < $data->lastPage() - 2
                    )

                        <span class="dots">

                            ...

                        </span>

                    @endif

                @endfor


                {{-- NEXT --}}
                @if ($data->hasMorePages())

                    <a href="{{ $data->nextPageUrl() }}"
                       class="pagination-btn">

                        ›

                    </a>

                @else

                    <span class="pagination-btn disabled">

                        ›

                    </span>

                @endif

            </div>

        </section>

    </main>

    <script>
    function validateSearch() {
        const input = document.getElementById("searchInput").value;
        const alertBox = document.getElementById("searchAlert");

        if (!input.trim()) {
            alertBox.style.display = "block";
            return false;
        }

        alertBox.style.display = "none";
        return true;
    }
    </script>
</body>
</html>