@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script type="text/javascript" src="{{ asset('js/auth/jquery.js') }}"></script>
@endpush

@section('content')
    <div class="w-100">

        <main class="form-signin w-100 m-auto">
            <center><img src="{{ asset('img/logo.png') }}" class="logo" alt="" width="100px"></center>
            <center>
                <h3 class="h3 mb-3 fw-normal" id="judul">Kantin Institut Teknologi Del</h3>
            </center>
            <form method="POST" action="{{ route('auth.login') }}" id="login-form">
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

                <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
                <br>
                {{-- <a href="{{route('auth.register')}}" id="lupapassword">Daftar Akun</a> <br> --}}
                <a href="/forget-passwords" id="lupapassword">Lupa atau Reset Password ?</a>
                <center>
                    <p class="mt-5 mb-3 text-muted" id="lupapassword">Pengembangan Sistem Informasi Dilindungi
                        &copy;Institut Teknologi Del
                        2023</p>
                </center>
            </form>
        </main>
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
@push('script')
    <script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
