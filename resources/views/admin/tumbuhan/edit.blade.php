@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
@endpush

@section('content')

<div class="page-header">

    <div>
        <h1 class="title">
            Edit Informasi Tumbuhan
        </h1>

        <p class="subtitle">
            Edit dan perbarui informasi tumbuhan.
        </p>
    </div>

</div>

<div class="form-container">

    <form action="{{ url('/admin/tumbuhan/' . $tumbuhan->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- nama tumbuhan --}}
        <div class="form-group">

            <label>Nama Tumbuhan</label>

            <input type="text"
                   name="nama_tumbuhan"
                   value="{{ $tumbuhan->nama_tumbuhan }}"
                   required>

        </div>

        {{-- nama latin --}}
        <div class="form-group">

            <label>Nama Ilmiah</label>

            <input type="text"
                   name="nama_latin"
                   value="{{ $tumbuhan->nama_latin }}"
                   required>

        </div>

        {{-- jenis --}}
        <div class="form-group">

            <label>Kategori Tumbuhan</label>

            <select name="jenis" required>

                <option value="Monokotil"
                    {{ $tumbuhan->jenis == 'Monokotil' ? 'selected' : '' }}>

                    Monokotil

                </option>

                <option value="Dikotil"
                    {{ $tumbuhan->jenis == 'Dikotil' ? 'selected' : '' }}>

                    Dikotil

                </option>

            </select>

        </div>

        {{-- lokasi --}}
        <div class="form-group">

            <label>Lokasi</label>

            <input type="text"
                   name="lokasi"
                   value="{{ $tumbuhan->lokasi }}"
                   required>

        </div>

        {{-- latitude --}}
        <div class="form-group">

            <label>Latitude</label>

            <input type="text"
                   name="latitude"
                   value="{{ $tumbuhan->latitude }}">

        </div>

        {{-- longitude --}}
        <div class="form-group">

            <label>Longitude</label>

            <input type="text"
                   name="longitude"
                   value="{{ $tumbuhan->longitude }}">

        </div>

        {{-- deskripsi --}}
        <div class="form-group">

            <label>Deskripsi Tumbuhan</label>

            <textarea name="deskripsi"
                      rows="5"
                      required>{{ $tumbuhan->deskripsi }}</textarea>

        </div>

        {{-- gambar --}}
        <div class="form-group">

            <label>Gambar Tumbuhan</label>

            <input type="file"
                   name="gambar">

        </div>

        {{-- preview gambar --}}
        @if($tumbuhan->gambar)

            <div class="preview-image">

                <img src="{{ asset('images/tumbuhan/' . $tumbuhan->gambar) }}"
                     alt="{{ $tumbuhan->nama_tumbuhan }}">

            </div>

        @endif

        {{-- button --}}
        <div class="form-action">

            <a href="/admin/tumbuhan"
               class="btn-back">

                ← Kembali

            </a>

            <button type="submit"
                    class="btn-submit">

                Edit Data

            </button>

        </div>

    </form>

</div>


@endsection