@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/detail_tumbuhan.css') }}">
@endpush

@section('content')

<!-- PAGE HEADER -->
<div class="page-header">

    <h1 class="title">
        Informasi Detail Tumbuhan
    </h1>

    <p class="subtitle">
        Informasi lengkap data tumbuhan.
    </p>

</div>

<!-- DETAIL CARD -->
<div class="card-detail">

    <!-- HEADER -->
    <div class="detail-header">

        <!-- GAMBAR -->
        <div class="image-wrapper">

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

        <!-- INFO -->
        <div class="detail-info">

            <h2>
                {{ $tumbuhan->nama_tumbuhan }}
            </h2>

            <p class="latin">
                <i>{{ $tumbuhan->nama_latin }}</i>
            </p>

            <!-- JENIS -->
            <span class="badge">

                @if($tumbuhan->jenis == 'Monokotil')
                    Monokotil
                @else
                    Dikotil
                @endif

            </span>

        </div>

    </div>

    <!-- DETAIL CONTENT -->
    <div class="detail-content">

        <!-- LOKASI -->
        <div class="detail-item">

            <strong>Lokasi</strong>

            <p>
                {{ $tumbuhan->lokasi }}
            </p>

        </div>

        <!-- DESKRIPSI -->
        <div class="detail-item">

            <strong>Deskripsi</strong>

            <p class="description">
                {{ $tumbuhan->deskripsi }}
            </p>

        </div>

        <!-- MAP -->
        @if($tumbuhan->latitude && $tumbuhan->longitude)

        <div class="detail-item maps">

            <strong>Peta Lokasi</strong>

            <iframe
                loading="lazy"
                allowfullscreen
                src="https://www.google.com/maps?q={{ $tumbuhan->latitude }},{{ $tumbuhan->longitude }}&output=embed">
            </iframe>

        </div>

        @endif

    </div>

    <!-- ACTION -->
    <div class="detail-action">

        {{-- <!-- EDIT -->
        <a href="{{ url('/admin/tumbuhan/'.$tumbuhan->id.'/edit') }}"
           class="detail-btn-edit">

            Edit

        </a> --}}

        <!-- KEMBALI -->
        <a href="{{ url('/admin/tumbuhan') }}"
           class="detail-btn-back">

             ← Kembali

        </a>

    </div>

</div>

@endsection
