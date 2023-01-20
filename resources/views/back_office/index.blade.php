@extends('layouts.back_office')
@section('title')
    Back office Dashboard
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Back office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-primary">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="icon-puzzle"></i>
                                </div>
                                <h4 class="m-b-0">{{ $tickets }}</h4>
                                <p>All Tickets</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-success">
                            <div class="card-block p-b-0">
                                <button type="button" class="btn btn-transparent active p-a-0 pull-left">
                                    <i class="icon-puzzle"></i>
                                </button>
                                <h4 class="m-b-0">{{ $opendTickets }}</h4>
                                <p>Opend Tickets</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-warning">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="icon-puzzle"></i>
                                </div>
                                <h4 class="m-b-0">{{ $myTickets }}</h4>
                                <p>My Tickets</p>
                            </div>
                            <div class="chart-wrapper" style="height:70px;">
                                <canvas id="card-chart3" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-danger">
                            <div class="card-block p-b-0">
                                <div class="btn-group pull-left">
                                    <i class="icon-user"></i>
                                </div>
                                <h4 class="m-b-0">{{ $customers }}</h4>
                                <p>Customers</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart4" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/col-->

                </div>
                <!--/row-->
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
