@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الادوار</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل دور</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <ul>
            <form method="POST" action="{{ route('role.update' ,$role->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <label>name</label>
                    <input type="text" class="input-group" name="name" value="{{$role->name}}"  required>

                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <label>permissions </label>

                <div>
                    <p class="mg-b-10">Multiple Select</p>
                    <select multiple="multiple" name="permissions[]">
                        @foreach($permissions as $permission)

                            <option>
                                {{$permission->name}}
                            </option>
                        @endforeach
                    </select>

                </div>

{{--                <div class="col-lg-4">--}}
{{--                    <p class="mg-b-10">Multiple Select</p>--}}
{{--                    <select multiple="multiple" name="permissions[]"  id="treeview1">--}}
{{--                        @if(!empty($permissions))--}}
{{--                            @foreach($permissions as $v)--}}
{{--                                <li>{{ $v->name }}</li>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </select>--}}
{{--                </div>--}}
                <br>


                <button type="submit" class="success-widget">sub</button>

            </form>

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

