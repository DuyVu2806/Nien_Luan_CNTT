@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h2>{{ session('message') }}</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard</h2>
                <p class="m-md-0">Your analytics dashboard template</p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3 rounded">
                        <label for="">TOTAL ORDER</label>
                        <h1>{{ $totalOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">view</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-info text-white mb-3 rounded">
                        <label for="">TOTAL SALES</label>
                        <h1>$ {{ $totalPrice }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">view</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-secondary text-white mb-3 rounded">
                        <label for="">TODAY'S TOTAL SALES</label>
                        <h1>$ {{ $today_sales }}</h1>
                        <a href="{{ url('admin/orders/?date=' . now()->format('Y-m-d')) }}" class="text-white">view</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3 rounded">
                        <label for="">TOTAL REVIEWS</label>
                        <h1>{{ $total_reviews }}</h1>
                        <a href="{{ url('admin/review') }}" class="text-white">view</a>
                    </div>
                </div>
            </div>
        </div>
        @php
            $data = [];
            foreach ($orderItems as $item) {
                $year = $item->year;
                $month = $item->month;
                $quantity = $item->monthly_revenue;
                if (!isset($data[$year])) {
                    $data[$year] = [];
                }
                $data[$year][$month] = $quantity;
            }
            foreach ($data as $year => $months) {
                for ($month = 1; $month <= 12; $month++) {
                    if (!isset($data[$year][$month])) {
                        $data[$year][$month] = 0;
                    }
                }
            }
        @endphp
        @php
            $labelsPie = [];
            foreach ($categoriesBought as $key => $item) {
                $labelsPie[$key] = $item->name;
            }
            $labelsPie = array_values($labelsPie);
            $dataPie = [];
            foreach ($quantityByCategory as $key => $item) {
                $dataPie[$key] = $item->quantity;
            }
            $dataPie = array_values($dataPie);
        @endphp
        <div class="row mb-5">
            <div class="col-md-8">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-md-4" style="height: 400px; ">
                <canvas id="myChartPie"></canvas>
            </div>
        </div>
    @endsection
    @section('name')
    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

        <script>
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Arp', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Ocp', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Statistics on products sold in 2023',
                        data: [
                            {{ $data[2023][1] }}, {{ $data[2023][2] }}, {{ $data[2023][3] }},
                            {{ $data[2023][4] }}, {{ $data[2023][5] }}, {{ $data[2023][6] }},
                            {{ $data[2023][7] }}, {{ $data[2023][8] }}, {{ $data[2023][9] }},
                            {{ $data[2023][10] }}, {{ $data[2023][11] }}, {{ $data[2023][12] }},
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.2,
                            fill: false,
                            backgroundColor: 'rgba(54, 162, 235, 1)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                fontColor: 'black'
                            }
                        }
                    }
                }
            });
            
            const ctxP = document.getElementById('myChartPie');
            new Chart(ctxP, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($labelsPie) !!},
                    datasets: [{
                        label: 'Quantity of products by category',
                        data: {!! json_encode($dataPie) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        customCanvasBackgroundColor: {
                            color: 'lightGreen',
                        }
                    }
                },
                plugins: {
                    id: 'customCanvasBackgroundColor',
                    beforeDraw: (chart, args, options) => {
                        const {
                            ctx
                        } = chart;
                        ctx.save();
                        ctx.globalCompositeOperation = 'destination-over';
                        ctx.fillStyle = options.color || '#99ffff';
                        ctx.fillRect(0, 0, chart.width, chart.height);
                        ctx.restore();
                    }
                },
            });
        </script>
    @endsection
