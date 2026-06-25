@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')

<div class="page-header">

    <div>

        <h1 class="title">Beranda Admin</h1>

        <p class="subtitle">
            Ringkasan data tumbuhan dan aktivitas identifikasi.
        </p>

    </div>

</div>

<!-- KPI CARDS -->
<div class="grid">

    <div class="card">
        <h2>{{ $totalTumbuhan }}</h2>
        <p>Total Tumbuhan</p>
    </div>

    <div class="card">
        <h2>{{ $totalKlasifikasi }}</h2>
        <p>Total Klasifikasi</p>
    </div>

    <div class="card">
        <h2>{{ $valid }}</h2>
        <p>Hasil Valid</p>
    </div>

    <div class="card">
        <h2>{{ $invalid }}</h2>
        <p>Hasil Tidak Valid</p>
    </div>

    <div class="card">
        <h2>{{ $pending }}</h2>
        <p>Pending</p>
    </div>

</div>

<!-- CHARTS -->
<div class="chart-grid">

    <div class="chart-box">
        <h3>📈 Status Hasil Identifikasi</h3>
        <canvas id="statusChart"></canvas>
    </div>

    <div class="chart-box">
        <h3>🤖 Penggunaan Metode Identifikasi</h3>
        <canvas id="modelChart"></canvas>
    </div>

</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('statusChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Valid', 'Invalid', 'Pending'],
        datasets: [{
            data: [{{ $valid }}, {{ $invalid }}, {{ $pending }}],
            backgroundColor: [
                '#4CAF50',
                '#F44336',
                '#FF9800'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const ctx2 = document.getElementById('modelChart');

new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['YOLO', 'MNB'],
        datasets: [{
            label: 'Jumlah Klasifikasi',
            data: [{{ $yolo }}, {{ $mnb }}],
            backgroundColor: [
                '#2196F3',
                '#9C27B0'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

</script>

@endsection