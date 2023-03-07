<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" id="bg">
    <style>
        #bg {
            background-color: #00337C;
        }

        #profile {}
    </style>
    {{-- <img src="{{asset('img/logo.png')}}" alt="" width="50px"> --}}
    <a class="navbar-brand col-md-3 col-lg-2 me-0 py-2 px-3 fs-6" href=""><img src="{{ asset('img/logo.png') }}"
            alt="" width="45px"> Del Canteen Management</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0">
        <li class="nav-item dropdown">
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
        </li>
    </ul>
    <style>
        #bg {
            background-color: #00337C;
        }
    </style>


    {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
        aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="{{ route('auth.logout') }}" method="post">
                @method('DELETE')
                @csrf
                <button class="bg-transparent border-0 nav-link text-danger px-3" href="#">Keluar</button>
            </form>
        </div>
    </div> --}}
</header>
