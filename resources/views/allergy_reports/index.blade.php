@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card text-center">
                        <div class="card-header">
                            Laporan Mahasiswa Alergi
                        </div>
                        @foreach ($reports as $report)
                            <div class="card-body">
                                <h5 class="card-title">{{ $report->user->name }}</h5>
                                <p class="card-title">{{ $report->user->nim }}</p>
                                <p class="card-title">{{ $report->user->angkatan }}</p>
                                <p class="card-title">{{ $report->user->asrama }}</p>

                                <h5 class="card-text">Jenis Makanan Alergi: <strong>{{ $report->allergies }}</strong></h5>
                                <p class="card-text">Status: <span
                                        class="badge {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                        {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                    </span></p>
                                    @if($report->approved)
                                    <p class="card-text text-muted">Silahkan meminta makanan pengganti kepada pihak Kantin.</p>
                                @endif
                                <a href="" class="btn btn-primary btn-sm" disabled>Tanggal Laporan:
                                    {{ $report->created_at->format('d M Y') }}</a>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $report->created_at->diffForHumans() }}
                            </div>
                        @endforeach
                    </div>
                    {{-- <table style="width:100%">
                        <tr>
                            <td>Emil</td>
                            <td>:</td>
                            <td>Linus</td>
                        </tr>
                        <tr>
                            <td>Emil</td>
                            <td>:</td>
                            <td>Linus</td>
                        </tr>
                    </table> --}}
                    {{-- <div class="card-header">
                        <center>Data Laporan Alergi</center>
                    </div>
                    <div class="card-body">

                        {{-- <h1>Allergy Reports</h1> --}}
                    {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th>Jenis Alergi</th>
                                    <th>File</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->allergies }}</td>
                                        <td><a href="{{ asset('allergy_reports/' . $report->file) }}">{{ $report->file }}</a></td>

                                        <td>
                                            <span class="badge {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                                {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                            </span>
                                        </td>

                                        {{-- <td>{{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}</td> --}}
                    {{-- </tr>
                                @endforeach
                            </tbody>
                        </table>  --}}

                    {{-- </div> --}}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


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
    @include('partials.footer')
@endsection
