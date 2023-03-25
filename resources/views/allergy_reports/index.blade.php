@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Data Laporan Alergi</center>
                    </div>
                    <div class="card-body">
                        {{-- <h1>Allergy Reports</h1> --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Jenis Alergi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->allergies }}</td>
                                        <td>
                                            <span class="badge {{ $report->approved ? 'bg-success' : 'bg-danger' }}">
                                                {{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}
                                            </span>
                                        </td>

                                        {{-- <td>{{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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
