@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('List event') }}</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    @foreach($events as $event)
    <div class="row bg-primary text-white p-3">
        <div class="col-10">
            <h3 class="mb-0">Name</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">
                <i class="fa fa-lg fa-edit"></i>
            </a>
        </div>
        <div class="col-1">
            <form action="{{ route('events.destroy', $event->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-primary">
                    <i class="fa fa-lg fa-trash"></i>
                </button>
            </form>
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