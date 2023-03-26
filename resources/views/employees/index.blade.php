@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('pengguna.create') }}" class="btn btn-sm btn-primary">
                <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                Tambah Data Pengguna
            </a>
        </div>
        &nbsp;
        <div>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalImport">
                <i class="bi bi-download"></i> Import Data Pengguna
            </button>
        </div>
        &nbsp;
        <div>
            <a href="{{ asset('file/template.xlsx') }}" class="btn btn-secondary btn-sm" hr>
                <i class="bi bi-file-earmark"></i> Download Template Data
            </a>
        </div>
        {{-- &nbsp;
        <div>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalReset">
                <i class="bi bi-arrow-clockwise"></i> Reset Data Mahasiswa
            </button>
        </div> --}}
    </div>


    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('importuser') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Import</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    {{-- Modal Reset Mahasiswa --}}
    <div class="modal fade" id="exampleModalReset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.hapusMahasiswa') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p id="modalss">Apakah Anda yakin melakukan reset data Mahasiswa? Ini akan menyebabkan data dan laporan lainnya akan terhapus.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger btn-sm">Reset</button>
                    </div>
            </div>
            </form>
            <style>
                #modalss{
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 14px;
                    color: gray;
                }
            </style>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alerts')
    <livewire:employee-table />
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
@endpush
