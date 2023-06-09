<div>
    @if ($holiday)
        <div class="alert alert-success">
            <small class="fw-bold">Hari ini adalah hari libur.</small>
        </div>
    @else
        {{-- kondisi untuk Hari Jumat --}}
        @if (in_array(now()->format('l'), ['Friday']) && $data['is_makan'] == 0)
            <div class="alert alert-danger">
                <small class="fw-bold">Anda Tidak melaporkan Makan untuk Hari Jumat, sehingga Anda tidak boleh melakukan scan QR Code Masuk.</small>
            </div>
        {{-- kondisi untuk Hari Sabtu --}}
        @elseif (in_array(now()->format('l'), ['Saturday']) && $data['is_makan'] == 0)
            <div class="alert alert-danger">
                <small class="fw-bold">Anda Tidak melaporkan Makan untuk Hari Sabtu, sehingga Anda tidak boleh melakukan scan QR Code Masuk.</small>
            </div>
        {{-- kondisi untuk hari kerja --}}
        @elseif ($attendance->data->is_using_qrcode && !$data['is_there_permission'])
            {{-- jika belum absen dan absen masuk sudah dimulai --}}
            @if ($attendance->data->is_start && !$data['is_has_enter_today'])
                <button class="btn btn-primary px-3 py-2 btn-sm fw-bold d-block w-100 mb-2" data-bs-toggle="modal" data-bs-target="#qrcode-scanner-modal" data-is-enter="1">Scan QRCode Masuk</button>
                <a href="{{ route('home.permission', $attendance->id) }}" class="btn btn-secondary  px-3 py-2 btn-sm fw-bold d-block w-100">Izin</a>
            @endif

            @if ($data['is_has_enter_today'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Anda sudah berhasil mengirim Scan Masuk.</small>
                </div>
            @endif

            {{-- jika absen pulang sudah dimulai, dan mahasiswa sudah absen masuk dan belum absen pulang --}}
            @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'])
                <button class="btn btn-primary px-3 py-2 btn-sm fw-bold d-block w-100" data-bs-toggle="modal" data-bs-target="#qrcode-scanner-modal" data-is-enter="0">Scan QRCode Pulang</button>
            @endif

            {{-- sudah absen masuk dan absen pulang --}}
            @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Terimakasih! Anda sudah makan dan Scan pulang, Semoga hari Anda menyenangkan.</small>
                </div>
            @endif

            {{-- jika sudah Scan masuk dan belum saatnya Scan pulang --}}
            @if ($data['is_has_enter_today'] && !$attendance->data->is_end)
                <div class="alert alert-warning">
                    <small class="fw-bold">Jika Belum Selesai Makan, Belum saatnya melakukan Scan pulang.</small>
                </div>
            @endif
        {{-- kondisi untuk permintaan izin --}}
        @elseif ($data['is_there_permission'])
            {{-- menampilkan pesan jika ada permintaan izin yang sedang diproses --}}
            @if ($data['is_permission_accepted'] == null)
                <div class="alert alert-info">
                    <small class="fw-bold">Permintaan izin sedang diproses.</small>
                </div>
            {{-- menampilkan pesan jika permintaan izin ditolak --}}
            @elseif ($data['is_permission_accepted'] == 0)
                <div class="alert alert-danger">
                    <small class="fw-bold">Permintaan izin Anda ditolak.</small>
                </div>
            {{-- menampilkan pesan jika permintaan izin diterima --}}
            @else
                <div class="alert alert-success">
                    <small class="fw-bold">Permintaan izin sudah diterima.</small>
                </div>
            @endif
        @endif
    @endif

    <div class="modal fade" id="qrcode-scanner-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scan QRCode presensi makan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reader"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script src="{{ asset('html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script>
        const enterPresenceUrl = "{{ route('home.sendEnterPresenceUsingQRCode') }}";
        const outPresenceUrl = "{{ route('home.sendOutPresenceUsingQRCode') }}";
    </script>
    <script type="module" src="{{ asset('js/home/qrcode.js') }}"></script>
@endpush
