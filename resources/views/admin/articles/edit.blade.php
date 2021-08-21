@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Edit Article') }}</h1>

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

<form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Judul Article</label>
        <div class="col-sm-10">
            <input name="title" value="{{ $article->title }}" type="text" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Total Pengunjung</label>
        <div class="col-sm-10">
            <input name="visitor" value="{{ $article->visitor }}" type="text" class="form-control" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Event</label>
        <div class="col-sm-10">
            <select name="event_id" class="form-control">
                @if($article->event_id != null){
                    <option value="">Tidak Ada Event</option>
                    @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $event->id == $article->event_id ? 'selected' : '' }}>{{ $event->name }}</option>
                    @endforeach
                @else
                    <option value="" selected>Tidak Ada Event</option>
                    @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                @endif

            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Waktu</label>
        <div class="col-sm-10">
            <input name="time" value="{{ $article->post_date }}" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
            <textarea name="content" class="form-control ckeditor">{{ $article->content }}</textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Upload</label>
        <div class="col-sm-10">
            <input name="image" type="file" class="form-control-plaintext">
            <img src="{{ Storage::url($article->image) }}" alt="" height="200">
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
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>

<script src="{{ asset('datetimepicker/jquery.datetimepicker.full.min.js') }}"></script> 
<script>
    $(function() {
        $('.datepicker').datetimepicker();
    });
</script>
@endpush