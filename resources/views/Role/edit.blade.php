@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet"/>
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
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

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    تعديل دور {{ $role->name }}
                </div>
                <form method="POST" action="{{ route('role.update' ,$role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="bg-gray-200 p-4">
                                <div class="form-group">
                                    <label class="form-label">اسم الدور</label>
                                    <input class="form-control" placeholder="اسم الدور" type="text" name="name"
                                           value="{{$role->name}}">
                                    @if($errors->has('name'))
                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">الصلاحيات</label>
                                    <select name="permissions[]" id="permissions" multiple="multiple"
                                            onchange="console.log($(this).children(':selected').length)"
                                            class="selectsum2">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->name }}"
                                                {{ in_array($permission->name, $rolePermissions) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-main-primary pd-x-20">تعديل</button>

                            </div>

                        </div>
                    </div>


                </form>
            </div>
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
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
@endsection

