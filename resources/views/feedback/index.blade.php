@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush
@section('content')
    <div class="card mb-3">
        <div class="card mb-3 table-responsive">
            <table class="table table-bordered table-striped table-hover" id="">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tanggal Ulasan</th>
                        <th>Kategori</th>
                        <th>Rating</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                @if ($feedbacks->isEmpty())
                    <td colspan="7"><small class="text-muted">Tidak ada Kritik dan Saran yang disampaikan.</small></td>
                @else
                    <tbody>
                        @php $i=1 @endphp
                        @foreach ($feedbacks as $ulasan)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($ulasan->date)->format('d M Y') }}</td>
                                <td>{{ $ulasan->subject_review }}</td>
                                <td class="rating-cell" width="18%;">
                                    @if($ulasan->value_rating == 'Sangat Tidak Menyukai')
                                        <i class="fas fa-star" style="color: #f7ca18;"></i> <!-- bintang kuning -->
                                    @elseif($ulasan->value_rating == 'Tidak Menyukai')
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i> <!-- dua bintang kuning -->
                                    @elseif($ulasan->value_rating == 'Biasa Saja')
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i> <!-- tiga bintang kuning -->
                                    @elseif($ulasan->value_rating == 'Menyukai')
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i> <!-- empat bintang kuning -->
                                    @elseif($ulasan->value_rating == 'Sangat Menyukai')
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i>
                                        <i class="fas fa-star" style="color: #f7ca18;"></i> <!-- lima bintang kuning -->
                                    @endif
                                </td>
                                {{-- <td>{{ $ulasan->value_rating }}</td> --}}
                                <td>{{ $ulasan->description }}</td>
                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal{{ $ulasan->id }}">
                                        <i class="fa fa-eye"></i> Lihat Foto
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ $ulasan->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Foto Ulasan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('img/Feedback/' . $ulasan->user_id . '/' . $ulasan->file) }}"
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
            $('#examples').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'excel', 'csv', 'print'
                ]
            });
        });
    </script>
@endpush
