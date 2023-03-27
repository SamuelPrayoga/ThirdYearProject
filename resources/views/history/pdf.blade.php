@extends('layouts.home')


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1>History</h1>
                <div class="form-group">
                    <form action="{{ route('home.pdf.history') }}" method="POST">
                        @csrf
                        <label for="priod_date">Select date range:</label>
                        <select class="form-control" id="priod_date" name="priod_date">
                            @foreach ($priodDate as $date)
                                <option value="{{ $date }}">{{ $date }}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary" name="pdf">Export to PDF</button>
                        <button type="submit" class="btn btn-primary" name="excel">Export to Excel</button>
                    </form>
                </div>
                <table class="table table-bordered" id="exampl" style="width: 100%">
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
    <style>
        .table-inactive {
            background: #878787;
            color: #858585;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    @include('partials.footer')
@endsection
