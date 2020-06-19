<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Личный кабинет</title>
	<!-- plugins:css -->
	<link rel="stylesheet"
	      href="{{ asset('profile_theme') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="{{ asset('profile_theme') }}/assets/vendors/css/vendor.bundle.base.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" />
	<link  href="{{ asset('js/cropperjs/dist/cropper.css') }}" rel="stylesheet">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<!-- endinject -->
	<!-- Layout styles -->
	<link rel="stylesheet" href="{{ asset('profile_theme') }}/assets/css/style.css?v={{ time() }}">
	<link rel="stylesheet" href="{{ asset('profile_theme') }}/assets/css/main.css?v={{ time() }}">
	<link rel="stylesheet" href="{{ asset('profile_theme') }}/assets/css/datepicker-ui.css">
	<link rel="stylesheet" href="{{ asset('js/bar-rating/dist/themes/fontawesome-stars-o.css') }}">

	<!-- file uploader -->
	<link href="{{ asset('js') }}/fileuploader/dist/font/font-fileuploader.css" media="all" rel="stylesheet"> 
	<link href="{{ asset('js') }}/fileuploader/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
	
	<link rel="stylesheet" href="/css/loader.css">
	<!-- End layout styles -->
	<link rel="shortcut icon" href="/fav.ico"> 
	<script>
		var commision_withdrawal = {{ toFloat(setting('commision_withdrawal')) }};
		var minimum_withdrawal = {{ (setting('commision_withdrawal') > setting('minimum_withdrawal')) ? toFloat(setting('commision_withdrawal')) : toFloat(setting('minimum_withdrawal')) }};
	</script>
</head>
<body>
<div class="page-preloader">
	<div class="flip-square-loader mx-auto"></div>
</div>

<style> 
	.page-preloader{
		display: none;
		position: fixed;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0;
		z-index: 999999;
		margin:auto;
		opacity: 1 !important;
		background: rgba(255,255,255,.5);
		justify-content: center;
		align-items: center;
		width: 100%;
		height: 100%;
	}

	.flip-square-loader { 
	  -webkit-perspective: 120px;
	  -moz-perspective: 120px;
	  -ms-perspective: 120px;
	  perspective: 120px;
	  width: 100px;
	  height: 100px;
	  border-radius: 100%;
	  position: relative;
	  margin: 0 auto;
	}

	.flip-square-loader:before {
	  content: "";
	  position: absolute;
	  left: 25px;
	  top: 25px;
	  width: 50px;
	  height: 50px;
	  background-color: #219fe0;
	  animation: flip 1s infinite;
	}

	@keyframes flip {
	  0% {
	    transform: rotate(0);
	  }
	  50% {
	    transform: rotateY(180deg);
	  }
	  100% {
	    transform: rotateY(180deg) rotateX(180deg);
	  }
	}
</style>

