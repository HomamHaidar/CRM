@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المنتجات</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

            <div class="mb-3 mb-xl-0">

            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="input-group">
            <div class="col-sm-6 col-md-3 mg-t-10">
                <a class="btn btn-success-gradient btn-block" type="button" href="{{route('product.create')}}">اضافة
                    منتج</a>
            </div>
        </div>

        <div class="row row-sm">
            @foreach($product as $p)
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="pro-img-box">

                                <img class="w-100" src="{{ Storage::url($p->image) }}" alt="{{ $p->name }}"  srcset="">


                                <a  class="adtocart"> <i class="las la-shopping-cart "></i>
                                </a>
                            </div>
                            <div class="text-center pt-3">
                                <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{$p->name}}</h3>
                                <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger"> سعر المبيع
                                    : {{$p->selling_price}} $</h4>

                                <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger"> سعر الجملة
                                    : {{$p->wholesale_price}} $ </h4>
                            </div>
                            <div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">
                                <span>الكمية المتبقية: </span>
                                <span>
                                                {{$p->quantity}}
                               </span>
                            </div>
                            <div>

                                <button class="btn btn-danger-gradient btn-default" data-toggle="modal"
                                        data-target="#exampleModal{{$p->id}}">حذف المنتج
                                </button>
                                <a class="btn btn-info-gradient btn-default" type="submit"
                                   href="{{route('product.edit',$p->id)}}">تعديل المنتج
                                </a>
                                <form action="{{route('product.destroy',$p->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @include('Product.delete')
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach


            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection
