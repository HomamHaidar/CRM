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
    <!-- row -->
    <a class="email-button" href="{{route('user.create')}}"></a>

    <div class="row">

        <ul>

                <li>
                 <a class="btn-main-primary" href={{route('user.show',$user->id)}}>{{$user->name}}</a>
                    {{$user->email}}
                    {{$user->address}}
                    {{$user->getRoleNames()}}
                    @foreach($user->getAllPermissions() as $per)
                    {{$per['name']}}
                    @endforeach
                    <a type="submit"  href="{{route('user.edit',$user->id)}}">update</a>



                    <form action="{{route('user.destroy',$user->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>



        </ul>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection

