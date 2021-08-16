@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pembayaran</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-center">
        <div class="col-sm-6 m-3">
            <div class="mb-3 p-3 bg-white">
                <p>Silahkan Transfer Ke</p>
                <table class="table">
                    <tr>
                        <td>Metode</td>
                        <td>Transfer BNI</td>
                    </tr>
                    <tr>
                        <td>Nomor</td>
                        <td class="font-weight-bold">1234567</td>
                    </tr>
                    <tr>
                        <td>Total Pembayaran</td>
                        <td>Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
            <div class="mb-3 p-3 bg-white">
                <p>Informasi Penting:</p>
                <ol>
                    <li>Hanya berlaku dengan melakukan pembayaran dll</li>
                    <li>Pastikan Nomor sudah sesuai</li>
                    <li>Pastikan kembali nominal sudah sesuai</li>
                </ol>
            </div>
            <form action="{{ route('customer.transactions.payment.process', $transaction->code) }}" method="post" enctype="multipart/form-data" class="text-right">
                @csrf
                <div class="mb-3 p-3 bg-white text-left">
                    <p>Upload Bukti Transfer</p>
                    @if ($errors->any())
                    <div class="alert alert-danger border-left-danger" role="alert">
                        <ul class="pl-4 my-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input name="proof" type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lanjutkan</button>
            </form>
        </div>
        <div class="col-sm-3 bg-white m-3 h-100 p-5">
            <p>Order ID</p>
            <h1>{{ $transaction->code }}</h1>
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