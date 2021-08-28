@extends('layouts.admin')

@section('main-content')

<!-- Main Content goes here -->

<div class="card7 mb-3 p-3 bg-white">
                <h6><b>Peraturan untuk Admin</b></h6>
                <ol>
                    <li>Event yang sudah dipesan oleh costumer <b>tidak dapat dihapus</b></li>
                    <li>Pastikan tidak membuat event yang berunsur <b>SARA</b></li>
                    <li>Gunakan bahasa yang <b>sopan dan jelas</b> dalam pembuatan event</li>

                </ol>
            </div>

            <br>
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>{{ __('List Event') }}</b></h1>


        <div class="row">   
        <div class="col-sm-6">
            
        <h4 class="mb-4 text-gray-600">List Event untuk tahun {{ Request::get('year') ?? date('Y') }}</h4>
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


<hr>
    @foreach($events as $event)
    <div class="row bg-primary2 text-white p-3 mb-3">
        <div class="col-10">
        <h4 class="mb-0">#{{ $loop->iteration }} {{ $event->name }}</h4>
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
                <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')" class="btn btn-primary2">
                    <i class="fa fa-minus-circle"></i>
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