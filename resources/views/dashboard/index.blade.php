@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Jumlah Mahasiswa Makan</h6>
                        <h4 class="fw-bold">{{ $userCount }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Pagi, Hari: Jumat  </h6>
                        <h4 class="fw-bold">{{ $makan_pagi }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Siang, Hari: Jumat </h6>
                        <h4 class="fw-bold">{{ $makan_siang }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Malam, Hari: Jumat </h6>
                        <h4 class="fw-bold">{{ $makan_malam }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <div class="row">

            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Pagi, Hari: Sabtu </h6>
                        <h4 class="fw-bold">{{ $pagi_sabtu }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Siang, Hari: Sabtu </h6>
                        <h4 class="fw-bold">{{ $siang_sabtu }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">

        </div>
    </div>
@endsection
