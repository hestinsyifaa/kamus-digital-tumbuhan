@php
use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/klasifikasi.css') }}">
@endpush

@section('content')

<div class="page-header">
    <h1 class="title">Hasil Identifikasi</h1>
    <p class="subtitle">
        Menampilkan hasil identifikasi berdasarkan data ciri tumbuhan atau foto daun
        yang diproses oleh sistem.
    </p>
</div>

<!-- TOP BAR -->
<div class="top-bar">
    <form method="GET" action="/admin/klasifikasi" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="Cari hasil identifikasi..."
            value="{{ request('search') }}"
        >
        <button type="submit">Cari</button>
    </form>
</div>

<!-- CARD INFO -->
<div class="cards">

    <div class="card">
        <h2>{{ $data->total() }}</h2>
        <p>Total Klasifikasi</p>
    </div>

    {{-- <div class="card">
        <h2>{{ $data->where('status','valid')->count() }}</h2>
        <p>Valid</p>
    </div>

    <div class="card">
        <h2>{{ $data->where('status','tidak valid')->count() }}</h2>
        <p>Tidak Valid</p>
    </div> --}}

</div>

<!-- TABLE CARD -->
<div class="table-card">

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Inputan Data</th>
                    <th>Hasil Identifikasi</th>
                    <th>Tingkat Kecocokan</th>
                    <th>Status Validasi</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>

            @forelse($data as $item)

                <tr>

                    <td>
                        @if($item->input_type == 'gambar')
                            <img src="{{ asset('uploads/' . $item->input_name) }}" class="table-image" alt="gambar">
                        @else
                            {{ Str::limit($item->input_name, 70) }}
                        @endif
                    </td>

                    <td>
                        <strong>{{ ucfirst($item->hasil) }}</strong>
                    </td>

                    <td>
                        @php
                            $score = round($item->confidence * 100, 2);
                        @endphp

                        <span class="confidence
                            @if($score >= 80) high
                            @elseif($score >= 50) medium
                            @else low
                            @endif
                        ">
                            {{ $score }}%
                        </span>
                    </td>

                    <td>
                        @if($item->status == 'valid')
                            <span class="badge success">Valid</span>
                        @elseif($item->status == 'pending')
                            <span class="badge warning">Pending</span>
                        @else
                            <span class="badge danger">Tidak Valid</span>
                        @endif
                    </td>

                    <td>
                        {{ $item->created_at->format('d M Y') }}
                        <br>
                        <small>{{ $item->created_at->format('H:i') }}</small>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="empty">
                        Belum ada data klasifikasi
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- =======================================================
     PAGINATION (CLEAN)
======================================================= -->
<div class="pagination-wrapper">

@if ($data->lastPage() > 1)
<div class="pagination-wrapper">

    {{-- Prev --}}
    @if ($data->onFirstPage())
        <span class="page-btn disabled">‹</span>
    @else
        <a href="{{ $data->previousPageUrl() }}" class="page-btn">‹</a>
    @endif

    @php
        $current = $data->currentPage();
        $last = $data->lastPage();
    @endphp

    {{-- First page --}}
    @if ($current > 2)
        <a href="{{ $data->url(1) }}" class="page-btn">1</a>
    @endif

    {{-- Dots left --}}
    @if ($current > 3)
        <span class="page-btn disabled">...</span>
    @endif

    {{-- Middle --}}
    @for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++)
        @if ($i == $current)
            <span class="page-btn active">{{ $i }}</span>
        @else
            <a href="{{ $data->url($i) }}" class="page-btn">{{ $i }}</a>
        @endif
    @endfor

    {{-- Dots right --}}
    @if ($current < $last - 2)
        <span class="page-btn disabled">...</span>
    @endif

    {{-- Last page --}}
    @if ($current < $last - 1)
        <a href="{{ $data->url($last) }}" class="page-btn">{{ $last }}</a>
    @endif

    {{-- Next --}}
    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}" class="page-btn">›</a>
    @else
        <span class="page-btn disabled">›</span>
    @endif

</div>
@endif

@endsection