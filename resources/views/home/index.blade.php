@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-2">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <div class="card-header" id="fonts">
                        <i class="bi bi-pin-fill"></i> Pengumuman Penting
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if ($announce->isEmpty())
                                <td colspan="5" class="table-inactive"><small class="text-muted">Belum ada Pengumuman
                                        ditambahkan</small>
                                </td>
                            @else
                                @foreach ($announce as $peng)
                                    <div class="list-group-item d-flex justify-content-between align-items-start py-3">
                                        <div class="ms-2 me-auto">
                                            {{-- <i class="bi bi-pin-fill"></i> --}}
                                            <p class="mb-0">{!! $peng->deskripsi !!}</p>
                                            <small style="color: gray;">Sitoluama, {{ $peng->tanggal_pembuatan }}</small>
                                            &nbsp
                                            <div>
                                                <small style="color: gray;">Pengumuman Berakhir:
                                                    {{ $peng->tanggal_berakhir }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card shadow-sm mb-2">
                    <div class="card-header" id="fonts">
                        <i class="bi bi-stopwatch-fill"></i> Daftar Jadwal Makan Kantin
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if ($attendances->isEmpty())
                                <td colspan="5" class="table-inactive"><small class="text-muted">Belum ada Jadwal Makan
                                        Kantin diatur oleh Keasramaan</small>
                                </td>
                            @else
                                @foreach ($attendances as $attendance)
                                    <a href="{{ route('home.show', $attendance->id) }}"
                                        class="list-group-item d-flex justify-content-between align-items-start py-3">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $attendance->title }}</div>
                                            <p class="mb-0">{{ $attendance->description }}</p>
                                        </div>
                                        @include('partials.attendance-badges')
                                    </a>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Informasi Mahasiswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3 table-responsive">
                            <table class="table ps-3">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if (auth()->user()->avatar)
                                            <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" alt="Foto Profil"
                                                style="border-radius: 10%;" width="125px" height="120px">
                                        @else
                                            <img src="{{ asset('avatarDefault/avatarDefault.png') }}" alt="Default Avatar"
                                                style="border-radius: 10%;" width="125px" height="120px">
                                        @endif
                                    </td>


                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Asrama</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->asrama }}</a></td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->angkatan }}</a></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td><a href="tel:{{ auth()->user()->phone }}">{{ auth()->user()->phone }}</a></td>
                                </tr>
                                <tr>
                                    <td>Bergabung</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->created_at->diffForHumans() }}
                                        ({{ auth()->user()->created_at->format('d M Y') }})</td>
                                </tr>
                            </table>
                        </div>
                        <br>

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#exampleModal" style="font-weight: bolder">
                            <i class="bi bi-chat-left-text-fill"></i> Kritik dan Saran Kantin
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <img src="{{ asset('img/logo.png') }}" alt="" width="40px"
                                            height="45px"> &nbsp;
                                        <h5 class="modal-title" id="exampleModalLabel">Form Kritik dan Saran Kantin Del</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="theForm" action="{{ route('home.feedback-form') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="input-one">Catatan: </label>
                                                    <ul>
                                                        <li><small>Form ini disarankan diisi satu kali dalam satu hari
                                                                supaya pihak kantin dapat mengetahui keluhan
                                                                mahasiswa</small></li>
                                                        <li><small>Form ini bersifat rahasia, identitas Anda akan kami
                                                                rahasiakan !</small></li>
                                                    </ul>
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-one">Nama</label>
                                                    {{-- <input type="hidden" name="form_token" value="{{ session('form_token') }}"> --}}
                                                    <input type=hidden name=last id=last>
                                                    <input type="text" class="form-control" id="input-zero"
                                                        value="{{ auth()->user()->name }}" name="nama" readonly
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-one">NIM</label>

                                                    <input type="text" class="form-control" id="input-zero-one"
                                                        value="{{ auth()->user()->nim }}" name="nim" readonly
                                                        required>
                                                </div>
                                                <input type=hidden name=UserID value={{ auth()->user()->id }}>
                                                <div class="form-group">
                                                    <label for="input-one">Tanggal Ulasan</label>
                                                    <input type="date" class="form-control" name="date"
                                                        id="tanggal_ulasan" placeholder="" value="" required
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ulasan">Kategori Ulasan:</label>
                                                    <select class="form-control" id="ulasan" required
                                                        name="subject_review" aria-label="Default select example">
                                                        <option disabled selected value>-- Pilih Kategori --</option>
                                                        <option value="Kebersihan Kantin">Kebersihan Kantin</option>
                                                        <option value="Menu Makanan">Menu Makanan</option>
                                                        <option value="Pelayanan Kantin">Pelayanan Kantin</option>
                                                        <option value="Sistem Informasi Kantin">Sistem Informasi Kantin
                                                        </option>
                                                    </select>
                                                    {{-- <label for="input-one">Subjek Ulasan</label>
                                                    <input type="text" class="form-control" id="input-one"
                                                        name="subjek_ulasan" placeholder="" required> --}}
                                                </div>
                                                <script>
                                                    // Get the current date
                                                    const currentDate = new Date().toISOString().slice(0, 10);

                                                    // Set the value of the input field to the current date
                                                    document.getElementById("tanggal_ulasan").value = currentDate;
                                                </script>
                                                <label for="exampleFormControlTextarea1">Bagaimana rating Penilaian Anda
                                                    terhadap Pengalaman Makan Anda hari ini?</label>
                                                <div
                                                    class="rating-input-wrapper rating-flex d-flex flex-wrap justify-content-between mt-2">
                                                    <label><input type="radio" name="value_rating"
                                                            value="Sangat Tidak Menyukai" /><i
                                                            class="fa fa-star"></i></label>
                                                    <label><input type="radio" name="value_rating"
                                                            value="Tidak Menyukai" /><i class="fa fa-star"></i></label>
                                                    <label><input type="radio" name="value_rating"
                                                            value="Biasa Saja" /><i class="fa fa-star"></i></label>
                                                    <label><input type="radio" name="value_rating"
                                                            value="Menyukai" /><i class="fa fa-star"></i></label>
                                                    <label><input type="radio" name="value_rating"
                                                            value="Sangat Menyukai" /><i class="fa fa-star"></i></label>
                                                </div>
                                                <script>
                                                    // Get all the radio inputs and star icons
                                                    const radioInputs = document.querySelectorAll('input[type="radio"]');
                                                    const starIcons = document.querySelectorAll('.fa-star');

                                                    // Attach event listeners to radio inputs
                                                    radioInputs.forEach((input, index) => {
                                                        input.addEventListener('change', () => {
                                                            // Reset the "checked" class on all star icons
                                                            starIcons.forEach((icon, iconIndex) => {
                                                                if (iconIndex <= index) {
                                                                    icon.classList.add('checked');
                                                                } else {
                                                                    icon.classList.remove('checked');
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>

                                                <div class="rating-labels d-flex justify-content-between mt-1">
                                                    <label><small>Sangat Tidak Suka</small></label>
                                                    <label><small>Sangat Menyukai</small></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-two">Deskripsi</label>
                                                <textarea class="form-control" id="input-two" rows="3" name="description" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-two">Gambar (opsional)</label>
                                                <input type="file" class="form-control" name="file"
                                                    id="input-three" placeholder="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                    id="submitButton">Sampaikan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- LaporanMakan --}}
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <!-- Footer -->
    @include('partials.footer')
    <script>
        function showButton() {
            var today = new Date();
            var dayOfWeek = today.getDay(); // mengambil hari dalam bentuk angka, dimulai dari 0 (Minggu) hingga 6 (Sabtu)

            var currentHour = today.getHours(); // mengambil jam saat ini

            // tampilkan tombol hanya pada hari Kamis (4) dan Jumat (5) sebelum jam 24:00 (12 AM)
            if ((dayOfWeek === 4 && currentHour < 24) || dayOfWeek === 5) {
                document.getElementById("btn-day").style.display = "inline-block";
            } else {
                document.getElementById("btn-day").style.display = "none";
            }
        }
    </script>
    <script>
        showButton();
    </script>


@endsection
