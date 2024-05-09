    @extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الشركات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة شركة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <ul>
            <form method="POST" action="{{ route('company.store') }}">
                @csrf
                <div>
                    <label>name</label>
                    <input type="text" class="input-group" name="name" required >

                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div>
                    <label>field</label>
                    <input type="text" class="input-group" name="field" required >
                    @if($errors->has('field'))
                        <div class="alert alert-danger">{{ $errors->first('field') }}</div>
                    @endif
                </div>
                <div>
                    <label>address</label>
                    <input type="text" class="input-group" name="address" required>
                    @if($errors->has('address'))
                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div>
                    <label>Phone</label>
                    <input type="text" class="input-group" name="phone" required >
                    @if($errors->has('phone'))
                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <br>
                <div>
                    <label>Note</label>
                    <br>
                    <textarea  type="text" name="note"></textarea>
                </div>

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

