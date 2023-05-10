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
        <tbody>
            @php $i=1 @endphp
            @foreach ($menumakan as $menumakans)
                <tr>
                    <td width="2%">{{ $i++ }}.</td>
                    <td width="20%">{{ date('l, d M Y', strtotime($menumakans->tanggal_makan)) }}</td>
                    <td width="20%">{!! $menumakans->menu_pagi !!}</td>
                    <td width="20%">{!! $menumakans->menu_siang !!}</td>
                    <td width="20%">{!! $menumakans->menu_malam !!}</td>
                    <td>
                        <a href="/menumakan/edit/{{ $menumakans->id }}" class="badge text-bg-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a href="" data-toggle="modal" data-target="#myModal{{ $menumakans->id }}" class="badge text-bg-danger"><i class="bi bi-trash-fill"></i> Hapus</a>
                        {{-- <a href="" class="badge text-bg-success"><i class="bi bi-send-exclamation-fill"></i> Ajukan Perubahan</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    @foreach ($menumakan as $menumakans)
        <div class="modal fade" id="myModal{{ $menumakans->id }}" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i>  Hapus Data</h4>
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
