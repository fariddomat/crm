@extends('layouts.back_office')
@section('title')
    New Ticket
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Types</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Back Office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">

                                <div class="card-header">
                                    <strong>تفاصيل التذكرة</strong>
                                </div>

                                <div class="card-block">
                                    <form action="{{ route('agent.tickets.store') }}" method="post" class="form-horizontal "
                                        enctype="multipart/form-data">
                                        @csrf
                                        @include('layouts._error')                  <input type="hidden" name="profile_id" value="{{ $profile_id }}" id="">
                                        <input type="hidden" name="ticket_type_id" value="{{  $ticket_type_id }}"
                                            id="">

                                        @if ($ticket_type_id!=3)
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">التصنيف</label>
                                            <div class="col-md-8">
                                                <select name="ticket_classification_id" id="" class="form-control">
                                                    @foreach ($classification as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">
                                                @if ($ticket_type_id!=3)
                                                التعليق
                                                @else
                                                المقترح
                                                @endif
                                                </label>
                                            <div class="col-md-8">
                                                <input type="text" id="comments" name="comments"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">المرفقات</label>
                                            <div class="col-md-8">
                                                <input type="file" multiple id="attachments" name="attachments"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <input type="hidden" name="agent_id" value="{{ Auth::id() }}">


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-dot-circle-o"></i>
                                                حفظ</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                                مسح الحقول</button>
                                        </div>
                                    </form>
                                </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
