@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class=""><b>{{ __('List Article') }}</b></h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3">
        @foreach($articles as $article)
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body bg-primary">
                    <h5 class="card-title text-white font-weight-bold">{{ $article->title }}</h5>
                    <p class="small text-white">{{ date('D d-m-Y H:s', strtotime($article->created_at)) }}</p>
                    <a href="{{ route('customer.articles.show', $article->id) }}" class="btn btn-outline-light">Lihat</a>
                </div>
            </div>
        </div>
        @endforeach
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