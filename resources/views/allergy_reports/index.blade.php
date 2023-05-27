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
                        @if ($reports->isEmpty())
                            {{-- class="table-inactive"><small>Belum ada Menu Makanan
                            ditambahkan</small> --}}
                            <td colspan="6" class="text-muted">Tidak ada laporan Alergi Anda</td>
                        @else
                            @foreach ($reports as $report)
                                <div class="card-body">
                                    <div class="card mb-3 table-responsive">

                                        <table class="table ps-3">
                                            <tr>
                                                <td>NIM</td>
                                                <td>:</td>
                                                <td>{{ $report->user->nim }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ $report->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Asrama</td>
                                                <td>:</td>
                                                <td>{{ $report->user->asrama }}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Angkatan</td>
                                                <td>:</td>
                                                <td>{{ auth()->user()->angkatan }}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Alergi</td>
                                                <td>:</td>
                                                <td>{{ implode(', ', json_decode($report->allergies)) }}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td><span
                                                        class="badge {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                                        {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                                    </span></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Laporan</td>
                                                <td>:</td>
                                                <td><a>{{ $report->created_at->format('d M Y') }}</a></td>
                                            </tr>
                                            {{-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $report->created_at->diffForHumans() }}</a></td>
                                    </tr> --}}
                                        </table>
                                    </div>
                                    @if ($report->approved)
                                        <p class="card-text text-muted">Silahkan meminta makanan pengganti kepada pihak
                                            Kantin.
                                        </p>
                                    @endif
                                    {{-- <a href="" class="btn btn-primary btn-sm" disabled>Tanggal Laporan:
                                    {{ $report->created_at->format('d M Y') }}</a> --}}
                                </div>
                                <div class="card-footer text-muted">
                                    {{ $report->created_at->diffForHumans() }}
                                </div>
                            @endforeach
                        @endif
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
