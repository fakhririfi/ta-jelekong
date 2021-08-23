@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>{{ __('List Ticketing') }}</b></h1>

<!-- Main Content goes here -->

<div class="container-fluid">

    <form method="get" class="row mb-3 justify-content-left">
        <div class="col-sm-4 bg-white p-3">
            <label for="" class="mb-2 d-block">Filter Event</label>
            <select name="event_id" class="form-control mb-2">
                @foreach($events as $event)
                <option value="{{ $event->id }}" {{ Request::get('event_id') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-control mb-2">
                <option value="" {{ Request::get('status') == 'all' ? 'selected' : '' }}>Semua</option>
                <option value="paid" {{ Request::get('status') == 'paid' ? 'selected' : '' }}>Sudah Bayar</option>
                <option value="payment" {{ Request::get('status') == 'payment' ? 'selected' : '' }}>Belum Bayar</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    @foreach($transactions as $transaction)
    <div class="row bg-primary2 text-white p-3 mb-3">
        <div class="col-11">
            <h3 class="mb-0">{{ $transaction->code }}</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('customer.transactions.ticketing.show', $transaction->code) }}" class="btn btn-primary">
                <i class="fa fa-lg fa-edit"></i>
            </a>
        </div>

    

    </div>
    @endforeach
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