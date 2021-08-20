@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Cari Tiket</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-left">
        <div class="col-sm-4 m-3 bg-white p-5">
            <p>Cek Pesanan Disini</p>
            @if ($errors->any())
            <div class="alert alert-danger border-left-danger" role="alert">
                <ul class="pl-4 my-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('customer.transactions.ticketing.search') }}" method="post" class="row justify-content-center">
                @csrf
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Masukan Order ID</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Cek Pesanan</button>
                </div>
            </form>
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
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $(this).siblings(".custom-file-label").css("overflow", "hidden");
        $(this).siblings(".custom-file-label").css("white-space", "nowrap");
        $(this).siblings(".custom-file-label").css("text-overflow", "ellipsis");
    });
</script>
@endpush