<div class="container-scroller">
	<!-- partial:partials/_navbar.html -->
	<nav
		class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
		<div
			class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
			<a class="navbar-brand brand-logo" href="/"><img
				src="/img/logo.png" alt="logo"/></a>

			<a class="navbar-brand brand-logo-mini" href="/"><img
				src="/img/logo-mob.png" alt="logo"/></a>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-stretch">
			<button class="navbar-toggler navbar-toggler align-self-center"
			        type="button" data-toggle="minimize">
				<span class="mdi mdi-menu"></span>
			</button>
			
			<ul class="navbar-nav navbar-nav-right">
				<li class="nav-item nav-profile dropdown">
					<a class="nav-link"
					   href="{{ route('account', ['lang' => $lang]) }}">
						<div class="nav-profile-img">
							<img src="{{ imageThumb(Auth::user()->image, 'uploads/clients', 181, 181, 0) }}"
							     alt="image">
							<span class="availability-status online"></span>
						</div>
						<div class="nav-profile-text">
							<p class="mb-1 text-black">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
						</div>
					</a>
				 
				</li>
				<li class="nav-item nav-logout d-none d-lg-block">
					<a class="nav-link" href="{{ route('logout', ['lang' => $lang]) }}">
						<i class="mdi mdi-power"></i>
					</a>
				</li>
			</ul>
			<button
				class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
				type="button" data-toggle="offcanvas">
				<span class="mdi mdi-menu"></span>
			</button>
		</div>
	</nav>
	<!-- partial -->
	<div class="container-fluid page-body-wrapper">
		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				@php
					$menu = \App\Models\ProfileMenu::accessType(Auth()->user()->type)->orderByPageUp()->visible()->get();
				@endphp
				@foreach($menu as $item)
					<li class="nav-item">
						<a class="nav-link" href="{{ route($item->route, ['lang' => $lang]) }}">
							<span class="menu-title">{{ $item["name_$lang"] }}</span>  
							@php 
								$count = false;
								if($item->route == 'enrollment') {
									$count = \App\Models\Tips::confirmed()
							                               ->where('id_user', \Auth::user()->id)
							                               ->where('open', '1')
							                               ->count();
								} if($item->route == 'account') {
									$count = \App\Models\LocationUser::where('status', 'pending')
								                                     ->where('id_user', \Auth::user()->id) 
								                                     ->count();
								}
							@endphp
						 
							@if(@$count)
								<span class="num-span">{{ $count }}</span>
							@endif
							  
							{!! $item["icon"] !!}
						</a>
					</li> 
				@endforeach 
			</ul>
		</nav>
		<!-- partial -->
		<div class="main-panel {{ in_array(uri(3), ['account', 'contact-us']) ? 'profile-page' : '' }}">
			<div class="content-wrapper">

				@if(request()->session()->has('lk_success'))
					<div class="row" id="proBanner">
						<div class="col-12">
	                        <span class="d-flex align-items-center purchase-popup" style="justify-content: space-between;">
			                  <p>{{ request()->session()->get('lk_success') }}</p>
			              
			                  <i class="mdi mdi-close" id="bannerClose"></i>
			                </span>
						</div>
					</div>
				@endif
  				 
  				@yield('content')

			</div>
			<!-- content-wrapper ends -->
			<!-- partial -->
		</div>
		<!-- main-panel ends -->
	</div>
	<!-- page-body-wrapper ends -->
	
	<!-- partial:partials/_footer.html -->
	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4">
					<img src="{{ asset('profile_theme') }}/assets/images/logo-white.png" alt="logo">
					<p>Сервис для оплаты чаевых <br> безналичным расчетом</p>
					<p class="small">© {{ request()->server('SERVER_NAME') }}</p>
				</div>
				<div class="col-md-4 text-center align-center ft-payments">
					<div class="partners">
						<img src="{{ asset('profile_theme') }}/assets/images/socials/visa-big.png" alt="visa">
						<img src="{{ asset('profile_theme') }}/assets/images/socials/mastercard.png" alt="mastercard">
						<img src="{{ asset('profile_theme') }}/assets/images/socials/mir.png" alt="mir">
					</div>
					<a href="#" class="policy">Политики конфиденциальности</a>
				</div>
				<div class="col-md-4 align-center ft-socials">
					<p class="medium">Мы в соц. сетях:</p>
					<div class="social_link">
						<a href="https://www.facebook.com/chaevieonline" target="_blank">
							<img src="{{ asset('profile_theme') }}/assets/images/socials/facebook.png" alt="facebook">
						</a>
						<a href="https://vk.com/chaevieonline" target="_blank"><img src="{{ asset('profile_theme') }}/assets/images/socials/vk.png" alt="vk"></a>
						<a href="tg://resolve?domain=chaevieonline_bot" target="_blank">
							<img src="{{ asset('img') }}/telegram.png" alt="telegram"> 
                        </a>
						<a href="https://www.instagram.com/chaevieonline/" target="_blank">
							<img src="{{ asset('profile_theme') }}/assets/images/socials/instagram.png" alt="instagram">
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('profile_theme') }}/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('profile_theme') }}/assets/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('profile_theme') }}/assets/js/off-canvas.js"></script>
<script src="{{ asset('profile_theme') }}/assets/js/hoverable-collapse.js"></script>
<script src="{{ asset('profile_theme') }}/assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('profile_theme') }}/assets/js/dashboard.js"></script>
<script src="{{ asset('profile_theme') }}/assets/js/todolist.js"></script>
<!-- End custom js for this page -->

<script src="{{ asset('js/inputmask.min.js') }}?v={{ time() }}"></script>
<script src="/js/ajax.js?v={{ time() }}"></script>
<script src="/js/notify.js?v={{ time() }}"></script>
<script src="{{ asset('profile_theme') }}/assets/js/main.js?v={{ time() }}"></script>

<script src="{{ asset('js/cropperjs/dist/cropper.js') }}"></script>
<script src="{{ asset('js/bar-rating/jquery.barrating.js') }}"></script>
<script src="https://use.fontawesome.com/7d23dee490.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
 
<script src="{{ asset('profile_theme') }}/assets/js/jquery-ui.js"></script>  

<!-- file uploader -->
<script src="{{ asset('js') }}/fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>

@if($lang == 'ru')
<script src="{{ asset('profile_theme') }}/assets/js/datepicker-ru.js"></script>
@endif
 
<div id="ajax-notify">
    <div class="notify-inner"></div>
</div>
 
</body>
</html>