<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/tumbuhan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/detail_tumbuhan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/klasifikasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/models.css') }}"> --}}

     @stack('styles')

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="content">

        @yield('content')

    </div>

</div>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Validasi Error',
        text: '{{ $errors->first() }}'
    });
</script>
@endif

</body>
</html>