@extends('layouts.back_office')
@section('title')
    Back office Dashboard
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Back office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row" style="background: white; margin: 0 2px 15px; min-height: 70vh">
                    <div class="col-md-6 offset-md-4" style="margin-bottom: 25px">
                        <img src="{{ asset('dashboard/img/login.png') }}" alt="">
                    </div>
                </div>

            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
