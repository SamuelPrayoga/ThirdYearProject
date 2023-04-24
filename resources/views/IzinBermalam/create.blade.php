@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Formulir Laporan Izin Bermalam</center>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.izin-bermalam.create') }}" method="POST">
                            @csrf
                            <input type=hidden name=UserID value={{ auth()->user()->id }}>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="username" value="{{ Auth::user()->name }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" value="{{ Auth::user()->nim }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="text" class="form-control" id="angkatan"
                                    value="{{ Auth::user()->angkatan }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" id="prodi" value="{{ Auth::user()->prodi }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="attendance_id">Absen Makan</label>
                                <select class="form-control" id="attendance_id" name="attendance_id">
                                    @foreach ($attendances as $attendance)
                                        <option value="{{ $attendance->id }}">{{ $attendance->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keberangkatan" class="form-label">Waktu Keberangkatan</label>
                                <input type="datetime-local" class="form-control" id="barang" name="keberangkatan"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="kedatangan" class="form-label">Waktu Kedatangan</label>
                                <input type="datetime-local" class="form-control" id="kedatangan" name="kedatangan"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="alasan" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                <button type="submit" class="btn btn-primary btn-sm">Laporkan</button>
                            </div>
                        </form>
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
