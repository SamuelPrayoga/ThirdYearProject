<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pengumuman.index')}}">
                        <i class="fas fa-bullhorn"></i>
                        Pengumuman
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <strong>INFORMASI KANTIN</strong>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menumakan.*') ? 'active' : '' }}"
                        href="{{ route('menumakan.index') }}">
                        <i class="fas fa-utensils"></i>  Menu Makanan
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href=#>
                        <i class="bi bi-person-exclamation"></i> Piket Kantin
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href={{route('admin.showFeedback')}}>
                        <i class="fas fa-comments"></i> Kritik dan Saran
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link">
                    <strong>LAPORAN MAHASISWA</strong>
                </a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pengguna.*') ? 'active' : '' }}"
                        href="{{ route('pengguna.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        Mahasiswa
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/allergy-reports.*') ? 'active' : ''}}" href="{{ route('admin.allergy-reports.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        Mahasiswa Alergi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/allergy-reports.*') ? 'active' : '' }}" href="{{ route('admin.allergy-reports.rekap') }}">
                        <i class="bi bi-table"></i>
                        Total dan Prakiraan Masakan
                    </a>
                </li>
            @endif
            @if (auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.allergy-reports.index') }}">
                        <i class="bi bi-person"></i>
                        Mahasiswa IB
                        {{-- @if ($jumlah > 0)
                            <span class="badge">{{ $jumlah }}</span>
                        @endif --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}"
                        href="{{ route('holidays.index') }}">
                        <i class="bi bi-calendar-event"></i>
                        Data Hari Libur
                    </a>
                </li>
            @endif
            @if (auth()->user()->isDepkebdis())
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard2-minus"></i>
                        Laporan Barang
                    </a>
                </li>
            @endif
            @if (auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>ABSENSI MAKAN</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}"
                        href="{{ route('attendances.index') }}">
                        <i class="bi bi-qr-code"></i>
                        Absensi Makan Kantin
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('presences.*') ? 'active' : '' }}"
                        href="{{ route('presences.index') }}">
                        <i class="bi bi-qr-code-scan"></i>
                        Record Data Makan
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>USER MANAGEMENT</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"
                        href="{{ route('positions.index') }}">
                        <i class="fas fa-user-shield"></i>
                        Role
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"
                        href="{{ route('positions.index') }}">
                        <i class="bi bi-activity"></i>
                        Profiling
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="nav-link btn btn-link" type="submit">
                        <i class="bi bi-power"></i> {{ Auth::user()->name }} | Logout
                    </button>
                </form>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="bg" role="button" data-toggle="dropdown"
                    aria-haspopup="false" aria-expanded="true">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form action="{{ route('auth.logout') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn fw-bold btn-danger btn-sm w-100">
                            Keluar</button>
                    </form>
                    </a>
                </div>
            </li> --}}
        </ul>
    </div>
</nav>
