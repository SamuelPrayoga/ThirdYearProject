@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush


@section('content')
    <div class="card mb-3 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="examples">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Asrama</th>
                    <th>Jenis Alergi</th>
                    <th>Laporan</th>
                    @if (auth()->user()->isKeasramaan())
                        <th>Dokumen</th>
                    @endif
                    <th>Status</th>
                    @if (auth()->user()->isKeasramaan())
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            @if ($reports->isEmpty())
                <td colspan="8"><small class="text-muted">Tidak ada Laporan Alergi oleh Mahasiswa.</small></td>
            @else
                <tbody>
                    @php $i=1 @endphp
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->user->nim }}</td>
                            <td>{{ $report->user->asrama }}</td>
                            <td>
                                @foreach (json_decode($report->allergies) as $allergy)
                                    {{ $allergy }},
                                @endforeach
                            </td>
                            <td>{{ $report->created_at->diffForHumans() }}</td>

                            {{-- <td>{{ $report->allergies }}</td> --}}
                            @if (auth()->user()->isKeasramaan())
                                <td><a href="{{ asset('allergy_reports/' . $report->file) }}">{{ $report->file }}</a></td>
                            @endif
                            <td>
                                <span class="badge rounded-pill {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                    {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                </span>
                            </td>

                            {{-- <td>{{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}</td> --}}
                            @if (auth()->user()->isKeasramaan())
                                <td>
                                    @if (!$report->approved)
                                        <form action="{{ route('admin.approve', $report->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="badge bg-success"><i
                                                    class="fas fa-check-square"></i>
                                                Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.reject', $report->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger"><i
                                                    class="bi bi-x-square-fill"></i>
                                                Tolak</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.destroy', $report->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger"><i class="fas fa-trash"></i>
                                            Hapus Data</button>
                                    </form>
                                </td>
                            @endif

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
