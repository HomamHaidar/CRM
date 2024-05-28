@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء المحتملين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سجل العملاء</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->


    <div class="col-lg-4 mg-t-20 mg-lg-t-0" >
        <form method="POST" action="{{ route('lead.update') }}">
            @method('PUT')
            @csrf
            <select class="form-control select2" name="client_id" onchange="if (this.value == '-1') { window.location.href = '{{ route('client.create', ['source' => 'select_option']) }}'; } else { this.form.submit(); }">

                <option label="Choose one">
                    اختر احد عملائك لبدء المفاوضات
                </option>
                @foreach($clients as $client)
                    <option  value="{{$client->id}}">
                        {{$client->name}}
                    </option>
                @endforeach
                    <option value="-1" >
                    <span class="btn-link">ليس من عملائك السابقين؟</span>

                    </option>

            </select>

        </form>
    </div><!-- col-4 -->
        <div class="row">

            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="col-sm-6 col-md-3 mg-t-10">

                    </div>
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
                                    @foreach($leads as $lead)
                                    <td>
                                        <a class=" btn-link-" href="{{route('lead.show',$lead->id)}}">{{$lead->name}}</a>
                                    </td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->address}}</td>
                                    <td>  {{$lead->phone}}</td>
                                    <td>{{$lead->company->name}}</td>


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
            <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

            <!--Internal  Datatable js -->
            <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
            <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
            <!--Internal  jquery.maskedinput js -->
            <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
            <!--Internal  spectrum-colorpicker js -->
            <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
            <!-- Internal Select2.min js -->
            <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
            <!--Internal Ion.rangeSlider.min js -->
            <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
            <!--Internal  jquery-simple-datetimepicker js -->
            <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
            <!-- Ionicons js -->
            <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
            <!--Internal  pickerjs js -->
            <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
            <!-- Internal form-elements js -->
            <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
        @endsection

