<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <!-- HTML -->

    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isKeasramaan())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                @if (auth()->user()->isKeasramaan())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengumuman.index') }}">
                            <i class="fas fa-bullhorn"></i>
                            Pengumuman
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('barang.show') }}">
                        <i class="fas fa-file"></i>
                        Barang Hilang-Temuan
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isPengelola())
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <strong>INFORMASI KANTIN</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengumuman.index') }}">
                        <i class="fas fa-bullhorn"></i>
                        Pengumuman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menumakan.*') ? 'active' : '' }}"
                        href="{{ route('menumakan.index') }}">
                        <i class="fas fa-utensils"></i> Menu Makanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{ route('admin.showFeedback') }}>
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
                        Pengguna/Mahasiswa
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isKeasramaan() or
                    auth()->user()->isPengelola())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/allergy-reports.*') ? 'active' : '' }}"
                        href="{{ route('admin.allergy-reports.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        Mahasiswa Alergi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin/allergy-reports.*') ? 'active' : '' }}"
                        href="{{ route('admin.allergy-reports.rekap') }}">
                        <i class="bi bi-table"></i>
                        Total dan Prakiraan Masakan
                    </a>
                </li>
            @endif
            @if (auth()->user()->isKeasramaan() or
                    auth()->user()->isPengelola() or
                    auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}"
                        href="{{ route('holidays.index') }}">
                        <i class="fas fa-calendar"></i>
                        Data Hari Libur
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.lapmakan.index') }}">
                        <i class="fas fa-file-alt"></i>
                        Data Mahasiswa IB
                    </a>
                </li>
                {{-- @endif
            @if (auth()->user()->isDepkebdis() or
    auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard2-minus"></i>
                        Laporan Barang
                    </a>
                </li> --}}
            @endif
            @if (auth()->user()->isKeasramaan() or
                    auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link">
                        <strong>PRESENSI MAKAN</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}"
                        href="{{ route('attendances.index') }}">
                        <i class="bi bi-qr-code"></i>
                        Presensi Makan Kantin
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() or
                    auth()->user()->isKeasramaan() or
                    auth()->user()->isPengelola())
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
            @endif
            <li class="nav-item">
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="nav-link btn btn-link" type="submit">
                        <i class="bi bi-power"></i> {{ Auth::user()->name }} | Logout
                    </button>
                </form>
            </li>
        </ul>
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
<script>
    // JavaScript

    // Toggle sidebar expand-collapse
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('sidebar-expanded');
        sidebar.classList.toggle('sidebar-collapsed');
    }

    // Menggunakan event listener untuk memanggil fungsi toggleSidebar saat tombol di klik
    const toggleButton = document.querySelector('#toggleButton');
    toggleButton.addEventListener('click', toggleSidebar);
</script>
