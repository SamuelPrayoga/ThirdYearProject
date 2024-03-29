<nav class="navbar navbar-expand-md navbar-dark py-3" id="bg">
    <style>
        #bg {
            background-color: #367FA9;
        }

        #navbarfont {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            font-weight: lighter;


        }

        #navbarfonts {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: lighter;

        }
    </style>
    <div class="container">
        <img src="{{ asset('img/logo.png') }}" width="65px" height="74px" alt="/" srcset="">
        &nbsp;
        <a class="navbar-brand" href="/" id="navbarfont"
            style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8); font-weight: bold;">Kantin Institut Teknologi Del</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0" id="navbarfonts">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.index') }}"
                        style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6); font-weight: bold;">Beranda <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.menumakan') }}"
                        style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6); font-weight: bold;">Menu Makan <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6); font-weight: bold;">
                        Pelaporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarfonts">
                        <a class="dropdown-item" href="{{ route('home.allergy-reports.create') }}">
                            <i class="fas fa-utensils"></i> Alergi Makanan</a>
                        <a class="dropdown-item" href="{{ route('home.lapor.IB') }}">
                            <i class="fas fa-car"></i> Izin Bermalam</a>
                        <a class="dropdown-item" href="{{ route('home.laporan-barang') }}"><i
                                class="fas fa-file-alt"></i>
                            Barang Hilang dan Temuan</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.pengumuman') }}"
                        style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6); font-weight: bold;">Pengumuman</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6); font-weight: bold;">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarfonts">
                        <li><a class="dropdown-item" type="button" href="{{ route('home.edit.profile') }}"><i
                                    class="fas fa-user"></i> Ubah Profil</a></li>
                        <li><a class="dropdown-item" type="button" href="{{ route('home.allergy-reports.index') }}"><i
                                    class="fas fa-flag"></i> Laporan Alergiku</a></li>
                        <li><a class="dropdown-item" type="button" href="{{ route('home.feedbackku') }}"><i
                                    class="fas fa-comment"></i> Kritik dan Saranku</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-power-off"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.getElementById('logout-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit langsung

        Swal.fire({
            title: 'Apakah anda yakin ingin keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Jika pengguna mengklik "Ya", submit form
            }
        });
    });
</script>
