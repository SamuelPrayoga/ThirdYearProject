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
        <strong><a class="navbar-brand" href="/" id="navbarfont"> Kantin Institut Teknologi Del</a></strong>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0" id="navbarfonts">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.index') }}">Beranda <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.menumakan') }}">Menu Makan <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pelaporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarfonts">
                        <a class="dropdown-item" href="{{ route('home.allergy-reports.create')}}"><i class="bi bi-clipboard-x"></i> Alergi Makanan</a>
                        <a class="dropdown-item" href="{{ route('home.laporan-barang') }}"><i
                                class="bi bi-question-circle"></i></i> Barang Hilang dan Temuan</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.pengumuman') }}">Pengumuman</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarfonts">
                        <li><a class="dropdown-item" type="button" href="#"><i class="bi bi-people"></i> My Profile</a></li>
                        <li><a class="dropdown-item" type="button" href="{{ route('home.allergy-reports.index')}}"><i class="bi bi-flag"></i> Laporan Alergiku</a></li>
                        <li><a class="dropdown-item" type="button" href="{{ route('home.feedbackku') }}"><i class="bi bi-chat-dots"></i> Kritik dan Saranku</a></li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn fw-bold btn-danger btn-sm w-100" type="submit"
                                    id="navbarfonts">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
