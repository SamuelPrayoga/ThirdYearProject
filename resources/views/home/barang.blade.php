@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Formulir Laporan Kehilangan atau Temuan Barang</center>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.laporan-barang-form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="ulasan">Kategori Laporan:</label>
                                <select class="form-control" id="laporan" required="required" name="kategori"
                                    aria-label="Default select example">
                                    <option disabled selected value>-- Pilih Laporan --</option>
                                    <option value="Kehilangan Barang">Kehilangan Barang</option>
                                    <option value="Menemukan">Temuan Barang</option>
                                    </option>
                                </select>
                            </div>
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
                            <div class="mb-3">
                                <label for="barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="barang" name="item_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat Terakhir Dilihat/Ditemukan</label>
                                <input type="text" class="form-control" id="tempat" name="place" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tanggal" class="form-label">Tanggal Hilang/Ditemukan</label>
                                    <input type="date" class="form-control" id="tanggal" name="date" required>
                                </div>
                                <div class="col">
                                    <label for="waktu" class="form-label">Waktu Hilang/Ditemukan</label>
                                    <input type="time" class="form-control" id="waktu" name="time" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Ciri-Ciri / Deskripsi
                                    Tambahan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Gambar/Contoh Gambar</label>
                                <input type="file" class="form-control" name="file" id="input-three" placeholder=""
                                    required>
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
