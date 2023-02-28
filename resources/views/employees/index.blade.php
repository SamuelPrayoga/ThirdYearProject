@extends('layouts.app')

@push('style')
@powerGridStyles
@endpush

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">
            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
            Tambah Data Mahasiswa
        </a>
    </div>
&nbsp;
    <div>
        <a href="#" class="btn btn-sm btn-success">
            <i class="bi bi-upload"></i> <span class="align-text-bottom me-1"></span>
            Import Data Mahasiswa
        </a>
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
