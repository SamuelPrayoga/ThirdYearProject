@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('content')
    <div class="float-end mt-2">
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

    </div>
    <br>
    <br>
    <div class="card mb-3 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="exampls">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Asrama</th>
                    <th>Makan Pada</th>
                    <th>Waktu Makan</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            @if ($laporan_makanan->isEmpty())
                <td colspan="8"><small class="text-muted">Tidak Laporan Makan Jumat-Sabtu Mahasiswa.</small></td>
            @else
                <tbody>
                    @php $i=1 @endphp
                    @foreach ($laporan_makanan as $reports)
                        <tr>
                            <td>{{ $i++ }}</td>
                            {{-- <td></td> --}}
                            <td>{{ $reports->user->nim }}</td>
                            <td>{{ $reports->user->name }}</td>
                            <td>{{ $reports->user->prodi }}</td>
                            <td>{{ $reports->user->angkatan }}</td>
                            <td>{{ $reports->user->asrama }}</td>
                            <td>{{ strftime('%A, %e %B %Y', strtotime($reports->tanggal)) }}</td>
                            {{-- <td>{{ date('l, j F Y', strtotime($reports->tanggal)) }}</td> --}}
                            {{-- <td>{{$reports->tanggal}}</td> --}}
                            <td>
                                @foreach (json_decode($reports->waktu_makan) as $waktu)
                                    @if ($waktu == 'Pagi')
                                        <span class="badge badge-success">{{ $waktu }}</span>
                                    @elseif ($waktu == 'Siang')
                                        <span class="badge badge-warning">{{ $waktu }}</span>
                                    @elseif ($waktu == 'Malam')
                                        <span class="badge badge-primary">{{ $waktu }}</span>
                                    @else
                                        {{ $waktu }}
                                    @endif

                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            {{-- <td><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td> --}}
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
