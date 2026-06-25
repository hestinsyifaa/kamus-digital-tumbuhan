<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lembar Validasi Pakar</title>

    <!-- (opsional, kadang tidak kebaca di PDF tapi tetap kita tambahin) -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .page {
            padding: 30px 40px;
            margin-top: 20px;
        }

        /* KOP */
        .kop {
            text-align: center;
            margin-bottom: 15px;
        }

        .kop h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .kop p {
            margin: 3px 0;
            font-size: 12px;
        }

        /* INFO PAKAR */
        .info-pakar {
            margin-bottom: 15px;
            font-size: 12px;
        }

        .info-pakar p {
            margin: 3px 0;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11px;
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
            text-align: center;
            font-weight: 600;
        }

        .col-no { width: 5%; text-align: center; }
        .col-input { width: 30%; text-align: center; }
        .col-hasil { width: 18%; text-align: center; }
        .col-confidence { width: 15%; text-align: center; }
        .col-status { width: 27%; }

        img {
            max-width: 60px;
        }

        /* STATUS */
        .status-box {
            line-height: 1.6;
        }

        /* TTD */
        .ttd {
            margin-top: 70px;
            width: 100%;
        }

        .ttd-right {
            float: right;
            text-align: center;
            width: 250px;
        }

        .line {
            margin-top: 60px;
            border-top: 1px solid #000;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

<div class="page">

<!-- KOP -->
<div class="kop">
    <h3 style="margin:0; font-size:15px; font-weight:bold;">
        LEMBAR VALIDASI HASIL IDENTIFIKASI TUMBUHAN
    </h3>

    <p style="margin:3px 0; font-size:12px;">
        Sistem Identifikasi Tumbuhan Berbasis Artificial Intelligence (AI)
    </p>
</div>

<br>

<!-- INFO PAKAR -->
<div class="info-pakar">
    <p><b>Nama Validator :</b> ..............................................</p><br>
    <p><b>Instansi       :</b> ..............................................</p><br>
    <p><b>Tanggal        :</b> ..............................................</p><br>
</div>

<!-- TABLE -->
<table>
    <thead>
        <tr>
            <th class="col-no">No.</th>
            <th class="col-input">Inputan Data</th>
            <th class="col-hasil">Hasil Identifikasi</th>
            <th class="col-confidence">Tingkat Kecocokan</th>
            <th class="col-status">Status Validasi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $i => $item)
        <tr>
            <td class="col-no">{{ $i + 1 }}</td>

            <!-- INPUT -->
            <td class="col-input">
                @if($item->input_type == 'gambar')
                    @php
                        $path = public_path('uploads/' . $item->input_name);
                    @endphp

                    @if(file_exists($path))
                        <img src="{{ $path }}">
                    @else
                        -
                    @endif
                @else
                    {{ $item->input_name }}
                @endif
            </td>

            <!-- HASIL -->
            <td class="col-hasil">
                {{ ucfirst($item->hasil) }}
            </td>

            <!-- CONFIDENCE -->
            <td class="col-confidence">
                {{ number_format($item->confidence * 100, 2) }}%
            </td>

            <!-- STATUS PAKAR -->
            <td class="col-status">
                <div class="status-box">
                    [....] Valid<br>
                    [....] Tidak Valid<br><br>

                    Catatan:<br>
                    .............................
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- TANDA TANGAN (PAKAR SAJA) -->
<div class="ttd">
    <div class="ttd-right">
        <p>Pakar / Validator</p>

        <br><br><br>

        {{-- <div class="line"></div> --}}
        <p><b>( ........................................ )</b></p>
    </div>

    <div class="clear"></div>
</div>

</div>

</body>
</html>