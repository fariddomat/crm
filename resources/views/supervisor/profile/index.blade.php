@extends('layouts.supervisor')
@section('title')
    Supervisor Profiles
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supervisor.profiles.index') }}">Profiles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor.home') }}">Supervisor</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <a href="{{ route('supervisor.tickets.create') }}" class="btn btn-primary">تذكرة جديدة <i class="fa fa-edit"></i></a>
            <div class="col-lg-12" style="margin-top: 15px">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> الزبائن
                    </div>
                    <div class="card-block table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>عدد التذاكر</th>
                                    <th>التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->first_name }} {{ $profile->last_name }}</td>
                                    <td>{{ $profile->tickets->count() }}</td>
                                    <td>
                                        <a href="{{ route('supervisor.profiles.show', $profile->id) }}" class="btn btn-success btn-sm"><i class="fa fa-ticket"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>@if ($profiles->count()==0)
                                <h3>لايوجد بيانات لعرضها</h3>
                                @endif
                        <ul class="pagination">
                            {{$profiles->links()}}
                        </ul>
                    </div>
                </div>
            </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
