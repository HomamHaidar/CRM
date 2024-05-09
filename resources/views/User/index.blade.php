@extends('layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين والادوار</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="col-sm-6 col-md-3 mg-t-10">
        <a class="btn btn-success-gradient btn-block" type="button" href="{{route('user.create')}}">اضافة مستخدم</a>
    </div>
            <br>
    <div class="col">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="title"><strong>المستخدمين</strong></h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">الاسم</th>
                            <th class="border-bottom-0">الايميل</th>
                            <th class="border-bottom-0">العنوان</th>
                            <th class="border-bottom-0">الدور</th>
                            <th class="border-bottom-0">الصلاحيات</th>
                            <th class="border-bottom-0">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><a class="primary" href={{route('user.show',$user->id)}}>{{$user->name}}</a>
                                </td>
                                <td>   {{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>
                                    {{$user->getRoleNames()}}
                                </td>
                                <td>

                                    <select >
                                        @foreach($user->getAllPermissions() as $per)
                                        <option value="{{$per['id']}}">{{$per['name']}}</option>
                                        @endforeach
                                    </select>

                                </td>
                                <td>
                                    <button class="btn btn-danger-gradient btn-default" data-toggle="modal"
                                            data-target="#exampleModal{{$user->id}}">حذف المستخدم
                                    </button>


                                    <a class="btn btn-info-gradient btn-default" type="submit"
                                            href="{{route('user.edit',$user->id)}}">تعديل المستخدم
                                    </a>

                                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @include('User.delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Container closed -->
    </div>

    <!-- main-content closed -->

@endsection
@section('js')

@endsection

