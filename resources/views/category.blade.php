@extends('layouts.layout')
@section('title','Danh mục sản phẩm')
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
<link rel="stylesheet" href="{{ asset('public/theme_fontend/css/categorycs.css') }}">
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

<div id="wrap-inner">
	<div class="products">
		<h3>{{ $cateName->c_name }}</h3>
		<div class="product-list row">
			@foreach($prodcate as $item)

			<div class="product-item col-md-4 col-sm-6 col-xs-12">
				<a href="#"><img src="{{asset('/storage/app/avatar/'.$item->p_image)}}" class="img-thumbnail"></a>
				<p><a href="#">{{$item->p_name}}</a></p>
				<p class="price"><del>{{number_format($item->p_price,0,',','.')}}đ</del> <span style="font-size: 12px; ">(-{{ $item->p_promotion }}%)</span></p>	  
				<p class="price">{{number_format($item->p_price-$item->p_price*$item->p_promotion/100,0,',','.')}}đ</p>	  
				<p>@if($item->p_status == 1) <span style="color: #2cc067; font-size: 16px;"><i class="fa fa-check"> Còn hàng</i></span> @else <span style="color: red; font-size: 16px;"><i class="fa fa-times"> Hết hàng</i></span> @endif</p> 
				<div class="marsk">
					<a href="{{ route('getDetails',['id'=>$item->p_id,'slug'=>$item->p_slug]) }}">Xem chi tiết </a>
				</div>                                    
			</div>

			@endforeach  
			
		</div>                	                	
	</div>

	<div id="pagination">
		<ul class="pagination pagination-lg justify-content-center">
			{{ $prodcate->links('vendor/pagination/bootstrap-4') }};
		</ul>
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