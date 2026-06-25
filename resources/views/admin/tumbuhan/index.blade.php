@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/tumbuhan.css') }}">
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1 class="title">Data Tumbuhan</h1>

        <p class="subtitle">
            Kelola data taksonomi tumbuhan pada sistem.
        </p>
    </div>
</div>

<!-- TOP BAR -->
<div class="top-bar">

    <!-- LEFT -->
    <div class="left-actions">

        <a href="{{ url('/admin/tumbuhan/create') }}" class="btn-add">
            + Tambah Data
        </a>

        <div class="data-info">
            Total <strong>{{ $data->total() }}</strong> data
        </div>

    </div>

    <!-- RIGHT -->
    <form action="{{ url('/admin/tumbuhan') }}"
          method="GET"
          class="search-form">

        <input type="text"
               name="search"
               placeholder="Cari tumbuhan..."
               value="{{ request('search') }}">

        <button type="submit">Cari</button>

    </form>

</div>

<!-- =======================================================
     ALERT SUCCESS
======================================================= -->
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- =======================================================
     TABLE
======================================================= -->
<div class="table-card">

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Tumbuhan</th>
                    <th>Nama Ilmiah</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($data as $t)

                <tr>

                    <td>
                        @if($t->gambar)
                            <img src="{{ asset('images/tumbuhan/' . $t->gambar) }}"
                                 class="table-image"
                                 alt="{{ $t->nama_tumbuhan }}">
                        @else
                            <div class="no-image">Tidak Ada Gambar</div>
                        @endif
                    </td>

                    <td class="nama">
                        {{ $t->nama_tumbuhan }}
                    </td>

                    <td>
                        <i>{{ $t->nama_latin }}</i>
                    </td>

                    <td>
                        <span class="badge {{ strtolower($t->jenis) }}">
                            {{ $t->jenis }}
                        </span>
                    </td>

                    <td>
                        {{ $t->lokasi }}
                    </td>

                    <td>
                        <div class="action-group">

                            <a href="{{ url('/admin/tumbuhan/' . $t->id) }}"
                               class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ url('/admin/tumbuhan/' . $t->id . '/edit') }}"
                               class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ url('/admin/tumbuhan/' . $t->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn-delete"
                                        onclick="confirmDelete(this.form)">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="empty">
                        Data tumbuhan belum tersedia
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

    @if ($data->onFirstPage())
        <span class="pagination-btn disabled">‹</span>
    @else
        <a href="{{ $data->previousPageUrl() }}" class="pagination-btn">‹</a>
    @endif

    @for ($i = 1; $i <= $data->lastPage(); $i++)

        @if ($i == $data->currentPage())
            <span class="pagination-btn active">{{ $i }}</span>

        @elseif (
            $i == 1 ||
            $i == $data->lastPage() ||
            ($i >= $data->currentPage() - 1 && $i <= $data->currentPage() + 1)
        )
            <a href="{{ $data->url($i) }}" class="pagination-btn">
                {{ $i }}
            </a>

        @elseif (
            ($i == 2 && $data->currentPage() > 3) ||
            ($i == $data->lastPage() - 1 && $data->currentPage() < $data->lastPage() - 2)
        )
            <span class="dots">...</span>
        @endif

    @endfor

    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}" class="pagination-btn">›</a>
    @else
        <span class="pagination-btn disabled">›</span>
    @endif

</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(form){
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}
</script>

@endsection