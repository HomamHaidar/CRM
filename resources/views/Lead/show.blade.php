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
    <!---Internal  Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!--- Internal Timeline css-->
    <link href="{{URL::asset('assets/plugins/timeline/css/timeline.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$client->name}}</span>
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
                            <a href="{{route('client.edit',$client->id)}}"
                               class="btn ripple btn-primary text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="تعديل العميل"><i class="fe fe-edit"></i></a>
                            @endcan
                            @can('delete client')
                            <a data-toggle="modal" data-target="#exampleModal{{$client->id}}"
                               class="btn ripple btn-secondary text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="حذف العميل"><i class="fe fe-trash-2"></i></a>
                                @endcan
                            @can('lead to client')
                            <a href="{{route('lead.edit',$client->id)}}"
                               class="btn ripple btn-danger text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="حذف من المستهدفين"><i class="fe fe-minus"></i></a>
                                @endcan
                             @can('add task')
                            <a href="#" class="btn ripple btn-success text-white btn-icon" data-placement="top"
                               data-toggle="tooltip" title="اضافة مهمة"><i class="fe fe-check-square"></i></a>
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
                                            <a class="tx-medium">مستقل</a>
                                        @else
                                            <a href="{{route('company.show',$client->company->id)}}"
                                               class="tx-medium">{{$client->company->name}}</a>

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
                        @can('won lead')
                        <a class="btn btn-outline-success btn-block btn-rounded" id="win" data-status="فوز"
                           data-toggle="modal" data-target="#archiveModal{{$client->id}}">فوز</a>
                        @endcan
                        @can('lose lead')
                            <a class="btn btn-outline-danger btn-block btn-rounded" id="lose" data-status="خسارة"
                           data-toggle="modal" data-target="#archiveModal{{$client->id}}">خسارة</a>
                        @endcan
                        @include('Lead.status',['status' => old('status')])
                    </div>


                </div>
            </div>
        </div>




        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <h3 class="font-semibold">سجلنا مع العميل</h3>
                </div>
                <div class="card-body">

                    <div class="vtimeline">
                        @if($activities)
                         @foreach($activities as $activitiy)
                            @if($activitiy->id %2==0)

                                @if($activitiy->type=='lunch')
                                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-primary">

                                        @elseif($activitiy->type=='call')
                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">

                                        @elseif($activitiy->type=='meet')
                                                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-success">

                                        @elseif($activitiy->type=='note')
                                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">

                                        @endif
                            @else
                                                                    @if($activitiy->type=='lunch')
                                                                        <div class="timeline-wrapper timeline timeline-wrapper-primary">

                                                                            @elseif($activitiy->type=='call')
                                                                                <div class="timeline-wrapper timeline timeline-wrapper-danger">

                                                                                    @elseif($activitiy->type=='meet')
                                                                                        <div class="timeline-wrapper timeline timeline-wrapper-success">

                                                                                            @elseif($activitiy->type=='note')
                                                                                                <div class="timeline-wrapper timeline timeline-wrapper-info">

                                                                                                    @endif
                            @endif
                            @if($activitiy->type=='lunch')
                              <div class="timeline-badge"><i class="las la-phone"></i></div>
                            @elseif($activitiy->type=='call')
                              <div class="timeline-badge"><i class="far fa-calendar"></i></div>

                            @elseif($activitiy->type=='meet')
                                         <div class="timeline-badge"><i class="fe fe-clock"></i></div>

                            @elseif($activitiy->type=='note')
                                <div class="timeline-badge"><i class="la la-sticky-note"></i></div>

                            @endif
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h6 class="timeline-title">            {{$activitiy->title}}</h6>
                                </div>
                                <div class="timeline-body">
                                    <p>{{$activitiy->comment}}</p>
                                </div>
                                <div class="timeline-footer d-flex align-items-center flex-wrap">

                                    <span class="mr-auto"><i
                                            class="fe fe-calendar text-muted mr-1"></i>{{$activitiy->end}}
                                    <-------------
                                    </span>
                                    <span class="mr-auto"><i
                                            class="fe fe-calendar text-muted mr-1"></i>{{$activitiy->start}}

                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
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
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all buttons with data-status attribute
            document.querySelectorAll('a[data-status]').forEach(button => {
                button.addEventListener('click', function () {
                    // Get the status from the data attribute
                    let status = this.getAttribute('data-status');
                    let title = 'تسجيل حالة ' + this.getAttribute('data-status');
                    let title2 = 'هل انت متاكد من تسجيل حالة ل ' + this.getAttribute('data-status');
                    // Set the value of the hidden input field in the modal
                    document.getElementById('status-input').value = status;
                    document.getElementById('status-header').textContent = title;
                    document.getElementById('status-header2').textContent = title2;

                });
            });
        });
    </script>
@endsection

