@extends('layouts.back_office')
@section('title')
    Edit Profile
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>profile</a></li>
            <li class="breadcrumb-item"><a href="{{ route('back_office.home') }}">Back Office</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
              <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> تعديل  الملف الشخصي
                    </div>
                    <div class="card-block ">
                        <form action="{{ route('back_office.updateProfile') }}" method="POST" >
                            @csrf
                            @method('post')
                            @include('layouts._error')

                            <div class="form-group">
                                <label for="name">المهمة</label>
                                <label for="name">
                                    {{ $user->roles->first()->name }}
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email',$user->email) }}"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="password">كلمة السر</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder=""  autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="password_c">تأكيد كلمة السر</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_c"
                                autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                                    تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>

        </div>
        <!--/.container-fluid-->
    </main>
@endsection
