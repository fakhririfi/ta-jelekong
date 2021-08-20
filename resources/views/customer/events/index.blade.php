@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('List event') }}</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary mb-4">Acara Yang Tersedia</h2>
        </div>
        <div class="owl-carousel col-12">
            @foreach($current_events as $event)

            <div class="relative">
                <a href="{{ route('customer.events.show', $event->id) }}" class="text-decoration-none">
                    <div class="text-white ml-3" style="position:absolute; bottom: 0; left: 0;">
                        <h3 class="font-weight-bold text-primary">{{ $event->name }}</h3>
                        <h3 class="font-weight-bold text-primary">{{ date('D d-m-Y H:s', strtotime($event->time)) }}</h3>
                    </div>
                    <div class="overflow-hidden" style="height: 350px; width: 350px;">
                        <img src="{{ Storage::url($event->image) }}" class="h-100" style="object-fit: cover;">
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>

    <div class="row p-3 mb-3">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary mb-4">Acara Yang Akan Datang</h2>
        </div>
        <div class="owl-carousel col-12">
            @foreach($future_events as $event)

            <div class="relative">
                <a href="{{ route('customer.events.show', $event->id) }}" class="text-decoration-none">
                    <div class="text-white ml-3" style="position:absolute; bottom: 0; left: 0;">
                        <h3 class="font-weight-bold text-primary">{{ $event->name }}</h3>
                        <h3 class="font-weight-bold text-primary">{{ date('D d-m-Y H:s', strtotime($event->time)) }}</h3>
                    </div>
                    <div class="overflow-hidden" style="height: 350px; width: 350px;">
                        <img src="{{ Storage::url($event->image) }}" class="h-100" style="object-fit: cover;">
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