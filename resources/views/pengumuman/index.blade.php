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
    <div class="card mb-3">
        @include('partials.alerts')
        {{-- Konten --}}


        <table class="table table-bordered table-hover" id="examples">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Tanggal Dibuat</th>
                    <th>Deskripsi</th>
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
                            <td>{{ $i++ }}</td>
                            {{-- <td>{{ $announce->tanggal_berakhir }}</td> --}}
                            <td>{!! $announce->tanggal_pembuatan !!}</td>
                            <td>{!! $announce->deskripsi !!}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pengumuman.edit', $announce->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a> &nbsp;
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $announce->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>

                                    &nbsp
                                    <form action="{{ route('pengumuman.publish', $announce->id) }}" method="POST">
                                        @csrf
                                        @if ($announce->published != 1)
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fa fa-upload"></i> Publish
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
        @if(isset($announce))
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
    @powerGridScripts
@endpush
