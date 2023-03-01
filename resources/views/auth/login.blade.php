@extends('layouts.auth')

@push('style')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush

@section('content')

<div class="w-100">

    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('auth.login') }}" id="login-form">
            <center><img src="{{asset('img/logo.png')}}" alt="" width="100px"></center><br>
            <center><strong><h2 class="h3 mb-3 fw-normal">DEL CANTEEN MANAGEMENT SYSTEM INSTITUT TEKNOLOGI DEL</h2></strong></center>

            <div class="mb-3">
                <label for="floatingInputEmail"><i class="bi bi-person-circle"></i> Email Zimbra</label>
                <input type="text" class="form-control" id="floatingInputEmail" name="email"
                    placeholder="@students.del.ac.id" required>
            </div>
            <div class="mb-3">
                <label for="floatingPassword"><i class="bi bi-key"></i> Password</label>
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="*******" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckRemember" required>
                <label class="form-check-label" for="flexCheckRemember">
                    Saya Setuju pada Privasi dan aturan DelCanteen
                </label>
            </div>

            <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
            <br> <br>
            <a href="/forget-passwords">Lupa atau ingin Reset Password ?</a>
            <center><p class="mt-5 mb-3 text-muted">Pengembangan Sistem Informasi Dilindungi &copy;Institut Teknologi Del 2023</p></center>
        </form>
    </main>
</div>
@endsection

@push('script')
<script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
