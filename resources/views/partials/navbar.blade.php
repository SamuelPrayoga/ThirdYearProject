<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" id="bg">
    {{-- <img src="{{asset('img/logo.png')}}" alt="" width="50px"> --}}
    <a class="col-md-3 col-lg-2 me-0 py-2 px-3 fs-6" href="/">
        <img src="{{ asset('img/logo.png') }}" alt="" width="45px" id="bg">
        <span class="tulisan">Kantin IT Del</span>
    </a>

    <button id="toggleButton"><i class="fas fa-bars"></i></button>
    <style>
        #bg {
            background-color: #367FA9;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tulisan {
            color: white;
            text-decoration: none;
        }
    </style>
    {{-- <style>
        .sidebar {
            overflow-y: auto;
        }
    </style> --}}

</header>
