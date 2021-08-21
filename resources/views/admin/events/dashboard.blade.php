@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="mb-2 text-gray-800"><b>{{ __('Dashboard') }}</b></h1>
<div class="row">
    <div class="col-sm-6">
        <h4 class="mb-4 text-gray-600">Dashboard Event untuk tahun {{ Request::get('year') ?? date('Y') }}</h4>
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

<div class="row1">
    <div class="col-sm-4">
        <div class="card2 shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary2">Total Event</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card2 shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary2">Penyelenggara</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="organizerChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card2 shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary2">Kategori</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        let data = JSON.parse('{{ $countData }}')
        var ctx = $("#myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Events",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: data,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return `${tooltipItem.yLabel} ${datasetLabel}`;
                        }
                    }
                }
            }
        });
        let organizerCount = JSON.parse('{{ $organizerCount }}')
        let organizer = JSON.parse('{{ $organizer }}'.replace(/&quot;/g, '"'))
        var ctx2 = $("#organizerChart");
        var myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: organizer,
                datasets: [{
                    label: "Events",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: organizerCount,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return `${tooltipItem.yLabel} ${datasetLabel}`;
                        }
                    }
                }
            }
        });
        let categoryData = JSON.parse('{{ $categoryData }}');
        let categories = JSON.parse('{{ $categories }}'.replace(/&quot;/g, '"'));
        var ctx3 = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: categories,
                datasets: [{
                    data: categoryData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#5b5b5b','#e8e065'],
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
    });
</script>
@endpush