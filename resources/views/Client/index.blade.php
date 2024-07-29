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
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سجل العملاء</span>
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
                    @can('add client')
                        <div class="col-sm-6 col-md-3 mg-t-10">
                            <a class="btn btn-success-gradient btn-block" type="button" href="{{route('client.create')}}">اضافة عميل</a>
                        </div>
                    @endcan
                    <div class="card-header pb-0">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">العملاء</h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">الاسم</th>
                                    <th class="border-bottom-0">البريد الالكتروني</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">الهاتف</th>
                                    <th class="border-bottom-0">اسم الشركة</th>

                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    @foreach($clients as $client)
                                    <td>
                                        <a class="btn-link" @can('show client') href={{route('client.show',$client->id)}} @endcan>{{$client->name}}</a>
                                    </td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>  {{$client->phone}}</td>
                                    @if($client->company==null)
                                    <td>مستقل</td>
                                     @else
                                     <td>{{$client->company->name}}</td>
                                    @endif

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

