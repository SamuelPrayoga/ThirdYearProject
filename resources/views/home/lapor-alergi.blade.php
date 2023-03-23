@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center><p class="font-weight-bold">Form Laporan Mahasiswa Alergi</p></center>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('home.lapor.reports') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Nama Mahasiswa') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required readonly autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="symptoms">{{ __('Symptoms') }}</label>
                                <textarea id="symptoms" class="form-control @error('symptoms') is-invalid @enderror" name="symptoms" required>{{ old('symptoms') }}</textarea>

                                @error('symptoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            tbody{
                font-size: 14px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }
        </style>
        {{-- <div id="w1" class="grid-view">Pengumuman
        </div> --}}
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
    @include('partials.footer')
@endsection
