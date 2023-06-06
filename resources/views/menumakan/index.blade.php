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
                                        <th scope="row">Tanggal</th>
                                        <th>
                                            <center>Pagi</center>
                                        </th>
                                        <th>
                                            <center>Siang</center>
                                        </th>
                                        <th>
                                            <center>Malam</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($menumakan->isEmpty())
                                        <td colspan="5" class="table-inactive"><small>Belum ada Menu Makanan
                                                ditambahkan</small></td>
                                    @else
                                        @foreach ($menumakan as $menu)
                                            <tr>
                                                <td width="20%">{{ date('d M Y', strtotime($menu->tanggal_makan)) }}</td>
                                                <td width="20%">
                                                    <center>{!! $menu->menu_pagi !!}<small><a href=""
                                                                data-toggle="modal"
                                                                data-target="#foto1_{{ $menu->id }}">Lihat
                                                                Gambar</a></small></center>
                                                </td>
                                                <div class="modal fade" id="foto1_{{ $menu->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Foto Menu Makanan
                                                                    Pagi</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($menu->foto1)
                                                                    <img src="{{ asset('public/menu_makanan/' . $menu->foto1) }}"
                                                                        alt="Foto 1" class="img-fluid">
                                                                @else
                                                                    <p>Tidak ada foto tersedia</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td width="20%">
                                                    <center>{!! $menu->menu_siang !!}<small><a href=""
                                                                data-toggle="modal"
                                                                data-target="#foto2_{{ $menu->id }}">Lihat
                                                                Gambar</a></small></center>
                                                </td>
                                                <div class="modal fade" id="foto2_{{ $menu->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Foto Menu Makanan
                                                                    Siang</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($menu->foto2)
                                                                    <img src="{{ asset('public/menu_makanan/' . $menu->foto2) }}"
                                                                        alt="Foto 2" class="img-fluid">
                                                                @else
                                                                    <p>Tidak ada foto tersedia</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td width="20%">
                                                    <center>{!! $menu->menu_malam !!}<small><a href=""
                                                                data-toggle="modal"
                                                                data-target="#foto3_{{ $menu->id }}">Lihat
                                                                Gambar</a></small></center>
                                                </td>
                                                <div class="modal fade" id="foto3_{{ $menu->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">Foto Menu Makanan
                                                                    Malam</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($menu->foto3)
                                                                    <img src="{{ asset('public/menu_makanan/' . $menu->foto3) }}"
                                                                        alt="Foto 3" class="img-fluid">
                                                                @else
                                                                    <p>Tidak ada foto tersedia</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <!-- Modal -->
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
