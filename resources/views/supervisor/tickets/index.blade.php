@extends('layouts.supervisor')
@section('title')
    Tickets
@endsection
@section('styles')
    <link href="{{ asset('dashboard/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/removeSortingDataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/datatablesStyles.css') }}" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <!-- JS -->


    <script src="{{ asset('dashboard/js/datatables.min.js') }}" defer></script>
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js" defer></script>

    <!-- Buttons -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js" defer>
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js" defer></script>

    <!-- JSZip -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>

    <!-- pdfmake -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js" defer>
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" defer></script>

    <!-- html2canvas -->
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['print',
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('sheet', sheet).attr('rightToLeft', 'true');
                }
                    }
                ]
            });
        });
    </script>
@endpush
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('supervisor.tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor.home') }}">Supervisor</a>
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
                                        <option value="open" {{ request()->status == 'open' ? 'selected' : '' }}>مفتوحة
                                        </option>
                                        <option value="progress" {{ request()->status == 'progress' ? 'selected' : '' }}>في
                                            تقدم</option>
                                        <option value="closed" {{ request()->status == 'closed' ? 'selected' : '' }}>مغلقة
                                        </option>

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
                            <table id="dataTable" class="table table-striped ">
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
                                            <td><a href="{{ route('supervisor.profiles.show', $ticket->profile->id) }}">{{ $ticket->profile->first_name }}
                                                    {{ $ticket->profile->last_name }}</a></td>
                                            <td>{{ $ticket->ticket_type->name }}</td>
                                            <td>
                                                @if ($ticket->agent)
                                                    {{ $ticket->agent->name }}
                                                @else
                                                    -----
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ticket->back_office)
                                                    {{ $ticket->back_office->name }}
                                                @else
                                                    -----
                                                @endif
                                            </td>
                                            @if ($ticket->ticket_classification)
                                                <td>{{ $ticket->ticket_classification->name }}</td>
                                            @else
                                                <td>-----</td>
                                            @endif
                                            <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($ticket->status == 'closed')
                                                    {{ $ticket->updated_at->diffForHumans() }}
                                                @else
                                                    ----------
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="tag @if ($ticket->status == 'open') tag-success
                                        @elseif ($ticket->status == 'progress')
                                        tag-warning
                                        @else
                                        tag-danger @endif">{{ $ticket->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('supervisor.tickets.edit', $ticket->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @if ($tickets->count() == 0)
                                <h3>لايوجد بيانات لعرضها</h3>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
