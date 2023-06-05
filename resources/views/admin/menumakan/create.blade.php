@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
@endsection

@section('content')
    @include('partials.alerts')
    {{-- disin --}}

    <form action="{{ Route('menumakan.createmenus') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="" id="">Tanggal:</label>
            <input type="date" name="tanggal_makan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="menu_pagi">Menu Pagi</label>
            <textarea name="menu_pagi" id="task-textarea" cols="30" rows="10"></textarea>
            <input type="file" name="foto1" class="form">
            <small id="emailHelp" class="form-text text-muted">Tambahkan Foto Menu Makanan</small>
        </div>
        <div class="form-group">
            <label for="menu_siang">Menu Siang</label>
            <textarea name="menu_siang" id="task-textarea2" cols="30" rows="10"></textarea>
            <input type="file" name="foto2" class="form">
            <small id="emailHelp" class="form-text text-muted">Tambahkan Foto Menu Makanan</small>
        </div>
        <div class="form-group">
            <label for="menu_malam">Menu Malam</label>
            <textarea name="menu_malam" id="task-textarea3" cols="30" rows="10"></textarea>
            <input type="file" name="foto3" class="form">
            <small id="emailHelp" class="form-text text-muted">Tambahkan Foto Menu Makanan</small>
        </div>
        {{-- <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> --}}
        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-clipboard2-plus-fill"></i> Tambah</button>
    </form>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#task-textarea'), {
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
                        'fontColor',
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
    <script>
        ClassicEditor
            .create(document.querySelector('#task-textarea2'), {
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
                        'fontColor',
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
    <script>
        ClassicEditor
            .create(document.querySelector('#task-textarea3'), {
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
                        'fontColor',
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

    @powerGridScripts
@endpush
