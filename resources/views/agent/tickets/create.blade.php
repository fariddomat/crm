@extends('layouts.agent')
@section('title')
    New Ticket
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('agent.tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agent.home') }}">Agent</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <form action="{{ route('agent.tickets.profile') }}" method="POST">
                                @csrf
                                @include('layouts._error')

                            <div class="card-header">
                                <strong>طلب جديد</strong>
                            </div>
                            <div class="card-block">
                                <div class="form-group col-sm-6">
                                    <label for="phone_number">رقم الهاتف</label>
                                    <input type="text" dir="ltr" class="form-control" id="phone_number" name="phone_number" placeholder="+966">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> التالي</button>
                            </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
