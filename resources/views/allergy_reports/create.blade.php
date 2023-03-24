@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Formulir Laporan Alergi</center>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.allergy-reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                              <div class="form-group">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="username" value="{{ Auth::user()->name }}"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="username" value="{{ Auth::user()->nim }}"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" id="username" value="{{ Auth::user()->prodi }}"
                                        readonly>
                                </div>
                                        <label for="allergies">Jenis Alergi</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="seafood" value="Seafood">
                                            <label class="form-check-label" for="seafood">Makanan Laut/Seafood</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="telur" value="Telur">
                                            <label class="form-check-label" for="telur">Telur</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="kacang" value="Kacang-Kacangan">
                                            <label class="form-check-label" for="kacang">Kacang-Kacangan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="lele" value="Ikan Laut">
                                            <label class="form-check-label" for="lele">Ikan Laut</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="pedas" value="Makanan Pedas">
                                            <label class="form-check-label" for="pedas">Makanan Pedas</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="allergies[]" id="lemak" value="Makanan Berlemak">
                                            <label class="form-check-label" for="lemak">Makanan Berlemak</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Surat Keterangan Dokter/Bukti Lainnya <span class="text-danger"> *</span></label>
                                        <input type="file" class="form-control" name="file[]" id="file" placeholder=""
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>

                        {{-- <form method="POST" action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="username" value="{{ Auth::user()->name }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="username" value="{{ Auth::user()->nim }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="jenis-alergi" class="form-label">Jenis Alergi</label>
                                <p class="text-secondary"><small>Pilih Sesuai dengan Alergi yang Anda miliki<span class="text-danger"> *</span></small></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Telur" id="checkbox-kacang">
                                    <label class="form-check-label" for="checkbox-Telur">
                                        Telur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Ikan Laut" id="checkbox-ikanlaut">
                                    <label class="form-check-label" for="checkbox-ikanlaut">
                                        Ikan Laut
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lele" id="checkbox-lele">
                                    <label class="form-check-label" for="checkbox-lele">
                                        Lele
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kacangan" id="checkbox-kacangan">
                                    <label class="form-check-label" for="checkbox-kacangan">
                                        Kacang-Kacangan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Pedas" id="checkbox-pedas">
                                    <label class="form-check-label" for="checkbox-pedas">
                                        Makanan Pedas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Susu" id="checkbox-susu">
                                    <label class="form-check-label" for="checkbox-susu">
                                        Susu
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Seafood" id="checkbox-seafood">
                                    <label class="form-check-label" for="checkbox-seafood">
                                        Seafood
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Makanan Berlemak" id="checkbox-berlemak">
                                    <label class="form-check-label" for="checkbox-berlemak">
                                        Makanan Kadar Lemak Tinggi
                                    </label>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Surat Keterangan Dokter/Bukti Lainnya <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control" name="file" id="input-three" placeholder=""
                                        required>
                                </div>
                                <!-- tambahkan jenis makanan yang lainnya -->
                            </div>
                            <div class="text-end">
                                <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                <button type="submit" class="btn btn-primary btn-sm">Laporkan</button>
                            </div>

                        </form> --}}
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
