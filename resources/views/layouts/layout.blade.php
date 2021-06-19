<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Web bán hàng - @yield('title')</title>
	<link rel="stylesheet" href="{{asset('public/theme_fontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/theme_fontend/css/homecss.css')}}">
	<script type="text/javascript" src="{{asset('public/theme_fontend/js/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/theme_fontend/js/js-zoom_image.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="{{asset('public/theme_fontend/js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>    
	<!-- header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<h1>
						<a href="{{ route('home') }}"><img style="width: 300px; height: 98px;" src="{{ asset('public/theme_fontend/img/home/logoB.png') }}"></a>						
						<nav><a id="pull" class="btn btn-danger" href="#">
							<i class="fa fa-bars"></i>
						</a></nav>			
					</h1>
				</div>
				<div id="search" class="col-md-7 col-sm-12 col-xs-12">
					<form method="get" action="{{ route('search') }}" enctype="multipart/form-data" role ="search" class="navbar-form">
						<div class="input-group">
							<div class="input-group-btn">
								<input type="text" class="form-control" placeholder="Search" name="result">
							</div>
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</div>

					</form>
				</div>
				<div id="cart" class="col-md-2 col-sm-12 col-xs-12">
					<a class="display" href="{{ route('getShow') }}">Giỏ hàng</a>
					<a href="{{ route('getShow') }}"><?php echo Cart::count(); ?></a>				    
				</div>
			</div>			
		</div>
	</header><!-- /header -->
	<!-- endheader -->

	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-4">
					@yield('left')

					<div id="banner-l" class="text-center">
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-1.png" alt="" class="img-thumbnail"></a>
						</div>
						
					</div>
				</div>

				<div id="main" class="col-md-8">
					<!-- main -->
					@yield('slide')

					<div id="banner-t" class="text-center">
						<div class="row">
							
							
						</div>					
					</div>

					{{-- main --}}

					@yield('main')

					<!-- end main -->
				</div>
			</div>
		</div>
	</section>
	<!-- endmain -->

	<!-- footer -->
	<footer id="footer">			
		<div id="footer-t">
			<div class="container">
				<div class="row">				
					<div id="logo-f" class="col-md-3 col-sm-12 col-xs-12 text-center">						
						<a href="#"><img style="width: 300px; height: 98px;" src="{{ asset('public/theme_fontend/img/home/logoB.png') }}"></a>		
					</div>
					<div id="about" class="col-md-3 col-sm-12 col-xs-12">
						<h3>About us</h3>
						<p class="text-justify">.......</p>
					</div>
					<div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
						<h3>Hotline</h3>
						<p>Phone Sale: (+84) 961653561</p>
						<p>Email: thteam47@gmail.com</p>
					</div>
					<div id="contact" class="col-md-3 col-sm-12 col-xs-12">
						<h3>Contact Us</h3>
						<p>Hà Nội</p>
						<p>Hải Dương</p>
					</div>
				</div>				
			</div>
			<div id="footer-b">				
				<div class="container">
					<div class="row">
						<div id="footer-b-l" class="col-md-6 col-sm-12 col-xs-12 text-center">
							<p>HTC</p>
						</div>
						<div id="footer-b-r" class="col-md-6 col-sm-12 col-xs-12 text-center">
							<p>© HTC. All Rights Reserved</p>
						</div>
					</div>
				</div>
				<div id="scroll" style="position: fixed; margin-top: 300px">
					<a href="#"><img src="{{ asset('public/theme_fontend/img/home/scroll.png') }}"></a>
				</div>	
			</div>
		</div>
	</footer>
	<!-- endfooter -->
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
	
	<script>
		imageZoom("myimage", "myresult");
	</script>
</body>
</html>