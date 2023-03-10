@extends('layouts.home')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="mb-2">
                    @include('partials.attendance-badges')
                </div>
                @include('partials.alerts')

                <h1 class="fs-2">{{ $attendance->title }}</h1>
                <p class="text-muted">{{ $attendance->description }}</p>

                <div class="mb-4">
                    <span class="badge text-bg-light border shadow-sm">Waktu Mulai :
                        {{ substr($attendance->data->start_time, 0, -3) }} -
                        {{ substr($attendance->data->batas_start_time, 0, -3) }}</span>
                    <span class="badge text-bg-light border shadow-sm">Waktu Selesai :
                        {{ substr($attendance->data->end_time, 0, -3) }} -
                        {{ substr($attendance->data->batas_end_time, 0, -3) }}</span>
                </div>

                @if (!$attendance->data->is_using_qrcode)
                    <livewire:presence-form :attendance="$attendance" :data="$data" :holiday="$holiday">
                    @else
                        @include('home.partials.qrcode-presence')
                @endif
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Data Makan Mahasiswa 30 Hari Terakhir </h5>
                <h5 class="mb-3">Nama: {{ Auth::user()->name }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu Masuk</th>
                                <th scope="col">Waktu Selesai</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($priodDate as $date)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    {{-- not presence / tidak hadir --}}
                                    @php
                                        $histo = $history->where('presence_date', $date)->first();
                                    @endphp
                                    @if (!$histo)
                                        <td>{{ $date }} </td>
                                        <td colspan="3">
                                            @if ($date == now()->toDateString())
                                                <div class="badge text-bg-warning">Belum Makan</div>
                                            @else
                                                <div class="badge text-bg-danger">Tidak Makan</div>
                                            @endif
                                        </td>
                                    @else
                                        <td>{{ $histo->presence_date }} </td>
                                        <td>{{ $histo->presence_enter_time }} WIB</td>
                                        <td>
                                            @if ($histo->presence_out_time)
                                                {{ $histo->presence_out_time }} WIB
                                            @else
                                                <span class="badge text-bg-danger">Belum Absensi Pulang</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($histo->is_permission)
                                                <div class="badge text-bg-warning">Izin</div>
                                            @else
                                                <div class="badge text-bg-success">Makan</div>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

@endsection
