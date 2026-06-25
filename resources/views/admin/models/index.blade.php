@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet"
      href="{{ asset('css/admin/models.css') }}">
@endpush

@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="page-header">

        <h1 class="title">
            🤖 Models AI
        </h1>

        <p class="subtitle">
            Daftar model AI yang digunakan dalam sistem klasifikasi
        </p>

    </div>

    <!-- INFO BOX -->
    <div class="info-box">

        <p>
            Sistem menggunakan model berbeda sesuai jenis input:
            <br><br>
            🍃 Gambar → YOLOv26 (Object Detection)
            <br>
            📄 Teks → Multinomial Naive Bayes (NLP)
        </p>

    </div>

    <!-- TABLE -->
    <div class="card">

        <div class="card-header">

            <h2>
                Model Tersedia
            </h2>

        </div>

        <div class="table-wrapper">

            <table class="models-table">

                <thead>

                    <tr>
                        <th>Nama Model</th>
                        <th>Tipe</th>
                        <th>File</th>
                        <th>Akurasi</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($models as $m)

                    <tr>

                        <!-- NAME -->
                        <td class="center">

                            <strong>
                                {{ $m->name }}
                            </strong>

                        </td>

                        <!-- TYPE -->
                        <td class="center">

                            <span class="badge type">

                                {{ strtoupper($m->type) }}

                            </span>

                        </td>

                        <!-- FILE -->
                        <td class="center">

                            <code class="file">

                                {{ $m->file_path }}

                            </code>

                        </td>

                        <!-- ACCURACY -->
                        <td class="center">

                            <span class="accuracy">

                                {{ $m->accuracy }}%

                            </span>

                        </td>

                        <!-- STATUS -->
                        <td class="center">

                            @if($m->status == 'active')

                                <span class="badge success">
                                    AVAILABLE
                                </span>

                            @else

                                <span class="badge danger">
                                    INACTIVE
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="empty">

                            Tidak ada data model

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection