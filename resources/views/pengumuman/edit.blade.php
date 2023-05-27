@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
@endsection

@section('content')
    @include('partials.alerts')
    {{-- disin --}}

    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="ckeditor form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="editor"
                rows="5">{{ old('deskripsi', $pengumuman->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Letakkan library CKEditor di sini, sebelum script CKEditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>

        <!-- Script CKEditor -->
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'fontSize',
                            'fontFamily',
                            'highlight',
                            'undo',
                            'redo'
                        ]
                    },
                    language: 'en'
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
    </form>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    @powerGridScripts
@endpush
