@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Riwayat Izin Bermalam</center>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th>Keberangkatan</th>
                                    <th>Kedatangan</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @if ($izinBermalams->isEmpty())
                                <td colspan="6">Tidak ada Izin Bermalam Tersedia.</td>
                            @else
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($izinBermalams as $IB)
                                        <tr>
                                            @if ($IB->user_id == auth()->user()->id)
                                                {{-- Tampilkan data feedback/ulasan yang hanya ditambahkan oleh pengguna yang sedang login --}}
                                                <td><center>{{ $i++ }}.</center></td>
                                                <td>{{ $IB>keberangkatan }}</td>
                                                <td>{{ $IB>kedatangan }}</td>
                                                <td>{{ $IB>alasan}}</td>
                                                <td>{{ $IB>status }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif

                        </table>
                    </div>

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
