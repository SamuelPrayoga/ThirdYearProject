@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
@endsection

@section('content')
    @include('partials.alerts')
    {{-- disin --}}
    <form action="{{Route('menumakan.updatemenus', $editmenus->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Tanggal:</label>
            <input type="date" name="tanggal_makan" class="form-control" value="{{$editmenus->tanggal_makan}}" required>
        </div>

        <div class="form-group">
            <label for="">Menu Makan Pagi:</label>
            <textarea class="ckeditor form-control" name="menu_pagi" id="task-textarea" cols="10" rows="10" required>{{$editmenus->menu_pagi}}</textarea>
            <div class="custom-file">
                <input type="file" name="foto1" class="custom-file-input" onchange="updateFileName(this)">
                <label class="custom-file-label" id="foto1FileName">{{$editmenus->foto1}}</label>
                <small id="emailHelp" class="form-text text-muted">4 x 6 <span class="text-danger">(rekomendasi)</span></small>
            </div>
        </div>

        <div class="form-group">
            <label for="">Menu Makan Siang:</label>
            <textarea class="ckeditor form-control" name="menu_siang" id="task-textarea2" cols="30" rows="10" required>{{$editmenus->menu_siang}}</textarea>
            <div class="custom-file">
                <input type="file" name="foto2" class="custom-file-input" onchange="updateFileName(this)">
                <label class="custom-file-label" id="foto2FileName">{{$editmenus->foto2}}</label>
                <small id="emailHelp" class="form-text text-muted">4 x 6 <span class="text-danger">(rekomendasi)</span></small>
            </div>
        </div>

        <div class="form-group">
            <label for="">Menu Makan Malam:</label>
            <textarea class="ckeditor form-control" name="menu_malam" id="task-textarea3" cols="30" rows="10" required>{{$editmenus->menu_malam}}</textarea>
            <div class="custom-file">
                <input type="file" name="foto3" class="custom-file-input" onchange="updateFileName(this)">
                <label class="custom-file-label" id="foto3FileName">{{$editmenus->foto3}}</label>
                <small id="emailHelp" class="form-text text-muted">4 x 6 <span class="text-danger">(rekomendasi)</span></small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
    </form>

    <script>
        function updateFileName(input) {
            var spanId = input.getAttribute('name') + 'FileName';
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerText = fileName;
        }
    </script>

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
