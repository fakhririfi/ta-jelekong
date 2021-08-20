@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pembayaran</h1>

<!-- Main Content goes here -->

<div class="container-fluid">
    <div class="row p-3 mb-3 justify-content-center">
        <div class="col-sm-6 m-3">
            <div class="mb-3 p-3 bg-white">
                <table class="table table-borderless">
                    <tr>
                        <td>Titel</td>
                        <td>{{ $transaction->title }}</td>
                    </tr>
                    <tr>
                        <td>Nama Depan</td>
                        <td>{{ $transaction->first_name }}</td>
                    </tr>
                    <tr>
                        <td>Nama Belakang</td>
                        <td>{{ $transaction->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $transaction->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telephone</td>
                        <td>{{ $transaction->phone }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Tiket</td>
                        <td>{{ $transaction->ticket }} Tiket</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $transaction->event->category }}</td>
                    </tr>
                </table>
            </div>
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
                    <p>Countdown Transfer</p>
                    <h2 class="mb-3 text-center font-weight-bold" id="jam"></h2>
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
                    <p>Jika sudah melakukan pembayaran silahkan upload bukti dan hubungi admin di nomor berikut:</p>
                    <h5 class="font-weight-bold text-center">08512345601</h5>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        <div class="col-sm-3 bg-white m-3 h-100 p-5">
            <p>Order ID</p>
            <h1>{{ $transaction->code }}</h1>
            <hr>
            <div class="overflow-hidden" style="height: 100px;">
                <img src="{{ Storage::url($transaction->event->image) }}" class="w-100" style="object-fit: cover;">
            </div>
            <h3 class="font-weight-bold">{{ $transaction->event->name }}</h3>
            <h5 class="font-weight-bold">{{ date('D d-m-Y H:s', strtotime($transaction->event->time)) }}</h5>
            <p>
                <span class="font-weight-bold">Penyelenggara: </span>
                {{ $transaction->event->organizer }}
            </p>
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
    // Set the date we're counting down to
    var countDownDate = new Date("{{ Carbon\Carbon::parse($transaction->updated_at)->addHour(2) }}").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display the result in the element with id="demo"
        document.getElementById("jam").innerHTML = `${hours} Jam : ${minutes} Menit : ${seconds} Detik`;
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("jam").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
@endpush