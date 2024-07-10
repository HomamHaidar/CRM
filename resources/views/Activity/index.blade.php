@extends('layouts.master')
@section('css')
    <!-- Internal CSS -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        .breadcrumb-header .content-title {
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .btn-info, .btn-danger, .btn-warning {
            margin-right: 10px;
        }

        .task-table th, .completed-task-table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .task-table td, .completed-task-table td {
            text-align: center;
            vertical-align: middle;
        }

        .completed-task {
            text-decoration: line-through;
            background-color: #f0f0f0;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .main-content-label {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
        }

        .completed-task-section {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المهام</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المهمات</span>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="card">
        <div class="card-body p-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="pd-t-20 pd-l-20 pd-r-20 d-flex justify-content-between align-items-center">
                <div>
                    <div class="main-content-label">المهام</div>
                </div>
                <div>
                    <a type="button" data-target="#createModal" class="btn ripple btn-success text-white btn-icon" data-placement="top" data-toggle="modal" title="اضافة مهمة">
                        <i class="fe fe-check-square"></i>
                    </a>
                </div>
            </div>
            <br>

            <div class="table-responsive">
                <table class="table table-bordered task-table" id="task-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>المهمة</th>
                        <th>النوع</th>
                        <th>في صفقة</th>
                        <th>في عميل محتمل</th>
                        <th>من </th>
                        <th>الى</th>
                        <th>المستخدمين المشاركين</th>
                        <th>مسندة من قبل</th>
                        <th>ملاحظات</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="task-body">
                    @foreach($activity as $a)
                        @if (!$a->is_done)
                            <tr>
                                <td>
                                    <input type="checkbox" class="complete-task" data-task-id="{{ $a->id }}" {{ $a->is_done ? 'checked' : '' }}>
                                </td>
                                <td class="task-name">{{ $a->title }}</td>
                                <td>{{ $a->type }}</td>
                                <td></td>
                                @foreach($a->clients as $cc)
                                    <td>{{ $cc->name }}</td>
                                @endforeach
                                <td>{{ $a->start }}</td>
                                <td>{{ $a->end }}</td>
                                <td>
                                    <button class="btn ripple btn-primary" data-toggle="dropdown" type="button">المستخدمين لهذه المهمة
                                        <i class="fas fa-caret-down ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        @foreach($a->users as $usersto)
                                            <a class="dropdown-item" href="{{ route('user.show', $usersto->id) }}">{{ $usersto->name }}</a>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $a->user->name }}</td>
                                <td>{{ $a->comment }}</td>
                                <td>
                                    @if($a)
                                    <i class="si si-pencil text-primary mr-2" data-target="#editModal{{$a->id}}"  data-toggle="modal" title="Edit"></i>

                                    @endif
                                        <form action="{{route('activity.destroy',$a->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @include('Activity.delete')
                                    </form>
                                    <i class="si si-trash text-danger mr-2" data-target="#deleteModal{{$a->id}}" data-toggle="modal" title="Delete"></i>
                                </td>
                                @include('Activity.edit')
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card completed-task-section mt-4">
        <div class="card-body p-0">
            <div class="pd-t-20 pd-l-20 pd-r-20">
                <div class="main-content-label">المهام المكتملة</div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered completed-task-table" id="completed-task-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>المهمة</th>
                        <th>النوع</th>
                        <th>في صفقة</th>
                        <th>في عميل محتمل</th>
                        <th>من </th>
                        <th>الى</th>
                        <th>المستخدمين المشاركين</th>
                        <th>مسندة من قبل</th>
                        <th>ملاحظات</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="completed-task-body">
                    @foreach($activity as $a)
                        @if ($a->is_done)
                            <tr class="completed-task">
                                <td>
                                    <input type="checkbox" class="complete-task" data-task-id="{{ $a->id }}" {{ $a->is_done ? 'checked' : '' }}>
                                </td>
                                <td class="task-name">{{ $a->title }}</td>
                                <td>{{ $a->type }}</td>
                                <td></td>
                                @foreach($a->clients as $cc)
                                    <td>{{ $cc->name }}</td>
                                @endforeach
                                <td>{{ $a->start }}</td>
                                <td>{{ $a->end }}</td>
                                <td>
                                    <button class="btn ripple btn-primary" data-toggle="dropdown" type="button">المستخدمين مع هذا العميل
                                        <i class="fas fa-caret-down ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        @foreach($a->users as $usersto)
                                            <a class="dropdown-item" href="{{ route('user.show', $usersto->id) }}">{{ $usersto->name }}</a>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $a->user->name }}</td>
                                <td>{{ $a->comment }}</td>
                                <td>

                                </td>
                            </tr>



                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('Activity.create')

@endsection
@section('js')
    <!-- Internal JS -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const completeTaskCheckboxes = document.querySelectorAll('.complete-task');

            completeTaskCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const taskId = this.getAttribute('data-task-id');
                    const isDone = this.checked ? 1 : 0;

                    fetch(`/activity/${taskId}/complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ is_done: isDone })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const taskRow = this.closest('tr');
                                if (isDone) {
                                    taskRow.classList.add('completed-task');
                                    document.getElementById('completed-task-body').appendChild(taskRow);
                                } else {
                                    taskRow.classList.remove('completed-task');
                                    document.getElementById('task-body').appendChild(taskRow);
                                }
                            }
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dealSelect = document.getElementById('dealSelect');
            const leadSelect = document.getElementById('leadSelect');

            dealSelect.addEventListener('change', function () {
                if (dealSelect.value) {
                    leadSelect.disabled = true;
                    leadSelect.value = "";
                } else {
                    leadSelect.disabled = false;
                }
            });

            leadSelect.addEventListener('change', function () {
                if (leadSelect.value) {
                    dealSelect.disabled = true;
                    dealSelect.value = "";
                } else {
                    dealSelect.disabled = false;
                }
            });
        });
    </script>
@endsection
