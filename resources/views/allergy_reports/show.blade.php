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
                    <th width="20%">Jenis Alergi</th>
                    @if ($reports->where('approved', 2)->count() > 0)
                        <th>Alasan Penolakan</th>
                    @endif


                    @if (auth()->user()->isKeasramaan())
                        <th>Dokumen</th>
                    @endif
                    <th>Status</th>
                    @if (auth()->user()->isKeasramaan())
                        <th><center>Aksi</center></th>
                    @endif
                </tr>
            </thead>
            @if ($reports->isEmpty())
                <td colspan="9"><small class="text-muted">Tidak ada Laporan Alergi oleh Mahasiswa.</small></td>
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
                                    {{ $allergy }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            {{-- <td>
                                @foreach (json_decode($report->allergies) as $allergy)
                                    {{ $allergy }},
                                @endforeach
                            </td> --}}
                            @if ($reports->where('approved', 2)->count() > 0)
                                <td>{{ $report->alasan_penolakan }}</td>
                            @endif

                            {{-- <td>{{ $report->allergies }}</td> --}}
                            @if (auth()->user()->isKeasramaan())
                                <td><a href="{{ asset('allergy_reports/' . $report->file) }}">{{ $report->file }}</a></td>
                            @endif
                            {{-- <td>
                                <span class="badge rounded-pill {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                    {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                                </span>
                            </td> --}}
                            <td>
                                <span
                                    class="badge rounded-pill {{ $report->approved == 1 ? 'bg-success' : ($report->approved == 2 ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $report->approved == 1 ? 'Disetujui' : ($report->approved == 2 ? 'Ditolak' : 'Menunggu') }}
                                </span>
                            </td>


                            {{-- <td>{{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}</td> --}}
                            @if (auth()->user()->isKeasramaan())
                                <td>
                                    @if (!$report->approved)
                                        <form action="{{ route('admin.approve', $report->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                        <!-- Tambahkan tombol yang akan memicu modal -->
                                        <button type="button" class="button btn-danger btn-sm" data-toggle="modal"
                                            data-target="#rejectModal">
                                            <i class="fas fa-times-circle"></i>
                                        </button>

                                        <!-- Tambahkan modal -->
                                        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog"
                                            aria-labelledby="rejectModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form untuk memasukkan alasan penolakan -->
                                                        <form action="{{ route('admin.reject', $report->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="reason">Alasan:</label>
                                                                <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" required></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- <form action="{{ route('admin.destroy', $report->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button btn-danger btn-sm"><i
                                                class="fas fa-trash-alt"></i>
                                        </button>
                                    </form> --}}

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
