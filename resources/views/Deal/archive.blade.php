@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الارشيف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ارشيف الصفقات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->


    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-header pb-0">

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">الصفقات</h4>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">عنوان الصفقة</th>
                                <th class="border-bottom-0">العميل </th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">مفتتح الصفقة</th>
                                <th class="border-bottom-0">المستخدمين المشاركين</th>
                                <th class="border-bottom-0">موعد البداية</th>
                                <th class="border-bottom-0">موعد النهاية</th>
                                <th class="border-bottom-0">الاجمالي</th>
                                <th class="border-bottom-0">نموذج الرحلة</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">افكارك عن الصفقة</th>



                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                @foreach($deals as $deal)
                                    <td>
                                        {{$deal->title}}
                                    </td>
                                    <td>{{$deal->client->name}}</td>
                                    <td>{{$deal->product->name}}</td>
                                    <td>{{$deal->user->name}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary" data-toggle="dropdown"
                                                    id="dropdownMenuButton" type="button">المستخدمين مع هذا العميل <i
                                                    class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                @foreach($deal->users as $user)
                                                    <a class="dropdown-item"
                                                       href="{{route('user.show',$user->id)}}">{{$user->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($deal->start)->format('Y-m-d') }}</td>

                                    <td>{{ \Carbon\Carbon::parse($deal->end)->format('Y-m-d') }}</td>
                                    <td>{{$deal->total}}</td>
                                    <td>{{$deal->journey->name}}</td>
                                    @if($deal->status)
                                        <td class="badge-success">
                                          فوز
                                        </td>
                                  @else
                                        <td class="badge-danger">
                                            خسارة
                                        </td>
                                    @endif
                                    <td>{{$deal->reason}}</td>


                            </tr>

                            @endforeach


                            </tbody>
                        </table>
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
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
