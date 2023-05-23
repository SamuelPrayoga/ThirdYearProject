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
    </style>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Jumlah Mahasiswa Makan</h6>
                        <h4 class="fw-bold">{{ $userCount }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Pagi, Hari: Jumat </h6>
                        <h4 class="fw-bold">{{ $makan_pagi }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Siang, Hari: Jumat </h6>
                        <h4 class="fw-bold">{{ $makan_siang }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Malam, Hari: Jumat </h6>
                        <h4 class="fw-bold">{{ $makan_malam }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Pagi, Hari: Sabtu </h6>
                        <h4 class="fw-bold">{{ $pagi_sabtu }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="fs-6 fw-light">Makan Siang, Hari: Sabtu </h6>
                        <h4 class="fw-bold">{{ $siang_sabtu }}</h4>
                        <p class="text-muted">Mahasiswa</p>
                        <small class="text-muted">Minggu ini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
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
        <div class="container">
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="containers2"></div>
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
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
                    194.1, 95.6, 54.4
                ]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
                    106.6, 92.3
                ]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
                    51.2
                ]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
                    51.1
                ]

            }]
        });
    </script>
        <script>
            Highcharts.chart('containers2', {
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
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
                    name: 'Tokyo',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
                        194.1, 95.6, 54.4
                    ]

                }, {
                    name: 'New York',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
                        106.6, 92.3
                    ]

                }, {
                    name: 'London',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
                        51.2
                    ]

                }, {
                    name: 'Berlin',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
                        51.1
                    ]

                }]
            });
        </script>
@endsection
