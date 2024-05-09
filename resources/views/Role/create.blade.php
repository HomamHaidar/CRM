    @extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الادوار</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة دور</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <ul>
            <form method="POST" action="{{ route('role.store') }}">
                @csrf
                <div>
                    <label>name</label>
                    <input type="text" class="input-group" name="name" required >

                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                    <label>permissions </label>

                        <div >
                            <p class="mg-b-10">Multiple Select</p>
                            <select multiple="multiple" name="permissions[]" required>
                               @foreach($permissions as $permission)
                                <option value={{$permission->id}}>
                                    {{$permission->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>





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

