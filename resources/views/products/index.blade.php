@extends('layouts.master')
@section('title')
Productd
@endsection
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
				<h4 class="content-title mb-0 my-auto">Settings </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <!-- add section button -->
                    <div class="col-sm-6 col-md-4 col-xl-3 my-4">
                        <button class="custom_button"><a class="modal-effect custom_link" data-effect="effect-flip-vertical" data-toggle="modal" href="#modaldemo8">Add Product</a></button>
                    </div>

                    <!-- table opened -->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
                                                <th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Product Name</th>
												<th class="border-bottom-0">Section Name</th>
                                                <th class="border-bottom-0">Description</th>
												<th class="border-bottom-0">Actions</th>
										</thead>
										<tbody>
                                            @foreach($products as $product)
                                            	<tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$product->product_name}}</td>
													<td>{{$product->section->section_name}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>
                                                        <a href="#edit{{$product->id}}" class="modal-effect btn btn-info btn-sm custom_link" data-effect="effect-flip-vertical" data-toggle="modal" title="Edit Product"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete{{ $product->id }}" title="Delete Product"><i
                                                                class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!--Edit Modal Start -->
                                                <div class="modal" id="edit{{$product->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Edit Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
																								<form method ="POST" action="{{route('products.update',$product)}}">
																									@csrf
																									{{ method_field('patch') }}
																									<div class="form-group">
																										<input class="form-control" placeholder="Enter product name" name="product_name" value="{{$product->product_name}}" type="text">
																									</div>
																									<input class="form-control" name="product_id" value="{{$product->id}}" type="hidden">
																									<div class="form-group">
																										<input class="form-control" placeholder="Enter product description" name="description" value="{{$product->description}}" type="text">
																									</div>
																									<div class="mb-4">
																										<p class="mg-b-10">Product</p>
																										<select name="section_id" class="form-control SlectBox">
																											<option value="{{$product->section->id}}">{{$product->section->section_name}}</option>
																											@foreach($sections as $sec)
																												<option value="{{$sec->id}}">{{$sec->section_name}}</option>
																											@endforeach
																										</select>
																									</div>
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
                                                <!--Edit Modal End -->


                                                <!--Delete Modal End-->
                                                <div class="modal" id="delete{{$product->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Delete Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('products.destroy',$product)}}">
                                                                                                    @csrf
                                                                                                     {{ method_field('delete') }}
                                                                                                    <p class="text-danger my-3">Are you sure you want to delete product?</p>
                                                                                                    <input class="form-control" placeholder="Enter section name" name="product_id" value="{{$product->id}}" type="hidden">
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


                                    <!-- Add Modal Start -->
                                    <div class="modal" id="modaldemo8">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Add New Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    	<div class="col-lg-12 col-md-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="bg-gray-200 p-4">
                                                                    			<form method ="POST" action="{{route('products.store')}}">
																					@csrf
																					<div class="form-group">
																						<input class="form-control" placeholder="Enter product name" name="product_name" type="text">
																					</div>
																					<div class="form-group">
																						<input class="form-control" placeholder="Enter product description" name="description" type="text">
																					</div>
																					<div class="mb-4">
																						<p class="mg-b-10">Section</p>
																						<select name="section_id" class="form-control SlectBox">
																							<option value='' selected disabled>---Select Section---</option>
																							@foreach($sections as $sec)
																								<option value="{{$sec->id}}">{{$sec->section_name}}</option>
																							@endforeach
																						</select>
																					</div>
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
							</div>
						</div>
					</div>
				<!-- /table -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
