@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Acara Yang Tersedia</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3">
        <div class="col-sm-6 overflow-hidden" style="height: 400px;">
            <img src="{{ Storage::url($event->image) }}" class="w-100" style="object-fit: cover;">
        </div>
        <div class="col-sm-6">
            <h3 class="font-weight-bold">{{ $event->name }}</h3>
            <h3 class="font-weight-bold">{{ date('D d-m-Y H:s', strtotime($event->time)) }}</h3>
            <p>
                <span class="font-weight-bold">Penyelenggara: </span>
                {{ $event->organizer }}
            </p>
            <p>
                <span class="font-weight-bold">Harga Tiket: </span>
                Rp. {{ number_format($event->price, 0, ',', '.') }}
            </p>
            <p class="font-weight-bold">Deskripsi</p>
            <p>{{ $event->description }}</p>
            <p>
                <span class="font-weight-bold">Kuota: </span>
                {{ $event->quota }}
            </p>
            <button type="button" class="btn btn-primary w-50 font-weight-bold p-3 {{ $event->quota <= 0 ? 'disabled' : '' }}" data-toggle="modal" data-target="#exampleModalCenter" {{ $event->quota <= 0 ? 'disabled' : '' }}>
                Pesan
            </button>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('customer.transactions.confirmation', $event->id) }}" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Masukan Jumlah Tiket</label>
                        <input type="number" class="form-control" name="ticket">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
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