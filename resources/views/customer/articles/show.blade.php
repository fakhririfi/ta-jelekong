@extends('layouts.admin')

@section('main-content')

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3">
        <div class="col-sm-12">
            <h1 class="font-weight-bold">{{ $article->title }}</h1>
            <p class="small">{{ date('D d-m-Y H:s', strtotime($article->created_at)) }}</p>
        </div>
        <div class="col-sm-12">
            <img src="{{ Storage::url($article->image) }}" class="w-100">
        </div>
        <div class="col-sm-12 my-3">
            <h4>Share On:</h4>
            <div class="sharethis-inline-share-buttons text-left"></div>
        </div>
        @if($event != null)
        <div class="col-sm-12 p-3 bg-white">
            <p>Detail event nya dapat di lihat di : <a href="{{ route('customer.events.show', $event->id) }}">{{ route('customer.events.show', $event->id) }}</a></p>
        </div>
        @endif
        <div class="col-sm-12 p-3 bg-white">
            {!! $article->content !!}
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

@push('js')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60e93c47d2455f00191cee31&product=inline-share-buttons" async="async"></script>
@endpush