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
    <!-- row -->
    <a class="btn-success" href="{{route('role.create')}}">create</a>

    <div class="row">

        <ul>
            @foreach($roles as $role)
                <li>
                 <p>{{$role->name}}</p>

                    <br>
                    <select>
                        @foreach($role->getAllPermissions() as $per)
                            <option value="{{$per->id}}">  {{$per->name}}</option>
                        @endforeach
                    </select>

                    <br>
                    <a type="submit"  href="{{route('role.edit',$role->id)}}">update</a>

                    <br>
                    @if(($role->id!=1 ))
                    <form action="{{route('role.destroy',$role->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @endif
                </li>

            @endforeach

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

