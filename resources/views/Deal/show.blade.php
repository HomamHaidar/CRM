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

        .center-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

        .date-top-right {
            position: absolute;
            top: 10px;
            right: 20px;
            color: red;
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
                <h4 class="content-title mb-0 my-auto">الصفقات</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$deal->title}}</span>
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
                <div class="main-content-body main-content-body-contacts card custom-card position-relative">
                    <div class="date-top-right">
                        بدات في
                        <h5>{{ \Carbon\Carbon::parse($deal->start)->format('Y-m-d') }}</h5>
                        الوقت المتوقع للانتهاء
                        <h5>{{ \Carbon\Carbon::parse($deal->expected_time)->format('Y-m-d') }}</h5>
                    </div>
                    <div class="main-contact-info-header pt-md-3 center-content">
                        <div>
                            <div class="media-title">
                                <h3>{{$deal->title}}</h3>
                                <h5> مع العميل <a
                                        href="{{route('client.show',$deal->client->id)}}">{{$deal->client->name}}</a>
                                </h5>
                            </div>
                        </div>

                        <div class="main-contact-action btn-list pt-3 pr-3">
                            @can('edit deal')
                                <a href="{{route('deal.edit',$deal->id)}}"
                                   class="btn ripple btn-primary text-white btn-icon" data-placement="top"
                                   data-toggle="tooltip" title="تعديل الصفقة"><i class="fe fe-edit"></i></a>
                            @endcan
                            @can('delete client')
                                <a data-toggle="modal" href="" data-target="#exampleModal{{$deal->id}}"
                                   class="btn ripple btn-secondary text-white btn-icon" data-placement="top"
                                   data-toggle="tooltip" title="حذف الصفقة"><i class="fe fe-trash-2"></i></a>
                            @endcan

                            @can('add task')
                                    <a data-toggle="modal" href="" data-target="#createModal"
                                       class="btn ripple btn-success text-white btn-icon" data-placement="top"
                                       data-toggle="tooltip" title="اضافة مهمة للصفقة"><i class="fe fe-check-square"></i></a>


                            @endcan
                        </div>
                    </div>
                    <div class="main-contact-info-body p-4">
                        <div>
                            <h6>نبذة</h6>
                            <p>{{$deal->description}}</p>
                        </div>
                        <div class="media-list pb-0">
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>المنتج </label> <span class="tx-medium">{{$deal->product->name}}</span>
                                    </div>
                                    <div>
                                        <label>الكمية المطلوبة</label> <span
                                            class="tx-medium">{{$deal->quantity}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>الضريبة المضافة </label> <span class="tx-medium">{{$deal->tax}}</span>
                                    </div>
                                    <div>
                                        <label>اجمالي قيمة الصفقة</label> <span
                                            class="tx-medium">{{$deal->total}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>مفتتح الصفقة</label> <span class="tx-medium">{{$deal->user->name}}</span>
                                    </div>

                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary" data-toggle="dropdown"
                                                id="dropdownMenuButton" type="button">المستخدمين مع هذه الصفقة <i
                                                class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @foreach($deal->users as $user)
                                                <a class="dropdown-item"
                                                   href="{{route('user.show',$user->id)}}">{{$user->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <div>
                                        <label>نموذج الرحلة</label> <span class="tx-medium">{{$deal->journey->name}}</span>
                                    </div>
                                    <div>
                                        <label>المرحلة الحالية</label> <span class="tx-medium">{{$deal->stage->name}}</span>

                                    </div>



                                    <div>
                                        <form method="POST" action="{{route('update.stage',$deal->id)}}">
                                            @csrf
                                            <input type="hidden" name="next" value="1">
                                            <button type="submit" class="btn btn-primary-gradient btn-with-icon ">نقل الى المرحلة التالية</button>

                                        </form>
                                    </div>
                                    <div>
                                        @if($deal->stage->id != $deal->journey->stages[0]->id)

                                            <form method="POST" action="{{route('update.stage',$deal->id)}}">
                                                @csrf
                                                <input type="hidden" name="perv" value="1">
                                                <button type="submit" class="btn btn-warning-gradient btn-with-icon ">تراجع الى  المرحلة السابقة</button>

                                            </form>
                                        @endif
                                    </div>


                                </div>
                            </div>

                        </div>
                        @can('won deal')
                            <a class="btn btn-outline-success btn-block btn-rounded" id="win" data-status="فوز"
                               data-toggle="modal" data-target="#archiveModal{{$deal->id}}">فوز</a>
                        @endcan
                        @can('lose deal')
                            <a class="btn btn-outline-danger btn-block btn-rounded" id="lose" data-status="خسارة"
                               data-toggle="modal" data-target="#archiveModal{{$deal->id}}">خسارة</a>
                        @endcan
                        @include('deal.status',['status' => old('status')])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Deal.activity')
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
                                                    <div
                                                        class="timeline-wrapper timeline-inverted timeline-wrapper-success">

                                                        @elseif($activitiy->type=='note')
                                                            <div
                                                                class="timeline-wrapper timeline-inverted timeline-wrapper-info">

                                                                @endif
                                                                @else
                                                                    @if($activitiy->type=='lunch')
                                                                        <div
                                                                            class="timeline-wrapper timeline timeline-wrapper-primary">

                                                                            @elseif($activitiy->type=='call')
                                                                                <div
                                                                                    class="timeline-wrapper timeline timeline-wrapper-danger">

                                                                                    @elseif($activitiy->type=='meet')
                                                                                        <div
                                                                                            class="timeline-wrapper timeline timeline-wrapper-success">

                                                                                            @elseif($activitiy->type=='note')
                                                                                                <div
                                                                                                    class="timeline-wrapper timeline timeline-wrapper-info">

                                                                                                    @endif
                                                                                                    @endif
                                                                                                    @if($activitiy->type=='lunch')
                                                                                                        <div
                                                                                                            class="timeline-badge">
                                                                                                            <i class="las la-phone"></i>
                                                                                                        </div>
                                                                                                    @elseif($activitiy->type=='call')
                                                                                                        <div
                                                                                                            class="timeline-badge">
                                                                                                            <i class="far fa-calendar"></i>
                                                                                                        </div>

                                                                                                    @elseif($activitiy->type=='meet')
                                                                                                        <div
                                                                                                            class="timeline-badge">
                                                                                                            <i class="fe fe-clock"></i>
                                                                                                        </div>

                                                                                                    @elseif($activitiy->type=='note')
                                                                                                        <div
                                                                                                            class="timeline-badge">
                                                                                                            <i class="la la-sticky-note"></i>
                                                                                                        </div>

                                                                                                    @endif
                                                                                                    <div
                                                                                                        class="timeline-panel">
                                                                                                        <div
                                                                                                            class="timeline-heading">
                                                                                                            <h6 class="timeline-title">            {{$activitiy->title}}</h6>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="timeline-body">
                                                                                                            <p>{{$activitiy->comment}}</p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="timeline-footer d-flex align-items-center flex-wrap">

                                    <span class="mr-auto"><i
                                            class="fe fe-calendar text-muted mr-1"></i>{{$activitiy->end}}
                                    <-------------
                                    </span>
                                                                                                            <span
                                                                                                                class="mr-auto"><i
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

                                                    <form action="{{route('deal.destroy',$deal->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                     @include('Deal.delete')
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

