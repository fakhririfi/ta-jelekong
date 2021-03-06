@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Konfirmasi Pemesanan</b></h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-center bg-white">
        <div class="col-4 mb-5">
            <h1 class="text-center font-weight-bold">Informasi Event</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4 overflow-hidden" style="height: 200px;">
                <img src="{{ Storage::url($event->image) }}" class="w-100" style="object-fit: cover;">
            </div>
            <div class="col-sm-4">
                <p>
            <h4 class="font-weight-bold">Nama Event : </h4>
                <h3>{{ $event->name }}</h3>
            </p>
<p>
<h4 class="font-weight-bold">Waktu : </h4>
                {{ date('D d-m-Y H:s', strtotime($event->time)) }}
</p>
                <p>
                    <span class="font-weight-bold">Harga Tiket: </span>
                    Rp. {{ number_format($event->price, 0, ',', '.') }}
                </p>
            </div>
        </div>
        <div class="col-sm-4 mt-5 text-center">
            <p class="font-weight-bold">Jumlah Tiket: </p>
            <p>
                x {{ Request::get('ticket') }}
            </p>
        </div>
        <div class="col-sm-4 mt-5 text-center">
            <p class="font-weight-bold">
                Total Pembayaran:
            </p>
            <p>
                Rp. {{ number_format($event->price*Request::get('ticket'), 0, ',', '.') }}
            </p>
        </div>
    </div>
    <div class="row p-3 mb-3 justify-content-center bg-white">
        <div class="col-sm-12 mb-5">
            <h1 class="text-center font-weight-bold">Detail Pemesanan</h1>
            <h3 class="text-center font-weight">Mohon Konfirmasi Data Anda</h3>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('customer.transactions.confirmation.process', $event->id) }}" method="post" class="row justify-content-center">
            @csrf
            <input name="ticket" value="{{ Request('ticket') }}" type="text" hidden>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="" class="form-label">Titel</label>
                
                <select name="title" class="form-control">
                <option selected="true" value="" disabled="disabled">Pilih Titel</option>
                <option value="Tari">Mr</option>
                <option value="Pentas Musik">Mrs</option>
                <option value="Teater">Lain-lain</option>
            </select>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Depan</label>
                    <input type="text" name="first_name" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Telephone</label>
                    <input type="number" name="phone" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
            </div>
        </form>
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