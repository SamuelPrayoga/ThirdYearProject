@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card">
                        <div class="card-header">
                            Laporan Alergi Mahasiswa
                        </div>
                        <div class="card-body">
                            @if ($reports->isEmpty())
                                <td colspan="6" class="table-inactive"><small class="text-muted">Tidak ada Laporan
                                        Alergi yang dilaporkan.</small>
                                </td>
                                {{-- <td colspan="6"><small class="text-muted">Tidak ada Laporan Alergi.</small></td> --}}
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
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill {{ $report->approved == 1 ? 'bg-success' : ($report->approved == 2 ? 'bg-danger' : 'bg-warning') }}">
                                                            {{ $report->approved == 1 ? 'Disetujui' : ($report->approved == 2 ? 'Ditolak' : 'Menunggu') }}
                                                        </span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Tanggal Laporan</td>
                                                    <td>:</td>
                                                    <td><a>{{ $report->created_at->format('d M Y') }}</a></td>
                                                </tr>
                                                @if ($report->where('approved', 2)->count() > 0)
                                                <tr>
                                                    <td>Alasan Penolakan</td>
                                                    <td>:</td>
                                                    <td><a class="card-text text-muted danger">{{ $report->alasan_penolakan }}</a></td>
                                                </tr>
                                                @endif
                                                {{-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $report->created_at->diffForHumans() }}</a></td>
                                    </tr> --}}
                                            </table>
                                        </div>
                                        <style>
                                            .warning {
                                                background-color: rgb(255, 255, 168);
                                            }

                                            .success {
                                                background-color: rgb(168, 255, 168);
                                            }

                                            .danger {
                                                background-color: rgb(255, 183, 183);
                                            }
                                        </style>

                                        @if ($report->approved == 0)
                                            <p class="card-text text-muted warning">Mohon Menunggu konfirmasi permintaan
                                                Anda
                                            </p>
                                        @elseif ($report->approved == 1)
                                            <p class="card-text text-muted success">Silahkan meminta makanan pengganti
                                                kepada
                                                pihak Kantin.</p>
                                        {{-- @elseif ($report->approved == 2)
                                            <p class="card-text text-muted danger">{{$report->alasan_penolakan}}</p> --}}
                                        @endif
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
