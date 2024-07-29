@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">نماذج الرحلة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة النموذج</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        اضافة نموذج
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-gray-200 p-4">
                                <div class="form-group">
                                    <!-- resources/views/journeys/create.blade.php -->
                                    <form action="{{ route('journey.update', $journey->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="name">Journey Name:</label>
                                            <input type="text" id="name" name="name" value="{{ $journey->name }}" required>
                                        </div>

                                        <div id="stages">
                                            @foreach ($journey->stages as $index => $stage)
                                                <div class="stage">
                                                    <label for="stage_{{ $index }}">Stage {{ $index + 1 }}:</label>
                                                    <input type="hidden" name="stages[{{ $index }}][id]" value="{{ $stage->id }}">
                                                    <input type="text" id="stage_{{ $index }}" name="stages[{{ $index }}][name]" value="{{ $stage->name }}" required>
                                                    <button type="button" class="remove-stage">حذف</button>

                                                </div>
                                            @endforeach
                                        </div>

                                        <button class="btn btn-main-primary pd-x-20" type="button" id="addStage">اضف مرحلة</button>
                                        <button class="btn btn-success pd-x-20" type="submit">حفظ</button>
                                    </form>



                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
    <script>
        document.getElementById('addStage').addEventListener('click', function() {
            const stagesDiv = document.getElementById('stages');
            const newStageIndex = stagesDiv.children.length;
            const newStageDiv = document.createElement('div');
            newStageDiv.classList.add('stage');

            const newStageLabel = document.createElement('label');
            newStageLabel.setAttribute('for', `stage_${newStageIndex}`);
            newStageLabel.textContent = `Stage ${newStageIndex + 1}:`;

            const newStageInput = document.createElement('input');
            newStageInput.setAttribute('type', 'text');
            newStageInput.setAttribute('id', `stage_${newStageIndex}`);
            newStageInput.setAttribute('name', `stages[${newStageIndex}][name]`);
            newStageInput.setAttribute('required', true);

            const removeButton = document.createElement('button');
            removeButton.setAttribute('type', 'button');
            removeButton.classList.add('remove-stage');
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
                newStageDiv.remove();
            });

            newStageDiv.appendChild(newStageLabel);
            newStageDiv.appendChild(newStageInput);
            newStageDiv.appendChild(removeButton);

            stagesDiv.appendChild(newStageDiv);
        });

        document.querySelectorAll('.remove-stage').forEach(button => {
            button.addEventListener('click', function() {
                button.parentElement.remove();
            });
        });
    </script>
    <!--Internal  Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
    <!-- Internal TelephoneInput js-->

    <script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
@endsection



