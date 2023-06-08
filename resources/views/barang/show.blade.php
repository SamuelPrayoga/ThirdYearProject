@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('content')
    <div class="card mb-3 table-responsive">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead class="dark">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>
                        <center>Status</center>
                    </th>
                    <th>Tanggal Berakhir</th>
                    <th>Selengkapnya</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($reports as $barang)
                    <tr>
                        <td width="2%">{{ $i++ }}.</td>
                        <td width="20%">{{ $barang->kategori }}</td>
                        <td width="25%">{{ $barang->name }} </td>
                        <center>
                            <td width="8%">
                                @if ($barang->showed == 0)
                                    <span class="badge badge-danger"><i class="fas fa-ban"></i> Tidak Ditampilkan</span>
                                @elseif($barang->showed == 1)
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Ditampilkan</span>
                                @endif
                            </td>
                        </center>

                        <td width="15%">{{ $barang->expiry_date }}</td>
                        <div class="modal fade" id="foto2_{{ $barang->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Informasi Selengkapnya</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{!! $barang->description !!}</p>
                                        <img src="{{ url('img/Barang/' . $barang->file) }}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td width="10%">
                            <small><a href="" data-toggle="modal" data-target="#foto2_{{ $barang->id }}">Lihat
                                    Gambar</a></small>
                        </td>
                        <td>
                            @if ($barang->showed == 1)
                                <form class="d-inline-block"
                                    action="{{ route('barang.not-showed', ['id' => $barang->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                            @else
                                <form class="d-inline-block"
                                    action="{{ route('barang.update-showed', ['id' => $barang->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                            @endif

                            <a href="" data-toggle="modal" data-target="#myModal{{ $barang->id }}"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @foreach ($reports as $barang)
        <div class="modal fade" id="myModal{{ $barang->id }}" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i> Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapusnya?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        {{-- <button type="button" class="btn btn-danger btn-sm"
                            onclick="window.location.href='/laporanbarang/delete/{{ $barang->id }}'">Hapus</button> --}}
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
