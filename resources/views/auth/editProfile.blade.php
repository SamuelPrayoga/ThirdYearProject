@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Edit Profil</center>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="username"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim"
                                        value="{{ Auth::user()->nim }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="prodi" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" id="prodi"
                                        value="{{ Auth::user()->prodi }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan"
                                        value="{{ Auth::user()->angkatan }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="asrama" class="form-label">Asrama</label>
                                    <input type="text" class="form-control" id="asrama"
                                        value="{{ Auth::user()->asrama }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="avatar" class="form-label">Avatar:</label>
                                    <br>
                                    <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" alt="Foto Profil"
                                        style="border-radius: 10%;" width="125px" height="120px">
                                    <br><br>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="number" class="form-control" id="phone"
                                        value="{{ Auth::user()->phone }}" name="phone">
                                    <small class="text-danger">*</small><small class="text-secondary"> Hanya Nomor Telepon
                                        yang dapat diubah.</small>
                                </div>
                                {{-- <div class="mb-3">
                                    <a href="/forget-passwords" id="lupapassword" class="text-danger">UBAH PASSWORD</a>
                                </div> --}}
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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
