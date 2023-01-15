@extends('layouts.admin')
@section('title')
    Edit User
@endsection
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>edit</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">users</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
              <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> تعديل مستخدم
                    </div>
                    <div class="card-block ">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" >
                            @csrf
                            @method('put')
                            @include('layouts._error')


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
                            {{-- Roles --}}
                            <div class="form-group">
                                <label for="role">المهمة</label>
                                <select class="form-control" name="role_id" id="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>

                                    @endforeach
                                </select>
                                {{-- <a href="{{ route('admin.roles.create') }}">Create new Role</a> --}}
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
