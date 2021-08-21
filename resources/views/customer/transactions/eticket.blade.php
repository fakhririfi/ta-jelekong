<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

</head>

<body id="page-top" onload="window.print();">
    <div class="container-fluid">
        <div class="row p-3 mb-3 justify-content-center">
            <div class="col-sm-6 m-3">
                <div class="card mb-3 bg-white">
                    <div class="card-header bg-primary text-white">
                        Detail Reservasi
                    </div>
                    <div class="card-body">
                        <p>Status Transaksi</p>
                        <h4 class="font-weight-bold">{{ ucwords($transaction->status) }}</h4>
                        <p>Tanggal Pesan</p>
                        <h4 class="font-weight-bold">{{ date('D d-m-Y H:s', strtotime($transaction->created_at)) }}</h4>
                        <p>Order ID</p>
                        <h4 class="font-weight-bold">{{ $transaction->code }}</h4>
                        <p>Pemesanan</p>
                        <h4 class="font-weight-bold">{{ $transaction->ticket }} Tiket</h4>
                    </div>
                </div>
                <div class="card mb-3 bg-white">
                    <div class="card-header bg-primary text-white">
                        Detail Acara
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                            <td colspan="2">
                                <div class="overflow-hidden mb-3" style="height: 200px;">
                                    <img src="{{ Storage::url($transaction->event->image) }}" class="w-100" style="object-fit: cover;">
                                </div>
                            </tr>
                            </td>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $transaction->event->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Acara</td>
                                <td>{{ date('D d-m-Y H:s', strtotime($transaction->event->time)) }}</td>
                            </tr>
                            <tr>
                                <td>Penyelenggara</td>
                                <td>{{ $transaction->event->organizer }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{ $transaction->event->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card mb-3 bg-white">
                    <div class="card-header bg-primary text-white">
                        Detail Pelanggan
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>Titel</td>
                                <td>{{ $transaction->title }}</td>
                            </tr>
                            <tr>
                                <td>Nama Depan</td>
                                <td>{{ $transaction->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Nama Belakang</td>
                                <td>{{ $transaction->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $transaction->email }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telephone</td>
                                <td>{{ $transaction->phone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card mb-3 bg-white">
                    <div class="card-header bg-primary text-white">
                        Detail Pembayaran
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>Harga</td>
                                <td>Rp. {{ number_format($transaction->amount - 2000, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Biaya Layanan</td>
                                <td>Rp. {{ number_format(2000, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td>Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>