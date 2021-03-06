@extends('layouts.calendaradmin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Buat Jadwal') }}</h1>

<!-- Main Content goes here -->

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('schedule.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Nama Event</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Waktu Mulai</label>
        <div class="col-sm-10">
            <input name="time" value="{{ $start }}" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Waktu Berakhir</label>
        <div class="col-sm-10">
            <input name="end" value="{{ $end }}" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Contact Person</label>
        <div class="col-sm-10">
            <input name="contact_person" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-10">
            <input name="location" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <textarea name="description" class="form-control" rows="8"></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Penyelenggara</label>
        <div class="col-sm-10">
            <input name="organizer" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <button class="btn btn-primary mx-auto w-25">Simpan</button>
    </div>
</form>

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

@push('css')
<link rel="stylesheet" href="{{ asset('datetimepicker/jquery.datetimepicker.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script>
    $(function() {
        $('.datepicker').datetimepicker();
    });
</script>
@endpush
