@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script type="text/javascript" src="{{asset('js/auth/jquery.js')}}"></script>
@endpush

@section('content')
    <div class="w-100">

        <main class="form-signin w-100 m-auto">
            <form method="POST" action="{{ route('auth.login') }}" id="login-form">
                <center><img src="{{ asset('img/logo.png') }}" class="logo" alt="" width="100px"></center>
                <center>
                        <h3 class="h3 mb-3 fw-normal" id="judul">Kantin Institut Teknologi Del</h3>
                    </center>

                <div class="mb-3">
                    <label for="floatingInputEmail" id="labels">Email Zimbra</label>
                    <input type="email" class="form-control" id="floatingInputEmail" name="email" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }} </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="floatingPassword" id="labels">Password</label>
                    <input type="password" class="form-control" id="floatingPassword" name="password"
                        required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('password') }} </span>
                    @endif
                </div>

                <div class="mb-3">
                    <input type="checkbox" class="form-checkbox" id="lupapassword"><small>  Tampilkan Password</small>
                </div>

                <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
                <br> <br>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <a href="/forget-passwords" id="lupapassword">Lupa atau Reset Password ?</a>
                <center>
                    <p class="mt-5 mb-3 text-muted" id="lupapassword">Pengembangan Sistem Informasi Dilindungi &copy;Institut Teknologi Del
                        2023</p>
                </center>
            </form>
        </main>
    </div>
    <style>
        #login-form-button{
            background: #367fa9;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.form-checkbox').click(function(){
                if($(this).is(':checked')){
                    $('#floatingPassword').attr('type','text');
                }else{
                    $('#floatingPassword').attr('type','password');
                }
            });
        });
    </script>
@endsection
@include('partials.alerts')
@push('script')
    <script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-param" content="_csrf">
    <link rel="stylesheet" href="{{asset('css/auth/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/nprogress.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/blue.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
</head>

<body class="hold-transition login-page" style="background: white;">
    <div class="login-box">
        <div class="login-box-body" style="border: 2px solid #eee">
            <p class="login-box-msg"><img src="{{asset('img/logo.png')}}" width="70px"><br>Kantin Institut Teknologi Del
            </p>

            <form id="login-form" action="{{ route('auth.login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <div class="form-group field-loginform-username required">
                        <label class="control-label" for="loginform-username">Email Zimbra</label>
                        <input type="email" class="form-control" id="loginform-username" name="email"
                        placeholder="" aria-required="true">

                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-loginform-password required">
                        <label class="control-label" for="loginform-password">Password</label>
                        <input type="password" id="loginform-password" class="form-control" name="password"
                            aria-required="true">

                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <div class="form-group field-loginform-rememberme">
                                    <a href="/forget-passwords">Reset Password ?</a>
                                    <div class="help-block"></div>
                                </div>
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <script src="{{asset('js/auth/jquery.js')}}"></script>
    <script src="{{asset('js/auth/yii.js')}}"></script>
    <script src="{{asset('js/auth/bootstrap.js')}}"></script>
    <script src="{{asset('js/auth/jquery.pjax.js')}}"></script>
    <script src="{{asset('js/auth/yii.validation.js')}}"></script>
    <script src="{{asset('js/auth/yii.activeForm.js')}}"></script>
    <script src="{{asset('js/auth/icheck.min.js')}}"></script>
    <script src="{{asset('js/auth/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/auth/fastclick.min.js')}}"></script>
    <script src="{{asset('js/auth/nprogress.js')}}"></script>
    <script src="{{asset('js/auth/bootbox.min.js')}}"></script>
    <script src="{{asset('js/auth/app.js')}}"></script>
    <script src="{{asset('js/auth/v2.js')}}"></script>
    <script>
        jQuery(function($) {
            jQuery('#login-form').yiiActiveForm([{
                "id": "loginform-username",
                "name": "username",
                "container": ".field-loginform-username",
                "input": "#loginform-username",
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {
                        "message": "Username cannot be blank."
                    });
                }
            }, {
                "id": "loginform-password",
                "name": "password",
                "container": ".field-loginform-password",
                "input": "#loginform-password",
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {
                        "message": "Password cannot be blank."
                    });
                }
            }, {
                "id": "loginform-rememberme",
                "name": "rememberMe",
                "container": ".field-loginform-rememberme",
                "input": "#loginform-rememberme",
                "validate": function(attribute, value, messages, deferred, $form) {
                    yii.validation.boolean(value, messages, {
                        "trueValue": "1",
                        "falseValue": "0",
                        "message": "Remember Me must be either \"1\" or \"0\".",
                        "skipOnEmpty": 1
                    });
                }
            }], []);
        });
    </script>
    @include('partials.alerts')
    @push('script')
        <script type="module" src="{{ asset('js/auth/login.js') }}"></script>
    @endpush
</body>

</html> --}}


