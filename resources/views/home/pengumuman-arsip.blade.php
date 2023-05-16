@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>
                            <p class="font-weight-bold">Pengumuman Diarsipkan</p>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 table-responsive">
                            <table class="table table-bordered" id="exa">
                                <thead>
                                    <tr>
                                        <th><small>#</small></th>
                                        <th style="width: 20%"><small>Kategori</small></th>
                                        <th style="width: 37%"><small>Nama Pelapor</small></th>
                                        <th style="width: 25%"><small>Tanggal Berakhir</small></th>
                                        <th style="width: 16.66%"><small>Tanggal Pembuatan</small></th>
                                        <th style="width:  8.33%" class="action-column"><small>&nbsp;</small></th>
                                    </tr>
                                </thead>
                                @if ($pengumumanArsip->isEmpty())
                                    <td colspan="6" class="text-muted">Tidak ada pengumuman yang ditampilkan</td>
                                @else
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach ($pengumumanArsip as $p)
                                            <tr>
                                                <td>{{ $i++ }}.</td>
                                                <td>{{ strtoupper($p->kategori) }} </td>
                                                <td>{{ strtoupper($p->name) }}</td>
                                                <td>{{ $p->expiry_date }}</td>
                                                <td>{{ $p->created_at }}</td>
                                                <td><a href="#" class="" data-toggle="modal"
                                                        data-target="#exampleModal{{ $p->id }}">Selengkapnya
                                                    </a>

                                                </td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    <p>{{ $p->kategori }}</p>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{!! $p->description !!}</p>
                                                                <p><strong>Foto atau Ilustrasi: </strong></p>
                                                                <img src="{{ url('img/Barang/' . $p->file) }}"
                                                                    width="100%" height="100%" alt="">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <small class="text-muted">Pengumuman yang diarsipkan adalah pengumuman yang sudah melewati expired
                            date</small>
                        <br>
                        <a href="{{ route('home.pengumuman') }}" class="btn btn-secondary btn-sm"><i
                                class="fas fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    {{ $pengumumanArsip->links() }}
                </div>
            </div>
        </div>
        <style>
            tbody {
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
