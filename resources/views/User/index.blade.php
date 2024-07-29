@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                @can('add user')
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <a class="btn btn-success-gradient btn-block" type="button" href="{{route('user.create')}}">اضافة مستخدم</a>
                    </div>
                @endcan
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">جدول المستخدمين</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="wd-lg-8p"><span>المستخدم</span></th>
                                <th class="wd-lg-20p"><span></span></th>
                                <th class="wd-lg-20p"><span>العنوان</span></th>
                                <th class="wd-lg-20p"><span>الايميل</span></th>
                                <th class="wd-lg-20p"><span>الدور</span></th>
                                <th class="wd-lg-20p"><span>الصلاحيات</span></th>
                                <th class="wd-lg-20p"><span>تاريخ الاضافة</span></th>
                                <th class="wd-lg-20p">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                             src="{{URL::asset('assets/img/faces/1.jpg')}}">
                                    </td>
                                    <td>


                                         <a class="primary" @can('show user') href={{route('user.show',$user->id)}}  @endcan>{{$user->name}}</a>


                                    </td>

                                    <td>
                                        {{$user->address}}
                                    </td>
                                    <td class="text-center">
                                        {{$user->email}}
                                    </td>
                                    <td>
                                    <a >  {{$user->getRoleNames()->first()}}</a>
                                    </td>

                                    <td>

                                        <select id="permissions" name="permissions" class="form-control">
                                            <option value="" disabled selected>الصلاحيات </option>
                                            @foreach($user->getAllPermissions() as $permission)
                                                <option value="{{ $permission->id }}" >{{ $permission->name }}</option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>
                                        {{ $user->created_at->format('d/m/Y') }}                                    </td>
                                    <td>
                                        @can('delete user')
                                        @if(!$user->hasRole('Admin'))
                                            <button class="btn btn-danger-gradient btn-default" data-toggle="modal"
                                                    data-target="#exampleModal{{$user->id}}">حذف المستخدم
                                            </button>
                                        @endif
                                        @endcan
                                       @can('edit user')
                                        <a class="btn btn-info-gradient btn-default" type="submit"
                                           href="{{route('user.edit',$user->id)}}">تعديل المستخدم
                                        </a>
                                       @endcan

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
        <!-- COL END -->
    </div>
    <!-- row closed  -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endsection
