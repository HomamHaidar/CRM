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
                <h4 class="content-title mb-0 my-auto">نماذج الرحلة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> </span>
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
                @can('add journey')
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <a class="btn btn-success-gradient btn-block" type="button" href="{{route('journey.create')}}">اضافة نموذج</a>
                    </div>
                @endcan
                <div class="card-header pb-0">

                    <div class="d-flex justify-content-between">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="wd-lg-20p"><span>اسم النموذج</span></th>
                                <th class="wd-lg-20p"><span>المراحل</span></th>
                                <th class="wd-lg-20p">العمليات</th>
                            </tr>
                            </thead>
                           @foreach($journey as $j)
                            <tbody>
                            <td>
                                {{$j->name}}
                            </td>

                            <td>

                                <select class="form-control">
                                    <option value="" disabled selected>المراحل </option>
                                    @foreach($j->stages as $js)
                                        <option value="{{ $js->id }}" >{{ $js->name }}</option>
                                    @endforeach
                                </select>

                            </td>

                            <td >
                                @can('delete journey')
                                    <button class="btn btn-danger-gradient btn-default" data-toggle="modal"
                                            data-target="#exampleModal{{$j->id}}">حذف النموذج
                                    </button>
                                @endcan

                               @can('edit journey')
                                <a class="btn btn-info-gradient btn-default" type="submit"
                                   href="{{route('journey.edit',$j->id)}}">تعديل النموذج
                                </a>
                                @endcan


                                <form action="{{route('journey.destroy',$j->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @include('journey.delete')
                                </form>
                            </td>
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
@endsection
@section('js')
    <script>
        document.getElementById('addStage').addEventListener('click', function() {
            const stagesDiv = document.getElementById('stages');
            const newStageIndex = stagesDiv.children.length / 2; // adjust based on your HTML structure
            const newStageLabel = document.createElement('label');
            newStageLabel.setAttribute('for', `stage_${newStageIndex}`);
            newStageLabel.textContent = `Stage ${newStageIndex + 1}:`;
            const newStageInput = document.createElement('input');
            newStageInput.setAttribute('type', 'text');
            newStageInput.setAttribute('id', `stage_${newStageIndex}`);
            newStageInput.setAttribute('name', `stages[${newStageIndex}][name]`);
            newStageInput.setAttribute('required', true);
            stagesDiv.appendChild(newStageLabel);
            stagesDiv.appendChild(newStageInput);
        });
    </script>
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

