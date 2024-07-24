@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
                <h4 class="content-title mb-0 my-auto">الصفقات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة صفقة</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                         data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
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
                        اضف معلومات الصفقة
                    </div>
                    <form method="POST" action="{{route('deal.store')}}">
                        @csrf

                        <div id="wizard1">
                            <h3>بيانات الصفقة</h3>
                            <section>
                                <div class="control-group form-group">
                                    <label class="form-label">العنوان</label>
                                    <input type="text" class="form-control required" name="title" placeholder="العنوان">
                                </div>
                                <div class="control-group form-group">
                                    <label class="form-label">الوصف</label>
                                    <textarea type="text" class="form-control required" name="description">

                                    </textarea>
                                </div>
                                <div class="control-group form-group">
                                    <label class="form-label">المستخدم مالك الصفقة</label>
                                    <select class="form-control select2" name="user_id">

                                        <option label="Choose one" disabled>
                                            اختر المستخدم الذي يملك الصفقة
                                        </option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">
                                                {{$user->name}}
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="control-group form-group mb-0">
                                    <label class="form-label"> المستخدمون المشاركون</label>
                                    <select name="permissions[]" id="permissions" multiple="multiple"
                                            onchange="console.log($(this).children(':selected').length)"
                                            class="selectsum2">

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">
                                                {{$user->name}}
                                            </option>
                                        @endforeach

                                    </select>


                                </div>
                                <div class="control-group form-group mb-0">
                                    <label class="form-label">الوقت المتوقغ للاغلاق</label>
                                    <input type="date" class="form-control required" placeholder="Address">
                                </div>
                            </section>
                            <h3>معلومات العميل</h3>
                            <section>
                                <div class="col-lg-12 col-md-12">
                                    <div class="card overflow-hidden">
                                        <div class="card-header pb-0">
                                            <h3 class="card-title">ادخل معلومات العميل</h3>
                                            <p class="text-muted card-sub-title mb-0">
                                                ادخل معلومات العميل اذا كان جديدا او اختر احد عملائك.</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="panel-group1" id="accordion11">
                                                <div class="panel panel-default  mb-4">
                                                    <div class="panel-heading1 bg-primary ">
                                                        <h4 class="panel-title1">
                                                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                               data-parent="#accordion11" href="#collapseFour1"
                                                               aria-expanded="false">عميل جديد<i
                                                                    class="fe fe-arrow-left ml-2"></i></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFour1" class="panel-collapse collapse"
                                                         role="tabpanel" aria-expanded="false">
                                                        <div class="panel-body border">
                                                            <div class="table-responsive mg-t-20">
                                                                <div class="bg-gray-200 p-4">
                                                                    <div class="form-group">
                                                                        <label>الاسم</label>
                                                                        <input class="form-control"
                                                                               placeholder="الاسم" name="name"
                                                                               type="text">
                                                                        @if($errors->has('name'))
                                                                            <div
                                                                                class="alert alert-danger">{{ $errors->first('name') }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>البريد الالكتروني</label>
                                                                        <input class="form-control" name="email"
                                                                               placeholder="الايميل" required=""
                                                                               type="email">
                                                                        @if($errors->has('email'))
                                                                            <div
                                                                                class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>العنوان</label>
                                                                        <input class="form-control"
                                                                               placeholder="العنوان" name="address"
                                                                               type="text">
                                                                        @if($errors->has('address'))
                                                                            <div
                                                                                class="alert alert-danger">{{ $errors->first('address') }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>الهاتف</label>
                                                                        <input class="form-control" name="phone"
                                                                               type="tel">


                                                                        @if($errors->has('phone'))
                                                                            <div
                                                                                class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>facebook </label>
                                                                        <input class="form-control" name="facebook"
                                                                               type="text">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>instagram </label>
                                                                        <input class="form-control" name="instagram"
                                                                               type="text">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>linkedin </label>
                                                                        <input class="form-control" name="linkedin"
                                                                               type="text">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>نبذة</label>

                                                                        <textarea class="form-control"
                                                                                  placeholder="نبذة تعريفية "
                                                                                  name="note" type="text">  </textarea>
                                                                    </div>
                                                                    <div class="parsley-select wd-250 mg-t-30"
                                                                         id="slWrapper2">
                                                                        <p class="mg-b-10">الشركة <span
                                                                                class="tx-danger">*</span></p>
                                                                        <select class="form-control select2"
                                                                                data-parsley-class-handler="#slWrapper2"
                                                                                data-parsley-errors-container="#slErrorContainer2"
                                                                                data-placeholder="Choose one"
                                                                                name="company_id">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            @foreach ($companies as $company)
                                                                                <option
                                                                                    value="{{ $company->id }}">{{ $company->name }} </option>
                                                                            @endforeach


                                                                            @if($errors->has('company_id'))
                                                                                <div
                                                                                    class="alert alert-danger">{{ $errors->first('company_id') }}</div>
                                                                            @endif

                                                                            <option value="null" name="company_id">
                                                                                مستقل
                                                                            </option>
                                                                        </select>
                                                                        {{--                                                    <input type="hidden" name="islead" value="{{$lead}}">--}}

                                                                        <div class="parsley-select wd-250 mg-t-30"
                                                                             id="slWrapper2">
                                                                            <p class="mg-b-10">المستخدم المالك <span
                                                                                    class="tx-danger">*</span></p>
                                                                            <select class="form-control select2"
                                                                                    data-parsley-class-handler="#slWrapper2"
                                                                                    required
                                                                                    data-parsley-errors-container="#slErrorContainer2"
                                                                                    multiple name="user_id[]">
                                                                                <option
                                                                                    label="اختر المستخدمين لهذا العميل">
                                                                                </option>
                                                                                @foreach ($users as $user)
                                                                                    <option
                                                                                        value="{{ $user->id }}">{{ $user->name }} </option>
                                                                                @endforeach


                                                                                @if($errors->has('user_id'))
                                                                                    <div
                                                                                        class="alert alert-danger">{{ $errors->first('user_id') }}</div>
                                                                                @endif

                                                                            </select>


                                                                        </div>


                                                                        {{--                                                    <input type="hidden" name="islead" value="{{$lead}}">--}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default mb-0">
                                                    <div class="panel-heading1  bg-primary">
                                                        <h4 class="panel-title1">
                                                            <a class="accordion-toggle mb-0 collapsed"
                                                               data-toggle="collapse" data-parent="#accordion11"
                                                               href="#collapseFive2" aria-expanded="false">عميل سابق <i
                                                                    class="fe fe-arrow-left ml-2"></i></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFive2" class="panel-collapse collapse"
                                                         role="tabpanel" aria-expanded="false">
                                                        <div class="panel-body border">
                                                            <select class="form-control select2"
                                                                    data-parsley-class-handler="#slWrapper2"
                                                                    data-parsley-errors-container="#slErrorContainer2"
                                                                    data-placeholder="Choose one"
                                                                    name="client_id">
                                                                <option label="Choose one">
                                                                </option>
                                                                @foreach ($clients as $client)
                                                                    <option
                                                                        value="{{$client->id }}">{{ $client->name }} </option>
                                                                @endforeach


                                                                @if($errors->has('client_id'))
                                                                    <div
                                                                        class="alert alert-danger">{{ $errors->first('client_id') }}</div>
                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                            <h3>المنتج المطلوب</h3>
                            <section>
                                <div class="form-group">
                                    <label class="form-label">حدد المنتج</label>
                                    <select class="form-control select2"
                                            data-parsley-class-handler="#slWrapper2"
                                            data-parsley-errors-container="#slErrorContainer2"
                                            data-placeholder="Choose one"
                                            name="product_id">
                                        <option label="Choose one">
                                        </option>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id }}">{{ $product->name }} </option>
                                        @endforeach


                                        @if($errors->has('product_id'))
                                            <div
                                                class="alert alert-danger">{{ $errors->first('product_id') }}</div>
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">الكمية</label>

                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="حدد الكمية">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">اضف ضريبة</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="اضف ضريبة">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">المجموع النهائي</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control">

                                    </div>
                                </div>
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-sm-8">--}}
                                {{--                                        <div class="form-group mb-sm-0">--}}
                                {{--                                            <label class="form-label">Expiration</label>--}}
                                {{--                                            <div class="input-group">--}}
                                {{--                                                <input type="number" class="form-control" placeholder="MM"--}}
                                {{--                                                       name="expiremonth">--}}
                                {{--                                                <input type="number" class="form-control" placeholder="YY"--}}
                                {{--                                                       name="expireyear">--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="col-sm-4 ">--}}
                                {{--                                        <div class="form-group mb-0">--}}
                                {{--                                            <label class="form-label">CVV <i class="fa fa-question-circle"></i></label>--}}
                                {{--                                            <input type="number" class="form-control" required="">--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                         </section>
                            <button type="submit">sdfsa</button>
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
    <!--Internal  Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{URL::asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{URL::asset('assets/js/form-wizard.js')}}"></script>
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
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
