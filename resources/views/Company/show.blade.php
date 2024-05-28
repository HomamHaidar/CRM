@extends('layouts.master')
@section('css')
    <style>
        .custom-card-widget {
            background-color: #ffffff; /* Background color */
            padding: 20px; /* Padding inside the widget */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow for the card */
            margin-bottom: 20px; /* Space below the card */
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الشركات</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$company->name}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <!-- Left Column for Client Details -->
        <div class="col-lg-8">
            <div class="">
                <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
                <div class="main-content-body main-content-body-contacts card custom-card">
                    <div class="main-contact-info-header pt-3">
                        <div class="media">
                            <div class="main-img-user">
                                <img alt="avatar" src="{{URL::asset('assets/img/media/company.png')}}">
                            </div>
                            <div class="media-body">
                                <h5>{{$company->name}}</h5>
                                <span class="badge-primary ">{{$company->field}}</span>
                            </div>
                        </div>
                        <div class="main-contact-action btn-list pt-3 pr-3">
                            <a href="{{route('company.edit',$company->id)}}"
                               class="btn ripple btn-primary text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="تعديل الشركة"><i class="fe fe-edit"></i></a>
                            <a data-toggle="modal" data-target="#exampleModal{{$company->id}}"
                               class="btn ripple btn-secondary text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="حذف الشركة"><i class="fe fe-trash-2"></i></a>
                        </div>
                    </div>
                    <div class="main-contact-info-body p-4">
                        <div>
                            <h6>نبذة</h6>
                            <p>{{$company->note}}</p>
                        </div>
                        <div class="media-list pb-0">
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>الهاتف</label> <span class="tx-medium">{{$company->phone}}</span>
                                    </div>
                                    <div>
                                        <label>العنوان</label> <span class="tx-medium">{{$company->address}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">قائمة الموظفين في الشركة <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($company->clients as $client)
                                                <a class="dropdown-item"
                                                   href="{{route('client.show',$client->id)}}">{{$client->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other contents can go here -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

                <div class="card bg-primary-gradient text-white ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-users tx-40"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">عدد الموظفين</span>
                                    <h2 class="text-white mb-0">600</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card bg-danger-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-shopping-cart tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">عدد الصفقات</span>
                                <h2 class="text-white mb-0">854</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-success-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-bar-chart-2 tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">الارباح</span>
                                <h2 class="text-white mb-0">98K</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>




    </div>
    </div>

    <form action="{{route('company.destroy',$company->id)}}" method="POST">
        @csrf
        @method('DELETE')
        @include('Company.delete')
    </form>
    <!-- row closed -->
@endsection
@section('js')
@endsection
