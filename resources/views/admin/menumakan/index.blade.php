@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('menumakan.create') }}" class="btn btn-sm btn-primary">
                <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                Tambah Menu Makan
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mb-3 table-responsive">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead class="dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Menu Pagi</th>
                    <th>Menu Siang</th>
                    <th>Menu Malam</th>
                    <th>Action</th>
                </tr>
            </thead>
            @if ($menumakan->isEmpty())
                <td colspan="6"><small class="text-muted">Belum ada Menu Makanan Ditambahkan.</small></td>
            @else
                <tbody>
                    @php $i=1 @endphp
                    @foreach ($menumakan as $menumakans)
                        <tr>
                            <td width="2%">{{ $i++ }}.</td>
                            <td width="20%">{{ date('l, d M Y', strtotime($menumakans->tanggal_makan)) }}</td>
                            <td width="20%">{!! $menumakans->menu_pagi !!}
                                <small><a href="" data-toggle="modal" data-target="#foto1_{{ $menumakans->id }}">Lihat Gambar</a></small>
                            </td>
                            <div class="modal fade" id="foto1_{{ $menumakans->id }}" tabindex="-1"
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
                                            @if ($menumakans->foto1)
                                                <img src="{{ asset('public/menu_makanan/' . $menumakans->foto1) }}"
                                                    alt="Foto 1" class="img-fluid">
                                            @else
                                                <p>Tidak ada foto tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td width="20%">{!! $menumakans->menu_siang !!}
                                <small><a href="" data-toggle="modal" data-target="#foto2_{{ $menumakans->id }}">Lihat Gambar</a></small>
                            </td>
                            <div class="modal fade" id="foto2_{{ $menumakans->id }}" tabindex="-1"
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
                                            @if ($menumakans->foto2)
                                                <img src="{{ asset('public/menu_makanan/' . $menumakans->foto2) }}"
                                                    alt="Foto 2" class="img-fluid">
                                            @else
                                                <p>Tidak ada foto tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td width="20%">{!! $menumakans->menu_malam !!}
                                <small><a href="" data-toggle="modal" data-target="#foto3_{{ $menumakans->id }}">Lihat Gambar</a></small>
                            </td>
                            <div class="modal fade" id="foto3_{{ $menumakans->id }}" tabindex="-1"
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
                                            @if ($menumakans->foto3)
                                            {{-- <img src="{{ asset('menu_makanan/' . $menumakans->foto3) }}" alt="Foto 3" class="img-fluid"> --}}
                                                <img src="{{ asset('public/menu_makanan/' . $menumakans->foto3) }}"
                                                    alt="Foto 3" class="img-fluid">
                                            @else
                                                <p>Tidak ada foto tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td><a href="/menumakan/edit/{{ $menumakans->id }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- <a href="/menumakan/edit/{{ $menumakans->id }}" class="badge text-bg-warning"><i
                                        class="bi bi-pencil-square"></i> Edit</a> --}}
                                <a href="" data-toggle="modal" data-target="#myModal{{ $menumakans->id }}"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>                                </a>
                                {{-- <a href="" class="badge text-bg-success"><i class="bi bi-send-exclamation-fill"></i> Ajukan Perubahan</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
    @foreach ($menumakan as $menumakans)
        <div class="modal fade" id="myModal{{ $menumakans->id }}" role="dialog">
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
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="window.location.href='/menumakan/delete/{{ $menumakans->id }}'">Hapus</button>
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
