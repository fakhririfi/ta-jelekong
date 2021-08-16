@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>{{ __('List event') }}</b></h1>

<!-- Main Content goes here -->

<div class="container-fluid">


<div class="row">
        <div class="col-sm-6">
            <h3 class="mb-4 text-gray-600">List Event untuk tahun {{ Request::get('year') ?? date('Y') }}</h3>
        </div>
        <div class="col-sm-6">
            <form action="" method="get" class="text-right">
                <select name="year" class="form-control w-50 d-inline">
                    <option value="2021" {{ Request::get('year') == '2021' ? 'selected' : '' }}>2021</option>
                    <option value="2022" {{ Request::get('year') == '2022' ? 'selected' : '' }}>2022</option>
                    <option value="2023" {{ Request::get('year') == '2023' ? 'selected' : '' }}>2023</option>
                    <option value="2024" {{ Request::get('year') == '2024' ? 'selected' : '' }}>2024</option>
                </select>
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    @foreach($events as $event)
    <div class="row bg-primary2 text-white p-3 mb-3">
        <div class="col-10">
        <h3 class="mb-0">#{{ $loop->iteration }} {{ $event->name }}</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">
                <i class="fa fa-lg fa-edit"> Edit </i>
            </a>
        </div>
        <div class="col-1">
            <form action="{{ route('events.destroy', $event->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')" class="btn btn-primary2">
                    <i class="fa fa-minus-circle"> Hapus </i>
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
