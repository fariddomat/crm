@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')
<div class="container">
    <div class="row" style="padding-top: 50px">
        <div class="col-md-8 push-md-2">
            <div class="card" style="margin: 0 auto">
                <div class="card-header">UOA CRM </div>

                <div class="card-body" style="margin: 25px">
                    <div class="row">
                        <div class="col-md-6" style="text-align: center; padding-top: 50px">
                            <img src="{{ asset('dashboard/img/login.png') }}" alt="">
                        </div>
                        <div class="col-md-6" style="padding-top: 70px; padding-bottom: 70px">
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">
        <label for="email" class="col-md-4">البريد الإلكتروني</label>
    </div>
    <div class="form-group row">
        <div class="col-md-8">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password"  class="col-md-4 ">كلمة السر</label>
    </div>
    <div class="form-group row">
        <div class="col-md-8">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-2">
            <button type="submit" class="btn btn-primary" style="background-color: #002d57">
                <i class="fa fa-sign-in"></i> تسجيل الدخول
            </button>
        </div>
    </div>
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
