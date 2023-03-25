@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('holidays.create') }}" class="btn btn-sm btn-primary">
            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
            Tambah Data Hari Libur
        </a>
    </div>
</div> --}}
@endsection

@section('content')
    @include('partials.alerts')
    {{-- Konten --}}
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Asrama</th>
                <th>Jenis Alergi</th>
                <th>Dokumen</th>
                <th>Status</th>
                <th>Aksi</th>
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
                        <td>{{ $report->allergies }}</td>
                        <td><a href="{{ asset('allergy_reports/' . $report->file) }}">{{ $report->file }}</a></td>
                        <td>
                            <span class="badge rounded-pill {{ $report->approved ? 'bg-success' : 'bg-warning' }}">
                                {{ $report->approved ? 'Disetujui' : 'Menunggu' }}
                            </span>
                        </td>

                        {{-- <td>{{ $report->approved ? 'Disetujui' : 'Belum disetujui' }}</td> --}}

                        <td>
                            @if (!$report->approved)
                                <form action="{{ route('admin.approve', $report->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="badge bg-success"><i class="bi bi-check-square-fill"></i>
                                        Setujui</button>
                                </form>
                                <form action="{{ route('admin.reject', $report->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge bg-danger"><i class="bi bi-x-square-fill"></i>
                                        Tolak</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
