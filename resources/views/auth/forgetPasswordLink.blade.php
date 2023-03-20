<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script type="text/javascript" src="{{asset('js/auth/jquery.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
</head>

<body>
    <div class="w-100">

        <main class="form-signin w-100 m-auto">
            <center><img src="{{ asset('img/logo.png') }}" alt="" width="100px"></center><br>
            <center>
                <h4  id="judul">Reset Password</h4>
            </center>
            <form action="{{ route('reset.password.post') }}" method="POST" id="login-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                    <label for="email_address" id="labels">Alamat Email</label>
                        <input type="text" id="email_address" class="form-control" name="email" placeholder="Email Zimbra Mahasiswa"
                            required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    <label for="password" id="labels">Password Baru</label>
                        <input type="password" id="password" class="form-control" name="password"
                            required autofocus>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    <label for="password-confirm" id="labels">Konfirmasi Password Baru</label>
                        <input type="password" id="password-confirm" class="form-control"
                            name="password_confirmation" required autofocus>
                        @if ($errors->has('password_confirmation'))
                            <span
                                class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                        <br>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="w-100 btn btn-primary" id="login-form-button">
                        Reset Password
                    </button>
                </div>
            </form>
            {{-- <form action="{{ route('reset.password.post') }}}" method="POST" id="login-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="floatingInputEmail"><i class="bi bi-person-circle"></i> Email Aktif Mahasiswa</label>
                    <input type="text" class="form-control" id="floatingInputEmail" name="email"
                        placeholder="Email Zimbra" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }} </span>
                    @endif
                    <br>
                    <label for="password"><i class="bi bi-person-circle"></i> Password</label>
                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <label for="password-confirm"><i class="bi bi-person-circle"></i> Konfirmasi Password</label>
                    <input type="password" id="password" class="form-control" name="password_confirmation" required autofocus>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif

                </div>
                <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Reset
                    Password</button>
                <br>
                <center>
                    <p class="mt-5 mb-3 text-muted">Pengembangan Sistem Informasi Dilindungi &copy;Institut Teknologi
                        Del 2023</p>
                </center>
            </form> --}}
        </main>
    </div>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #login-form-button {
            background: #367fa9;
            border-color: #367fa9;
            font-size: 14px;
        }

        #footer {
            font-size: 13px;
        }

        #judul {
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
        }

        #labels {
            font-family: Arial, Helvetica, sans-serif;
            font-size: small;
            font-weight: lighter;
        }
    </style>
</body>

</html>




{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/auth/forgot.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
</head>

<body>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reset Password Del Canteen Management System</div>
                        <div class="card-body">

                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email"
                                            required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password"
                                            required autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                        Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password-confirm" class="form-control"
                                            name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span
                                                class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html> --}}
