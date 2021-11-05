@extends('layouts.layout')
@section('title','Đặt hàng')

@section('headerScrol')
<header id="headerScroll" style="background-color: #3399FF;height: 50px;">
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
<link rel="stylesheet" href="{{ asset('public/theme_fontend/css/carts.css') }}">
<nav id="menu">
	<ul>
		<li class="menu-item">danh mục sản phẩm</li>
		@foreach($category as $item)
		<li class="menu-item"><a href="{{ route('getCategory',['id'=>$item->c_id,'slug'=>$item->c_slug]) }}" title=""><i class="{{ $item->c_icon }}" style="padding-right: 10px;"></i> {{ $item->c_name }} ({{ $item->c_total_product }})</a></li>
		@endforeach
	</ul>
</nav>
<script>
	window.onscroll = function() {myFunction()};		
	var menus = document.getElementById("menu");
	var menuSc = document.getElementById("header");
	var st = menuSc.offsetTop;
	function myFunction() {			
		if (window.pageYOffset > st) {
			menus.classList.add("menuSco");								
		} else {
			menus.classList.remove("menuSco");
		}
	}
</script>
@endsection

@section('main')
<script type="text/javascript">
	function updateCart(qty, rowId){
		$.get(
			'{{ route('updateCart') }}',
			{ qty:qty,rowId:rowId },
			function(){
				location.reload();
			}
			);
	}
</script>
<div id="wrap-inner">
	<div id="list-cart">
		<?php
		$message = Session::get('error');
		if ($message){
			echo '<p class="alert alert-danger">',$message ,'</p>';
			Session::put('error',null);
		}
		?>
		@if(Cart::count()>0)
		<h3>Giỏ hàng</h3>
		
		<table class="table table-bordered .table-responsive text-center">
			<tr class="active">
				<td style="width: 11.112%;">Ảnh mô tả</td>
				<td style="width: 22.222%;">Tên sản phẩm</td>
				<td style="width: 22.222%;">Số lượng</td>
				<td style="width: 16.6665%;">Đơn giá</td>
				<td style="width: 16.6665%;">Thành tiền</td>
				<td style="width: 11.112%;">Xóa</td>
			</tr>

			@foreach($items as $item)
			<tr>
				<td><img class="img-responsive" style="width: 180px; height: 150px;" src="{{asset('/storage/app/avatar/'.$item->options->img)}}"></td>
				<td>{{ $item->name }}</td>
				<td width="22.222%" >
					<div class="form-group">
						<input class="form-control" type="number" value="{{ $item->qty }}" onchange="updateCart(this.value,'{{ $item->rowId }}')">
					</div>
				</td>
				<td><span class="price" style="font-size: 14px;">{{number_format($item->price,0,',','.')}}đ</span></td>
				<td><span class="price" style="font-size: 14px;">{{number_format($item->price*$item->qty,0,',','.')}}đ</span></td>
				<td><a href="{{ route('deleteProduct',$item->rowId) }}">Xóa</a></td>
			</tr>
			@endforeach

		</table>
		<div class="row" id="total-price">
			<div class="col-md-6 col-sm-12 col-xs-12">										
				Tổng thanh toán: <span class="total-price">{{ $total }}đ</span>

			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				
				<a href="{{ route('deleteProduct','all') }}" class="my-btn btn float-right" >Xóa giỏ hàng</a>
				<a href="{{ route('home') }}" class="my-btn btn float-right" style="margin-right:10px; ">Mua tiếp</a>
			</div>
		</div>
		<div id="xac-nhan" >
			<h3>Xác nhận mua hàng</h3>
			<form method="POST"  enctype="multipart/form-data" >
				@csrf
				<div class="form-group">
					<label for="email">Email address:</label>
					<input required type="email" class="form-control" id="email" name="email" value="<?php if ($infoUser != null) echo $infoUser->email ?>">
				</div>
				<div class="form-group">
					<label for="name">Họ và tên:</label>
					<input required type="text" class="form-control" id="name" name="name" value="<?php if ($infoUser != null) echo $infoUser->name ?>">
				</div>
				<div class="form-group">
					<label for="phone">Số điện thoại:</label>
					<input required type="number" class="form-control" id="phone" name="phone" value="<?php if ($infoUser != null) echo $infoUser->phone ?>">
				</div>
				<div class="form-group">
					<label for="add">Địa chỉ:</label>
					<input required type="text" class="form-control" id="add" name="add">
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default">Thực hiện đơn hàng</button>
				</div>
			</form>
		</div>        	          
		@else 
		<div style = "height: 510px;">
			<a href="{{ route('home') }} " style="text-decoration: none; color: #FF99CC	; font-size: 30px;">Giỏ hàng rỗng. Quay lại trang chủ.</a>
		</div>
		
		@endif     

	</div>


</div>		

@endsection
@section('userlogin')
@if($checklogin==1)
<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('getShow') }}"><?php echo Auth::user()->name; ?></a>
@else
<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('loginUser') }}">Đăng nhập</a>
@endif
@endsection