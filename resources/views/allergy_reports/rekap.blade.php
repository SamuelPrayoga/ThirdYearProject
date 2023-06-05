@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('content')
    <div class="card mb-3">
        @include('partials.alerts')
        {{-- Konten --}}
        <div class="card mb-3 table-responsive">
            <table id="example" class="table table-bordered">
                <colgroup>
                    <col style="width: 65%;">
                    <col style="width: 1%;">
                    <col style="width: 5%;">
                    <col style="width: 15%;">
                    <col style="width: 8%;">
                </colgroup>
                <thead class="thead-dark">
                    <tr>
                        <th>Jenis Alergi</th>
                        <th></th>
                        <th>Total</th>
                        <th>Prakiraan Jumlah yang akan dimasak</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Alergi Ikan Laut</td>
                        <td>:</td>
                        <td>{{ $countAllergiesLaut }}</td>
                        <td>{{ $jumlahIkanLaut }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Telur</td>
                        <td>:</td>
                        <td>{{ $countAllergiesTelur }}</td>
                        <td>{{ $jumlahTelur }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Ikan Lele</td>
                        <td>:</td>
                        <td>{{ $countAllergiesLele }}</td>
                        <td>{{ $jumlahLele }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Seafood</td>
                        <td>:</td>
                        <td>{{ $countAllergiesSeafood }}</td>
                        <td>{{ $jumlahSeafood }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Makanan Pedas</td>
                        <td>:</td>
                        <td>{{ $countAllergiesPedas }}</td>
                        <td>{{ $jumlahPedas }}</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Alergi Daging Kerbau/Sapi/Kambing</td>
                        <td>:</td>
                        <td>{{ $countAllergiesDagingSapi }}</td>
                        <td>{{ $jumlahDaging }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Daging Ayam</td>
                        <td>:</td>
                        <td>{{ $countAllergiesDagingAyam }}</td>
                        <td>{{ $jumlahDagingAyam }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Ikan Mas</td>
                        <td>:</td>
                        <td>{{ $countAllergiesIkanMas }}</td>
                        <td>{{ $jumlahIkanMas }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Daun Singkong</td>
                        <td>:</td>
                        <td>{{ $countAllergiesDaunSingkong }}</td>
                        <td>{{ $jumlahDaunSingkong }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Terung Hijau</td>
                        <td>:</td>
                        <td>{{ $countAllergiesTerung }}</td>
                        <td>{{ $jumlahTerungHijau }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Kikil</td>
                        <td>:</td>
                        <td>{{ $countAllergiesKikil }}</td>
                        <td>{{ $jumlahKikil }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Kacang Kedelai (Tahu Tempe)</td>
                        <td>:</td>
                        <td>{{ $countAllergiesKedelai }}</td>
                        <td>{{ $jumlahKedelai }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Kacang-Kacangan</td>
                        <td>:</td>
                        <td>{{ $countAllergiesKacang }}</td>
                        <td>{{ $jumlahKacangan }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Ikan Mujahir</td>
                        <td>:</td>
                        <td>{{ $countAllergiesMujahir }}</td>
                        <td>{{ $jumlahMujahir }}</td>
                        <td>Potong</td>
                    </tr>
                    <tr>
                        <td>Alergi Nenas</td>
                        <td>:</td>
                        <td>{{ $countAllergiesNenas }}</td>
                        <td>{{ $jumlahNenas }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Pepaya</td>
                        <td>:</td>
                        <td>{{ $countAllergiesPepaya }}</td>
                        <td>{{ $jumlahPepaya }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Gori</td>
                        <td>:</td>
                        <td>{{ $countAllergiesGori }}</td>
                        <td>{{ $jumlahGori }}</td>
                        <td>Porsi</td>
                    </tr>
                    <tr>
                        <td>Alergi Jamur</td>
                        <td>:</td>
                        <td>{{ $countAllergiesJamur }}</td>
                        <td>{{ $jumlahJamur }}</td>
                        <td>Porsi</td>
                    </tr>
                </tbody>
            </table>
        </div>
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
            $('#exam').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'excel', 'csv', 'print'
                ]
            });
        });
    </script>
@endpush
