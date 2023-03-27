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
            @endif
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart-plus"></i>
                        Pembelian Bahan Makanan
                    </a>
                </li>
            @endif
            {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart-plus"></i>
                        Pemesanan Makanan
                    </a>
                </li> --}}
            @if (auth()->user()->isAdmin())
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
                {{-- <li class="nav-item">
                    <a class="nav-link" href=#>
                        <i class="bi bi-person-exclamation"></i> Piket Kantin
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href=#>
                        <i class="bi bi-info-circle"></i> Kritik dan Saran
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
                    <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}"
                        href="{{ route('pengguna.index') }}">
                        <i class="bi bi-people"></i>
                        Mahasiswa
                    </a>
                </li>
            @endif
            @if (auth()->user()->isOperator())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.allergy-reports.index') }}">
                        <i class="bi bi-person"></i>
                        Mahasiswa Alergi
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
                        <i class="bi bi-person-gear"></i>
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
        </ul>
    </div>
</nav>
