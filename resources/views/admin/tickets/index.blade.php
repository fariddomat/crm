@extends('layouts.admin')
@section('title')
     Tickets
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
             <div class="col-lg-12" style="margin-top: 15px">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> التذاكر
                    </div>
                    <div class="card-block table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>نوع التذكرة</th>
                                    <th>التصنيف</th>
                                    <th>تاريخ الفتح</th>
                                    <th>تاريخ الاغلاق</th>
                                    <th>الحالة</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->profile->first_name }} {{ $ticket->profile->last_name }}</td>
                                    <td>{{ $ticket->ticket_type->name }}</td>
                                    <td>{{ $ticket->ticket_classification->name }}</td>
                                    <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                    <td>@if ($ticket->status=='closed')
                                        {{ $ticket->updated_at->diffForHumans() }}
                                    @else
                                        ----------
                                    @endif</td>
                                    <td>
                                        <span class="tag @if ($ticket->status == 'open')
                                        tag-success
                                        @elseif ($ticket->status == 'progress')
                                        tag-warning
                                        @else
                                        tag-danger
                                        @endif">{{ $ticket->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>@if ($tickets->count()==0)
                                <h3>لايوجد بيانات لعرضها</h3>
                                @endif
                        <ul class="pagination">
                            {{$tickets->links()}}
                        </ul>
                    </div>
                </div>
            </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
