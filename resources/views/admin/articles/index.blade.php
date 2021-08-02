@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('List Article') }}</h1>

<!-- Main Content goes here -->

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-sm-8">

        @foreach($articles as $article)
    <div class="row bg-primary text-white p-3 mb-3">
        <div class="col-10">
            <h3 class="mb-0">{{ $article->title }}</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">
                <i class="fa fa-lg fa-edit"></i>
            </a>
        </div>
        <div class="col-1">
            <form action="{{ route('articles.destroy', $article->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')" class="btn btn-primary">
                    <i class="fa fa-lg fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

    @endforeach
    </div>
        <div class="col-sm-4">
            <h6 class="font-weight-bold">Data Event dan Article</h6>
            <table class="table table-bordered bg-white">
                <tr>
                    <th>Event</th>
                    <th>Status Article</th>
                </tr>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ count($articles->where('event_id', $event->id)) > 0 ? 'Sudah' : 'Belum' }}</td>
                </tr>
                @endforeach
            </table>
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