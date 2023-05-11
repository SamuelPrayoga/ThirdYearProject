@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Formulir Laporan Kehilangan atau Temuan Barang</center>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('home.laporan-barang-form') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="ulasan">Kategori Laporan:</label>
                                    <select class="form-control" id="laporan" required="required" name="kategori"
                                        aria-label="Default select example">
                                        <option disabled selected value>-- Pilih Laporan --</option>
                                        <option value="Kehilangan Barang">Kehilangan Barang</option>
                                        <option value="Menemukan Barang">Temuan Barang</option>
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="username" name="name"
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim"
                                        value="{{ Auth::user()->nim }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan"
                                        value="{{ Auth::user()->angkatan }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="prodi" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" id="prodi"
                                        value="{{ Auth::user()->prodi }}" readonly>
                                </div>
                                <input type=hidden name=UserID value={{ auth()->user()->id }}>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="ckeditor" name="description" id="editor">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Letakkan library CKEditor di sini, sebelum script CKEditor -->
                                <script src="path/to/ckeditor.js"></script>
                                <!-- Script CKEditor -->
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#editor'))
                                        .then(editor => {
                                            console.log(editor);
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Gambar/Contoh Gambar</label>
                                    <input type="file" class="form-control" name="file" id="input-three"
                                        placeholder="" required>
                                </div>

                                <!-- Script CKEditor -->
                                <div class="float-end mt-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <script src="path/to/ckeditor.js"></script> --}}
            </div>
        </div>
    </div>
    <style>
        .table-inactive {
            background: #878787;
            color: #858585;
        }
    </style>
    @include('partials.footer')
@endsection
@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    @powerGridScripts
@endpush
