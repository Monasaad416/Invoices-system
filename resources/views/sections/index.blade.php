@extends('layouts.master')
@section('title')
Sections
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
							<h4 class="content-title mb-0 my-auto">Settings </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Sections</span>
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
                        <button class="custom_button"><a class="modal-effect custom_link" data-effect="effect-flip-vertical" data-toggle="modal" href="#modaldemo8">Add Section</a></button>
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
												<th class="border-bottom-0">Section Name</th>
                                                <th class="border-bottom-0">Description</th>
												<th class="border-bottom-0">Actions</th>
										</thead>
										<tbody>
                                            @foreach($sections as $sec)
                                            	<tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$sec->section_name}}</td>
                                                    <td>{{$sec->description}}</td>
                                                    <td>
                                                        <a href="#edit{{$sec->id}}" class="modal-effect btn btn-info btn-sm custom_link" data-effect="effect-flip-vertical" data-toggle="modal" title="Edit Section"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_sec{{ $sec->id }}" title="Delete Section"><i
                                                                class="fa fa-trash"></i>
                                                        </button>
                                                        {{-- <a href="{{route('t_seczes.show',$sec->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true"><i class="fa fa-binoculars" title="{{trans('sec_trans.show_questions')}}"></i></a> --}}
                                                    </td>
                                                </tr>
                                                <!--Edit Modal Start -->
                                                <div class="modal" id="edit{{$sec->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Edit Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('sections.update',$sec->id)}}">
                                                                                                    @csrf
                                                                                                     {{ method_field('patch') }}
                                                                                                    <div class="form-group">
                                                                                                        <input class="form-control" placeholder="Enter section name" name="section_name" value="{{$sec->section_name}}" type="text">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input class="form-control" placeholder="Enter section description" name="description" value="{{$sec->description}}" type="text">
                                                                                                    </div>
                                                                                                    <input class="form-control" placeholder="Enter section name" name="sec_id" value="{{$sec->id}}" type="hidden">
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
                                                <div class="modal" id="delete_sec{{$sec->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Delete Section</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('sections.destroy',$sec)}}">
                                                                                                    @csrf
                                                                                                     {{ method_field('delete') }}
                                                                                                    <p class="text-danger my-3">Are you sure you want to delete section?</p>
                                                                                                    <input class="form-control" placeholder="Enter section name" name="sec_id" value="{{$sec->id}}" type="hidden">
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
                                                                                    <form method ="POST" action="{{route('sections.store')}}">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <input class="form-control" placeholder="Enter section name" name="section_name" type="text">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input class="form-control" placeholder="Enter section description" name="description" type="text">
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
