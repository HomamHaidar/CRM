@extends('layouts.master')

@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

    <style>
        body {
            margin-top: 30px;
        }
        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            color: #bbb;
        }
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصفقات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة صفقة</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                                    <p><small>بيانات الصفقة</small></p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                    <p><small>بيانات العميل</small></p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                    <p><small>بيانات المنتج</small></p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{route('deal.store')}}">
                            @csrf
                            <div class="panel panel-primary setup-content" id="step-1">
                                <div class="panel-heading">
                                    <h3 class="panel-title">الصفقة</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="form-label">العنوان</label>
                                        <input type="text" class="form-control required" name="title" placeholder="العنوان" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">الوصف</label>
                                        <textarea type="text" class="form-control required" name="description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">المستخدم مالك الصفقة</label>
                                        <select class="form-control select2" name="user_id" required>
                                            <option label="اختر المستخدم الذي يملك الصفقة" disabled selected>اختر المستخدم الذي يملك الصفقة</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-label">المستخدمون المشاركون</label>
                                        <select name="users_in[]" multiple="multiple" class="selectsum2" required>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-label">الوقت المتوقع للاغلاق</label>
                                        <input type="date" class="form-control required" name="expected_time" required>
                                    </div>
                                    <input type="hidden" class="form-control required" name="start" value="{{now()}}" required>

                                    <div class="form-group">
                                        <label class="form-label">اختر نموذج الرحلة</label>
                                        <select class="form-control select2" name="journey_id" required>
                                            <option label="اختر نموذج الرحلة" disabled selected>اختر نموذج الرحلة</option>
                                            @foreach($journeys as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button class="btn btn-primary nextBtn pull-right" type="button">التالي</button>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content" id="step-2">
                                <div class="panel-heading">
                                    <h3 class="panel-title">بيانات العميل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="form-label">اختر عميلا</label>
                                        <select class="form-control select2" name="client_id" required>
                                            <option label="اختر عميلا" disabled selected >اختر عميلا</option>
                                            @foreach ($clients as $client)
                                                <option value="{{$client->id}}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('client_id'))
                                            <div class="alert alert-danger">{{ $errors->first('client_id') }}</div>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">التالي</button>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content" id="step-3">
                                <div class="panel-heading">
                                    <h3 class="panel-title">بيانات المنتج</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="form-label">حدد المنتج</label>
                                        <select class="form-control select2" name="product_id" id="product_id">
                                            <option label="اختر المنتج" disabled selected>اختر المنتج</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{ $product->name }}</option>
                                            @endforeach
                                            @if($errors->has('product_id'))
                                                <div class="alert alert-danger">{{ $errors->first('product_id') }}</div>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">الكمية</label>
                                        <input type="number" class="form-control" placeholder="حدد الكمية" name="quantity" id="quantity">
                                        <div id="quantity-error" style="display: none; color: red;">الكمية المحددة غير متوفرة.</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">اضف ضريبة</label>
                                        <input type="number" class="form-control" placeholder="اضف ضريبة" name="tax" id="tax">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">المجموع النهائي</label>
                                        <input type="number" class="form-control" name="total" id="total" readonly>
                                    </div>
                                    <button class="btn btn-success pull-right" type="submit">حفظ!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>

    <script>
        $(document).ready(function () {
            var productPrice = 0;
            var availableQuantity = 0;

            $('#product_id').change(function () {
                var productId = $(this).val();

                if (productId) {
                    $.ajax({
                        url: '{{ url("/products") }}/' + productId,
                        type: 'GET',
                        success: function (data) {
                            productPrice = data.price;
                            availableQuantity = data.available_quantity;
                            $('#quantity-error').hide(); // Hide error message when product changes
                            calculateTotal();
                        },
                        error: function (error) {
                            alert('Failed to fetch product details');
                        }
                    });
                }
            });

            $('#quantity').on('input', function () {
                validateQuantity();
                calculateTotal();
            });

            $('#tax').on('input', function () {
                calculateTotal();
            });

            function validateQuantity() {
                var quantity = parseInt($('#quantity').val());

                if (isNaN(quantity) || quantity <= 0 || quantity > availableQuantity) {
                    $('#quantity-error').show();
                    return false;
                } else {
                    $('#quantity-error').hide();
                    return true;
                }
            }

            function calculateTotal() {
                var quantity = parseInt($('#quantity').val());
                var tax = parseFloat($('#tax').val());

                if (!validateQuantity()) {
                    $('#total').val('');
                    return;
                }

                if (isNaN(tax) || tax < 0) {
                    tax = 0;
                }

                var total = (quantity * productPrice) + tax;
                $('#total').val(total.toFixed(2));
            }

            // Prevent form submission if there is an error
            $('form').submit(function (event) {
                if (!validateQuantity()) {
                    event.preventDefault(); // Prevent form submission
                    alert('الكمية المحددة غير متوفرة .');
                }
            });

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],input[type='date'],input[type='number'],textarea,select"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-success').trigger('click');
        });
    </script>

    <!-- Internal Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{URL::asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-wizard js -->
    <script src="{{URL::asset('assets/js/form-wizard.js')}}"></script>
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!-- Internal Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Fileuploads js -->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <!-- Internal Fancy uploader js -->
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <!-- Internal Sumoselect js -->
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <!-- Internal TelephoneInput js -->
    <script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
@endsection
