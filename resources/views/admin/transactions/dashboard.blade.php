@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<!-- Main Content goes here -->

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Pembelian Tiket</th>
                        </tr>
                        @foreach($transactions as $index => $trasaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $events[$index]->name }}</td>
                            <td>{{ $trasaction->total }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Paling Laku</h6>
                </div>
                <div class="card-body">
                    <h3 class="font-weight-bold text-center">{{ $events[0]->name }}</h3>
                    <p class="text-center">{{ $transactions[0]->total }} Tiket</p>
                </div>
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