@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الادوار</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الادوار</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">




        <div class="col-xl-12">
            <div class="card">
               @can('add role')
                <div class="col-sm-6 col-md-3 mg-t-10">
                    <a class="btn btn-success-gradient btn-block" type="button" href="{{route('role.create')}}">اضافة دور</a>
                </div>
                @endcan
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">الادوار</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الدور</th>
                                <th>الصلاحيات</th>
                                <th>المستخدمين بهذا الدور</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$role->name}}</td>
                                <td>  <select id="permissions" name="permissions" class="form-control">
                                        <option value="" disabled selected>الصلاحيات </option>
                                        @foreach($role->getAllPermissions() as $per)
                                            <option value="{{ $per->id }}" >{{ $per->name }}</option>
                                        @endforeach
                                    </select></td>
                                <td>
                                    <select class="form-control">
                                        @foreach($role->users as $user)
                                            <option value="{{ $user->id }}" > {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    @can('edit role')
                                         <a type="submit" class="btn btn-primary-gradient btn-default" href="{{route('role.edit',$role->id)}}">تعديل الدور</a>
                                    @endcan
                                    @can('delete role')
                                        @if(($role->id!=1 ))
                                        <button class="btn btn-danger-gradient btn-default" data-toggle="modal"
                                                data-target="#exampleModal{{$role->id}}">حذف الدور
                                        </button>
                                    @endif
                                   @endcan
                                    <br>

                                    <form action="{{route('role.destroy',$role->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @include('Role.delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!--div-->
        <!--/div-->

        <!--div-->

        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
