@extends('layouts.app')

@section('content')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #containers {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .card.shadow {
            transition: transform 0.3s ease-in-out;
        }

        .card.shadow:hover {
            transform: scale(1.05);
        }
    </style>
    <div>
        @if ($alergiBaruCount > 0)
            <div class="alert alert-warning">
                Anda memiliki {{ $alergiBaruCount }} Laporan baru yang perlu dikonfirmasi mengenai alergi makanan oleh
                mahasiswa <a href="{{ route('admin.allergy-reports.index') }}">Konfirmasi Sekarang</a>
            </div>
        @else
        @endif
        @if ($izinMakan > 0)
            <div class="alert alert-danger">
                Anda memiliki {{ $izinMakan }} Izin Makan dari Mahasiswa baru yang perlu dikonfirmasi<a href="/presences/{attendance}/permissions"> Konfirmasi Sekarang</a>
            </div>
        @else
        @endif
        @if ($izinIB > 0)
            <div class="alert alert-danger">
                Anda memiliki {{ $izinIB }} Data Laporan Izin Bermalam perlu diperiksa<a href="{{ route('admin.lapmakan.index') }}"> Periksa Sekarang</a>
            </div>
        @else
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="card shadow bg-primary text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-users"></i> Jumlah Seluruh Mahasiswa
                        </h6>
                        <h4 class="fw-bold">{{ $userCount }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow bg-info text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-calendar-check"></i> Jumlah Mahasiswa IB Hari ini
                        </h6>
                        <h4 class="fw-bold">{{ $userIB }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow bg-success text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-utensils"></i> Jumlah Porsi Makan Hari ini
                        </h6>
                        <h4 class="fw-bold">{{ $mahasiswaMakan }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow bg-danger text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-allergies"></i> Jumlah Mahasiswa Alergi
                        </h6>
                        <h4 class="fw-bold">{{ $userAllergy }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow bg-warning text-dark">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-coffee"></i> Menu Makan Pagi
                        </h6>
                        @if ($menus)
                            <p>{!! $menus->menu_pagi !!}</p>
                        @else
                            <p class="text-muted">Belum ada menu pagi hari ini.</p>
                        @endif
                        <p class="text-muted">Hari ini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow bg-secondary text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-utensil-spoon"></i> Menu Makan Siang
                        </h6>
                        @if ($menus)
                            <p>{!! $menus->menu_siang !!}</p>
                        @else
                            <p class="text-muted">Belum ada menu siang hari ini.</p>
                        @endif
                        <p class="text-muted">Hari ini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow bg-primary text-white">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">
                            <i class="fas fa-utensils-alt"></i> Menu Makan Malam
                        </h6>
                        @if ($menus)
                            <p>{!! $menus->menu_malam !!}</p>
                        @else
                            <p class="text-muted">Belum ada menu malam hari ini.</p>
                        @endif
                        <p class="text-muted">Hari ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="containers">
        <div class="row">
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="containers"></div>
                    <p class="highcharts-description">
                        {{-- ini description --}}
                    </p>
                </figure>
            </div>
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="containers1"></div>
                    <p class="highcharts-description">
                        {{-- ini description --}}
                    </p>
                </figure>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="containers2"></div>
                    <p class="highcharts-description">
                        {{-- ini description --}}
                    </p>
                </figure>
            </div>
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="containers3"></div>
                    <p class="highcharts-description">
                        {{-- ini description --}}
                    </p>
                </figure>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        var allergyData = @json($approvedData);
        var pendingData = @json($pendingData);

        // Membuat array untuk menyimpan nama bulan sesuai dengan index
        var monthNames = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        // Mengubah data bulan pada sumbu x menjadi nama bulan dari data yang diambil
        var categories = allergyData.map(function(data) {
            var monthIndex = parseInt(data.month) - 1; // Mengurangi 1 karena indeks dimulai dari 0
            return monthNames[monthIndex];
        });

        Highcharts.chart('containers', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Alergi Makanan'
            },
            subtitle: {
                text: 'Sumber: Kantin IT Del'
            },
            xAxis: {
                categories: categories, // Menggunakan array categories yang baru
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (Mahasiswa)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Mahasiswa</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Approved',
                data: allergyData.map(function(data) {
                    return data.count;
                })
            }, {
                name: 'Pending',
                data: pendingData.map(function(data) {
                    return data.count;
                })
            }]
        });
    </script>
    <script>
        Highcharts.chart('containers1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Data Mahasiswa Alergi berdasarkan Jenis Alergi'
            },
            subtitle: {
                text: 'Source: Kantin IT Del'
            },
            xAxis: {
                categories: [
                    'Ikan Laut',
                    'Telur',
                    'Ikan Lele',
                    'Seafood',
                    'Makanan Pedas',
                    'Daging Kerbau/Sapi/Kambing',
                    'Daging Ayam',
                    'Ikan Mas',
                    'Daun Singkong',
                    'Terung',
                    'Jamur',
                    'Kikil',
                    'Kacang Kedelai',
                    'Kacangan',
                    'Ikan Mujahir',
                    'Nenas',
                    'Pepaya',
                    'Gori'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (Mahasiswa)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Mahasiswa</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Jumlah Alergi',
                data: [{{ $countAllergiesLaut }}, {{ $countAllergiesTelur }}, {{ $countAllergiesLele }},
                    {{ $countAllergiesSeafood }}, {{ $countAllergiesPedas }},
                    {{ $countAllergiesDagingSapi }}, {{ $countAllergiesAyam }},
                    {{ $countAllergiesIkanMas }}, {{ $countAllergiesDaunSingkong }},
                    {{ $countAllergiesTerung }}, {{ $countAllergiesJamur }},
                    {{ $countAllergiesKikil }}
                ]

            }]
        });
    </script>
    {{-- <script>
        var kebersihanData = @json($kebersihanData);
        var pendingData = @json($pendingData);

        // Membuat array untuk menyimpan nama bulan sesuai dengan index
        var monthNames = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        // Mengubah data bulan pada sumbu x menjadi nama bulan dari data yang diambil
        var categories = allergyData.map(function(data) {
            var monthIndex = parseInt(data.month) - 1; // Mengurangi 1 karena indeks dimulai dari 0
            return monthNames[monthIndex];
        });
        var categories = kebersihanData.map(function(data) {
            var monthIndex = parseInt(data.month) - 1; // Mengurangi 1 karena indeks dimulai dari 0
            return monthNames[monthIndex];
        });

        Highcharts.chart('containers2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Penilaian Kritik dan Saran Kantin'
            },
            subtitle: {
                text: 'Sumber: Kantin IT Del'
            },
            xAxis: {
                categories: categories, // Menggunakan array categories yang baru
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (Mahasiswa)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Mahasiswa</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Kebersihan Kantin',
                data: kebersihanData.map(function(data) {
                    return data.count;
                })
            }, {
                name: 'Pelayanan Kantin',
                data: pendingData.map(function(data) {
                    return data.count;
                })
            }, {
                name: 'Menu Makanan',
                data: pendingData.map(function(data) {
                    return data.count;
                })
            }, {
                name: 'Sistem Informasi Kantin',
                data: pendingData.map(function(data) {
                    return data.count;
                })
            }]
        });
    </script> --}}
@endsection
