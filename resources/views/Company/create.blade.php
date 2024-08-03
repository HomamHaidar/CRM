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

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        اضافة شركة
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-gray-200 p-4">
                                <form method="POST" action="{{ route('company.store') }}">
                                    @csrf
                                <div class="form-group">

                                        <label>الاسم</label>
                                        <input class="form-control" placeholder="الاسم" name="name" type="text">
                                        @if($errors->has('name'))
                                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                    <div class="form-group">

                                        <label>الحقل العاملة به</label>
                                        <input class="form-control" placeholder="الاسم" name="field" type="text">
                                        @if($errors->has('field'))
                                            <div class="alert alert-danger">{{ $errors->first('field') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input class="form-control" placeholder="العنوان" name="address" type="text">
                                    @if($errors->has('address'))
                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <input class="form-control"   name="phone" type="tel">


                                    @if($errors->has('phone'))
                                        <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>نبذة</label>

                                    <textarea class="form-control" placeholder="نبذة تعريفية " name="note" type="text">  </textarea>
                                </div>



                                    <div class="mg-t-30">
                                        <button class="btn btn-main-primary pd-x-20" type="submit">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </form>
    </div>
    </div>
    </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection


