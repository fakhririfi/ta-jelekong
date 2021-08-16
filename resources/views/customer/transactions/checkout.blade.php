@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Checkout</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-center">
        <div class="col-sm-6 m-3">
            <div class="mb-3 p-3 bg-white">
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
                    <tr>
                        <td>Jumlah Tiket</td>
                        <td>{{ $transaction->ticket }} Tiket</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $transaction->event->category }}</td>
                    </tr>
                </table>
            </div>
            <div class="mb-3 p-3 bg-white">
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
            <div class="mb-3 p-3 bg-white">
                <p>Informasi Penting:</p>
                <ol>
                    <li>Hanya berlaku dengan melakukan pembayaran dll</li>
                    <li>Pastikan Nomor sudah sesuai</li>
                    <li>Pastikan kembali nominal sudah sesuai</li>
                </ol>
            </div>
            <div class="mb-3 p-3 bg-white text-center">
                <p>Silahkan bayar ke nomer rekening</p>
                <h2 class="font-weight-bold">1234567</h2>
                <h3>BNI</h3>
            </div>
            <form action="{{ route('customer.transactions.checkout.process', $transaction->code) }}" method="post" class="text-right">
                @csrf
                <button type="submit" class="btn btn-primary">Lanjutkan</button>
            </form>
        </div>
        <div class="col-sm-3 bg-white m-3 h-100 p-5">
            <p>Order ID</p>
            <h1>{{ $transaction->code }}</h1>
            <hr>
            <div class="overflow-hidden" style="height: 100px;">
                <img src="{{ Storage::url($transaction->event->image) }}" class="w-100" style="object-fit: cover;">
            </div>
            <h3 class="font-weight-bold">{{ $transaction->event->name }}</h3>
            <h5 class="font-weight-bold">{{ date('D d-m-Y H:s', strtotime($transaction->event->time)) }}</h5>
            <p>
                <span class="font-weight-bold">Penyelenggara: </span>
                {{ $transaction->event->organizer }}
            </p>
        </div>
    </div>
</div>

<!-- End of Main Content -->
@endsection

@push('notif')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endpush