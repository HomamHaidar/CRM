@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل بيانات {{$user->name}}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="col-12 col-xl-12 col-xl-12 col-xl-10">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h3>  <strong>عدل بيانات الموظف</strong></h3>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('user.update',$user->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاسم</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name',$user->name)}}" placeholder="الاسم" required autofocus>
                            @if($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الاكتروني</label>
                            <input type="email" class="form-control" name="email"  autocomplete="new-email"
                                   value="{{ old('email',$user->email)}} " placeholder="البريد الالكتروني" required>
                            @if($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان</label>
                            <input type="text" class="form-control" name="address" placeholder="العنوان"  value="{{ old('address',$user->address)}}" required>
                            @if($errors->has('address'))
                                <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">كلمة السر</label>
                            <input type="password" class="form-control" name="password" placeholder="كلمة السر" required autocomplete="new-password"
                                   value="{{ old('password',$user->password)}}">
                            @if($errors->has('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">تاكيد كلمة السر</label>
                            <input type="password" class="form-control" name="confirm_password" name="confirm_password"
                                   value="{{ old('password',$user->password)}}" placeholder="تاكيد كلمة السر" required>
                            @if($errors->has('confirm_password'))
                                <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                            @endif
                        </div>
                        <input type="hidden" class="input-group" name="id" value="{{ $user->id}}">

                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">تحديث</button>

                </form>
            </div>
        </div>
    </div>



    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection

