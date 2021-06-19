@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.get.list.product') }}">Danh mục sản phẩm</a></li>
			<li class="breadcrumb-item active" aria-current="page">Thêm danh mục sản phẩm</li>
		</ol>
	</div>
	
</div>

<div class="row">
	
	<div class="col-lg-12">

		<section class="panel">
			<header class="panel-heading">
				Thêm danh mục sản phẩm
			</header>
			<div class="panel-body">
				<form role="form" action="" method="POST" class="form-horizontal ">
					@csrf
					
					@include('admin::category.form')
					<div class="form-group">
						<div class="text-center">
							<button class="btn btn-success" type="submit">Thêm danh mục</button>
						</div>
					</div>

				</form>
			</div>

		</section>
	</div>
</div>

@stop