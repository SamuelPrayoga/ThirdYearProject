@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Data Mahasiswa</h6>
                    <h4 class="fw-bold">{{ $userCount }}</h4>
                    <p class="text-muted">Mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Mahasiswa Izin Bermalam</h6>
                    <h4 class="fw-bold">80</h4>
                    <p class="text-muted">Mulai Jumat Sore / Tidak Makan Sore</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Mahasiswa Izin Bermalam</h6>
                    <h4 class="fw-bold">55</h4>
                    <p class="text-muted">Mulai Sabtu Pagi / Tidak Makan Siang</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Mahasiswa Izin Bermalam</h6>
                    <h4 class="fw-bold">150</h4>
                    <p class="text-muted">Mulai Sabtu Sore / Ikut Makan Siang</p>
                </div>
            </div>
        </div>

    </div>
</div>
<div>
    <div class="container">
        {{-- <div class="card shadow">
            <h6 class="fs-6 fw-light">  Pemberitahuan</h6>
            <div class="card-body">
                <div class="card-body">

                </div>
            </div>
        </div> --}}
      </div>
</div>
@endsection
