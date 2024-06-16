@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل العميل</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        تعديل عميل
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-gray-200 p-4">
                                <div class="form-group">
                                    <form method="POST" action="{{ route('client.update',$client->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <label>الاسم</label>
                                        <input class="form-control" name="name" type="text" value="{{$client->name}}">
                                        @if($errors->has('name'))
                                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                       @endif
                                </div>
                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input class="form-control" name="email"   value="{{ old('email',$client->email)}}" required="" type="email">
                                    @if($errors->has('email'))
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input class="form-control"  value="{{$client->address}}" name="address" type="text">
                                    @if($errors->has('address'))
                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <input class="form-control" value="{{$client->phone}}"  name="phone" type="tel">

                                    @if($errors->has('phone'))
                                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>facebook </label>
                                    <input class="form-control" value="{{$client->facebook}}"  name="facebook" type="text">

                                </div>
                                <div class="form-group">
                                    <label>instagram </label>
                                    <input class="form-control" name="instagram" value="{{$client->instagram}}"  type="text">

                                </div>
                                <div class="form-group">
                                    <label>linkedin </label>
                                    <input class="form-control" name="linkedin" value="{{$client->linkedin}}"  type="text">

                                </div>
                                <div class="form-group">
                                    <label>نبذة</label>

                                    <textarea class="form-control"   placeholder="نبذة تعريفية " name="note" type="text">{{$client->note}}  </textarea>
                                </div>
                                <div class="parsley-select wd-250 mg-t-30" id="slWrapper2">
                                    <p class="mg-b-10">الشركة <span class="tx-danger">*</span></p>
                                    <select class="form-control select2" data-parsley-class-handler="#slWrapper2"
                                            data-parsley-errors-container="#slErrorContainer2"
                                            data-placeholder="Choose one" required="" name="company_id">
                                        <option label="Choose one">
                                        </option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ old('company_id', $client->company_id) == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                        @if($errors->has('company_id'))
                                            <div class="alert alert-danger">{{ $errors->first('company_id') }}</div>
                                        @endif
                                    </select>
                                    <div class="parsley-select wd-250 mg-t-30" id="slWrapper2">
                                        <p class="mg-b-10">المستخدم المالك <span class="tx-danger">*</span></p>
                                        <select class="form-control select2" data-parsley-class-handler="#slWrapper2" required
                                                data-parsley-errors-container="#slErrorContainer2"
                                                multiple  name="user_id[]">
                                            <option label="اختر المستخدمين لهذا العميل">
                                            </option>
                                            @foreach ($users as $user)
                                                {{ old('user_id', $user->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                                </option>
                                            @endforeach


                                            @if($errors->has('user_id'))
                                                <div class="alert alert-danger">{{ $errors->first('user_id') }}</div>
                                            @endif

                                        </select>



                                    </div>
                                    <div class="mg-t-30">
                                        <button class="btn btn-main-primary pd-x-20" type="submit">تعديل</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" class="input-group" name="id" value="{{ $client->id}}">


        </form>
    </div>
    </div>
    </div>
    </div>





    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
    <!-- Internal TelephoneInput js-->

    <script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
@endsection


