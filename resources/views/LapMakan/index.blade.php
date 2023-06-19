@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush
@section('buttons')
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="" class="btn btn-sm btn-light">
                <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
                Kembali
            </a>
        </div>
    </div> --}}
@endsection

@section('content')
    {{-- <div class="float-end mt-2">
        <form id="hapus-semua-form" action="{{ route('admin.lap.hapussemua') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Anda yakin ingin menghapus semua data laporan?');">
                <i class="fas fa-sync"></i>
                Reset Laporan
            </button>
        </form>
        &nbsp;
    </div> --}}
    {{-- <div class="row">
        <div class="col-md-6 offset-md-6">
            <form action="#" method="get">
                <div class="mb-3">
                    <label for="filterDate" class="form-label fw-bold">Tampilkan Berdasarkan Tanggal</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="filterDate" name="display-by-date"
                            value="{{ request('display-by-date') }}">
                        <button class="btn btn-primary" type="submit" id="button-addon1">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="card mb-3 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="examples">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Asrama</th>
                    <th>Tanggal Berangkat</th>
                    <th>Waktu Berangkat</th>
                    <th>Tanggal Kembali</th>
                    <th>Waktu Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @if ($laporan_makanan->isEmpty())
                <td colspan="8"><small class="text-muted">Tidak Ada Laporan Izin Mahasiswa.</small></td>
            @else
                <tbody>
                    @php $i=1 @endphp
                    @foreach ($laporan_makanan as $reports)
                        <tr>
                            <td>{{ $i++ }}</td>
                            {{-- <td></td> --}}
                            <td>{{ $reports->user->nim }}</td>
                            <td>{{ $reports->user->name }}</td>
                            <td>
                                @if ($reports->is_makan == 0)
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif ($reports->is_makan == 1)
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif ($reports->is_makan == 2)
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $reports->user->asrama }}</td>
                            <td>{{ $reports->tanggal_berangkat }}</td>
                            <td>{{ $reports->jam_berangkat }}</td>
                            <td>{{ $reports->tanggal_kembali }}</td>
                            <td>{{ $reports->jam_kembali }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" type="button" id="toolsDropdown" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs"></i> Tools
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="toolsDropdown">
                                        @if ($reports->is_makan == 1)
                                            <form class="d-inline-block"
                                                action="{{ route('IB.decline', ['reports' => $reports->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <!-- Ubah metode menjadi POST -->
                                                <button type="submit" class="btn btn-sm dropdown-item">
                                                    <i class="fas fa-times-circle"></i> Decline
                                                </button>
                                            </form>
                                        @else
                                            <form class="d-inline-block"
                                                action="{{ route('IB.approve', ['reports' => $reports->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <!-- Ubah metode menjadi POST -->
                                                <button type="submit" class="btn btn-sm dropdown-item">
                                                    <i class="fas fa-check-circle"></i> Approve
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#examples').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'excel', 'csv', 'print'
                ]
            });
        });
    </script>
@endpush
