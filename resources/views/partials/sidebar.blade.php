<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard.index') }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-megaphone"></i>
                        Pengumuman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart-plus"></i>
                        Pemesanan Makanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <strong>INFORMASI KANTIN</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menumakan.*') ? 'active' : '' }}"
                        href="{{ route('menumakan.index') }}">
                        <i class="bi bi-menu-down"></i> Menu Makanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=#>
                        <i class="bi bi-person-exclamation"></i> Piket Kantin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=#>
                        <i class="bi bi-info-circle"></i> Kritik dan Saran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>LAPORAN MAHASISWA</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}"
                        href="{{ route('employees.index') }}">
                        <i class="bi bi-people"></i>
                        Mahasiswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-person"></i>
                        Mahasiswa Alergi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}"
                        href="{{ route('holidays.index') }}">
                        <i class="bi bi-file-earmark-medical"></i>
                        Izin Sakit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard2-minus"></i>
                        Laporan Kehilangan Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard-data"></i>
                        Laporan Temuan Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>ABSENSI MAKAN</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}"
                        href="{{ route('attendances.index') }}">
                        <i class="bi bi-clipboard"></i>
                        Absensi Makan Kantin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('presences.*') ? 'active' : '' }}"
                        href="{{ route('presences.index') }}">
                        <i class="bi bi-clipboard-check"></i>
                        Record Data Kehadiran Makan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>USER MANAGEMENT</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"
                        href="{{ route('positions.index') }}">
                        <i class="bi bi-person-gear"></i>
                        Role
                    </a>
                </li>
                <li class="nav-link">
                    <form action="{{ route('auth.logout') }}" method="POST"
                    onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
                        @method('DELETE')
                        @csrf
                        <button class="nav-link btn-danger" type="submit">
                            <i class="bi bi-box-arrow-in-left"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>
