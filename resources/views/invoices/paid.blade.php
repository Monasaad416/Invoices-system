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
							<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Paid Invoices</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
    Paid Invoices
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                <!-- table opened -->
					<div class="col-xl-12">
						<div class="card mg-b-20">
					         <!-- add section button -->
						<h3 class="mx-3 my-3">Paid Invoices</h3>

							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
                                                <th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Invoice Number</th>
												<th class="border-bottom-0">Invoice Date</th>
												<th class="border-bottom-0">Due Date</th>
												<th class="border-bottom-0">Product</th>
												<th class="border-bottom-0">Section</th>
                                                <th class="border-bottom-0">Discount</th>
                                                <th class="border-bottom-0">Rate VAT</th>
                                                <th class="border-bottom-0">Value Vat</th>
                                                <th class="border-bottom-0">Total</th>
                                                <th class="border-bottom-0">Notes</th>
                                                <th class="border-bottom-0">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($paid_invoices as $invoice)
												<tr>
													<td>{{$loop->iteration}}</td>
													<td class="color"><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a></td>
													<td>{{$invoice->invoice_date}}</td>
													<td>{{$invoice->due_date}}</td>
                                                    <td class="color"><a href="{{route('sections.show',$invoice->section->id)}}">{{$invoice->section->section_name}}</a></td>
													<td>{{$invoice->product->product_name}}</td>
													<td>{{$invoice->discount}}</td>
													<td>{{$invoice->rate_vat}}</td>
													<td>{{$invoice->value_vat}}</td>
													<td>{{$invoice->total}}</td>
													<td>{{$invoice->note}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="custom_button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                              Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                              <a class="dropdown-item"  href="{{route('invoices.edit',$invoice)}}">
                                                                <i class="fa fa-edit text-info mx-1"></i>Edit Invoice
                                                              </a>
                                                              <a class="dropdown-item" href="#" class="modal-effect text-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-effect="effect-flip-vertical"
                                                                data-target="#delete{{ $invoice->id }}" title="Delete Invoice">
                                                                    <i class="fa fa-trash text-danger mx-1"></i> Delete Invoice
                                                              </a>
                                                              <a class="dropdown-item" href="{{route('edit_status',['invoice_id'=>$invoice->id])}}"><i class="fa fa-edit text-warning mx-1"></i> Edit Status</a>

                                                          </div>
                                                    </td>
												</tr>

												<!--Delete Modal End-->
                                                <div class="modal" id="delete{{$invoice->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Delete Invoice</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('invoices.destroy',$invoice)}}">
                                                                                                    @csrf
                                                                                                     {{ method_field('delete') }}
                                                                                                    <p class="text-danger font-weight-bold my-3">Are you sure you want to delete invoice number {{$invoice->invoice_number}}</p>
                                                                                                    <input class="form-control" placeholder="Enter section name" name="invoice_id" value="{{$invoice->id}}" type="hidden">
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
                                                <!--Delete Modal End-->
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<!-- /table -->
				</div>
				<!-- row closed -->
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
@endsection

