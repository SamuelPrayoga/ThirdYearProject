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
                                    <input type="text" class="form-control" id="username"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="username"
                                        value="{{ Auth::user()->nim }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" id="username"
                                        value="{{ Auth::user()->prodi }}" readonly>
                                </div>
                                <label for="allergies">Jenis Alergi <span class="text-danger" style="color: red">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="ikanLaut"
                                        value="Ikan Laut">
                                    <label class="form-check-label" for="ikanLaut">Ikan Laut</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="telur"
                                        value="Telur">
                                    <label class="form-check-label" for="telur">Telur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="lele"
                                        value="Ikan Lele">
                                    <label class="form-check-label" for="lele">Ikan Lele</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="seafood"
                                        value="Seafood">
                                    <label class="form-check-label" for="seafood">Seafood</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="pedas"
                                        value="Makanan Pedas">
                                    <label class="form-check-label" for="pedas">Makanan Pedas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="daging"
                                        value="Daging Kerbau/Sapi/Kambing">
                                    <label class="form-check-label" for="daging">Daging Kerbau/Sapi/Kambing</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="ayam"
                                        value="Daging Ayam">
                                    <label class="form-check-label" for="ayam">Daging Ayam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="ikanmas"
                                        value="Ikan Mas">
                                    <label class="form-check-label" for="ikanmas">Ikan Mas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="daunubi"
                                        value="Daun Singkong">
                                    <label class="form-check-label" for="daunubi">Daun Singkong</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="terung"
                                        value="Terung Hijau">
                                    <label class="form-check-label" for="terung">Terung Hijau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="jamur"
                                        value="Jamur">
                                    <label class="form-check-label" for="jamur">Jamur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="kikil"
                                        value="Kikil">
                                    <label class="form-check-label" for="kikil">Kikil</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="kedelai"
                                        value="Kacang Kedelai (Tahu/Tempe)">
                                    <label class="form-check-label" for="kedelai">Kacang Kedelai (Tahu/Tempe)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="kacangan"
                                        value="Kacang-Kacangan">
                                    <label class="form-check-label" for="kacangan">Kacang-Kacangan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="jahir"
                                        value="Ikan Mujahir">
                                    <label class="form-check-label" for="jahir">Ikan Mujahir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="nenas"
                                        value="Nenas">
                                    <label class="form-check-label" for="nenas">Nenas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="pepaya"
                                        value="Pepaya">
                                    <label class="form-check-label" for="pepaya">Pepaya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="allergies[]" id="gori"
                                        value="Gori">
                                    <label class="form-check-label" for="gori">Gori</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Surat Keterangan Dokter/Bukti Lainnya <span
                                        class="text-danger"> *</span></label>
                                <input type="file" class="form-control" name="file[]" id="file" placeholder=""
                                    required>
                                <small>Penamaan File: Alergi_NIM_Nama</small>
                            </div>
                            <div class="float-end mt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Laporkan</button>
                            </div>
                        </form>

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
    @include('partials.footer')
@endsection
