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
                <div class="col-lg-12">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" id="search" autofocus
                                        value="{{ request()->search }}" aria-describedby="helpId" placeholder="البحث">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="type" class="form-control">
                                        <option value="">كل الأنواع</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ request()->type == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="">الحالة</option>
                                        <option value="open" {{ request()->status == 'open' ? 'selected' : '' }}>مفتوحة</option>
                                        <option value="progress" {{ request()->status == 'progress' ? 'selected' : '' }}>في تقدم</option>
                                        <option value="closed" {{ request()->status == 'closed' ? 'selected' : '' }}>مغلقة</option>

                                    </select>
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
                        <i class="fa fa-align-justify"></i> التذاكر
                    </div>
                    <div class="card-block table-responsive">
<table class="table table-striped ">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>نوع التذكرة</th>
            <td>Agent</td>
            <td>Back office</td>
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
            <td><a href="{{ route('admin.profiles.show', $ticket->profile->id) }}">{{ $ticket->profile->first_name }} {{ $ticket->profile->last_name }}</a></td>
            <td>{{ $ticket->ticket_type->name }}</td>
            <td>
                @if ($ticket->agent)
                {{ $ticket->agent->name }}
            @else
            -----
            @endif</td>
            <td>@if ($ticket->back_office)
                {{ $ticket->back_office->name }}
            @else
            -----
            @endif</td>
            @if ($ticket->ticket_classification)
            <td>{{ $ticket->ticket_classification->name }}</td>
            @else
            <td>-----</td>
            @endif
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
