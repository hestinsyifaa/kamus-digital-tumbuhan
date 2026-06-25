@php
use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/validasi.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

<div class="header">

    <div class="left">
        <h1 class="title">Validasi Hasil Identifikasi</h1>
        <p class="subtitle">Menampilkan data hasil identifikasi tumbuhan yang perlu divalidasi.</p>
    </div>

    <div class="actions">
        <button type="button" class="btn-export" onclick="exportPdf()">
            <i class="fa-solid fa-download"></i> Unduh File
        </button>
    </div>

</div>


<div class="header-section">

    <div class="cards">
        <div class="card">
            <h2>{{ $totalPending }}</h2>
            <p>Data Pending</p>
        </div>

        {{-- <div class="card">
            <h2>{{ $totalValid }}</h2>
            <p>Valid</p>
        </div>

        <div class="card">
            <h2>{{ $totalInvalid }}</h2>
            <p>Tidak Valid</p>
        </div> --}}
    </div>

</div>

<!-- TABLE -->
<div class="table-card">
    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>Inputan Data</th>
                    <th>Hasil Identifikasi</th>
                    <th>Tingkat Kecocokan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($data as $item)

                <tr>

                    <!-- INPUT -->
                    <td>
                        @if($item->input_type == 'gambar')
                            <img src="{{ asset('uploads/' . $item->input_name) }}"
                                 class="table-image">
                        @else
                            <div class="text-wrap">
                                {{ Str::limit($item->input_name, 70) }}
                            </div>
                        @endif
                    </td>

                    <!-- HASIL -->
                    <td>
                        <strong>{{ ucfirst($item->hasil) }}</strong>
                    </td>

                    <!-- CONFIDENCE -->
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

                    <!-- ACTION -->
                    <td>
                        <div class="action-buttons">

                            <!-- VALID -->
                            <form method="POST"
                                  action="{{ url('/admin/validasi/'.$item->id) }}"
                                  class="validasi-form">
                                @csrf
                                <input type="hidden" name="status" value="valid">

                                <button type="button"
                                        class="btn-valid"
                                        onclick="confirmValid(this.form)">
                                    ✔ Valid
                                </button>
                            </form>

                            <!-- INVALID -->
                            <form method="POST"
                                  action="{{ url('/admin/validasi/'.$item->id) }}"
                                  class="validasi-form">
                                @csrf
                                <input type="hidden" name="status" value="tidak valid">

                                <button type="button"
                                        class="btn-invalid"
                                        onclick="confirmInvalid(this.form)">
                                    ✖ Tidak
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="4" class="empty">
                        Tidak ada data pending
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- PAGINATION -->
@if ($data->hasPages())
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

</div>
@endif

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function exportPdf() {
    Swal.fire({
        title: 'Export PDF?',
        text: "Data akan diunduh sebagai laporan validasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2e7d32',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Export',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('/admin/validasi/export-pdf') }}";
        }
    });
}

function confirmValid(form){
    Swal.fire({
        title: 'Validasi data?',
        text: "Data akan ditandai sebagai VALID",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Valid',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}

function confirmInvalid(form){
    Swal.fire({
        title: 'Tandai tidak valid?',
        text: "Data akan ditolak",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}
</script>

@endsection