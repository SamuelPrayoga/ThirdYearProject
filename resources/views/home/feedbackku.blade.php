@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Kritik dan Saran Saya</center>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>Tanggal Ulasan</th>
                                        <th>Rating</th>
                                        <th>Kategori Ulasan</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                @if ($feedback->isEmpty())
                                    <td colspan="6"><small class="text-muted">Tidak ada Feedback.</small></td>
                                @else
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach ($feedback as $ulasan)
                                            <tr>
                                                @if ($ulasan->user_id == auth()->user()->id)
                                                    {{-- Tampilkan data feedback/ulasan yang hanya ditambahkan oleh pengguna yang sedang login --}}
                                                    <td>
                                                        <center>{{ $i++ }}.</center>
                                                    </td>
                                                    <td width="10%">
                                                        {{ \Carbon\Carbon::parse($ulasan->date)->format('d M Y') }}</td>
                                                    {{-- <td>{{ $ulasan->date->format('d F Y') }}</td> --}}
                                                    {{-- <td>{{ $ulasan->value_rating }}</td> --}}
                                                    <td class="rating-cell" width="18%;">
                                                        @if ($ulasan->value_rating == 'Sangat Tidak Menyukai')
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <!-- bintang kuning -->
                                                        @elseif($ulasan->value_rating == 'Tidak Menyukai')
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <!-- dua bintang kuning -->
                                                        @elseif($ulasan->value_rating == 'Biasa Saja')
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <!-- tiga bintang kuning -->
                                                        @elseif($ulasan->value_rating == 'Menyukai')
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <!-- empat bintang kuning -->
                                                        @elseif($ulasan->value_rating == 'Sangat Menyukai')
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <i class="fas fa-star" style="color: #f7ca18;"></i>
                                                            <!-- lima bintang kuning -->
                                                        @endif
                                                    </td>
                                                    <td width="15%">{{ $ulasan->subject_review }}</td>
                                                    <td>{{ $ulasan->description }}</td>
                                                    {{-- <td><a href="{{route('home.forbidden')}}">View</a></td> --}}
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                                            data-target="#exampleModal{{ $ulasan->id }}">
                                                            <i class="fas fa-eye" style="color: #ffffff"></i>
                                                        </a>
                                                    </td>

                                                    {{-- <td><img src="{{ asset('storage/img/Feedback/'.$ulasan->file) }}" width="200px" height="120px" alt=""></td> --}}
                                                @endif
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $ulasan->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Foto Ulasan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (file_exists(public_path('img/Feedback/' . auth()->user()->id . '/' . $ulasan->file)))
                                                                <img src="{{ asset('img/Feedback/' . auth()->user()->id . '/' . $ulasan->file) }}"
                                                                    class="img-fluid">
                                                            @else
                                                                <p>Tidak ada gambar tersedia</p>
                                                            @endif
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
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
