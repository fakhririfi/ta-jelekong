@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class=""><b>{{ __('List event') }}</b></h1>

<!-- Main Content goes here -->



<div class="container-fluid">

    <div class="row p-3 mb-3">
        <div class="col-12">
            <h3 class="font-weight-bold text-primary mb-4" style="background-color: #ececec;border-radius: 10px;width: 15%;/*! padding: -3.5rem; */text-align: center;padding: 0.5rem;">Filter Event</h3>

        </div>
        <div class="col-12 mb-3">
            <form action="" method="get">
                <select name="month" class="form-control">
                    <option value="1" {{ Request::get('month') == 1 ? 'selected' : '' }}>Januari</option>
                    <option value="2" {{ Request::get('month') == 2 ? 'selected' : '' }}>Februari</option>
                    <option value="3" {{ Request::get('month') == 3 ? 'selected' : '' }}>Maret</option>
                    <option value="4" {{ Request::get('month') == 4 ? 'selected' : '' }}>April</option>
                    <option value="5" {{ Request::get('month') == 5 ? 'selected' : '' }}>Mei</option>
                    <option value="6" {{ Request::get('month') == 6 ? 'selected' : '' }}>Juni</option>
                    <option value="7" {{ Request::get('month') == 7 ? 'selected' : '' }}>Juli</option>
                    <option value="8" {{ Request::get('month') == 8 ? 'selected' : '' }}>Agustus</option>
                    <option value="9" {{ Request::get('month') == 9 ? 'selected' : '' }}>September</option>
                    <option value="10" {{ Request::get('month') == 10 ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ Request::get('month') == 11 ? 'selected' : '' }}>November</option>
                    <option value="12" {{ Request::get('month') == 12 ? 'selected' : '' }}>Desember</option>
                </select>
                <button class="btn btn-primary mt-3">Filter</button>
            </form>
        </div>
        <div class="owl-carousel col-12">
            @foreach($filtered_events as $event)

            <div class="card3" style="width: 23rem;">
                <a href="{{ route('customer.events.show', $event->id) }}" class="text-decoration-none">
                    <div class="overflow-hidden" style="height: 200px;">
                        <img class="card-img-top h-100" src="{{ Storage::url($event->image) }}" alt="Card image cap" style="object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h3 class="font-weight-bold text-primary">{{ $event->name }}</h3>
                        <h5 class="font-weight-normal">{{ Carbon\Carbon::parse($event->time)->locale('id_ID')->isoFormat('LLLL') }}</h5>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>
<hr>
    <div class="row p-3 mb-3">
        <div class="col-12">
        <h3 class="font-weight-bold text-primary mb-4" style="background-color: #ececec;border-radius: 10px;width: 25%;/*! padding: -3.5rem; */text-align: center;padding: 0.5rem;">Acara Yang Tersedia</h3>
        </div>
        <div class="owl-carousel col-12">
            @foreach($current_events as $event)

            <div class="card3" style="width: 23rem;">
                <a href="{{ route('customer.events.show', $event->id) }}" class="text-decoration-none">
                    <div class="overflow-hidden" style="height: 200px;">
                        <img class="card-img-top h-100" src="{{ Storage::url($event->image) }}" alt="Card image cap" style="object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h3 class="font-weight-bold text-primary">{{ $event->name }}</h3>
                        <h5 class="font-weight-normal">{{ Carbon\Carbon::parse($event->time)->locale('id_ID')->isoFormat('LLLL') }}</h5>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>
<hr>
    <div class="row p-3 mb-3">
        <div class="col-12">
        <h3 class="font-weight-bold text-primary mb-4" style="background-color: #ececec;border-radius: 10px;width: 30%;/*! padding: -3.5rem; */text-align: center;padding: 0.5rem;">Acara Yang Akan Datang</h3>
        </div>
        <div class="owl-carousel col-12">
            @foreach($future_events as $event)

            <div class="card3" style="width: 23rem;">
                <a href="{{ route('customer.events.show', $event->id) }}" class="text-decoration-none">
                    <div class="overflow-hidden" style="height: 200px;">
                        <img class="card-img-top h-100" src="{{ Storage::url($event->image) }}" alt="Card image cap" style="object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h3 class="font-weight-bold text-primary">{{ $event->name }}</h3>
                        <h5 class="font-weight-normal">{{ Carbon\Carbon::parse($event->time)->locale('id_ID')->isoFormat('LLLL') }}</h5>
                    </div>
                </a>
            </div>

            @endforeach
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

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
</script>
@endpush

