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
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <strong>طلب لمستخدم جديد</strong>
                            </div>
                            <div class="card-block">
                                <form action="{{ route('agent.tickets.newTicket') }}" method="post"
                                    class="form-horizontal ">
                                    @csrf
                                    @include('layouts._error')
                                    <input type="hidden" name="phone_number" value="{{ $phone_number }}" id="">
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
                                            <input type="text" id="first_name" value="{{ old('first_name') }}" name="first_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">الاسم الثاني</label>
                                        <div class="col-md-8">
                                            <input type="text" id="last_name" value="{{ old('last_name') }}"  name="last_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">رقم الهوية
                                            (اختياري)</label>
                                        <div class="col-md-8">
                                            <input type="text" id="id_number" value="{{ old('id_number') }}"  name="id_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">رقم الجامعي</label>
                                        <div class="col-md-8">
                                            <input type="text" id="aou_number" value="{{ old('aou_number') }}"  name="aou_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">الجنسية (اختياري)</label>
                                        <div class="col-md-8">
                                            <input type="text" id="nationality" value="{{ old('nationality') }}"  name="nationality" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">البريد الإلكتروني</label>
                                        <div class="col-md-8">
                                            <input type="email" id="email" value="{{ old('email') }}"  name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم الكلية</label>
                                        <div class="col-md-8">
                                            <select name="college_name" id="college_name" class="form-control">
                                                <option value="">اختر </option>
                                                @foreach ($colleges as $item)
                                                    <option value="{{ $item->id }}" @if (old('college_name')== $item->id)
                                                        selected
                                                    @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم التخصص</label>
                                        <div class="col-md-8">
                                            <select name="specialization" id="spec_name" class="form-control">
                                                {{-- @foreach ($specializations as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach --}}
                                                <option value="">اختر كلية</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اسم الفرع</label>
                                        <div class="col-md-8">
                                            <select name="branch_name" id="" class="form-control">
                                                @foreach ($branches as $item)
                                                    <option value="{{ $item->id }}" @if (old('branch_name')== $item->id)
                                                        selected
                                                    @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="hf-email">اللغة</label>
                                        <div class="col-md-8">
                                            <select name="language" id="" class="form-control">
                                                <option value="ar"  @if (old('language')== 'ar')
                                                    selected
                                                @endif>عربي</option>
                                                <option value="en"  @if (old('language')== 'en')
                                                    selected
                                                @endif>English</option>
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
