@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
@endpush

@section('content')

<div class="page-header">

    <div>
        <h1 class="title">Tambah Data Tumbuhan</h1>

        <p class="subtitle">
            Tambahkan data tumbuhan baru ke dalam sistem.
        </p>
    </div>

</div>

    @if ($errors->any())
        <div class="custom-alert">
            {{ $errors->first() }}
        </div>
    @endif

<div class="form-container">

    <form action="{{ url('/admin/tumbuhan') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        {{-- nama tumbuhan --}}
        <div class="form-group">

            <label>Nama Tumbuhan</label>

            <input type="text"
                   name="nama_tumbuhan"
                   placeholder="Contoh: Jagung"
                   required>

        </div>

        {{-- nama latin --}}
        <div class="form-group">

            <label>Nama Ilmiah</label>

            <input type="text"
                   name="nama_latin"
                   placeholder="Contoh: Zea mays"
                   required>

        </div>

        {{-- jenis --}}
        <div class="form-group">

            <label>Kategori Tumbuhan</label>

            <select name="jenis" required>

                <option value="">
                    -- Pilih Jenis --
                </option>

                <option value="Monokotil">
                    Monokotil
                </option>

                <option value="Dikotil">
                    Dikotil
                </option>

            </select>

        </div>

        {{-- lokasi --}}
        <div class="form-group">

            <label>Lokasi</label>

            <input type="text"
                   name="lokasi"
                   placeholder="Contoh: Kebun Raya Bogor"
                   required>

        </div>

        {{-- latitude --}}
        <div class="form-group">

            <label>Latitude</label>

            <input type="text"
                   name="latitude"
                   placeholder="-6.5971">

        </div>

        {{-- longitude --}}
        <div class="form-group">

            <label>Longitude</label>

            <input type="text"
                   name="longitude"
                   placeholder="106.8060">

        </div>

        {{-- upload gambar --}}
        <div class="form-group">

            <label>Gambar Tumbuhan</label>

            <input type="file"
                   name="gambar"
                   accept="image/*">

        </div>

        {{-- deskripsi --}}
        <div class="form-group">

            <label>Deskripsi Tumbuhan</label>

            <textarea name="deskripsi"
                      rows="5"
                      placeholder="Masukkan deskripsi tumbuhan..."
                      required></textarea>

        </div>

        {{-- tombol --}}
        <div class="form-action">

            <a href="{{ url('/admin/tumbuhan') }}"
               class="btn-back">

                ← Kembali

            </a>

            <button type="submit"
                    class="btn-submit">

                Simpan

            </button>

        </div>

    </form>

</div>


@endsection