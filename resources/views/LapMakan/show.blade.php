@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center>Lapor Izin Bermalam</center>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#laporModal"><i
                                    class="fas fa-book"></i> Lapor Izin Bermalam</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Jam Berangkat</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jam Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($izin_bermalam as $index => $lapor)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($lapor->is_makan == 0)
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @elseif ($lapor->is_makan == 1)
                                                    <span class="badge badge-success">Disetujui</span>
                                                @elseif ($lapor->is_makan == 2)
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $lapor->tanggal_berangkat }}</td>
                                            <td>{{ $lapor->jam_berangkat }}</td>
                                            <td>{{ $lapor->tanggal_kembali }}</td>
                                            <td>{{ $lapor->jam_kembali }}</td>
                                            <td>
                                                @if ($lapor->is_makan == 0)
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#editModal{{ $index }}"><i
                                                            class="fas fa-cogs"></i>
                                                        Edit</button>
                                                @elseif ($lapor->is_makan == 1 || $lapor->is_makan == 2)
                                                    <button class="btn btn-primary btn-sm" disabled><i
                                                            class="fas fa-cogs"></i>
                                                        Edit</button>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- End Modal Edit -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                                                <!-- Modal Edit -->
                                                                <div class="modal fade" id="editModal{{ $index }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="editModalLabel{{ $index }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form id="editForm{{ $index }}"
                                                                            action="{{ route('home.IB.edit', ['id' => $lapor->id]) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="editModalLabel{{ $index }}">
                                                                                    Edit
                                                                                    Data</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="UserID"
                                                                                        value="{{ auth()->user()->id }}">
                                                                                    <label for="input-one">Catatan:</label>
                                                                                    <ul>
                                                                                        <li><small>Form ini Hanya dapat diisi satu kali oleh
                                                                                                mahasiswa, Pastikan Anda mengisi data dengan
                                                                                                benar.</small></li>
                                                                                        <li><small>Form ini bertujuan untuk mengkonfirmasi Anda
                                                                                                apakah melakukan Izin Bermalam atau
                                                                                                tidak</small>
                                                                                        </li>
                                                                                        <li><small>Sesuaikan tanggal dan waktu keberangkatan
                                                                                                pada
                                                                                                Campus Information System (CIS)</small></li>
                                                                                    </ul>
                                                                                    <div class="form-group" id="formBerangkat">
                                                                                        <label for="tanggal">Tanggal dan Jam Berangkat</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="date" class="form-control"
                                                                                                    name="tanggal_berangkat"
                                                                                                    id="tanggal_berangkat{{ $index }}"
                                                                                                    placeholder=""
                                                                                                    value="{{ $lapor->tanggal_berangkat }}"
                                                                                                    required>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <input type="time" class="form-control"
                                                                                                    name="jam_berangkat"
                                                                                                    id="jam_berangkat{{ $index }}"
                                                                                                    placeholder=""
                                                                                                    value="{{ $lapor->jam_berangkat }}"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group" id="formKembali">
                                                                                        <label for="tanggal">Tanggal dan Jam Kembali</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="date" class="form-control"
                                                                                                    name="tanggal_kembali"
                                                                                                    id="tanggal_kembali{{ $index }}"
                                                                                                    placeholder=""
                                                                                                    value="{{ $lapor->tanggal_kembali }}"
                                                                                                    required>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <input type="time" class="form-control"
                                                                                                    name="jam_kembali"
                                                                                                    id="jam_kembali{{ $index }}"
                                                                                                    placeholder=""
                                                                                                    value="{{ $lapor->jam_kembali }}" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                                    data-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                                    id="submitButton{{ $index }}">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade" id="laporModal" tabindex="-1" role="dialog"
                                                                aria-labelledby="laporModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form id="theForm" action="{{ route('home.lapor.makan') }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="laporModalLabel">Form Lapor Izin
                                                                                    Bermalam</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="UserID"
                                                                                        value="{{ auth()->user()->id }}">
                                                                                    <label for="input-one">Catatan: </label>
                                                                                    <ul>
                                                                                        <li><small>Form ini Hanya dapat diisi satu kali oleh
                                                                                                mahasiswa,
                                                                                                Pastikan Anda
                                                                                                mengisi
                                                                                                data dengan benar.</small></li>
                                                                                        <li><small>Form ini bertujuan untuk mengkonfirmasi Anda
                                                                                                apakah melakukan Izin
                                                                                                Bermalam atau
                                                                                                tidak</small></li>
                                                                                        <li><small>Sesuaikan tanggal dan waktu keberangkatan
                                                                                                pada
                                                                                                Campus Information
                                                                                                System
                                                                                                (CIS)
                                                                                            </small></li>
                                                                                    </ul>
                                                                                    <div class="form-group" id="formBerangkat">
                                                                                        <label for="tanggal">Tanggal dan Jam Berangkat</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="date" class="form-control"
                                                                                                    name="tanggal_berangkat" id="tanggal"
                                                                                                    placeholder="" value="" required>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <input type="time" class="form-control"
                                                                                                    name="jam_berangkat" id="jam_berangkat"
                                                                                                    placeholder="" value="" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group" id="formKembali">
                                                                                        <label for="tanggal">Tanggal dan Jam Kembali</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="date" class="form-control"
                                                                                                    name="tanggal_kembali" id="tanggal"
                                                                                                    placeholder="" value="" required>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <input type="time" class="form-control"
                                                                                                    name="jam_kembali" id="jam_berangkat"
                                                                                                    placeholder="" value="" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="reset" class="btn btn-danger btn-sm"
                                                                                    data-dismiss="modal">Reset</button>
                                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                                    id="submitButton">Lapor</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                    </div>
                </div>
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
