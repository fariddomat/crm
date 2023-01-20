@extends('layouts.supervisor')
@section('title')
    Supervisor Dashboard
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supervisor.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor.home') }}">Back office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                Ticket Type Chart
                                <div class="card-actions">
                                    <a href="http://www.chartjs.org">
                                        <small class="text-muted">docs</small>
                                    </a>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="chart-wrapper">
                                    <canvas id="canvas-5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                Inquiries Chart
                                <div class="card-actions">
                                    <a href="http://www.chartjs.org">
                                        <small class="text-muted">docs</small>
                                    </a>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="chart-wrapper">
                                    <canvas id="canvas-2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                Complaints Chart
                                <div class="card-actions">
                                    <a href="http://www.chartjs.org">
                                        <small class="text-muted">docs</small>
                                    </a>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="chart-wrapper">
                                    <canvas id="canvas-3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection

@push('scripts')
    <script>
        console.log('');

        var barChartData = {
            labels: [<?php echo '"' . implode('","', $inquiries_label) . '"'; ?>],
            datasets: [{
                label: 'inquiries',
                backgroundColor: 'rgba(220,220,220,0.5)',
                borderColor: 'rgba(220,220,220,0.8)',
                highlightFill: 'rgba(220,220,220,0.75)',
                highlightStroke: 'rgba(220,220,220,1)',
                data: [<?php echo '"' . implode('","', $inquiries_count) . '"'; ?>]
            }]
        }

        var ctx = document.getElementById('canvas-2');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true
            }
        });

        var barChartData = {
            labels: [<?php echo '"' . implode('","', $complaints_label) . '"'; ?>],
            datasets: [{
                label: 'complaints',
                backgroundColor: 'rgba(220,220,220,0.5)',
                borderColor: 'rgba(220,220,220,0.8)',
                highlightFill: 'rgba(220,220,220,0.75)',
                highlightStroke: 'rgba(220,220,220,1)',
                data: [<?php echo '"' . implode('","', $complaints_count) . '"'; ?>]
            }]
        }

        var ctx = document.getElementById('canvas-3');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true
            }
        });

        var pieData = {
            labels: [
                'complaints',
                'suggestions',
                'inquiries'
            ],
            datasets: [{
                data: [{{ $complaints }}, {{ $suggestions }}, {{ $inquiries }}],
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56'
                ],
                hoverBackgroundColor: [
                    '#00ff00',
                    '#00ff00',
                    '#00ff00'
                ]
            }]
        };
        var ctx = document.getElementById('canvas-5');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true
            }
        });
    </script>
@endpush
