@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice Details</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('title')
    Invoice Details
@endsection
@section('content')
    <div class="panel panel-primary tabs-style-2">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#details" class="nav-link active" data-toggle="tab">Invoice Details</a></li>
                    <li><a href="#status" class="nav-link" data-toggle="tab">Payment Status</a></li>
                    <li><a href="#attachments" class="nav-link" data-toggle="tab">Attachments</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class="tab-pane active" id="details">
                   	<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table key-buttons text-md-nowrap">
								<tbody>
									<tr>
                                 
										<th class="border-bottom-0">Invoice Number</th>
										<td>{{$invoice->invoice_number}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Invoice Date</th>
										<td>{{$invoice->invoice_date}}</td>
								    </tr>
									<tr>
										<th class="border-bottom-0">Due Date</th>
										<td>{{$invoice->due_date}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Product</th>
										<td>{{$invoice->product->product_name}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Section</th>
										<td class="color"><a href="{{route('sections.show',$invoice->section->id)}}">{{$invoice->section->section_name}}</a></td>
									</tr>
									<tr>
										<th class="border-bottom-0">Collection Amount</th>
										<td>{{$invoice->collection_amount}}</td>
									</tr>

									<tr>
										<th class="border-bottom-0">Commission Amount</th>
										<td>{{$invoice->commission_amount}}</td>
									</tr>

									<tr>
										<th class="border-bottom-0">Discount</th>
										<td>{{$invoice->discount}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Rate VAT</th>
										<td>{{$invoice->rate_vat}}</td>
								    </tr>
                                    <tr>
										<th class="border-bottom-0">Value Vat</th>
										<td>{{$invoice->value_vat}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Total</th>
										<td>{{$invoice->total}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Status</th>
											<td>
											@if ($invoice->value_status == 1)
												<span class="text-success">{{ $invoice->status }}</span>
											@elseif($invoice->value_status == 2)
												<span class="text-danger">{{ $invoice->status }}</span>
											@else
												<span class="text-warning">{{ $invoice->status }}</span>
											@endif
										</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Notes</th>
										<td>{{$invoice->note}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Created At</th>
										<td>{{$invoice->created_at}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">User</th>
										<td>{{Auth::user()->name}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
                </div>
                <div class="tab-pane" id="status">
                   <div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table key-buttons text-md-nowrap">
								<tbody>
									<tr>
										<th class="border-bottom-0">Invoice Number</th>
										<td>{{$invoice->invoice_number}}</td>
									</tr>
									<tr>
										<th class="border-bottom-0">Status</th>
											<td>
											@if ($invoice->value_status == 1)
												<span class="btn btn-success">{{ $invoice->status }}</span>
											@elseif($invoice->value_status == 2)
												<span class="btn btn-danger">{{ $invoice->status }}</span>
											@else
												<span class="btn btn-warning">{{ $invoice->status }}</span>
											@endif
										</td>
									</tr>
									<tr>
										<th class="border-bottom-0">User</th>
										<td>{{Auth::user()->name}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
                </div>
                <div class="tab-pane" id="attachments">
					<div class="card-body">
                         <div class="my-auto">
            {{-- Add New Attachment Button --}}
            <div class="col-sm-6 col-md-4 col-xl-3 my-5">
                <button class="custom_button"><a class="modal-effect custom_link" data-effect="effect-flip-vertical" data-toggle="modal" href="#add-attachment">Add Attachment</a></button>
            </div>
            <!-- Add Modal Start -->
            <div class="modal" id="add-attachment">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Add New Attachment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="bg-gray-200 p-4">
                                                        <form method ="POST" action="{{route('invoice_attachments.store')}}"  enctype="multipart/form-data">
                                                            @csrf
                                                            <p class="text-danger">* Attachment type  pdf, jpeg ,.jpg , png </p>
                                                            <div class="col-sm-12 col-md-12">
                                                                <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                                            </div><br>
                                                            @error('file_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <input type="hidden" class="form-control" id="invoice_id" name="invoice_id" value={{$invoice->invoice_id}}  >
                                                            <input type="hidden" class="form-control" id="invoice_number" name="invoice_number" value={{$invoice->invoice_number}} title="Invoice Number" >
                                                            <div class="modal-footer">
                                                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                                                <button type="submit" class="btn btn-main-primary pd-x-20">Submit</button>
                                                            </div>

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
            <!--Add Modal End-->
        </div>
            <div class="table-responsive">
                    <table id="attachments" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">File name</th>
                                    <th class="border-bottom-0">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice_attachments as $attach)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{basename($attach->file_name)}}</td>

                                        <td>
                                            <a class="modal-effect btn btn-warning btn-sm" data-effect="effect-flip-vertical" data-toggle="modal" href="#view{{$attach->id}}"><i class="fa fa-eye text-white"></i></a>
                                            <a href="{{route('download',['invoice_number' => $invoice->invoice_number ,'file' => basename($attach->file_name) ] )}}" class="btn btn-info btn-sm" title="download Attachment"><i class="fa fa-download text-white"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete{{$attach->id }}" title="Delete Attachment"><i
                                                class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <style>
                                            .modal-dialog {
                                                max-width: 65% !important;
                                                max-height: 60% !important
                                            }
                                        </style>
                    
                                        <!--Delete Attachment End-->
                                        <div class="modal" id="delete{{$attach->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Delete Attachment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="bg-gray-200 p-4">
                                                                                        <form method ="POST" action="{{route('invoice_attachments.destroy',$attach->id)}}">
                                                                                            @csrf
                                                                                            {{ method_field('delete') }}
                                                                                            <p class="text-danger my-3">Are you sure you want to attachment : {{$attach->name}}?</p>
                                                                                            <input class="form-control" placeholder="Enter section name" name="file_id" value="{{$attach->id}}" type="hidden">
                                                                                            <div class="modal-footer">
                                                                                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                                                                                <button type="submit" class="btn btn-danger pd-x-20">Delete</button>
                                                                                            </div>

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
                                        <!--Delete Attachment End-->

                                        <!-- View Attachment Modal Start -->
                                        <div class="modal" id="view{{$attach->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Open Attachment <span style="color:#BF9270;">{{ basename($attach->file_name)}}</span></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                @if (pathinfo($attach->file_name, PATHINFO_EXTENSION) == 'png' ||
                                                                                    pathinfo($attach->file_name, PATHINFO_EXTENSION) == 'jpg' ||
                                                                                    pathinfo($attach->file_name, PATHINFO_EXTENSION) == 'jpeg')
                                                                                    <img src="{{asset("uploads/" .$attach->file_name)}}" alt="attchment"/>
                                                                                @endif
                                                                                @if (pathinfo($attach->file_name, PATHINFO_EXTENSION) == 'pdf')
                                                                                    <iframe src="{{ asset("uploads/" .$attach->file_name) }}" width="100%" height="100%">
                                                                                        This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('folder/file_name.pdf') }}">Download PDF</a>
                                                                                    </iframe>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--View Attachment Modal End-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('js')
<!-- Internal Data tables -->
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


{{-- <script>
    $('.delete_attachment').click(function(){
        let fileName = $(this).attr('data-file-name');
        let invoiceNo = $(this).attr('data-invoive-no');
        let fileId = $(this).attr('data-file-id');

        $('#delete-file-name').val(id);
        $('#delete-invoice-no').val(nameEn);
        $('#ddelete-file-id').val(nameAr);
})
</script> --}}

@endsection



