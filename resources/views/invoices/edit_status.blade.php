@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    Edit Invoice Status
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Edit Invoice Status</span>
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
                    <form action="{{ route('update_status',$invoice) }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <input name="invoice_id" type="hidden" value={{$invoice->id}} >
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Invoice Number</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number" value="{{$invoice->invoice_number}}" readonly >
                            </div>
                            @error('invoice_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label>Invoive Date</label>
                                <input class="form-control fc-datepicker" name="invoice_date" value="{{$invoice->invoice_date}}" placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            @error('invoice_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker" name="due_date" value="{{$invoice->due_date}}"  placeholder="YYYY-MM-DD" type="text" readonly>
                            </div>
                            @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Section</label>
                                <select name="section_id" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value="{{$invoice->section->id}}" selected >{{$invoice->section->section_name}}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label for="inputName" class="control-label">Product</label>
                                <select id="product" value="{{$invoice->product->id}}" name="product_id" class="form-control" readonly>
                                    <option value="{{ $invoice->product->id }}"> {{ $invoice->product->product_name}}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"> {{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('product_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- replace(/(\..*)\./g, '$1');"> replace anything that is not number with nothing --}}
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount</label>
                                <input type="text" class="form-control" id="collection_amount" value="{{$invoice->collection_amount}}" name="collection_amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                            </div>
                            @error('collection_amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col">
                                <label for="inputName" class="control-label">Commission Amount</label>
                                <input type="text" class="form-control form-control-lg" id="commission_amount"
                                    name="commission_amount" value="{{$invoice->commission_amount}}" title="Please enter commission amount "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                            </div>
                            @error('commission_amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    title="Please enter discount amount" {{$invoice->discount}}
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 readonly>
                            </div>
                            @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label for="inputName" class="control-label">VAT rate</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()" readonly>
                                    <!--placeholder-->
                                    <option value="{{$invoice->rat_vat}}" selected >{{$invoice->rate_vat}}</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>
                            @error('rate_vat')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">VAT value</label>
                                <input type="text" class="form-control" id="value_vat" name="value_vat" value="{{$invoice->value_vat}}"  readonly>
                            </div>
                            @error('value_vat')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label for="inputName" class="control-label">Total icluding VAT</label>
                                <input type="text" class="form-control" id="total" name="total" value="{{$invoice->total}}"  readonly>
                            </div>
                            @error('total')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Notes</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{$invoice->note}}"</textarea>
                            </div>
                            @error('note')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Update Payment Status</label>
                                <select name="status" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" >
                                    <!--placeholder-->
                                    <option value="0" selected >---Select status</option>
                                    <option value="unpaid">UnPaid</option>
                                    <option value="partially paid">Partially Paid</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label>Payment Date</label>
                                <input class="form-control fc-datepicker" name="payment_date" value="{{$invoice->payment_date}}"  placeholder="YYYY-MM-DD" type="text" >
                            </div>
                            @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div><br>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="custom_button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var sectionId = $(this).val();
                console.log(sectionId);
                if (sectionId) {
                    console.log(sectionId);
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to('/getProdsBySection') }}/" + sectionId ,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("commission_amount").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
            var Value_VAT = parseFloat(document.getElementById("value_vat").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('Please enter commission amount');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("value_vat").value = sumq;
                document.getElementById("total").value = sumt;
            }
        }
    </script>


@endsection
