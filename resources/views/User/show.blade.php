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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$user->name}}</span>
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
                                <h3>{{$user->name}}</h3>
                                <h5>{{$user->getRoleNames()->first()}}</h5>
                            </div>
                        </div>



                    </div>
                    <div class="main-contact-info-body p-4">

                        <div class="media-list pb-0">
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>تاريخ التسجيل</label> <span class="tx-medium">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</span>
                                    </div>
                                    <div>
                                        <label>الايميل</label> <span class="tx-medium">{{$user->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>العنوان</label> <span class="tx-medium">{{$user->address}}</span>
                                    </div>


                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">العملاء الذين جلبهم <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($user->client as $client)
                                                <a class="dropdown-item"
                                                   href="{{route('client.show',$client->id)}}">{{$client->name}}</a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="media">

                                <div class="media-body">
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">الصفقات المفتتحة <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($open as $deal)
                                                <a class="dropdown-item"
                                                   href="{{route('deal.show',$deal->id)}}">{{$deal->title}}</a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">الصفقات المشارك بها <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($in as $deal)
                                                <a class="dropdown-item"
                                                   href="{{route('deal.show',$deal->id)}}">{{$deal->title}}</a>
                                            @endforeach

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
                <h6 class="mb-2">عدد الصفقات الرابحة</h6>
                <h2 class="text-right"><i class="fa fa-won-sign icon-size float-left text-success text-success-shadow"></i>
                    <span>
                        {{$open->where('status',1)->count()}}
                    </span>
                </h2>
            </div>
            <div class="custom-card-widget">
                <h6 class="mb-2">مجموع المبيعات</h6>
                <h2 class="text-right"><i class="icon-size mdi mdi-poll-box   float-left text-primary text-primary-shadow"></i><span>{{$open->where('status',1)->sum('total')}}</span></h2>
            </div>
            <div class="custom-card-widget">
                <h6 class="mb-2">صافي الربح</h6>
                <h2 class="text-right"><i class="icon-size mdi mdi-percent   float-left text-warning text-warning-shadow"></i><span>{{$total}}</span></h2>
            </div>

        </div>
    </div>





    <!-- row closed -->
@endsection
@section('js')
@endsection
