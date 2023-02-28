<nav class="navbar navbar-expand-md bg-dark navbar-dark py-3">
    <div class="container">
        <img src="{{asset('img/logo.png')}}" width="65px" alt="" srcset="">
        &nbsp;
        <strong><a class="navbar-brand" href="#"> Del Canteen Management System</a></strong>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home.index') }}">Beranda <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">(current)</span>
                    Informasi Kantin
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home.menumakan') }}"><i class="bi bi-menu-down"></i> Menu Makanan</a>
                    <a class="dropdown-item" href="#"><i class="bi bi-calendar2-week"></i> Jadwal Piket</a>
                    {{-- <a class="dropdown-item" href="#"><i class="bi bi-map"></i> Denah Makan</a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#"><i class="bi bi-info-circle"></i> Kritik dan Saran</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pelaporan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="bi bi-clipboard-x"></i> Alergi Makanan</a>
                    <a class="dropdown-item" href="#"><i class="bi bi-question-circle"></i></i> Barang Hilang</a>
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#"><i class="bi bi-search"></i> Barang Temuan</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pengumuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pemesanan</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" type="button" href="#"><i class="bi bi-people"></i> My Profile</a>
                        <form action="{{ route('auth.logout') }}" method="post">
                            @method('DELETE')
                            @csrf

                            <button class="btn fw-bold btn-danger btn-sm w-100"><i class="bi bi-lock"></i> Keluar</button>
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    </div>
</nav>

{{-- <nav class="navbar navbar-expand-md bg-dark navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand bg-transparent fw-bold" href="{{ route('home.index') }}">Del Canteen Management</a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

            <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0">
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link {{ request()->routeIs('home.*') ? 'active fw-bold' : '' }}" aria-current="page"
                        href="{{ route('home.index') }}">Beranda</a>
                </li>

                <div class="dropdown    gap-md-4 py-2 py-md-0">
                    <button class="nav-link btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link" aria-current="page" href="#">Pelaporan</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link" aria-current="page" href="#">Pengumuman</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link" aria-current="page" href="#">Pemesanan Catering</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <a class="nav-link" aria-current="page" href="#">Kritik dan Saran</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <form action="{{ route('auth.logout') }}" method="post">
                        @method('DELETE')
                        @csrf

                        <button class="btn fw-bold btn-danger w-20">{{ Auth::user()->name }}</button>
                    </form>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0">
                    <form action="{{ route('auth.logout') }}" method="post">
                        @method('DELETE')
                        @csrf

                        <button class="btn fw-bold btn-danger w-100">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}
