@extends('layouts.master2')

@section('title')
    Register
@stop


@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
                                       <style>
                                            .desktop-logo{
                                                font-family: 'Dancing Script', cursive;
                                                font-family:  'Roboto Mono', monospace;
                                            }
                                        </style>
										<div class="mb-5 d-flex desktop-logo"> <a href="{{ url('/' . $page='Home') }}"><img src="{{URL::asset('assets/img/logo.jfif')}}" class="sign-favicon ht-40" alt="logo"></a><h1 style="color:#d16672" class="main-logo1 ml-1 mr-0 my-auto tx-28">INVSYS</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>Welcome,</h2>
												<h5 class="font-weight-semibold mb-4"> Register</h5>
                                                <form method="POST" action="{{ route('register') }}">
                                                 @csrf

                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <!-- Name -->
                                                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
													</div>
													<div class="form-group">
                                                        <label>E-Mail</label>
                                                            <!-- Email Address -->

                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
													</div>

												 <div class="form-group">
                                                    <label>Password</label>

                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
												  </div>


                                                 <div class="form-group">
                                                    <label>Confirm Password</label>

                                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">

                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
												  </div>

                                                    <button type="submit" class="custom_button btn-block">
                                                    {{ __('Register') }}
                                                    </button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->

                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/logo.jfif')}}" class="rounded-circle my-auto ht-xl-40p wd-md-100p wd-xl-40p mx-auto" alt="logo">
						</div>
					</div>
				</div>



           <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

			</div>
		</div>
@endsection
@section('js')
@endsection
