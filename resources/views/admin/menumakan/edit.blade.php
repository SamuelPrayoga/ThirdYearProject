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
<label for="" id="">Tanggal:</label>
<input type="date" name="tanggal_makan" class="form-control" value="{{$editmenus->tanggal_makan}}" required>

<label for="" id="">Menu Makan Pagi:</label>
<textarea class="ckeditor form-control" name="menu_pagi" id="task-textarea" cols="10" rows="10" required>{{$editmenus->menu_pagi}}</textarea>

<label for="" id="">Menu Makan Siang:</label>
<textarea class="ckeditor form-control" name="menu_siang" id="task-textarea2" cols="30" rows="10" required>{{$editmenus->menu_siang}}</textarea>

<label for="" id="">Menu Makan Malam:</label>
<textarea class="ckeditor form-control" name="menu_malam" id="task-textarea3" cols="30" rows="10" required  >{{$editmenus->menu_malam}}</textarea>
<br>
<button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-clipboard2-plus-fill"></i> Simpan</button>
</form>
@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#task-textarea' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#task-textarea2' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#task-textarea3' ) )
        .catch( error => {
            console.error( error );
        } );
</script>



@powerGridScripts
@endpush
