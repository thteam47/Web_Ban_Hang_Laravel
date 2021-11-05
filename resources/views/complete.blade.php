@extends('layouts.layout')
@section('title','Hoàn thành')

@section('headerScrol')
<header id="headerScroll" style="background-color: #3399FF; height: 50px;">
	<div class="container">				
		<div id="search" style="height: 50px; margin:auto;" class="col-md-7 col-sm-12 col-xs-12">
			<form method="get"  action="{{ route('search') }}" enctype="multipart/form-data" role ="search" class="navbar-form">
				<div class="input-group" style="width: 500px; margin: auto; padding-top: 10px;">
					<div class="input-group-btn" style="width: 90%;">
						<input type="text" style="margin: auto; height: 30px;" class="form-control" placeholder="Search" name="result">
					</div>
					<div class="input-group-btn" style="width: 10%;">
						<button class="btn btn-default" style="margin: auto; height: 30px;" type="submit"><i class="fa fa-search"></i></button>
					</div>
				</div>

			</form>
		</div>			
	</div>
</header>
@endsection

@section('left')
<link rel="stylesheet" href="{{ asset('public/theme_fontend/css/completecs.css') }}">

@endsection

@section('main')
<div id="wrap-inner">
	<div id="complete">
		<p class="info">Quý khách đã đặt hàng thành công!</p>
		<p>• Hóa đơn mua hàng của Quý khách đã được chuyển đến Địa chỉ Email có trong phần Thông tin Khách hàng của chúng Tôi</p>
		<p>• Sản phẩm của Quý khách sẽ được chuyển đến Địa có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.</p>
		<p>• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng</p>
		<p>Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</p>
	</div>
	<p class="text-right return"><a href="{{ route('home') }}">Quay lại trang chủ</a></p>
</div>		

@endsection
@section('userlogin')
	@if($checklogin==1)
	<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('getShow') }}"><?php echo Auth::user()->name; ?></a>
	@else
	<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('loginUser') }}">Đăng nhập</a>
	@endif
@endsection