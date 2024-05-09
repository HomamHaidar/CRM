@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الشركات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الشركات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <a class="btn-success" href="{{route('company.create')}}">create</a>

    <div class="row">

        <ul>
            @foreach($companies as $company)
                <li>
                 <a class="btn-main-primary" href={{route('company.show',$company->id)}}>{{$company->name}}</a>
                    {{$company->field}}
                    <br>
                    {{$company->address}}
                    <br>
                    {{$company->phone}}
                    <br>
                    {{$company->note}}

                    <a type="submit"  href="{{route('company.edit',$company->id)}}">update</a>



                    <form action="{{route('company.destroy',$company->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
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

