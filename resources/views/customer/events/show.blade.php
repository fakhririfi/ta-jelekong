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
        <div class="col-sm-6" style="text-align: justify;">
            <h3 class="font-weight-bold">{{ $event->name }}</h3>
            <h4 class="font-weight-bold">{{ Carbon\Carbon::parse($event->time)->locale('id_ID')->isoFormat('LLLL') }}</h4>
            <table class="table table-borderless">
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
            <a href="#" class="btn btn-primary w-50 font-weight-bold p-3 {{ $event->quota <= 0 ? 'disabled' : '' }}" {{ $event->quota <= 0 ? 'disabled' : '' }}>
                Pesan
            </a>
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
