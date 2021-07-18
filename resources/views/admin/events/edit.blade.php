@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Edit Event') }}</h1>

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

<form action="{{ route('events.update', $event->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Nama Event</label>
        <div class="col-sm-10">
            <input name="name" value="{{ $event->name }}" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Waktu</label>
        <div class="col-sm-10">
            <input name="time" value="{{ $event->time }}" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select name="category" class="form-control">
                <option value="Tari" {{ $event->category == 'Tari' ? 'selected' : '' }}>Tari</option>
                <option value="Pentas Musik" {{ $event->category == 'Pentas Musik' ? 'selected' : '' }}>Pentas Musik</option> 
                <option value="Teater" {{ $event->category == 'Teater' ? 'selected' : '' }}>Teater</option>
                <option value="Pameran" {{ $event->category == 'Pameran' ? 'selected' : '' }}>Pameran</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Contact Person</label>
        <div class="col-sm-10">
            <input name="contact_person" value="{{ $event->contact_person }}" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-10">
            <input name="location" value="{{ $event->location }}" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <textarea name="description" class="form-control" rows="8">{{ $event->description }}</textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Penyelenggara</label>
        <div class="col-sm-10">
            <input name="organizer" value="{{ $event->organizer }}" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Harga Tiket</label>
        <div class="col-sm-10">
            <input name="price" value="{{ $event->price }}" type="number" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Kuota</label>
        <div class="col-sm-10">
            <input name="quota" value="{{ $event->quota }}" type="number" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Upload</label>
        <div class="col-sm-10">
            <input name="image" type="file" class="form-control-plaintext">
            <img src="{{ Storage::url($event->image) }}" alt="" height="200">
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