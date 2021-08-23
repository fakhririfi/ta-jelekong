@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->


<!-- Main Content goes here -->
<div class="card11 bg-white p-5">
    
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800"><b>Acara Yang Tersedia</b></h1>
    <div class="row p-3 mb-3">
        <div class="col-sm-6 overflow-hidden" style="height: 400px;">
            <img src="{{ Storage::url($event->image) }}" class="foto w-100 foto" style="object-fit: cover;">
        </div>
        <div class="col-sm-6" style="text-align: justify;">
            <h3 class="font-weight-bold">{{ $event->name }}</h3>
            <h4 class="font-weight-normal">{{ Carbon\Carbon::parse($event->time)->locale('id_ID')->isoFormat('LLLL') }}</h4>
            <hr>
            <table class="table table-borderless">
            <tr>
                    <td>Tipe Acara</td>
                    <td>:</td>
                    <td>{{ $event->type }}</td>
                </tr>
                <tr>
                    <td>Penyelenggara</td>
                    <td>:</td>
                    <td>{{ $event->organizer }}</td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>:</td>
                    <td>{{ $event->contact_person }}</td>
                </tr>
                <tr>
                    <td>Harga Tiket</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($event->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>{{ $event->description }}</td>
                </tr>
                <tr>
                    <td>Kuota</td>
                    <td>:</td>
                    <td>{{ $event->quota }}</td>
                </tr>
            </table>
            <button type="button" class="btn btn-primary w-50 font-weight-bold p-3 {{ $event->quota <= 0 ? 'disabled' : '' }}" data-toggle="modal" data-target="#exampleModalCenter" {{ $event->quota <= 0 ? 'disabled' : '' }}>
                Pesan
            </button>
        </div>
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