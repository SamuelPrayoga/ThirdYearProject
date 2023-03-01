<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
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
                <h4>Reset Password</h4>
            </center>
            <form action="{{ route('forget.password.post') }}" method="POST" id="login-form">
                @csrf
                <div class="mb-3">
                    <label for="floatingInputEmail"><i class="bi bi-person-circle"></i> Email Aktif Mahasiswa</label>
                    <input type="text" class="form-control" id="floatingInputEmail" name="email"
                        placeholder="Email Zimbra" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }} </span>
                    @endif
                </div>
                <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Kirim Link Reset
                    Password</button>
                <br>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <center>
                    <p class="mt-5 mb-3 text-muted">Pengembangan Sistem Informasi Dilindungi &copy;Institut Teknologi
                        Del 2023</p>
                </center>
            </form>
        </main>
    </div>
    {{-- <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" id="navbar">Reset Password Del Canteen Management System</div>
                        <div class="card-body">

                          @if (Session::has('message'))
                               <div class="alert alert-success" role="alert">
                                  {{ Session::get('message') }}
                              </div>
                          @endif

                            <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Email Mahasiswa</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main> --}}
</body>

</html>
