@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h1 class="title">📜 Log Aktivitas</h1>

    <div class="card">

        <table width="100%">

            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                    <th>Model</th>
                    <th>User</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($logs as $log)

                <tr>

                    <!-- WAKTU -->
                    <td>
                        {{ $log->created_at->format('d M Y') }}
                        <br>
                        <small>
                            {{ $log->created_at->format('H:i') }}
                        </small>
                    </td>

                    <!-- TIPE -->
                    <td>
                        <span class="badge model">
                            {{ strtoupper($log->tipe) }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td>
                        @if($log->aksi == 'create')
                            <span class="badge success">CREATE</span>
                        @elseif($log->aksi == 'update')
                            <span class="badge warning">UPDATE</span>
                        @elseif($log->aksi == 'delete')
                            <span class="badge danger">DELETE</span>
                        @else
                            <span class="badge">{{ $log->aksi }}</span>
                        @endif
                    </td>

                    <!-- MODEL -->
                    <td>
                        {{ $log->model_used ?? '-' }}
                    </td>

                    <!-- USER -->
                    <td>
                        {{ $log->user ?? 'System' }}
                    </td>

                    <!-- DESKRIPSI -->
                    <td>
                        {{ $log->deskripsi }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="empty">
                        Tidak ada log aktivitas
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection