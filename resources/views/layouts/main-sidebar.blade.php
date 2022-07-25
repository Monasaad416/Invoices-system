<!-- main-sidebar -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                <style>
                    .desktop-logo{
                        font-family: 'Dancing Script', cursive;
                        font-family:  'Roboto Mono', monospace;
                    }
                </style>
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='dashboard') }}"><h1>INVSYS</h1></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='dashboard') }}"><h1>INVSYS</h1></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><h6>INVSYS</h6></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><h6>INVSYS</h6></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/profile_avatar.png')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
						</div>
					</div>
				</div>
                <style>
                   .slide:hover .side-menu__label, .slide:hover .angle, .slide:hover .side-menu__icon ,.slide:hover .fa,.slide.is-expanded {
                        color: #d16672 !important;
                    }
                    .slide:focus .side-menu__label, .slide:focus .angle, .slide:focus .side-menu__icon ,.slide:focus .fa,.is-expanded {
                        color: #d16672 !important;
                    }
                  .slide.is-expanded .side-menu__label, .slide.is-expanded .side-menu__icon, .slide.is-expanded .angle {
                        color: #d16672 !important;
                    }
                    .side-menu__item.active .side-menu__label {
                        color: #7e87a0 !important;
                    }
                    .app-sidebar .slide .side-menu__item.active::before {
                        content: '';
                        width: 3px;
                        height: 31px;
                        background: #d16672;
                        position: absolute;
                        left: 0;
                    }
                </style>

				<ul class="side-menu">
					<li class="side-item side-item-category">Invoices System</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/dashboard') }}"><i class="fa fa-home mx-1 text-muted" aria-hidden="true"></i><span class="side-menu__label text-muted">Index</span></a>
					</li>
				   @can('invoices')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fa fa-list mx-1 text-muted" aria-hidden="true"></i><span class="side-menu__label">Invoices</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
						@can('invoices_list')
							<li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">Invoices List</a></li>
						@endcan
						@can('paid_invoices')
							<li><a class="slide-item" href="{{ url('/' . $page='paid_invoices') }}">Paid Invoices</a></li>
					    @endcan
						@can('unpaid_invoices')
							<li><a class="slide-item" href="{{ url('/' . $page='unpaid_invoices') }}">Unpaid Invoices</a></li>
						@endcan
						@can('archived_invoice')
							<li><a class="slide-item" href="{{ url('/' . $page='invoices_archive') }}">Archived Invoices</a></li>
						@endcan
						</ul>
					</li>
					@endcan
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fa fa-clone mx-1 text-muted" aria-hidden="true"></i><span class="side-menu__label">Reporsts</span><i class="fa fa-bar-chart" aria-hidden="true"></i><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='invoices_report') }}">Invoices Reports</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='customers_report') }}">Customers Reports</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fa fa-user-circle mx-1 text-muted" aria-hidden="true"></i><span class="side-menu__label">Users</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='users') }}">Users List</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='roles') }}">Users Permission</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fa fa-cogs mx-1 text-muted" aria-hidden="true"></i><span class="side-menu__label">Settings</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='sections') }}">Sections</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='products') }}">Products</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
