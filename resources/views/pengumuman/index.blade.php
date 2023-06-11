@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush


@section('content')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('pengumuman.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah
                Pengumuman</a>
        </div>
    </div>
    <br>
    <div class="btn-toolbar mb-2 mb-md-0">
        Catatan:
        <div>
            <ul>
                <li>Pada Tombol <span class="badge badge-success"><i class="fas fa-check-circle"></i></span> digunakan untuk menampilkan pengumuman ke halaman mahasiswa</li>
                <li>Pada Tombol <span class="badge badge-warning"><i class="fas fa-ban"></i></span> digunakan untuk menyembunyikan pengumuman dari halaman mahasiswa</li>
            </ul>
        </div>
    </div>
    <br>
    <div class="card mb-3">
        {{-- @include('partials.alerts') --}}
        {{-- Konten --}}

        <div class="card mb-3 table-responsive">
            <table class="table table-bordered table-hover" id="examples">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Berakhir</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @if ($pengumuman->isEmpty())
                    <td colspan="5"><small class="text-muted">Tidak ada Pengumuman.</small></td>
                @else
                    <tbody>
                        @php $i=1 @endphp
                        @foreach ($pengumuman as $announce)
                            <tr>
                                <td width="3%">{{ $i++ }}</td>
                                {{-- <td>{{ $announce->tanggal_berakhir }}</td> --}}
                                <td width="10%">{{ date('d F Y', strtotime($announce->tanggal_pembuatan)) }}</td>
                                <td width="10%">{{ date('d F Y', strtotime($announce->tanggal_berakhir)) }}</td>
                                <td width="45%">{!! $announce->deskripsi !!}</td>
                                <center>
                                    <td width="8%">
                                        @if ($announce->published == 0)
                                            <span class="badge badge-danger"><i class="fas fa-ban"></i> Non-Aktif</span>
                                        @elseif($announce->published == 1)
                                            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>
                                        @endif
                                    </td>
                                </center>
                                <td width="18%">
                                    @if ($announce->published == 1)
                                        <form class="d-inline-block"
                                            action="{{ route('pengumuman.not-published', ['id' => $announce->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="published" value="0">
                                            <!-- Tambahkan input hidden untuk mengubah nilai 'published' -->
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form class="d-inline-block"
                                            action="{{ route('pengumuman.published', ['id' => $announce->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="published" value="1">
                                            <!-- Tambahkan input hidden untuk mengubah nilai 'published' -->
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <div class="btn-group" role="group">
                                        <a href="{{ route('pengumuman.edit', $announce->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a> &nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $announce->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        &nbsp
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
        @if (isset($announce))
            <div class="modal fade" id="deleteModal{{ $announce->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $announce->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $announce->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus pengumuman ini?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('pengumuman.destroy', $announce->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ]
            });
        });
    </script>
    @include('sweetalert::alert')

    @powerGridScripts
@endpush
