@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card">
                        <div class="card-header">
                            Laporan Mahasiswa Alergi
                        </div>
                        @foreach ($reports as $report)
                            <div class="card-body">
                                <p class="card-title">Laporan Alergi atas nama: {{ $report->user->name }}</p>
                                <p class="card-title">NIM: {{ $report->user->nim }}</p>
                                <p class="card-title">Angkatan: {{ $report->user->angkatan }}</p>
                                <p class="card-title">Asrama: {{ $report->user->asrama }}</p>

                                <h5 class="card-text">Jenis Makanan Alergi:</h5>
                                <p>{{ implode(', ', json_decode($report->allergies)) }}</p>
                                <p class="card-text">Status: <span
                                        class="badge {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                        {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                    </span></p>
                                @if ($report->approved)
                                    <p class="card-text text-muted">Silahkan meminta makanan pengganti kepada pihak Kantin.
                                    </p>
                                @endif
                                <a href="" class="btn btn-primary btn-sm" disabled>Tanggal Laporan:
                                    {{ $report->created_at->format('d M Y') }}</a>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $report->created_at->diffForHumans() }}
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .table-inactive {
            background: #878787;
            color: #858585;
        }
    </style>
    @include('sweetalert::alert')
    @include('partials.footer')
@endsection
