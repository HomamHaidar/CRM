@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4  class="content-title mb-0 my-auto" >الشركات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل {{$company->name}} </span>
            </div>

        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row">
        <ul>
            <form method="POST" action="{{ route('company.update',$company->id) }}">
                @method('PUT')
                @csrf
                <div>
                    <label>name</label>
                    <input type="text" class="input-group" name="name" value="{{$company->name}}" >

                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div>
                    <label>field</label>
                    <input type="text" class="input-group" name="field" value="{{$company->field}}" >
                    @if($errors->has('field'))
                        <div class="alert alert-danger">{{ $errors->first('field') }}</div>
                    @endif
                </div>
                <div>
                    <label>address</label>
                    <input type="text" class="input-group" name="address" value="{{$company->address}}">
                    @if($errors->has('address'))
                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div>
                    <label>Phone</label>
                    <input type="text" class="input-group" name="phone" value="{{$company->phone}}" >
                    @if($errors->has('phone'))
                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <br>
                <div>
                    <label>Note</label>
                    <br>
                    <textarea  type="text" name="note" >{{$company->note}}</textarea>
                </div>
                <br>
                <input type="hidden" class="input-group" name="id" value="{{ $company->id}}">

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

