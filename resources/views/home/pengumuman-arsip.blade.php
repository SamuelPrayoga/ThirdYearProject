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
                        <table class="table table-bordered" id="exa">
                            <thead>
                                <tr>
                                    <th><small>#</small></th>
                                    <th style="width: 50%"><small>Judul Pengumuman</small></th>
                                    <th style="width: 25%"><small>Tanggal Berakhir</small></th>
                                    {{-- <th style="width: 15%"><small>Waktu</small></th> --}}
                                    <th style="width: 16.66%"><small>Tanggal Pembuatan</small></th>
                                    <th style="width:  8.33%" class="action-column"><small>&nbsp;Action</small></th>
                                </tr>
                            </thead>
                            @if ($pengumumanArsip->isEmpty())
                                <td colspan="6">Tidak ada pengumuman yang Diarsipkan</td>
                            @else
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($pengumumanArsip as $p)
                                        <tr>
                                            <td>{{ $i++ }}.</td>
                                            <td>
                                                <p
                                                    class="text-muted">
                                                    {{ $p->kategori }}: {{ $p->item_name }}
                                                </p>
                                            </td>

                                            {{-- <td><a>{{ $p->kategori }}: {{ $p->item_name }} </a></td> --}}
                                            <td>{{ $p->expiry_date }}</td>
                                            {{-- <td>{{ $p->time }} WIB</td> --}}
                                            <td>{{ $p->created_at }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal{{ $p->id }}">
                                                    <i class="bi bi-eye-fill"></i> <small>Selengkapnya</small>
                                                </button>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                <p
                                                                    class="{{ $p->kategori == 'Keasramaan' ? 'text-primary' : ($p->kategori == 'Kehilangan Barang' ? 'text-danger' : 'text-success') }}">
                                                                    {{ $p->kategori }}
                                                                </p>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Seorang Mahasiswa telah {{ $p->kategori }}
                                                                {{ $p->item_name }}
                                                                dengan ciri ciri {{ $p->description }}.</p>
                                                            <p>Pada pukul {{ $p->time }} di {{ $p->place }}, pada
                                                                tanggal {{ $p->date }}</p>
                                                            <img src="{{ url('img/Barang/' . $p->file) }}" width="100%"
                                                                height="100%" alt="">
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
                        <small class="text-muted">Pengumuman yang diarsipkan adalah pengumuman yang sudah melewati expired date</small>
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
