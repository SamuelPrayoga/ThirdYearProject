@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script type="text/javascript" src="{{ asset('js/auth/jquery.js') }}"></script>
@endpush

@section('content')
    <div class="w-100">
        <div>
            <main class="form-signin w-100 m-auto">
                <center><img src="{{ asset('img/logo.png') }}" class="logo" alt="" width="100px"></center>
                <center>
                    <h3 class="h3 mb-3 fw-normal" id="judul">Kantin Institut Teknologi Del</h3>
                </center>
                <form method="POST" action="/register" id="login-form">
                    @csrf
                    <div class="mb-3">
                        <label for="floatingInputEmail" id="labels">NIM</label>
                        <input type="text" class="form-control" id="floatingInputNim" name="nim" required>
                        @if ($errors->has('nim'))
                            <span class="text-danger">{{ $errors->first('nim') }} </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingInputName" id="labels">Nama Lengkap</label>
                        <input type="text" class="form-control" id="floatingInputName" name="name" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }} </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingInputProdi" id="labels">Program Studi</label>
                        <select id="labels" class="form-control" id="floatingInputProdi" name="prodi" required>
                            <option id="labels" value="">Pilih Program Studi</option>
                            <option id="labels" value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                            <option id="labels" value="D3 Teknologi Informasi">D3 Teknologi Informasi</option>
                            <option id="labels" value="Sarjana Terapan Rekayasa Perangkat Lunak">Sarjana Terapan Rekayasa
                                Perangkat Lunak</option>
                            <option id="labels" value="S1 Teknik Elektro">S1 Teknik Elektro</option>
                            <option id="labels" value="S1 Informatika">S1 Informatika</option>
                            <option id="labels" value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                            <option id="labels" value="S1 Manajemen Rekayasa">S1 Manajemen Rekayasa</option>
                            <option id="labels" value="S1 Teknik Bioproses">S1 Teknik Bioproses</option>
                        </select>
                        @if ($errors->has('prodi'))
                            <span class="text-danger">{{ $errors->first('prodi') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingInputAngkatan" id="labels">Angkatan</label>
                        <select id="labels" class="form-control" id="floatingInputAngkatan" name="angkatan" required>
                            <option id="labels" value="">Pilih Angkatan</option>
                            <option id="labels" value="2018">2018</option>
                            <option id="labels" value="2019">2019</option>
                            <option id="labels" value="2020">2020</option>
                            <option id="labels" value="2021">2021</option>
                            <option id="labels" value="2022">2022</option>
                            <option id="labels" value="2023">2023</option>
                            <option id="labels" value="2024">2024</option>
                            <option id="labels" value="2025">2025</option>
                        </select>
                        @if ($errors->has('angkatan'))
                            <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingInputTele" id="labels">Nomor Telepon</label>
                        <input type="text" class="form-control" id="floatingInputTele" name="phone" required>
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }} </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingInputEmail" id="labels">Email Zimbra</label>
                        <input type="email" class="form-control" id="floatingInputEmail" name="email" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }} </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="floatingPassword" id="labels">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" name="password" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('password') }} </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" class="form-checkbox" id="lupapassword"><small> Tampilkan Password</small>
                    </div>

                    <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Daftar</button>
                    <br>
                    <a href="/login" id="lupapassword">Sudah memiliki Akun ?</a>
                    <center>
                        <p class="mt-5 mb-3 text-muted" id="lupapassword">Pengembangan Sistem Informasi Dilindungi
                            &copy;Institut Teknologi Del
                            2023</p>
                    </center>
                </form>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </main>
        </div>
    </div>
    <style>
        #login-form-button {
            background: #367fa9;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('#floatingPassword').attr('type', 'text');
                } else {
                    $('#floatingPassword').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
@include('partials.alerts')
@push('script')
    <script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
