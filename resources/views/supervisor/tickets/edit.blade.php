@extends('layouts.supervisor')
@section('title')
    Edit Ticket
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>edit</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor.tickets.index') }}">Tickets</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor.home') }}">Supervisore</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6">

                        <div class="card">

                                <div class="card-header">
                                    <strong>تفاصيل التذكرة</strong>
                                </div>

                                <div class="card-block">
                                    <form action="{{ route('supervisor.tickets.update',$ticket->id) }}" method="post" class="form-horizontal "
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @include('layouts._error')

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">نوع التذكرة</label>
                                            <div class="col-md-8">
                                                <select name="" id="" class="form-control" disabled>
                                                        <option>{{ $ticket->ticket_type->name }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        @if ($ticket->ticket_classification)

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">التصنيف</label>
                                            <div class="col-md-8">
                                                <select name="" id="" class="form-control" disabled>
                                                        <option>{{ $ticket->ticket_classification->name }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">
                                                @if ($ticket->ticket_type_id!=3)
                                                التعليق
                                                @else
                                                المقترح
                                                @endif
                                                </label>
                                            <div class="col-md-8">
                                                <input type="text" id="comments" name="comments"
                                                    class="form-control" value="{{ $ticket->comments }}" disabled>
                                            </div>
                                        </div>

                                        @if ($ticket->status=='progress')
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">تحديد Back Office</label>
                                            <div class="col-md-8">
                                                <select name="back_office_id" id="" class="form-control">
                                                    @foreach ($back_offices as $item)
                                                    <option value="{{ $item->id }}" @if ($ticket->back_office_id ==$item->id)
                                                        selected
                                                    @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif


                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">المرفقات</label>
                                            <div class="col-md-8">
                                                @foreach ($ticket->ticket_attachments as $index=>$item)
                                               <a href="/files/{{ $ticket->id }}/{{ $item->file }}"><img class="col-md-4" src="/files/{{ $ticket->id }}/{{ $item->file }}" alt="File {{ $index+1 }}"></a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">حالة التذكرة</label>
                                            <div class="col-md-8">
                                                <select name="status" id="" class="form-control">
                                                    {{-- <option value="open">مفتوحة</option> --}}
                                                    <option value="progress">مستمرة</option>
                                                    <option value="closed">مغلقة</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">مصدر التذكرة</label>
                                            <div class="col-md-8">
                                                <input type="text"  id="ticket_source" name="ticket_source"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">ملاحظات</label>
                                            <div class="col-md-8">
                                                <textarea name="request_description" id="request_description" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="">العميل Agent</label>
                                            <div class="col-md-8">
                                                <span>{{ $ticket->agent->name }}</span>
                                            </div>
                                        </div>

                                        @if ($ticket->status != 'closed')
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-dot-circle-o"></i>
                                                حفظ</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                                مسح الحقول</button>
                                        </div>
                                        @else
                                        <div class="card-footer">
                                            <a href="{{ route('supervisor.tickets.index') }}" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-home"></i>
                                                عودة</a>
                                        </div>
                                        @endif
                                    </form>
                                </div>

                        </div>

                    </div>
                    <div class="col-sm-6">

                        <div class="card">
                            <div class="card-header">
                                <strong>بيانات المستخدم</strong>
                            </div>
                            <div class="card-block">
                                <form
                                    class="form-horizontal ">
                                    @include('layouts._error')
                                    <input type="hidden" name="profile_id" value="{{ $profile->id }}" id="">

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">الاسم الأول</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->first_name }}" type="text" id="first_name"
                                                name="first_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">الاسم الثاني</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->last_name }}" type="text" id="last_name"
                                                name="last_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">رقم الهوية
                                            (اختياري)</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->id_number }}" type="text" id="id_number"
                                                name="id_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">رقم الجامعي</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->aou_number }}" type="text" id="aou_number"
                                                name="aou_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">الجنسية (اختياري)</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->nationality }}" type="text" id="nationality"
                                                name="nationality" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="">البريد الإلكتروني</label>
                                        <div class="col-md-8">
                                            <input value="{{ $profile->email }}" type="email" id="email"
                                                name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم الكلية</label>
                                        <div class="col-md-8">
                                            <select name="college_name" id="" class="form-control">
                                                <option value="">{{ $profile->college->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم التخصص</label>
                                        <div class="col-md-8">
                                            <select name="specialization" id="" class="form-control">
                                                <option value="">{{ $profile->specialization_name->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم الفرع</label>
                                        <div class="col-md-8">
                                            <select name="branch_name" id="" class="form-control">
                                                <option value="">{{ $profile->branch->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email">اللغة</label>
                                        <div class="col-md-8">
                                            <select name="language" id="" class="form-control">
                                                <option value="ar" @if ($profile->language == 'ar') selected @endif>
                                                    عربي</option>
                                                <option value="en" @if ($profile->language == 'en') selected @endif>
                                                    English</option>
                                            </select>
                                        </div>
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
