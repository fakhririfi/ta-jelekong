@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Ticketing</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-center">
        <div class="col-sm-12 m-3">

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