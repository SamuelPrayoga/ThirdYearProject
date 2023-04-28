@extends('layouts.app')

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('presences.show', $attendance->id) }}" class="btn btn-sm btn-light">
                <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
                Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="card-title">{{ $attendance->title }}</h5>
                    <br><br>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $attendance->description }}</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span href="" class="badge text-bg-warning">Izin</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="filterDate" class="form-label fw-bold">Tampilkan Berdasarkan Tanggal</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" id="filterDate" name="display-by-date"
                                    value="{{ request('display-by-date') }}">
                                <button class="btn btn-primary" type="submit" id="button-addon1">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="p-3 rounded bg-light border my-3 d-flex align-items-center justify-content-between">
            <div>Hari : <span class="fw-bold">
                    {{ \Carbon\Carbon::parse($date)->dayName }}
                    {{ \Carbon\Carbon::parse($date)->isCurrentDay() ? '(Hari ini)' : '' }}
                </span>
            </div>
            <div>Tanggal : <span class="fw-bold">{{ $date }}</span></div>
            <div>Jumlah : <span class="fw-bold">{{ $permissions->count() }}</span></div>
        </div>
        @if (count($permissions) === 0)
            <small class="text-danger fw-bold">Tidak ada data yang bisa ditampilkan, <a href="">Tampilkan data
                    berdasarkan hari
                    ini.</a></small>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Kontak</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $permission->user->name }}</td>
                                <td>
                                    <a href="mailto:{{ $permission->user->email }}">{{ $permission->user->email }}</a>
                                    <span class="fw-bold"> / </span>
                                    <a href="tel:{{ $permission->user->phone }}">{{ $permission->user->phone }}</a>
                                </td>
                                <td>{{ $permission->user->position->name }}</td>
                                @if ($permission->is_accepted)
                                    <td>
                                        <span class="badge text-bg-success border-0">Sudah Diterima</span>
                                        <button class="badge text-bg-info border-0 permission-detail-modal-triggers"
                                            data-permission-id="{{ $permission->id }}" data-bs-toggle="modal"
                                            data-bs-target="#permission-detail-modal"><i class="bi bi-info-circle-fill"></i>
                                            Lihat
                                            Alasan</button>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{ route('presences.acceptPermission', $attendance->id) }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                                            <input type="hidden" name="permission_date"
                                                value="{{ $permission->permission_date }}">
                                            <button class="badge text-bg-success border-0" type="submit"><i
                                                    class="bi bi-check-circle-fill"></i> Terima</button>
                                        </form>
                                        {{-- Declining --}}
                                        <form
                                            action="{{ route('presences.declinePermission', [$attendance->id, $permission->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                                            <input type="hidden" name="permission_date"
                                                value="{{ $permission->permission_date }}">
                                            <button class="badge text-bg-danger border-0" type="submit"><i
                                                    class="bi bi-x-circle-fill"></i> Tolak</button>
                                        </form>
                                        {{-- <form action="{{ route('presences.declinePermission', $attendance->id) }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                                            <input type="hidden" name="permission_date"
                                                value="{{ $permission->permission_date }}">
                                            <button class="badge text-bg-danger border-0" type="submit"><i
                                                    class="bi bi-x-circle-fill"></i> Tolak</button>
                                        </form> --}}
                                        @if ($permission->is_decline)
                                            <div class="mt-2 text-danger">
                                                Alasan ditolak: {{ $permission->decline_reason }}
                                            </div>
                                        @endif

                                        <button class="badge text-bg-primary border-0 permission-detail-modal-triggers"
                                            data-permission-id="{{ $permission->id }}" data-bs-toggle="modal"
                                            data-bs-target="#permission-detail-modal"><i class="bi bi-info-circle-fill"></i>
                                            Lihat
                                            Alasan</button>
                                    </td>
                                @endif

                                {{-- <td>{{ $permission->user->position->name }}</td>
                                @if ($permission->is_accepted)
                                    <td>
                                        <span class="badge text-bg-success border-0">Sudah Diterima</span>
                                        <button class="badge text-bg-info border-0 permission-detail-modal-triggers"
                                            data-permission-id="{{ $permission->id }}" data-bs-toggle="modal"
                                            data-bs-target="#permission-detail-modal"><i class="bi bi-info-circle-fill"></i>
                                            Lihat
                                            Alasan</button>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{ route('presences.acceptPermission', $attendance->id) }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                                            <input type="hidden" name="permission_date"
                                                value="{{ $permission->permission_date }}">
                                            <button class="badge text-bg-success border-0" type="submit"><i
                                                    class="bi bi-check-circle-fill"></i> Terima</button>
                                        </form>
                                        <form action="{{ route('presences.declinePermission', $attendance->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                                            <input type="hidden" name="permission_date" value="{{ $permission->permission_date }}">
                                            <button class="badge text-bg-danger border-0" type="submit"><i class="bi bi-x-circle-fill"></i> Tolak</button>
                                        </form>

                                        <button class="badge text-bg-primary border-0 permission-detail-modal-triggers"
                                            data-permission-id="{{ $permission->id }}" data-bs-toggle="modal"
                                            data-bs-target="#permission-detail-modal"><i class="bi bi-info-circle-fill"></i>
                                            Lihat
                                            Alasan</button>
                                    </td>
                                @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
    </div>
    </div>
    @if (count($permissions) !== 0)
        <div class="modal fade" id="permission-detail-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Izin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Judul Izin</td>
                                <td>:</td>
                                <td><span id="permission-title"></span></td>
                            </tr>
                            <tr>
                                <td>Alasan Lengkap</td>
                                <td>:</td>
                                <td><span id="permission-description"></span></td>
                            </tr>
                            <tr>
                                <td>Bukti Izin</td>
                                <td>:</td>
                                <td><a id="permission-file" href="{{ asset('storage/' . $permission->file) }}"
                                        target="_blank">Lihat file</a></td>
                            </tr>
                        </table>
                        {{-- <tr>
                    <td>Judul Izin wkw : <span id="permission-title"></span></td>
                    <td>Keterangan Izin : <p id="permission-description"></p></td>
                </tr> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <form action="{{ route('presences.acceptPermission', $attendance->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $permission->user->id }}">
                            <input type="hidden" name="permission_date" value="{{ $permission->permission_date }}">
                            @if ($permission->is_accepted == 0)
                                <button class="btn btn-success btn-sm border-0" type="submit">Terima</button>
                            @endif
                            {{-- @if ($permission->is_accepted = 1)
                    <button class="btn btn-success btn-sm border-0" type="submit">Terima</button>
                    @endif --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('script')
    <script>
        const permissionUrl = "{{ route('api.permissions.show') }}";
    </script>
    <script src="{{ asset('js/presences/permissions.js') }}"></script>
@endpush
