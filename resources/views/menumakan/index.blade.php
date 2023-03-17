@extends('layouts.home')


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-2">
                    <div class="card-header">
                        <center><img src="{{ asset('img/logo.png') }}" width="65px" alt="" srcset=""></center>
                        <center>DAFTAR MENU MAKANAN CIVITAS INSTITUT TEKNOLOGI DEL</center>
                        <center>NO: ITD/FBK/-/PR/ITDEL/-/2023</center>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="row">Tanggal</th>
                                    <th>
                                        <center>Pagi</center>
                                    </th>
                                    <th>
                                        <center>Siang</center>
                                    </th>
                                    <th>
                                        <center>Malam</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menumakan as $menu)
                                    <tr>
                                        <td width="20%">{{ date('d M Y', strtotime($menu->tanggal_makan)) }}</td>
                                        <td width="20%">
                                            <center>{!! $menu->menu_pagi !!}</center>
                                        </td>
                                        <td width="20%">
                                            <center>{!! $menu->menu_siang !!}</center>
                                        </td>
                                        <td width="20%">
                                            <center>{!! $menu->menu_malam !!}</center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<style>
    #footer {
        position:absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* Height of the footer */
        background: #367FA9;
        font-family:Arial, Helvetica, sans-serif;
        font-size: 14px;
        color: rgb(231, 231, 231);
        font-weight: lighter;
    }
</style>

<footer class="text-center text-lg-start bg-dark " id="footer">
    <!-- Section: Social media -->
    <!-- Copyright -->
    <div class="text-center p-4" style="background: #367FA9">
        Del Canteen Management System Copyright &copy;
        <script>
            document.write(new Date().getFullYear())
        </script> Kantin Institut Teknologi Del Rights Reserved
    </div>
    <!-- Copyright -->
</footer>

@endsection
