@extends('layouts.layout')
@section('title','Trang chủ')

@section('left')
<nav id="menu">
	<ul>
		<li class="menu-item">danh mục sản phẩm</li>
		@foreach($category as $item)
		<li class="menu-item"><a href="{{ route('getCategory',['id'=>$item->c_id,'slug'=>$item->c_slug]) }}" title=""><i class="{{ $item->c_icon }}" style="padding-right: 10px;"></i> {{ $item->c_name }} ({{ $item->c_total_product }})</a></li>
		@endforeach
	</ul>
</nav>
<div id="banner-l" class="text-center">
	@foreach ($advs as $adv)
	<div class="banner-l-item">
		<a href="{{ $adv->adv_link }}"><img src="{{ asset('/storage/app/advImg/'.$adv->adv_img) }}" alt="" class="img-thumbnail"></a>
	</div>
	@endforeach
</div>

@endsection
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
@section('slide')
<!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
<div id="slider">
	<div id="demo" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ul class="carousel-indicators">
			@for($i=0; $i <$count_bans;$i++) 
			@if($i==0) 
			<li data-target="#demo" data-slide-to="$i" class="active"></li>;
			@else 
			<li data-target="#demo" data-slide-to="$i"></li>;
			@endif
			@endfor

			{{-- <li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li> --}}
		</ul>

		<!-- The slideshow -->
		<div class="carousel-inner">
			{{-- <div class="carousel-item active">
				<img src="{{asset('public/theme_fontend/img/home/slide-1.png')}}" alt="Los Angeles" >
			</div>
			<div class="carousel-item">
				<img src="{{asset('public/theme_fontend/img/home/slide-2.png')}}" alt="Chicago">
			</div>
			<div class="carousel-item">
				<img src="{{asset('public/theme_fontend/img/home/slide-3.png')}}" alt="New York" >
			</div> --}}
			<?php $i=1; ?>
			@foreach ($bans as $ban)
			@if($i==1) 
			<div class="carousel-item active">
				<a href="{{ $ban->ban_link }}"><img src="{{ asset('/storage/app/banImg/'.$ban->ban_img) }}" alt="" class="img-thumbnail"></a>
			</div>
			@else 
			<div class="carousel-item">
				<a href="{{ $ban->ban_link }}"><img src="{{ asset('/storage/app/banImg/'.$ban->ban_img) }}" alt="" class="img-thumbnail"></a>
			</div>
			@endif
			<?php $i++; ?>
			@endforeach
		</div>
		<!-- Left and right controls -->
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
</div>
@endsection
@section('main')
<div id="wrap-inner">
	<div class="products">
		<h2 style="padding: 10px;">sản phẩm nổi bật</h2>
		<div class="product-list row">
			@foreach($hot as $item)
			<div class="product-item col-md-4 col-sm-6 col-xs-12" style="border-radius: 20px; padding: 10px; ">
				<a href="#"><img style="border-radius: 20px; padding: 10px; " src="{{asset('/storage/app/avatar/'.$item->p_image)}}" class="img-thumbnail"></a>
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
	<div class="products">
		<h2 style="padding: 10px;">sản phẩm mới</h2>
		<div class="product-list row">
			@foreach($news as $item)
			<div class="product-item col-md-4 col-sm-6 col-xs-12" style="border-radius: 20px; padding: 10px; ">
				<a href="#"><img style="border-radius: 20px; padding: 10px; " src="{{asset('/storage/app/avatar/'.$item->p_image)}}" class="img-thumbnail"></a>
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
	@if($category)
	<div class="products">
		@foreach($category as $cate )
		@if($cate->c_total_product>0)
		<h2 style="padding: 10px;"><a  style="color: #ff9600; text-decoration: none;" href="{{ route('getCategory',['id'=>$cate->c_id,'slug'=>$cate->c_slug]) }}">{{ $cate->c_name }}</a></h2>
		<div class="product-list row">	
			<?php $i=1; ?>		
			@foreach($pros as $item)			
			@if ($item->prod_cate == $cate->c_id && $i<7)
			<div class="product-item col-md-4 col-sm-6 col-xs-12" style="border-radius: 20px; padding: 10px; ">
				<a href="#"><img style="border-radius: 20px; padding: 10px; " src="{{asset('/storage/app/avatar/'.$item->p_image)}}" class="img-thumbnail"></a>
				<p><a href="#">{{$item->p_name}}</a></p>
				<p class="price"><del>{{number_format($item->p_price,0,',','.')}}đ</del> <span style="font-size: 12px; ">(-{{ $item->p_promotion }}%)</span></p>	  
				<p class="price">{{number_format($item->p_price-$item->p_price*$item->p_promotion/100,0,',','.')}}đ</p>	  
				<p>@if($item->p_status == 1) <span style="color: #2cc067; font-size: 16px;"><i class="fa fa-check"> Còn hàng</i></span> @else <span style="color: red; font-size: 16px;"><i class="fa fa-times"> Hết hàng</i></span> @endif</p>
				<div class="marsk">
					<a href="{{ route('getDetails',['id'=>$item->p_id,'slug'=>$item->p_slug]) }}">Xem chi tiết </a>
				</div>                                    
			</div>
			<?php $i++; ?>
			@endif
			@endforeach    
		</div>  
		@endif
		@endforeach
	</div>
	@endif
</div>

@endsection
@section('userlogin')
	@if($checklogin==1)
	<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('profile') }}"><?php echo Auth::user()->name; ?></a>
	@else
	<a class="login" style="color: white;text-align: center;margin:auto; font-size: 14px;font-weight: bold;" href="{{ route('loginUser') }}">Đăng nhập</a>
	@endif
@endsection