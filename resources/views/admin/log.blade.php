@extends('layouts.admin')
@section('title')
     Log
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Log</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="col-lg-12">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" id="search" autofocus
                                        value="{{ request()->search }}" aria-describedby="helpId" placeholder="رقم التذكرة">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                    بحث</button>

                            </div>
                        </div>
                    </form>
                </div>
             <div class="col-lg-12" style="margin-top: 15px">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Log
                    </div>
                    <div class="card-block table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>التذكرة</th>
                                    <th>نوع التذكرة</th>
                                    <td>المستخدم</td>
                                    <td>السجل</td>
                                    <th>التاريخ</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $ticket_log)
                                <tr>
                                    <td>{{ $ticket_log->ticket->id }}</td>
                                    <td>{{ $ticket_log->ticket->ticket_type->name }}</td>
                                    <td>{{ $ticket_log->user->name }}</td>
                                    <td>{{ $ticket_log->log }}</td>
                                    <td>{{ $ticket_log->created_at->diffForHumans() }}</td>

                                    <td>
                                        <a href="{{ route('admin.tickets.edit', $ticket_log->ticket->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>@if ($logs->count()==0)
                                <h3>لايوجد بيانات لعرضها</h3>
                                @endif
                        <ul class="pagination">
                            {{$logs->links()}}
                        </ul>
                    </div>
                </div>
            </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
