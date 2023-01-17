@extends('layouts.back_office')
@section('title')
    Show Profile
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>show</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.profiles.index') }}">Profiles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Back Office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
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

                    <div class="col-sm-6">

                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> التذاكر
                            </div>
                            <div class="card-block table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>النوع</th>
                                            <th>التصنيف</th>
                                            <th>الحالة</th>
                                            <th>التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profile->tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->ticket_type->name }} </td>
                                            @if ($ticket->ticket_classification)
                                   <td>{{ $ticket->ticket_classification->name }}</td>
                                   @else
                                   <td>-----</td>
                                   @endif
                                            <td> <span class="tag @if ($ticket->status == 'open')
                                                tag-success
                                                @elseif ($ticket->status == 'progress')
                                                tag-warning
                                                @else
                                                tag-danger
                                                @endif">{{ $ticket->status }}</span></td>
                                            <td>
                                                <a href="{{ route('back_office.tickets.edit', $ticket->id) }}" class="btn btn-success btn-sm"><i class="fa fa-ticket"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>@if ($profile->tickets->count()==0)
                                        <h3>لايوجد بيانات لعرضها</h3>
                                        @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
