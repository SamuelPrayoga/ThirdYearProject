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
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th>Tanggal Ulasan</th>
                                    <th>Rating</th>
                                    <th>Kategori Ulasan</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            @if ($feedback->isEmpty())
                                <p>Tidak ada ulasan yang tersedia.</p>
                            @else
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($feedback as $ulasan)
                                        <tr>
                                            @if ($ulasan->user_id == auth()->user()->id)
                                                {{-- Tampilkan data feedback/ulasan yang hanya ditambahkan oleh pengguna yang sedang login --}}
                                                <td><center>{{ $i++ }}.</center></td>
                                                <td>{{ $ulasan->date }}</td>
                                                <td>{{ $ulasan->value_rating }}</td>
                                                <td>{{ $ulasan->subject_review }}</td>
                                                <td>{{ $ulasan->description }}</td>
                                                {{-- <td><a href="{{route('home.forbidden')}}">View</a></td> --}}
                                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $ulasan->id }}">
                                                        Lihat Foto
                                                    </button>
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
                                                        <img src="{{ asset('img/Feedback/' . auth()->user()->id . '/' . $ulasan->file) }}"
                                                            width="100%" height="100%" alt="">
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
