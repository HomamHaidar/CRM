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
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$client->name}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <!-- Client Details Section -->
        <div class="col-sm-12 col-lg-7 col-xl-8">
            <div class="">
                <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
                <div class="main-content-body main-content-body-contacts card custom-card">
                    <div class="main-contact-info-header pt-3">
                        <div class="media">
                            <div class="main-img-user">
                                <img alt="avatar" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                            </div>
                            <div class="media-body">
                                <h5>{{$client->name}}</h5>
                            </div>
                        </div>

                        <div class="main-contact-action btn-list pt-3 pr-3">
                            @can('edit client')
                            <a href="{{route('client.edit',$client->id)}}" class="btn ripple btn-primary text-white btn-icon" data-placement="top" data-toggle="tooltip" title="تعديل العميل"><i class="fe fe-edit"></i></a>
                            @endcan
                            @can('delete client')
                            <a data-toggle="modal" data-target="#exampleModal{{$client->id}}" class="btn ripple btn-secondary text-white btn-icon" data-placement="top" data-toggle="tooltip" title="حذف العميل"><i class="fe fe-trash-2"></i></a>
                            @endcan
                        </div>


                    </div>
                    <div class="main-contact-info-body p-4">
                        <div>
                            <h6>نبذة</h6>
                            <p>{{$client->note}}</p>
                        </div>
                        <div class="media-list pb-0">
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>الهاتف</label> <span class="tx-medium">{{$client->phone}}</span>
                                    </div>
                                    <div>
                                        <label>الايميل</label> <span class="tx-medium">{{$client->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>العنوان</label> <span class="tx-medium">{{$client->address}}</span>
                                    </div>
                                    <div>
                                        <label>الشركة</label>
                                        @if($client->company==null)
                                            <a  class="tx-medium">مستقل</a>

                                        @else
                                            <a href="{{route('company.show',$client->company->id)}}"  class="tx-medium">{{$client->company->name}}</a>

                                        @endif
                                    </div>

                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">المستخدمين مع هذا العميل <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($users as $user)
                                                <a class="dropdown-item"
                                                   href="{{route('user.show',$user->id)}}">{{$user->name}}</a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="media">
                                <div class="main-profile-social-list">
                                    <div class="media">
                                        <div class="media-icon bg-primary-transparent text-primary">
                                            <i class="icon ion-logo-facebook"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{$client->facebook}}">{{$client->facebook}}</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-success-transparent text-danger">
                                            <i class="icon ion-logo-instagram"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{$client->instagram}}">{{$client->instagram}}</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-info-transparent text-info">
                                            <i class="icon ion-logo-linkedin"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{$client->linkedin}}">{{$client->linkedin}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-lg-5 col-xl-4">
            <div class="custom-card-widget">
                <h6 class="mb-2">عدد الصفقات</h6>
                <h2 class="text-left"><i class="fa fa-cart-plus icon-size float-left text-danger text-danger-shadow"></i><span>46,486</span></h2>
            </div>
            <div class="custom-card-widget">
                <h6 class="mb-2">مجموع المبيعات</h6>
                <h2 class="text-right"><i class="icon-size mdi mdi-poll-box   float-left text-warning text-warning-shadow"></i><span>$23,987</span></h2>
            </div>
        </div>
    </div>


    </div>


    <form action="{{route('client.destroy',$client->id)}}" method="POST">
        @csrf
        @method('DELETE')
        @include('Client.delete')
    </form>
    <!-- row closed -->
@endsection
@section('js')
@endsection
