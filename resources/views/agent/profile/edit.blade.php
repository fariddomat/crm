@extends('layouts.agent')
@section('title')
    New Profile
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('agent.profiles.index') }}">Profiles</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agent.home') }}">Agent</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-sm-6">

                        <div class="card">
                            <div class="card-header">
                                <strong>طلب لمستخدم موجود مسبقا</strong>
                            </div>
                            <div class="card-block">
                                <form action="{{ route('agent.tickets.newTicketOldUser') }}" method="post"
                                    class="form-horizontal ">
                                    @csrf
                                    @include('layouts._error')
                                    <input type="hidden" name="profile_id" value="{{ $profile->id }}" id="">

                                    {{-- <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">رقم الهاتف</label>
                                        <div class="col-md-8">
                                            <input dir="ltr" value="{{ $profile->phone_number }}" type="text" id="phone_number" name="phone_number" class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">نوع التذكرة</label>
                                        <div class="col-md-8">
                                            <select name="ticket_type_id" id="" class="form-control">
                                                @foreach ($ticketTypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">الاسم الأول</label>
                                        <div class="col-md-8">
                                            <input value="{{ old('first_name', $profile->first_name )}}" type="text" id="first_name"
                                                name="first_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">الاسم الثاني</label>
                                        <div class="col-md-8">
                                            <input value="{{old('last_name',$profile->last_name)   }}" type="text" id="last_name"
                                                name="last_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">رقم الهوية
                                            (اختياري)</label>
                                        <div class="col-md-8">
                                            <input value="{{old('id_number', $profile->id_number)  }}" type="text" id="id_number"
                                                name="id_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">رقم الجامعي</label>
                                        <div class="col-md-8">
                                            <input value="{{ old('aou_number',$profile->aou_number)  }}" type="text" id="aou_number"
                                                name="aou_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">الجنسية (اختياري)</label>
                                        <div class="col-md-8">
                                            <input value="{{ old('nationality',$profile->nationality)  }}" type="text" id="nationality"
                                                name="nationality" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">البريد الإلكتروني</label>
                                        <div class="col-md-8">
                                            <input value="{{ old('email',$profile->email)  }}" type="email" id="email"
                                                name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم الكلية</label>
                                        <div class="col-md-8">
                                            <select name="college_name" id="college_name" class="form-control">
                                                <option value="">اختر </option>
                                                @foreach ($colleges as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $profile->college_name) selected @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم التخصص</label>
                                        <div class="col-md-8">
                                            <select name="specialization" id="spec_name" class="form-control">
                                                @foreach ($profile->college->specializations as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $profile->specialization) selected @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم الفرع</label>
                                        <div class="col-md-8">
                                            <select name="branch_name" id="" class="form-control">
                                                @foreach ($branches as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $profile->branch_name) selected @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اللغة</label>
                                        <div class="col-md-8">
                                            <select name="language" id="" class="form-control">
                                                <option value="ar" @if ($profile->language == 'ar') selected @endif>
                                                    عربي</option>
                                                <option value="en" @if ($profile->language == 'en') selected @endif>
                                                    English</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="fa fa-dot-circle-o"></i>
                                            التالي</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                            مسح الحقول</button>
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
                                                <a href="{{ route('agent.tickets.edit', $ticket->id) }}" class="btn btn-success btn-sm"><i class="fa fa-ticket"></i></a>
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

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#college_name').on('change', function(e) {
                var college_id = e.target.value;
                $.ajax({
                    url: "{{ route('agent.specList') }}",
                    type: "POST",
                    data: {
                        college_id: college_id
                    },
                    success: function(data) {
                        $('#spec_name').empty();
                        $.each(data.spec[0].specializations, function(index,
                            spe) {
                            $('#spec_name').append('<option value="' +
                                spe
                                .id + '">' + spe.name + '</option>');
                        })
                    }
                })
            });
        });
    </script>
@endpush
