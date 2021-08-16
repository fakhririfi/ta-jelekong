@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<!-- Main Content goes here -->

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-4 text-gray-600">Dashboard untuk tahun {{ Request::get('year') ?? date('Y') }}</h3>
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

    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Pembelian Tiket</th>
                        </tr>
                        @foreach($transactions as $index => $trasaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $events[$index]->name }}</td>
                            <td>{{ $trasaction->total }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Paling Laku</h6>
                </div>
                <div class="card-body">
                    <h3 class="font-weight-bold text-center">{{ count($events) > 0 ? $events[0]->name : 'Tidak Ada Event' }}</h3>
                    <p class="text-center">{{ count($transactions) > 0 ? $transactions[0]->total : 0 }} Tiket</p>
                </div>
            </div>
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
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    let eventsTotal = JSON.parse('{{ $eventsTotal }}'.replace(/&quot;/g, '"'));
    let events = JSON.parse('{{ $eventsName }}'.replace(/&quot;/g, '"'));
    var ctx3 = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: events,
            datasets: [{
                data: eventsTotal,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
        },
    });
</script>
@endpush