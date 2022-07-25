@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                    <p class="mg-b-0">Invoices system monitoring dashboard.</p>
                </div>
            </div>

        </div>
        <!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">Invoices ({{number_format(App\Models\Invoice::count())}})</h6>
								</div>
								<div class="pb-0 mt-0">
									<div>
										<div>
											<h4 class="tx-20 font-weight-bold mb-1 text-white"> ${{number_format(App\Models\Invoice::sum('total'))}}</h4>
										</div>
                                        @if(isset($invoices_count))
                                            <div>
                                            @if(round($invoices_count / $invoices_count * 100 , 2) >= 50)
                                                <i class="fas fa-arrow-circle-up text-white"></i>
                                            @else
                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                            @endif
                                                <span class="text-white op-7"> {{round($invoices_count / $invoices_count * 100 , 2)}}% </span>
                                            </div>
                                        @endif
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">Unpaid Invoices ({{number_format(App\Models\Invoice::where('status','unpaid')->count())}})</h6>
								</div>
								<div class="pb-0 mt-0">
									<div>
										<div>
											<h4 class="tx-20 font-weight-bold mb-1 text-white"> ${{number_format(App\Models\Invoice::where('status','unpaid')->sum('total'))}}</h4>

										</div>
                                        @if(isset($invoices_count))
                                            <div>
                                                @if(round($unpaid_invoices_count/ $invoices_count * 100 , 2) >= 50 )
                                                    <i class="fas fa-arrow-circle-up text-white"></i>
                                                @else
                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                @endif
                                            <span class="text-white op-7">{{round($unpaid_invoices_count / $invoices_count * 100 , 2)}}% </span>
                                            </div>
                                        @endif
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">Paid Invoices ({{number_format(App\Models\Invoice::where('status','paid')->count())}})</h6>
								</div>
								<div class="pb-0 mt-0">
									<div>
										<div>
											<h4 class="tx-20 font-weight-bold mb-1 text-white"> ${{number_format(App\Models\Invoice::where('status','paid')->sum('total'))}}</h4>

										</div>
                                        @if($invoices_count)
										<div>
											@if(round($paid_invoices_count/ $invoices_count * 100 , 2) >= 50 )
												<i class="fas fa-arrow-circle-up text-white"></i>
											@else
											<i class="fas fa-arrow-circle-down text-white"></i>
											@endif
											<span class="text-white op-7">{{round($paid_invoices_count / $invoices_count * 100 ,2)}}% </span>
										</div>
                                        @endif
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-12">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-0">Invoices status </h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
                                @if(isset($barChartjs))
                                    <div style="width:75%;">
                                {!! $barChartjs->render() !!}
                                    </div>
                                @endif
                            </div>
						</div>
					</div>

				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">Recent Customers</h3>
								<p class="tx-12 mb-0 text-muted">A customer is an individual or business that purchases the goods service has evolved to include real-time</p>
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="list-group list-lg-group list-group-flush">
                                    @foreach ($sections as $section)
                                        <div class="list-group-item list-group-item-action" href="#">
                                            <div class="media mt-0">
                                                {{-- <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/3.jpg')}}" alt="Image description"> --}}
                                                <div class="media-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="mt-0">
                                                            <h5 class="mb-1 tx-15">{{$section->section_name}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">Recent Products</h3>
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="list-group list-lg-group list-group-flush">
                                    @foreach ($products as $product)
                                        <div class="list-group-item list-group-item-action" href="#">
                                            <div class="media mt-0">
                                                {{-- <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/3.jpg')}}" alt="Image description"> --}}
                                                <div class="media-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="mt-0">
                                                            <h5 class="mb-1 tx-15">{{$product->product_name}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">Recent Paid Invoice</h3>
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="mx-2">
                                    <h5>Invoice amount : <span>${{$recently_paid->total}}</span></h5>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- row close -->


		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
