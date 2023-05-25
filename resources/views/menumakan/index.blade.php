@extends('layouts.home')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        {{-- <center><img src="{{ asset('img/logo.png') }}" width="65px" alt="" srcset=""></center> --}}
                        <center>DAFTAR MENU MAKANAN CIVITAS INSTITUT TEKNOLOGI DEL</center>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($menumakan->isEmpty())
                                        <td colspan="5" class="table-inactive"><small>Belum ada Menu Makanan
                                                ditambahkan</small></td>
                                    @else
                                        @foreach ($menumakan as $menu)
                                            <tr>
                                                <td width="10%">{{ date('d M Y', strtotime($menu->tanggal_makan)) }}</td>
                                                <td width="80%">
                                                    {!! $menu->menu !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    {{-- @foreach ($menumakan as $menu)
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <p>Foto Menu Pagi ini</p>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{!! $menu->menu_pagi !!}</p>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Gambar Menu Makanan</strong></p>
                                                    <img src="{{asset('avatarDefault/avatarDefault.png')}}" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
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
